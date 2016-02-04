<?php

$status = Utils::getUrlParam('status');
UsersValidator::validateStatus($status);

$dao = new UsersDao();
$search = new FocSearchCriteria();
$search->setStatus($status);

// data for template
$title = Utils::capitalize($status) . 'Users';
$Users = $dao->find($search);
