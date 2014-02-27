<?php
class xss_protection {

	public function protect($value) {
		return htmlentities($value,ENT_QUOTES, 'UTF-8');
	}

}