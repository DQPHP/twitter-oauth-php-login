<?php
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
 
/* If the oauth_token is old redirect to the connect page. */
if ($_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
    unset($_SESSION);
    echo '<a href="login.php">Wrong Token value. Please try again from the first step.</a>';
    exit;
}
 
/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
$tw = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
$access_token = $tw->getAccessToken($_REQUEST['oauth_verifier']);
$content = $tw->get('account/verify_credentials');

echo '<a href="logout.php">Logout</a>';
echo '<hr>';

echo '<pre>';
print_r($content);
echo '</pre>';