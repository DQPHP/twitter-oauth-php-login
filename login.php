<?php

/* Start session and load library. */
session_start();
require_once('twitteroauth/twitteroauth.php');

/* Include CONSUMER_KEY/SECRET and OAUTH_CALLBACK Info */
require_once('config.php');

/* Build TwitterOAuth object with client credentials. */
$tw = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
 
/* Get temporary credentials. */
$request_token = $tw->getRequestToken(OAUTH_CALLBACK);

/* Save temporary credentials to session. */
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

/* If last connection failed don't display authorization link. */
switch ($tw->http_code) {
  case 200:
    /* Build authorize URL and redirect user to Twitter. */
    $url = $tw->getAuthorizeURL($_SESSION['oauth_token']);
    header('Location: ' . $url); 
    break;
  default:
    /* Show notification if something went wrong. */
    echo 'Could not connect to Twitter. Refresh the page or try again later.';
}
