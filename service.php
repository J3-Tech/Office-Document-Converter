<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
ini_set("soap.wsdl_cache_enabled", "0");
require_once realpath(dirname(__FILE__).'/resources/config.php');
new Convertor;
$service=new Service;
$service->create();

?>