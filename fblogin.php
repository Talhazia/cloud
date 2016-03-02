<?php

require_once __DIR__ . '/vendor/autoload.php';
if(!isset($_SESSION))
    {
        session_start();
    }

$fb = new Facebook\Facebook([
  'app_id' => '1543343672625172', // Replace {app-id} with your app id
  'app_secret' => 'b4cbee8c740fd23e5cc29cd3746fe4a4',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://cctalha.dev/project/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
 ?>
