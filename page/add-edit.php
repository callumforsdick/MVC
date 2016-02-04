<!DOCTYPE html>
<head>
    <title>foc</title>
</head>
<?php
$errors = array();
$foc = null;
$edit = array_key_exists('id', $_GET);
if ($edit) {
    $foc = Utils::getFocByGetId();
} else {
    // set defaults
    $foc = new Foc();
    $foc->setPriority(Foc::PRIORITY_MEDIUM);
    $dueOn = new DateTime("+1 day");
    $dueOn->setTime(0, 0, 0);
    $foc->setDueOn($dueOn);
}

if (array_key_exists('cancel', $_POST)) {
    // redirect
    Utils::redirect('detail', array('id' => $foc->getId()));
} elseif (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['foc']
    $data = array(
        'username' => $_POST['foc']['username'],
        'firsname' => $_POST['foc']['firsname'],
        'lastname' => $_POST['foc']['lastname'],
        'email' => $_POST['foc']['email'],
        'password' => $_POST['foc']['password'],
    );
        ;
    // map
    FocMapper::map($foc, $data);
    // validate
    $errors = FocValidator::validate($foc);
    // validate
    if (empty($errors)) {
        // save
        $dao = new FocDao();
        $foc = $dao->save($foc);
        Flash::addFlash('Changes saved successfully.');
        // redirect
        Utils::redirect('detail', array('id' => $foc->getId()));
    }
}
