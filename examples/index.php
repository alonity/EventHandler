<?php

use alonity\events\Handler;

ini_set('display_errors', true);
error_reporting(E_ALL);

require_once('../vendor/autoload.php');

// Listen to event test
Handler::listen('test', function(){
    echo '<p>Test event</p>';
});

// Emit event test
if(Handler::emit('test')){
    echo "<p>Success test event</p>";
}

// Listen to event test
Handler::listen('hello', function(){
    echo 'Test event';
});

// Remove event hello
Handler::removeListener('hello');

if(!Handler::emit('hello')){
    echo "<p>Event hello not found</p>";
}else{
    echo "<p>Success hello event</p>";
}

// Remove all events
Handler::removeAll();

?>