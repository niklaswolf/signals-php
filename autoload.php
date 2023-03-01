<?php
spl_autoload_register(function($className){
    $file = str_replace(['\\',], DIRECTORY_SEPARATOR, $className) . '.php';
    $file = str_replace('Signals/', 'lib/', $file);
    include $file;
});
