<?php
/*
* Security module
* =============================================
*  @version = 1.0.5
*  @last update = 24-2-2014
*/

class security_module {

	public $token;
	public $tokens = array();
	
	public function __construct() {
		
		$_SESSION['tokens'] = (isset($_SESSION['tokens']) ? (is_array($_SESSION['tokens']) ? $_SESSION['tokens'] : array()) : array());
		
		foreach($_SESSION['tokens'] AS $KEY => $VALUE) {

			if((time() - $_SESSION['csrf_' . $VALUE]) > (CSRF_TIME * 60)) {
				unset($_SESSION['csrf_' . $VALUE]);
				unset($_SESSION['tokens'][$KEY]);
			}
		}
		
		$this->tokens = array_values($this->tokens);
		
	}
	
	public function get() {
	
		$this->token = sha1(uniqid(mt_rand(), true));
		array_push($_SESSION['tokens'],$this->token);
		
		$this->set($this->token);
		
		return $this->token;
	}
	
	public function set($token) {
		$_SESSION['csrf_' . $token] = time();
	}
	
	public function view() {
		return $_SESSION['tokens'];
	}
	
	public function remove($token) {
	
		if(($key = array_search($token, $_SESSION['tokens'])) !== false) {
	
			unset($_SESSION['csrf_' . $token]);	
			unset($_SESSION['tokens'][$key]);
		
		}
		
		return true;
	}
	
	public function check($token) {
		return (isset($_SESSION['csrf_' . $token]) ? true : false);
	}
}
