<?php
// using the template with a header & footer


// rig up the include_path
set_include_path(
    realpath('../') . 
    PATH_SEPARATOR . 
    realpath('./')
);

require_once('ExampleTemplate.php');

// make an array for cars for the template1.php file to spit put
$cars = array(
    array('make'  => 'vw',   'model' => 'bug', 'year'  => '1966'),
    array('make'  => 'audi', 'model' => 'a4',  'year'  => '2009')
);

// the template files ('template1.php', 'header1.php', 'footer1.php')
// will all have access to variables called $foo and $cars
$templateData = array(
    'foo' => 'howdy',
    'cars' => $cars
);

// render the template
$t = new ExampleTemplate('template1.php', $templateData, 'header1.php', 'footer1.php');
$t->render();

// get the output of the template as a string
$stringValueOfTemplate = $t->render(true);
// var_dump $stringValueOfTemplate to see we captured the output as a string
var_dump($stringValueOfTemplate);

?>