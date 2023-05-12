<?php
/**
 * Class Fieldset.
 *
 * @since 1.0.0
 */

namespace Svorm\Form;

use Svorm\Helpers\Conditions;
use Svorm\Fields\MultipleField;
use Svorm\Fields\SingleField;

class Fieldset
{
    /**
     * @var string The ID of the fieldset.
     */
    public $id;

    /**
     * @var string The legend of the fieldset.
     */
    public $legend;

    /**
     * @var array An array of fields belonging to the fieldset.
     */
    public $fields = [];

    /**
     * @var string|null The ID of the next fieldset.
     */
    public $nextFieldset;

    /**
     * @var string|null The ID of the previous fieldset.
     */
    public $prevFieldset;

    /**
     * @var Conditions The conditions for the fieldset.
     */
    public $conditions;

    /**
     * Constructor.
     *
     * @param \stdClass $fieldsetData The fieldset data object.
     * @param array     $formValues   The form values.
     *
     * @since 1.0.0
     */
    public function __construct(\stdClass $fieldsetData, $formValues = [])
    {
        foreach ($fieldsetData->fields as $fieldData) {
            if (isset($fieldData->multiple) && $fieldData->multiple === true) {
                $this->fields[] = new MultipleField($fieldData, $formValues);
            } else {
                $this->fields[] = new SingleField($fieldData, $formValues);
            }
        }

        if(isset($fieldsetData->conditions) ) {
            $this->conditions = new Conditions($fieldsetData->conditions, $formValues);
        }
    }

    /**
     * Validate the fieldset.
     * 
     * @return bool True if the fieldset is valid, false otherwise.
     * 
     * @since 1.0.0
     */
    public function validate(): bool
    {
        $valid = true;

        foreach ($this->fields as $field) {
            if ($field->validate() === false) {
                $valid = false;
            }
        }

        return $valid;
    }

    /**
     * Get the errors of the fieldset.
     * 
     * @return array An array of errors.
     * 
     * @since 1.0.0
     */
    public function getValidationErrors(): array
    {
        $errors = [];

        foreach ($this->fields as $field) {
            $errors = array_merge($errors, $field->getValidationErrors());
        }

        return $errors;
    }

    /**
     * Check if the fieldset has a next fieldset.
     *
     * @return bool True if the fieldset has a next fieldset, false otherwise.
     */
    public function hasNext(): bool
    {
        return $this->nextFieldset !== null;
    }

    /**
     * Check if the fieldset has a previous fieldset.
     *
     * @return bool True if the fieldset has a previous fieldset, false otherwise.
     */
    public function hasPrev(): bool
    {
        return $this->prevFieldset !== null;
    }
}
