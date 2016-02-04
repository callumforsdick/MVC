<?php
// data for template
$foc = Utils::getFocByGetId();
$tooLate = $foc->getStatus() == Foc::STATUS_PENDING && $foc->getDueOn() < new DateTime();
