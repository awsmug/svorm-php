<?php
/**
 * MultipleField class.
 *
 * @since 1.0.0
 */

namespace Svorm\Fields;

class MultipleField extends Field
{
    /**
     * Get values of the multiple field.
     *
     * @return mixed[] All values of the field.
     *
     * @since 1.0.0
     */
    public function getValues()
    {
        return $this->formValues[$this->id];
    }

    /**
     * Get value of the field at the specified index.
     *
     * @param string $index Index of the value.
     *
     * @return mixed Value of the field.
     *
     * @since 1.0.0
     */
    public function getValue($index)
    {
        return $this->formValues[$this->id][$index];
    }

    /**
     * Validate field values and set errors.
     *
     * @return bool True if field is valid.
     *
     * @since 1.0.0
     */
    public function validate()
    {
        if( ! $this->conditionsFulfilled() ) {
            return true;
        }
        
        $validations = new Validations($this->validations);
        $errors = [];

        foreach ($this->getValues() as $value) {
            $validations->validate($value);
            if ($validations->getErrors()) {
                $errors = array_merge($errors, $validations->getErrors());
            }
        }

        $this->isValidated = true;
        $this->validationErrors = $errors;
        return count($this->validationErrors) === 0;
    }

    /**
     * Get the errors of the field.
     * 
     * @return array An array of errors.
     * 
     * @since 1.0.0
     */
    public function getValidationErrors()
    {
        return $this->validationErrors;
    }
}
