<?php
/**
 * Validations class.
 * 
 * @since 1.0.0
 */
namespace Svorm\Helpers;

class Validations
{
    /**
     * Errors after validation.
     * 
     * @var array
     * 
     * @since 1.0.0
     */
    private $errors = [];

    /**
     * Is validation done?
     * 
     * @var boolean
     * 
     * @since 1.0.0
     */
    private $validated = false;

    /**
     * Validations.
     * 
     * @var array
     * 
     * @since 1.0.0
     */
    private $validations;

    /**
     * Constructor.
     * 
     * @param mixed $value A value which have to be validated.
     * 
     * @since 1.0.0
     */
    public function __construct( array $validations )
    {
        $this->validations = $validations;
    }

    /**
     * Doing check for given values.
     * 
     * @param mixed $value A value which have to be validated.
     * 
     * @return array Array with errors.
     * 
     * @since 1.0.0
     */
    public function validate($value) : array
    {
        $this->errors = [];

        // Running each validation
        foreach ($this->validations as $validation) {
            $valueAsNumber = isset($validation->value) ? floatval($validation->value): null;

            // Assigning Validation functions
            $methods = new ValidationMethods();

            switch( $validation->type ) {
                case 'string':
                    if (! $methods->isString($value) ) {
                        array_push($this->errors, $validation->error);
                    }
                    break;
                case 'letters':
                    if (! $methods->letters($value) ) {
                        array_push($this->errors, $validation->error);
                    }
                    break;
                case 'int':
                    if (! $methods->isInt($value) ) {
                        array_push($this->errors, $validation->error);
                    }
                    break;
                case 'number':
                    if (! $methods->isNumber($value) ) {
                        array_push($this->errors, $validation->error);
                    }
                    break;
                case 'email':
                    if (! $methods->isEmail($value) ) {
                        array_push($this->errors, $validation->error);
                    }
                    break;
                case 'min':
                    if (! $methods->min($value, $valueAsNumber) ) {
                        array_push($this->errors, $validation->error);
                    }
                    break;
                case 'max':
                    if (! $methods->max($value, $valueAsNumber) ) {
                        array_push($this->errors, $validation->error);
                    }
                    break;
                case 'minLength':
                    if (! $methods->minLength($value, $valueAsNumber) ) {
                        array_push($this->errors, $validation->error);
                    }
                    break;
                case 'maxLength':
                    if (! $methods->maxLength($value, $valueAsNumber) ) {
                        array_push($this->errors, $validation->error);
                    }
                    break;
                case 'empty':
                    if ($methods->isEmpty($value) ) {
                        array_push($this->errors, $validation->error);
                    }
                    break;                    
                case 'inArray':
                    if (! $methods->inArray($value, $validation->values) ) {
                        array_push($this->errors, $validation->error);
                    }
                    break;
                case 'isChecked':
                    if (! $methods->isChecked($value) ) {
                        array_push($this->errors, $validation->error);
                    }
                    break;                    
                default:
                    array_push($this->errors, 'Validation-Type "' . $validation->type . '" does not exist.');
                    break;
            }
            
        }

        $this->validated = true;

        return $this->errors;
    }

    /**
     * Are there errors after validation?
     * 
     * @return boolean True on errors, false if not.
     * 
     * @since 1.0.0
     */
    public function isError() : bool
    {
        return count($this->errors) > 0;
    }

    /**
     * Get errors after validation.
     * 
     * @return array All errors.
     * 
     * @since 1.0.0
     */
    public function getErrors() : array
    {
        return $this->errors;
    }

    /**
     * Is validation done?
     * 
     * @return boolean True if validated, false if not.
     * 
     * @since 1.0.0
     */
    public function isValidated() : bool
    {
        return $this->validated;
    }
}
