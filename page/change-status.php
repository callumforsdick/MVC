<?php

$Users = Utils::getUsersByGetId();
$Users->setStatus(Utils::getUrlParam('status'));
if (array_key_exists('comment', $_POST)) {
    $Users->setComment($_POST['comment']);
}

$dao = new UsersDao();
$dao->save($Users);
Flash::addFlash('status changed successfully.');

Utils::redirect('detail', array('id' => $Users->getId()));
