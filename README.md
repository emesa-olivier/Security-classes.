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

<pre>
$security = new CSRF_Token();
</pre>

With `new` you can initialize a new class, you have to do this to use the class;

<hr>

<pre>
$security->get();
</pre>
returns a new token.
<hr>

<pre>
$security->check($token); 
</pre>
Returns true when the token is valid, if not it will return false.
<hr>

<pre>
$security->view();
</pre>
 returns all the open CSRF sessions.
<hr>

<pre>
$security->remove($token);
</pre>
remove a token.
<hr>
<h1>Preview script</h1>

<pre>

require_once 'csrf.class.php';

$security = new CSRF_Token();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['token'])) {
  if($security->check($_REQUEST['token'])) {
   // token valid.
  } else {
   // token invalid.
  }
}

</pre>
