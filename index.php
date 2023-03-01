<?php

// Adaption of
// https://dev.to/ryansolid/building-a-reactive-library-from-scratch-1i0p
// for PHP


require_once './lib/Signal.php';
require_once './lib/Effect.php';
require_once './lib/Memo.php';

use Signals\Effect;
use Signals\Signal;

echo "1. Create Signal";
$signal = new Signal(0);

echo "\n\n2. Create Reaction";
Effect::create(function () use ($signal) {
    echo "\nFrom reactive effect: the count is " . $signal->read();
});

echo "\n\n3. Set count to 5";
$signal->write(5);

echo "\n\n4. Set count to 10";
$signal->write(10);


echo "\n###### \n";

$firstName = new Signal('John');
$lastName = new Signal('Smith');
$displayName = \Signals\Memo::create(function() use ($firstName, $lastName){
    return $firstName->read() . " " . $lastName->read();
});
Effect::create(function() use ($displayName){
    echo "\nMy name is ".$displayName->read();
});

echo "\n\n1. change last name";
$lastName->write('Doe');
