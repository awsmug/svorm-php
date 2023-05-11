<?php
/**
 * Conditions class.
 *
 * @since 1.0.0
 */
namespace Svorm\Helpers;

class Conditions
{
    /**
     * @var HasConditionData[] The conditions.
     */
    public $conditions = [];

    /**
     * @var array The form values.
     */
    private $formValues = [];

    /**
     * Constructor.
     *
     * @param HasConditionData[] $conditions The conditions.
     * @param array              $formValues The form values.
     *
     * @since 1.0.0
     */
    public function __construct(array $conditions = [], array $formValues = [])
    {
        $this->conditions = $conditions;
        $this->formValues = $formValues;
    }

    /**
     * Checks if conditions are fulfilled.
     *
     * @return bool True if fulfilled, false if not.
     *
     * @since 1.0.0
     */
    public function fulfilled(): bool
    {
        $fulfillments = [];

        if (count($this->conditions) === 0) {
            return true;
        }

        foreach ($this->conditions as $condition) {
            $fulfilled = false;

            if (!isset($condition->fieldId) || !isset($condition->operator) || !isset($condition->value)) {
                trigger_error('Condition is not valid.', E_USER_WARNING);
            }

            if (!array_key_exists($condition->fieldId, $this->formValues)) {
                trigger_error('Field not found in form values: ' . $condition->fieldId, E_USER_WARNING);
            }

            $fieldValue = $this->formValues[$condition->fieldId];
            $compareValue = $this->filterCompareValue($condition->value);

            switch ($condition->operator) {
            case '==':
                $fulfilled = $compareValue == $fieldValue;
                break;
            case '!=':
                $fulfilled = $compareValue != $fieldValue;
                break;
            case '>':
                $fulfilled = floatval($fieldValue) > floatval($compareValue);
                break;
            case '<':
                $fulfilled = floatval($fieldValue) < floatval($compareValue);
                break;
            case '>=':
                $fulfilled = floatval($fieldValue) >= floatval($compareValue);
                break;
            case '<=':
                $fulfilled = floatval($fieldValue) <= floatval($compareValue);
                break;
            default:
                trigger_error('Operator does not exist: ' . $condition->operator, E_USER_ERROR);
            }

            $fulfillments[] = $fulfilled;
        }

        return !in_array(false, $fulfillments, true);
    }

    /**
     * Filter compare value.
     *
     * This makes values like "undefined" possible.
     *
     * @param  mixed $value Value to filter.
     * @return mixed Filtered value.
     *
     * @since 1.0.0
     */
    private function filterCompareValue($value)
    {
        switch ($value) {
        case 'undefined':
            return null;
        case 'true':
            return true;
        case 'false':
            return false;
        default:
            return $value;
        }
    }
}
