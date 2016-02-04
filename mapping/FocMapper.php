<!DOCTYPE html>
<head>
    <title>foc</title>
</head>
<?php
/**
 * Mapper for {@link Foc} from array.
 * @see FocValidator
 */
final class FocMapper {

    private function __construct() {
    }

    /**
     * Maps array to the given {@link Foc}.
     * <p>
     * Expected properties are:
     * <ul>
     *   <li>id</li>
     *   <li>priority</li>
     *   <li>created_on</li>
     *   <li>due_on</li>
     *   <li>last_modified_on</li>
     *   <li>title</li>
     *   <li>description</li>
     *   <li>comment</li>
     *   <li>status</li>
     *   <li>deleted</li>
     * </ul>
     * @param Foc $foc
     * @param array $properties
     */
    public static function map(Foc $foc, array $properties) {
        if (array_key_exists('id', $properties)) {
            $foc->setId($properties['id']);
        }
        if (array_key_exists('priority', $properties)) {
            $foc->setPriority($properties['priority']);
        }
        if (array_key_exists('created_on', $properties)) {
            $createdOn = self::createDateTime($properties['created_on']);
            if ($createdOn) {
                $foc->setCreatedOn($createdOn);
            }
        }
        if (array_key_exists('due_on', $properties)) {
            $dueOn = self::createDateTime($properties['due_on']);
            if ($dueOn) {
                $foc->setDueOn($dueOn);
            }
        }
        if (array_key_exists('last_modified_on', $properties)) {
            $lastModifiedOn = self::createDateTime($properties['last_modified_on']);
            if ($lastModifiedOn) {
                $foc->setLastModifiedOn($lastModifiedOn);
            }
        }
        if (array_key_exists('title', $properties)) {
            $foc->setTitle(trim($properties['title']));
        }
        if (array_key_exists('description', $properties)) {
            $foc->setDescription(trim($properties['description']));
        }
        if (array_key_exists('comment', $properties)) {
            $foc->setComment(trim($properties['comment']));
        }
        if (array_key_exists('status', $properties)) {
            $foc->setStatus($properties['status']);
        }
        if (array_key_exists('deleted', $properties)) {
            $foc->setDeleted($properties['deleted']);
        }
    }

    private static function createDateTime($input) {
        return DateTime::createFromFormat('Y-n-j H:i:s', $input);
    }

}
