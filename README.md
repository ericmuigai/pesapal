Pesapal package for Laravel
=======
<h2>Introduction</h2>
This is a Laravel 5.* pesapal package.
I provided this package as to help since pesapal do not have a package for Laravel.
<strong>Pesapal do not have a way to test this so I guess you will have to send money
payments to test. Please do ping me whenever you need something</strong>
<h3> For <a href='https://github.com/ericmuigai/pesapal/tree/4.2'>Laravel 4.2</a>
<h2>Installation</h2>
add <pre>"ericmuigai/pesapal": "3.0.x-dev"</pre> to your composer.json and then <pre>composer update</pre>
this will install the package
Once the package is installed add <pre>'Ericmuigai\Pesapal\PesapalServiceProvider',</pre> to the providers.
after this publish the config file by <pre>php artisan config:publish ericmuigai/pesapal</pre>
then migrate the package table by using <pre>php artisan vendor:publish</pre>
Go to your pesapal account and in the ipn url enter <pre>yoursite.com/listenipn</pre> or or the url to your public path/listenipn<br/>
You should now find the config.php in the <pre>config/pesapal.php </pre>


<h2>Configuration</h2>
This is what you should see in the config.php
<pre>
/**
 * this settings are needed in order to work with pesapal
 * enabled(bool) -if true sets the pesapal to live instead of demo website that was not functioning at the time of writing this package
 * consumer_key the consumer key gotten from the pesapal website
 * consumer_secret- The consumer secret gotten from the pesapal website
 * controller - This is the controller that will be called if the status is valid. A method updateItem($key, $pesapal_merchant_reference) will be called
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
</pre>
You are now set once the right info is entered.
<h2>How to use</h2>
Now you should be able to call the <pre>Pesapal::Iframe($array)</pre>
from any view you would like the iframe to appear.
The array should have this info in the <pre>$array</pre>
  <pre>/**
     * generates the iframe from the given details
     * @param array $values this array should contain the fields required by pesapal
     * description - description of the item or service
     * currency - if set will override the config settings you have of currency
     * user -which should be your client user id if you have a system of users
     * first_name- the first name of the user that is paying
     * last_name - the last name of the user that is paying
     * email - this should be a valid email or pesapal will throw an error
     * phone_number -which is optional if you have the email
     * amount - the total amount to be posted to pesapal
     * reference Please <em>Make sure this is a unique key to the transaction</em>. <em>An example is the id of the item or something</em>
     * type - default is MERCHANT
     * frame_height- this is the height of the iframe please provide integers as in 900 without the px
     *
     */'
     </pre>
