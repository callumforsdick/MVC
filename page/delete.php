<?php

$foc = Utils::getFocByGetId();

$dao = new FocDao();
$dao->delete($foc->getId());
Flash::addFlash('User deleted successfully.');

Utils::redirect('list', array('status' => $foc->getStatus()));
