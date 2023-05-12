<?php
/**
 * SingleField class.
 *
 * @since 1.0.0
 */

 namespace Svorm\Fields;

 use Svorm\Helpers\Validations;

class SingleField extends Field
{
    /**
     * Doing form things and get value of the field.
     *
     * @return mixed Value of the field.
     *
     * @since 1.0.0
     */
    public function getValue()
    {
        return $this->formValues[$this->id];
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
        $validations = new Validations($this->validations);
        $validations->validate($this->getValue());
        $this->isValidated = true;
        $this->validationErrors = $validations->getErrors();
        return count($this->validationErrors) === 0;
    }

    /**
     * Get the errors of the field.
     *
     * @return array An array of errors.
     *
     * @since 1.0.0
     */
    public function getValidationErrors(): array
    {
        return $this->validationErrors;
    }
}