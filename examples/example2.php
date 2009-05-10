<?php
// using the template with a header & footer AND including another template

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

// the template files ('template2.php', 'header1.php', 'footer1.php')
// will all have access to variables called $foo and $cars
$templateData = array(
    'foo' => 'howdy',
    'cars' => $cars
);

// get the template's output but dont render yet
$t      = new ExampleTemplate('template2.php', $templateData, 'header1.php', 'footer1.php');
$output = $t->render(true);

echo $output; // or echo $t would have worked...

?>