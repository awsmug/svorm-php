<?php
/**
 * Class Fieldset.
 *
 * @since 1.0.0
 */

namespace Svorm\Form;

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
     * @param HasFieldsetData $fieldsetData The fieldset data object.
     * @param array           $formValues   The form values.
     *
     * @since 1.0.0
     */
    public function __construct(HasFieldsetData $fieldsetData, $formValues = [])
    {
        $this->id = $fieldsetData->id;
        $this->legend = $fieldsetData->legend;
        $this->nextFieldset = $fieldsetData->nextFieldset;
        $this->prevFieldset = $fieldsetData->prevFieldset;

        foreach ($fieldsetData->fields as $fieldData) {
            if ($fieldData->multiple === true) {
                $this->fields[] = new MultipleField($fieldData, $formValues);
            } else {
                $this->fields[] = new SingleField($fieldData, $formValues);
            }
        }

        $this->conditions = new Conditions($fieldsetData->conditions, $formValues);
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
