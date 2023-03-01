<?php

// Adaption of
// https://dev.to/ryansolid/building-a-reactive-library-from-scratch-1i0p
// for PHP

spl_autoload_register(function($className){
    $file = str_replace(['\\',], DIRECTORY_SEPARATOR, $className).'.php';
    $file = str_replace('Signals/', 'lib/', $file);
    include $file;
});

use Signals\Effect;
use Signals\Memo;
use Signals\Signal;

echo "1. Create Signal";
$count = new Signal(0);

echo "\n\n2. Create Reaction";
new Effect(function () use ($count) {
    echo "\nThe count is " . $count->read();
});

echo "\n\n3. Set count to 5";
$count->write(5);

echo "\n\n4. Set count to 10";
$count->write(10);


echo "\n\n###### \n";

echo "\n\n1. Create signals";
$firstName = new Signal('John');
$lastName = new Signal('Smith');
$showFullName = new Signal(true);
$displayName = new Memo(function() use ($firstName, $lastName, $showFullName){
    if(!$showFullName->read()) {
        return $firstName->read();
    }
    return $firstName->read() . " " . $lastName->read();
});
new Effect(function() use ($displayName){
    echo "\nMy name is ".$displayName->read();
});

echo "\n\n2. Set showFullName: false";
$showFullName->write(false);

echo "\n\n3. Change lastName (won't trigger the effect)";
$lastName->write('Legend');

echo "\n\n4. Set showFullName: true";
$showFullName->write(true);
