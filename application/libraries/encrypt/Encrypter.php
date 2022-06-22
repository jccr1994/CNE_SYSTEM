<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('php-encrypter/src/Encrypter.php');
class Encrypter extends Encrypter {
	function __construct(){
		parent::__construct();
		$CI =& get_instance();
	}
}
?>