<?php
  // path where project is found
  $path='/var/www/service/';
  // public path to web service
  $public_dir='/service';
  $host='localhost';


  /*   define global constants  */
  defined("PUBLIC_ROOT")    ? null : define("PUBLIC_ROOT","http://{$_SERVER["SERVER_NAME"]}{$public_dir}/");
  defined("TEMPLATES_PATH") ? null : define("TEMPLATES_PATH",realpath(dirname(__FILE__).'/templates'));  
  defined("SHELL")          ? null : define('SHELL',realpath(dirname(__FILE__).'/shell'));
  defined("LIB")            ? null : define("LIB",realpath(dirname(__FILE__).'/lib'));  
  defined("ASSETS")         ? null : define("ASSETS", PUBLIC_ROOT.'/assets');
  defined("CONVERTDIR")     ? null : define('CONVERTDIR',"{$path}convert/");  
  defined("UPLOADDIR")      ? null : define('UPLOADDIR',"{$path}upload/");
  defined("PUBLIC_DIR")     ? null : define("PUBLIC_DIR",$public_dir);   
  defined("LOG")            ? null : define("LOG","{$path}log/");
  defined("ROOT_PATH")      ? null : define("ROOT_PATH",$path);
  defined("DS")             ? null : define("DS",'/');
  
  require_once(LIB.'/functions.php');
?>
