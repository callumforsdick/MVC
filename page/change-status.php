<?php

$foc = Utils::getFocByGetId();
$foc->setStatus(Utils::getUrlParam('status'));
if (array_key_exists('comment', $_POST)) {
    $foc->setComment($_POST['comment']);
}

$dao = new FocDao();
$dao->save($foc);
Flash::addFlash('status changed successfully.');

Utils::redirect('detail', array('id' => $foc->getId()));
