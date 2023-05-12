<?php

require __DIR__ . '/../vendor/autoload.php';

use Svorm\Form\Form;

$formData = json_decode(file_get_contents(__DIR__ . '/form.json'));

$formValues = array(
    'id' => 1,
    'name' => 'Do',
    'email' => 'john@doe',
    'message' => 'Hello world!'
);

$form = new Form($formData, $formValues);

if($form->validate()) {
    echo 'Form is valid!';
} else {
    echo 'Form is not valid!';
    print_r($form->getValidationErrors());
}

