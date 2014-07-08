<?PHP
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."api_FB/facebook/src/FacebookSession.php");
require_once($_SERVER['DOCUMENT_ROOT']."api_FB/facebook/src/FacebookRedirectLoginHelper.php");
require_once($_SERVER['DOCUMENT_ROOT']."api_FB/facebook/src/FacebookRequest.php");
require_once($_SERVER['DOCUMENT_ROOT']."api_FB/facebook/src/FacebookResponse.php");
require_once($_SERVER['DOCUMENT_ROOT']."api_FB/facebook/src/GraphObject.php");
require_once($_SERVER['DOCUMENT_ROOT']."api_FB/facebook/src/GraphUser.php");
/*request HttpClient*/
require_once($_SERVER['DOCUMENT_ROOT']."api_FB/facebook/src/HttpClients/FacebookHttpable.php");
require_once($_SERVER['DOCUMENT_ROOT']."api_FB/facebook/src/HttpClients/FacebookCurlHttpClient.php");
require_once($_SERVER['DOCUMENT_ROOT']."api_FB/facebook/src/HttpClients/FacebookCurl.php");
/*request Fb Exception*/
require_once($_SERVER['DOCUMENT_ROOT']."api_FB/facebook/src/FacebookSDKException.php");
require_once($_SERVER['DOCUMENT_ROOT']."api_FB/facebook/src/FacebookRequestException.php");
require_once($_SERVER['DOCUMENT_ROOT']."api_FB/facebook/src/FacebookAuthorizationException.php");

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\GraphUser;
use Facebook\GraphObject;
/*name space HttpClient*/
use Facebook\FacebookCurlHttpClient;
use Facebook\HttpClients;
use Facebook\FacebookCurl;
/*name space Fb Exception*/
use Facebook\FacebookRequestException;
use Facebook\FacebookSDKException;
use Facebook\FacebookAuthorizationException;

/*APP_ID and APP_SECRET*/
//YOUR APP ID FOR TEST 
#$APP_ID =
#$APP_SECRET = 
//phitlokplaza APP ID
$APP_ID = "291938030987666";
$APP_SECRET = "5087cdb040683b9b786249eae32c38e1";

$URL_REDIR = "http://localhost/api_FB/fb_authen_FIX.php";
FacebookSession::setDefaultApplication($APP_ID,$APP_SECRET);
$fb = new FacebookRedirectLoginHelper($URL_REDIR);
$fb_session = $fb->getSessionFromRedirect();
	
	if($fb_session){
		$fb_request = new FacebookRequest($fb_session, 'GET', '/me');
		$fb_response = $fb_request->execute()->getGraphObject();
		/*select fb info*/
		$fbUid = $fb_response->getProperty('id');
		$fbUname = $fb_response->getProperty('name'); 
		$fbUmail = $fb_response->getProperty('email');
			echo "<hr>";
			print_r($fb_response);
			echo "<hr>";
			echo $fbUid."<br>";
			echo $fbUname."<br><hr>";
			echo ($fbUmail == Null || $fbUmail == ""?"RESULT: CHECK GOT MAIL = NO":"RESULT: CHECK GOT MAIL = YES");
	}else{
			echo "<a href=".$fb->getLoginUrl().">Facebook Login</a>";
	}

