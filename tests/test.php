<?php

require __DIR__ . '/../vendor/autoload.php';

use Svorm\Form\Form;

$formData = json_decode(file_get_contents(__DIR__ . '/form.json'));

$formValues = array(
    'name' => 'John Doe',
    'email' => 'john@doe',
    'message' => 'Hello world!'
);

$form = new Form($formData, $formValues);

