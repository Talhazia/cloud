<?php

ini_set('display_errors',1);  error_reporting(E_ALL);


require 'vendor/autoload.php';
use Mailgun\Mailgun;


# First, instantiate the SDK with your API credentials and define your domain.
$mg = new Mailgun("key-3f57a39ea3bef42f294c5e5590e6e5d4");
$domain = "https://api.mailgun.net/v3/sandbox06544ae5e2c74187bd56ca729517bc90.mailgun.org";

# Now, compose and send your message.
$result = $mg->sendMessage($domain, array('from'    => 'talha.zia@uoit.net',
                                'to'      => 'talhazia00@gmail.com',
                                'subject' => 'The PHP SDK is awesome!',
                                'text'    => 'It is so simple to send a message.'));

              $httpResponseCode = $result->http_response_code;
                                $httpResponseBody = $result->http_response_body;

                                # Iterate through the results and echo the message IDs.
                                /*$logItems = $result->http_response_body->items;
                                foreach($logItems as $logItem){
                                    echo $logItem->message_id . "\n";
                                }*/
                                print_r($httpResponseBody->message);
