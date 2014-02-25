CSRF-Security-class
===================


<h1>First, you need to start a session!</h1>

<pre> session_start(); </pre>

<h1>Initialize the scripts</h1>

<pre>
define('CSRF_TIME', 4);
</pre>
Will make the token expire after 4 minutes.

<hr>

$security = new security_module();

$token = $security->get();

$security->get(); // returns a new token.
$security->check($token); // returns true when the token is valid, if not it will return false.
$security->view(); // returns all the open CSRF sessions.
$security->remove($token); // remove a token.

</pre>

<h1>Preview script</h1>

<pre>

require_once 'csrf.class.php';

$security = new security_module();

if(isset($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_REQUEST['token'])) {
  if($security->check($_REQUEST['token'])) {
   // token valid.
  } else {
   // token invalid.
  }
}

</pre>
