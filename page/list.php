<?php

$status = Utils::getUrlParam('status');
FocValidator::validateStatus($status);

$dao = new FocDao();
$search = new FocSearchCriteria();
$search->setStatus($status);

// data for template
$title = Utils::capitalize($status) . 'Foc';
$foc = $dao->find($search);
