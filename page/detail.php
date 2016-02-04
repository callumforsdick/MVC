<?php
// data for template
$Users = Utils::getFocByGetId();
$tooLate = $Users->getStatus() == Users::STATUS_PENDING && $Users->getDueOn() < new DateTime();
