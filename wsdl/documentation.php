<?php
//need to manually include for the function 'get_declared_classes()'
include_once("lib/soap/IPPhpdoc.class.php");
include_once("lib/soap/IPReflectionClass.class.php");
include_once("lib/soap/IPReflectionCommentParser.class.php");
include_once("lib/soap/IPReflectionMethod.class.php");
include_once("lib/soap/IPReflectionProperty.class.php");
include_once("lib/soap/IPXMLSchema.class.php");
include_once("lib/soap/WSDLStruct.class.php");
include_once("lib/soap/WSHelper.class.php");
include_once("lib/IPXSLTemplate.class.php");

$phpdoc=new IPPhpdoc();
if(isset($_GET['class'])) $phpdoc->setClass($_GET['class']);
echo $phpdoc->getDocumentation();
?>