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
     * @param FOc $Users
     *  {@link Foc} instance to be validated
     * @return array array of {@link Error} s
     */
    public static function validate(Users $Users) {
        $errors = array();
        if (!$Users->getCreatedOn()) {
            $errors[] = new Error('createdOn', 'Empty or invalid Created On.');
        }
        if (!$Users->getLastModifiedOn()) {
            $errors[] = new Error('lastModifiedOn', 'Empty or invalid Last Modified On.');
        }
        if (!trim($Users->getTitle())) {
            $errors[] = new Error('title', 'Title cannot be empty.');
        }
        if (!$Users->getDueOn()) {
            $errors[] = new Error('dueOn', 'Empty or invalid Due On.');
        }
        if (!trim($Users->getPriority())) {
            $errors[] = new Error('priority', 'Priority cannot be empty.');
        } elseif (!self::isValidPriority($Users->getPriority())) {
            $errors[] = new Error('priority', 'Invalid Priority set.');
        }
        if (!trim($Users->getStatus())) {
            $errors[] = new Error('status', 'Status cannot be empty.');
        } elseif (!self::isValidStatus($Users->getStatus())) {
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
        return in_array($status, Users::allStatuses());
    }

    private static function isValidPriority($priority) {
        return in_array($priority, Users::allPriorities());
    }

}
