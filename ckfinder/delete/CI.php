<?php
	/*ob_start();
    include('index.php');
    ob_end_clean();
    $CI =& get_instance();
    $CI->load->library('session'); //if it's not autoloaded in your CI setup
    echo $CI->session->userdata('directoriofiles');
*/
echo $_SERVER['DOCUMENT_ROOT'];
require_once $_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .'repositorioarchivos'. DIRECTORY_SEPARATOR .'index.php';
/*ob_start();
define('REQUEST', 'external');
require_once "index.php"; //or wherever the directory is relative to your path
ob_end_clean();
return $CI;
*/
?>