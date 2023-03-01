# signals-php

> :warning: **Disclaimer**  
> This is just a fun little demo-project to demonstrate an implementation of signals in PHP.
> Do not use this in serious projects!

Fun little demo implementation of reactivity based on Signals for PHP.
The implementation is based on the article https://dev.to/ryansolid/building-a-reactive-library-from-scratch-1i0p from 
Ryan Carniato.

Just run `php index.php` and see the magic happen 🪄✨

## API
### Signal
Create a signal.
```php
$count = new Signal(0);
// Get the value
$count->read();
// Set the value
$count->write(5);
```
### Effect
Create an effect with dependencies.
```php
Effect::create(function () use ($count) {
    echo "\nThe count is " . $count->read();
});
```

### Memo/Computed
Create a reactive derived value from signals.
````php
$firstName = new Signal('John');
$lastName = new Signal('Smith');
$showFullName = new Signal(true);

$displayName = Memo::create(function() use ($firstName, $lastName, $showFullName){
    if(!$showFullName->read()) {
        return $firstName->read();
    }
    return $firstName->read() . " " . $lastName->read();
});
````
