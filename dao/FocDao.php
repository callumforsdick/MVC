<!DOCTYPE html>
<head>
    <title>Users</title>
</head>
<?php
final class UsersDao {

    /** @var PDO */
    private $db = null;


    public function __destruct() {
        // close db connection
        $this->db = null;
    }

    /**
     * Find all {@link Foc}s by search criteria.
     * @return array array of {@link Foc}s
     */
    public function find(FocSearchCriteria $search = null) {
        $result = array();
        foreach ($this->query($this->getFindSql($search)) as $row) {
            $Users = new Users();
            UsersMapper::map($Users, $row);
            $result[$Users->getId()] = $Users;
        }
        return $result;
    }

    /**
     * Find {@link Foc} by identifier.
     * @return Users Foc or <i>null</i> if not found
     */
    public function findById($id) {
        $row = $this->query('SELECT * FROM Users WHERE deleted = 0 and id = ' . (int) $id)->fetch();
        if (!$row) {
            return null;
        }
        $Users = new Users();
        UsersMapper::map($Users, $row);
        return $Users;
    }

    /**
     * Save {@link Foc}.
     * @param Users $Users {@link Foc} to be saved
     * @return Users saved {@link Foc} instance
     */
    public function save(Users $Users) {
        if ($Users->getId() === null) {
            return $this->insert($Users);
        }
        return $this->update($Users);
    }

    /**
     * Delete {@link Users} by identifier.
     * @param int $id {@link Users} identifier
     * @return bool <i>true</i> on success, <i>false</i> otherwise
     */
    public function delete($id) {
        $sql = '
            UPDATE Users SET
                username = :username,
                password = :password
            WHERE
                id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':username' => self::formatDateTime(new DateTime()),
            ':password' => true,
            ':id' => $id,
        ));
        return $statement->rowCount() == 1;
    }

    /**
     * @return PDO
     */
    private function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        $config = Config::getConfig("db");
        try {
            $this->db = new PDO($config['dsn'], $config['username'], $config['password']);
        } catch (Exception $ex) {
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
        return $this->db;
    }

    private function getFindSql(FocSearchCriteria $search = null) {
        $sql = 'SELECT username, email FROM Users';
        $orderBy = 'username, email';
        if ($search !== null) {
            if ($search->getStatus() !== null) {
                $sql .= 'AND status = ' . $this->getDb()->quote($search->getStatus());
 //               switch ($search->getStatus()) {
 //                   case Users::STATUS_PENDING:
 //                       $orderBy = 'username, email';
 //                       break;
 //                   case Users::STATUS_DONE:
 //                   case Users::STATUS_VOIDED:
 //                       $orderBy = 'username DESC, email';
 //                       break;
 //                   default:
 //                       throw new Exception('No user for status: ' . $search->getStatus());
 //               }
            }
        }
        $sql .= ' ORDER BY ' . $orderBy;
        return $sql;
    }

    /**
     * @return Users
     * @throws Exception
     */
    private function insert(Users $Users) {
        $now = new DateTime();
        $Users->setId(null);
        $Users->setCreatedOn($now);
        $Users->setLastModifiedOn($now);
        $Users->setStatus(Users::STATUS_PENDING);
        $sql = '
            INSERT INTO Users (id, username email, password)
                VALUES (:id, :username, :email, :password)';
        return $this->execute($sql, $Users);
    }

    /**
     * @return Users
     * @throws Exception
     */
    private function update(Users $Users) {
        $Users->setLastModifiedOn(new DateTime());
        $sql = '
            UPDATE Users SET
                username = :username,
                email = :email,
                password = :password,
            WHERE
                id = :id';
        return $this->execute($sql, $Users);
    }

    /**
     * @return Users
     * @throws Exception
     */
    private function execute($sql, Users $Users) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($Users));
        if (!$Users->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('Users with ID "' . $Users->getId() . '" does not exist.');
        }
        return $Users;
    }

    private function getParams(Users $Users) {
        $params = array(
            ':id' => $Users->getId(),
            ':username' => $Users->getUsername(),
            ':email' => $Users->getEmail(),
            ':password' => $Users->getPassword()
        );
        if ($Users->getId()) {
            // unset created date, this one is never updated
            unset($params[':created_on']);
        }
        return $params;
    }

    private function executeStatement(PDOStatement $statement, array $params) {
        if (!$statement->execute($params)) {
            self::throwDbError($this->getDb()->errorInfo());
        }
    }

    /**
     * @return PDOStatement
     */
    private function query($sql) {
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
        if ($statement === false) {
            self::throwDbError($this->getDb()->errorInfo());
        }
        return $statement;
    }

    private static function throwDbError(array $errorInfo) {
        // log error, send email, etc.
        throw new Exception('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
    }

    private static function formatDateTime(DateTime $date) {
        return $date->format(DateTime::ISO8601);
    }

}
