<?php
session_start();
include 'oauth2-facebook/vendor/autoload.php';
$provider = new \League\OAuth2\Client\Provider\Facebook([
    'clientId'          => 'masukan client id',
    'clientSecret'      => 'masukan client secret',
    'redirectUri'       => 'masukan redirect uri',
    'graphApiVersion'   => 'v2.10',
]);

if (!isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl([
        'scope' => ['email'],
    ]);
    $_SESSION['oauth2state'] = $provider->getState();
    
    echo '<a href="'.$authUrl.'">Log in with Facebook!</a>';
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    echo 'Invalid state.';
    exit;

}

// Try to get an access token (using the authorization code grant)
$token = $provider->getAccessToken('authorization_code', [
    'code' => $_GET['code']
]);

// Optional: Now you have a token you can look up a users profile data
try {

    // We got an access token, let's now get the user's details
    $user = $provider->getResourceOwner($token);
    $_SESSION['fb'] = $user->toArray();
    //alihkan ke dashboard
    header("location: dashboard.php");

} catch (\Exception $e) {

    // Failed to get user details
    exit('Oh dear...');
}
?>