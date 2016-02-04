<?php

$Users = Utils::getUsersByGetId();

$dao = new UsersDao();
$dao->delete($Users->getId());
Flash::addFlash('User deleted successfully.');

Utils::redirect('list', array('status' => $Users->getStatus()));
