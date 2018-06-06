<?php

$filter_rules = [
    'whats' => FILTER_SANITIZE_STRING,
    'email' => FILTER_VALIDATE_EMAIL,

];

$validation = [
    'whats'=>[
        'is_null'=>'name is empty',
        'is_false'=>'name is wrong value',
    ],
    'email'=>[
        'is_null'=>'email is empty',
        'is_false'=>'email is wrong value',

    ],

];

/** MOTOR OU CORE DA APLICAÇÃO */

$data = filter_input_array(INPUT_POST, $filter_rules);

foreach ($data as $field=>$value) {
    if (empty($validation[$field])) {
        continue;
    }

    if ($value === null or $value == '') {
        echo $validation[$field]['is_null'];
    } elseif ($value === false) {
        echo $validation[$field]['is_false'];
    } elseif (isset($validation[$field]['other']) and $validation[$field]['other'] !== null) {
        echo $validation[$field]['other']($value);
    }

    echo '<br>';
}

/* echo '<br>';

           echo "<script>$(document).ready(function(){
               $(\"input#email\").val(\"\");
               $('#modal').modal('show');

           });</script>";*/

var_dump($data);

echo '<a href="index.html">voltar</a>';




?>
