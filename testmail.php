<?php

ini_set('display_errors',1);  error_reporting(E_ALL);


require 'vendor/autoload.php';
use Mailgun\Mailgun;


# First, instantiate the SDK with your API credentials and define your domain.
$mg = new Mailgun("key-3f57a39ea3bef42f294c5e5590e6e5d4");
$domain = "http://ec2-52-36-33-133.us-west-2.compute.amazonaws.com/testmail.php";

# Now, compose and send your message.
$mg->sendMessage($domain, array('from'    => 'talha.zia@uoit.net',
                                'to'      => 'talhazia00@gmail.com',
                                'subject' => 'The PHP SDK is awesome!',
                                'text'    => 'It is so simple to send a message.'));

                                $httpResponseCode = $result->http_response_code;
                                $httpResponseBody = $result->http_response_body;

                                # Iterate through the results and echo the message IDs.
                                $logItems = $result->http_response_body->items;
                                foreach($logItems as $logItem){
                                    echo $logItem->message_id . "\n";
                                }
