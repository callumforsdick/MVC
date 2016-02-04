<?php
/**
 * Validator for {@link Foc}.
 * @see FocMapper
 */
final class FocValidator {

    private function __construct() {
    }

    /**
     * Validate the given {@link Foc} instance.
     * @param FOc $foc {@link Foc} instance to be validated
     * @return array array of {@link Error} s
     */
    public static function validate(Foc $foc) {
        $errors = array();
        if (!$foc->getCreatedOn()) {
            $errors[] = new Error('createdOn', 'Empty or invalid Created On.');
        }
        if (!$foc->getLastModifiedOn()) {
            $errors[] = new Error('lastModifiedOn', 'Empty or invalid Last Modified On.');
        }
        if (!trim($foc->getTitle())) {
            $errors[] = new Error('title', 'Title cannot be empty.');
        }
        if (!$foc->getDueOn()) {
            $errors[] = new Error('dueOn', 'Empty or invalid Due On.');
        }
        if (!trim($foc->getPriority())) {
            $errors[] = new Error('priority', 'Priority cannot be empty.');
        } elseif (!self::isValidPriority($foc->getPriority())) {
            $errors[] = new Error('priority', 'Invalid Priority set.');
        }
        if (!trim($foc->getStatus())) {
            $errors[] = new Error('status', 'Status cannot be empty.');
        } elseif (!self::isValidStatus($foc->getStatus())) {
            $errors[] = new Error('status', 'Invalid Status set.');
        }
        return $errors;
    }

    /**
     * Validate the given status.
     * @param string $status status to be validated
     * @throws Exception if the status is not known
     */
    public static function validateStatus($status) {
        if (!self::isValidStatus($status)) {
            throw new Exception('Unknown status: ' . $status);
        }
    }

    /**
     * Validate the given priority.
     * @param int $priority priority to be validated
     * @throws Exception if the priority is not known
     */
    public static function validatePriority($priority) {
        if (!self::isValidPriority($priority)) {
            throw new Exception('Unknown priority: ' . $priority);
        }
    }

    private static function isValidStatus($status) {
        return in_array($status, foc::allStatuses());
    }

    private static function isValidPriority($priority) {
        return in_array($priority, foc::allPriorities());
    }

}
