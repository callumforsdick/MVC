<!DOCTYPE html>
<head>
    <title>Users</title>
</head>
<?php
/**
 * Mapper for {@link Foc} from array.
 * @see FocValidator
 */
final class UsersMapper {

    private function __construct() {
    }

    /**
     * Maps array to the given {@link Foc}.
     * <p>
     * Expected properties are:
     * <ul>
     *   <li>id</li>
     *   <li>priority</li>
     *   <li>created_on</li>
     *   <li>due_on</li>
     *   <li>last_modified_on</li>
     *   <li>title</li>
     *   <li>description</li>
     *   <li>comment</li>
     *   <li>status</li>
     *   <li>deleted</li>
     * </ul>
     * @param Foc $foc
     * @param array $properties
     */
    public static function map(Users $Users, array $properties) {
        if (array_key_exists('id', $properties)) {
            $Users->setId($properties['id']);
        }
        if (array_key_exists('priority', $properties)) {
            $Users->setPriority($properties['priority']);
        }
        if (array_key_exists('created_on', $properties)) {
            $createdOn = self::createDateTime($properties['created_on']);
            if ($createdOn) {
                $Users->setCreatedOn($createdOn);
            }
        }
        if (array_key_exists('due_on', $properties)) {
            $dueOn = self::createDateTime($properties['due_on']);
            if ($dueOn) {
                $Users->setDueOn($dueOn);
            }
        }
        if (array_key_exists('last_modified_on', $properties)) {
            $lastModifiedOn = self::createDateTime($properties['last_modified_on']);
            if ($lastModifiedOn) {
                $Users->setLastModifiedOn($lastModifiedOn);
            }
        }
        if (array_key_exists('title', $properties)) {
            $Users->setTitle(trim($properties['title']));
        }
        if (array_key_exists('description', $properties)) {
            $Users->setDescription(trim($properties['description']));
        }
        if (array_key_exists('comment', $properties)) {
            $Users->setComment(trim($properties['comment']));
        }
        if (array_key_exists('status', $properties)) {
            $Users->setStatus($properties['status']);
        }
        if (array_key_exists('deleted', $properties)) {
            $Users->setDeleted($properties['deleted']);
        }
    }

    private static function createDateTime($input) {
        return DateTime::createFromFormat('Y-n-j H:i:s', $input);
    }

}
