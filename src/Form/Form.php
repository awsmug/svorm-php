<?php
/**
 * Class Form
 *
 * @since 1.0.0
 */

namespace Svorm\Form;
use Svorm\Interfaces\HasFormData;

class Form
{
    /**
     * ID of the form.
     * 
     * @var string
     * 
     * @since 1.0.0
     */
    private $id;
    
    /**
     * Fieldsets of the form.
     * 
     * @var Fieldset[]
     * 
     * @since 1.0.0
     */
    private $fieldsets = [];
    
    /**
     * Values of the form.
     * 
     * @var array 
     * 
     * @since 1.0.0
     */
    private $formValues = [];
    
    /**
     * Current fieldset ID.
     * 
     * @var string
     * 
     * @since 1.0.0
     */
    private $currentFieldsetId = '';

    /**
     * Validation errors.
     * 
     * @var array
     * 
     * @since 1.0.0
     */
    private $validationErrors = [];

    /**
     * Form constructor.
     *
     * @param \stdClass $formData 
     * @param array     $formValues
     *
     * @since 1.0.0
     */
    public function __construct(\stdClass $formData, array $formValues = [])
    {
        $this->formValues = $formValues;

        foreach ($formData->fieldsets as $fieldsetData) {
            $fieldset = new Fieldset($fieldsetData, $formValues);
            array_push($this->fieldsets, $fieldset);
        }
    }

    /**
     * Get form values.
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getValues()
    {
        return $this->formValues;
    }

    /**
     * Validate form.
     * 
     * @return boolean
     * 
     * @since 1.0.0
     */
    public function validate()
    {
        $this->validationErrors = [];

        foreach ($this->fieldsets as $fieldset) {
            $fieldset->validate();
            $this->validationErrors = array_merge($this->validationErrors, $fieldset->getValidationErrors());
        }

        return empty($this->validationErrors);
    }

    /**
     * Get validation errors.
     * 
     * @return array
     * 
     * @since 1.0.0
     */
    public function getValidationErrors()
    {
        return $this->validationErrors;
    }
}