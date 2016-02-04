<!DOCTYPE html>
<head>
    <title>Users</title>
</head>
<?php
$errors = array();
$Users = null;
$edit = array_key_exists('id', $_GET);
if ($edit) {
    $Users = Utils::getFocByGetId();
} else {
    // set defaults
    $Users = new Foc();
    $Users->setPriority(Foc::PRIORITY_MEDIUM);
    $dueOn = new DateTime("+1 day");
    $dueOn->setTime(0, 0, 0);
    $Users->setDueOn($dueOn);
}

if (array_key_exists('cancel', $_POST)) {
    // redirect
    Utils::redirect('detail', array('id' => $Users->getId()));
} elseif (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['foc']
    $data = array(
        'username' => $_POST['Users']['username'],
        'firsname' => $_POST['Users']['firsname'],
        'lastname' => $_POST['Users']['lastname'],
        'email' => $_POST['Users']['email'],
        'password' => $_POST['Users']['password'],
    );
        ;
    // map
    UsersMapper::map($Users, $data);
    // validate
    $errors = UsersValidator::validate($Users);
    // validate
    if (empty($errors)) {
        // save
        $dao = new FocDao();
        $Users = $dao->save($Users);
        Flash::addFlash('Changes saved successfully.');
        // redirect
        Utils::redirect('detail', array('id' => $Users->getId()));
    }
}
