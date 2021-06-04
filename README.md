# Event Handler
Simple event handler class

## Install

`composer require alonity/eventhandler`

### Examples
```php
use alonity\events\Handler;

require('vendor/autoload.php');

// Listen event "example"
Handler::listen('example', function(){
    echo 'Event "example" running';
});

// Call to event "example"
Handler::emit('example');
```