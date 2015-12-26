<?php
/**
 * this settings are needed in order to work with pesapal
 * enabled(bool) -if true sets the pesapal to live instead of demo website that was not functioning at the time of writing this package
 * consumer_key the consumer key gotten from the pesapal website
 * consumer_secret- The consumer secret gotten from the pesapal website
 * controller - This is the controller that will be called if the status is valid,
 * please note the method that will be called will be updateItem and should be static that is update($key,$reference)
 * Key- the key to protect the method from being called elsewhere
 * redirectTo - the link to where your thankyou page is
 * email - Your email address where you will be emailed on complete transaction
 * name - your name
 * currency - the currency that will be used on payment
 *
 */
return array(

    'enabled' => true,
    'consumer_key' => "",
    'consumer_secret'=>"",
    'controller'=>"YourController",
    'key'=>"12345",
    'redirectTo'=>"/",
    'email'=>"your@email.com",
    'mail'=>true,
    'name'=>"Admin",
    'currency'=>"KES",

);