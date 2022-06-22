<?php
/*echo "\nEste script se ejecuta en: " . __DIR__;
$padre = dirname(__DIR__);
echo "\nLa ruta del padre es: $padre";
$masArriba = dirname($padre);
echo "\nUna ruta más arriba es: $masArriba";
*/
echo $_SERVER["DOCUMENT_ROOT"];

ob_start();
    include('index.php');
    ob_end_clean();
    $CI =& get_instance();
    $CI->load->library('session'); //if it's not autoloaded in your CI setup
    //echo $CI->session->userdata('idusuario');
echo $_COOKIE['tipouser'];
?>