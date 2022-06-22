<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require('PHPExcel-1.8.2/Classes/PHPExcel.php');
//require_once APPPATH."/PHPExcel-1.8.2/Classes/PHPExcel.php";
require_once APPPATH."/third_party/PHPExcel.php";
class Myphpexel extends PHPExcel {
	/*function __construct(){
		parent::__construct();
		//$CI =& get_instance();
	}*/
	public function __construct() {
        parent::__construct();
    }
}
?>