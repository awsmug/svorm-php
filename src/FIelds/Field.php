<?php
/**
 * Field class.
 *
 * @since 1.0.0
 */
namespace Svorm\Fields;

use Svorm\Helpers\Conditions;

abstract class Field
{
    /**
     * ID of the field.
     * 
     * @var string
     * 
     * @since 1.0.0
     */
    protected $id;
    
    /**
     * Values of the form.
     * 
     * @var array 
     * 
     * @since 1.0.0
     */
    protected $formValues = [];
    
    /**
     * The options/choices of the field.
     * 
     * @var array 
     * 
     * @since 1.0.0
     */
    protected $options;

    /**
     * The conditions of the field.
     * 
     * @var array 
     * 
     * @since 1.0.0
     */
    protected $conditions;

    /**
     * The validations of the field.
     * 
     * @var array 
     * 
     * @since 1.0.0
     */
    protected $validations;

    /**
     * The errors of the field.
     * 
     * @var string[]
     * 
     * @since 1.0.0
     */
    protected $validationErrors = [];

    /**
     * Indicates if the field has been validated.
     * 
     * @var bool
     * 
     * @since 1.0.0
     */
    protected $isValidated = false;

    /**
     * Initializing field.
     *
     * @param \stdClass $fieldData  Field data.
     * @param array     $formValues Form values.
     *
     * @since 1.0.0
     */
    public function __construct(\stdClass $fieldData, array $formValues = [])
    {
        $this->id = $fieldData->id;
        $this->formValues = $formValues;
        $this->validations = isset( $fieldData->validations ) ? $fieldData->validations : [];
        $this->conditions = isset( $fieldData->conditions ) ? $fieldData->conditions : [];
    }

    /**
     * Checks if conditions for displaying field are met.
     *
     * @return bool True if conditions are met, false otherwise.
     *
     * @since 1.0.0
     */
    protected function conditionsFulfilled()
    {
        if ($this->conditions === null || count($this->conditions) === 0) {
            return true;
        }

        $conditions = new Conditions($this->conditions, $this->formValues);
        return $conditions->fulfilled();
    }

    /**
     * Get errors of the field.
     *
     * @return string[] Errors of the field.
     *
     * @since 1.0.0
     */
    public function getValidationErrors()
    {
        return $this->validationErrors;
    }

    /**
     * Is field visible.
     *
     * @return bool True if field is visible, false otherwise.
     *
     * @since 1.0.0
     */
    public function isVisible()
    {
        return $this->conditionsFulfilled();
    }

    /**
     * Validate field.
     *
     * @return bool True if field is valid, false otherwise.
     *
     * @since 1.0.0
     */
    abstract public function validate();
}
