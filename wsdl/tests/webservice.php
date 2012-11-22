<?php
$wsdl = "http://".$_SERVER['HTTP_HOST']."/wshelper/service.php?class=contactManager&wsdl";
echo "<strong>WSDL file:</strong> ".$wsdl."<br>\n";

$options = Array('actor' =>'http://schema.jool.nl',
				 'trace' => true);
$client = new SoapClient($wsdl,$options);
echo "<hr> <strong>Result from getContacts call:</strong><br>";

$res = $client->getContacts();
print_r($res);
echo "<hr><strong>Raw Soap response:</strong><br>";
echo htmlentities($client->__getLastResponse());
echo "<hr><strong>SoapFault asking for an unknown contact:</strong><br>";
$client->getContact(1);
?>