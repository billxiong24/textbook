<?php
session_start();
require '../vendor/autoload.php';
$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'textbook-exchange',    // The client ID assigned to you by the provider
    'clientSecret'            => 'aWiq9fMQFXxNfz%yjj26ibn4S6NekKxf24*Ekpk#5CEmAUg+jz',   // The client password assigned to you by the provider
    'redirectUri'             => 'http://localhost/textbook/Static_Full_Version/oauth.php',
    'urlAuthorize'            => 'https://oauth.oit.duke.edu/oauth/authorize.php',
    'urlAccessToken'          => 'https://oauth.oit.duke.edu/oauth/token.php' ,
    'urlResourceOwnerDetails' => 'https://oauth.oit.duke.edu/oauth/resource.php'
]);

// If we don't have an authorization code then get one
if (!isset($_GET['code'])) {

    // Fetch the authorization URL from the provider; this returns the
    // urlAuthorize option and generates and applies any necessary parameters
    // (e.g. state).
    $authorizationUrl = $provider->getAuthorizationUrl();

    // Get the state generated for you and store it to the session.
    $_SESSION['oauth2state'] = $provider->getState();

    // Redirect the user to the authorization URL.
    header('Location: ' . $authorizationUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {

    try {

        // Try to get an access token using the authorization code grant.
        $accessToken = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        // We have an access token, which we may use in authenticated
        // requests against the service provider's API.
        
        //echo $accessToken->getToken() . "\n";
        //echo $accessToken->getRefreshToken() . "\n";
        //echo $accessToken->getExpires() . "\n";
        //echo ($accessToken->hasExpired() ? 'expired' : 'not expired') . "\n";

        // Using the access token, we may look up details about the
        // resource owner.
        $resourceOwner = $provider->getResourceOwner($accessToken);

        $resourceOwner = $resourceOwner->toArray();
        $_SESSION['username'] = chop($resourceOwner['eppn'],'@duke.edu');
        header('Location: index.php');

//        // The provider provides a way to get an authenticated API request for
//        // the service, using the access token; it returns an object conforming
//        // to Psr\Http\Message\RequestInterface.
//        $request = $provider->getAuthenticatedRequest(
//            'GET',
//            'http://brentertainment.com/oauth2/lockdin/resource',
//            $accessToken
//        );

    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

        // Failed to get the access token or user details.
        exit($e->getMessage());

    }

}
?>