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
     * @var string
     */
    private $_id;
    
    /**
     * @var Fieldset[]
     */
    private $_fieldsets = [];
    
    /**
     * @var array 
     */
    private $_formValues = [];
    
    /**
     * @var string
     */
    private $_currentFieldsetId = '';

    /**
     * Form constructor.
     *
     * @param array $formData 
     * @param array $formValues
     *
     * @since 1.0.0
     */
    public function __construct(HasFormData $formData, array $formValues = [])
    {
        $this->_id = $formData->id;
        $this->_currentFieldsetId = $formData->fieldsets[0]->id;
        $this->_formValues = $formValues;

        foreach ($formData->fieldsets as $fieldsetData) {
            $fieldset = new Fieldset($fieldsetData, $formValues);
            array_push($this->_fieldsets, $fieldset);
        }
    }

    /**
     * Set current fieldset.
     *
     * @param string $fieldsetId
     *
     * @since 1.0.0
     */
    public function setCurrentFieldset($fieldsetId)
    {
        if (!$this->fieldsetExists($fieldsetId)) {
            error_log('Fieldset with id "' . $fieldsetId . '" does not exist.');
            return;
        }

        $this->_currentFieldsetId = $fieldsetId;
    }

    /**
     * Check if fieldset exists.
     *
     * @param  string $fieldsetId Fieldset id.
     * @return bool True if fieldset exists, false if not.
     *
     * @since 1.0.0
     */
    public function fieldsetExists(string $fieldsetId): bool
    {
        foreach ($this->_fieldsets as $fieldset) {
            if ($fieldset->id === $fieldsetId) {
                return true;
            }
        }
        return false;
    }


    /**
     * Get current fieldset id.
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getCurrentFieldsetId()
    {
        return $this->_currentFieldsetId;
    }

    /**
     * Get current fieldset.
     *
     * @return Fieldset|null
     *
     * @since 1.0.0
     */
    public function getCurrentFieldset()
    {
        foreach ($this->_fieldsets as $fieldset) {
            if ($fieldset->id === $this->_currentFieldsetId) {
                return $fieldset;
            }
        }
        return null;
    }

    /**
     * Get value by field id.
     *
     * @param string $fieldId
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getValue($fieldId)
    {
        return $this->_formValues[$fieldId];
    }

    /**
     * Set value by field id.
     *
     * @param string $fieldId
     * @param mixed  $value
     *
     * @since 1.0.0
     */
    public function setValue($fieldId, $value)
    {
        $this->_formValues[$fieldId] = $value;
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
        return $this->_formValues;
    }
}