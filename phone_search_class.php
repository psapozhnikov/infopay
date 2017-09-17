<?php
$ch = curl_init('https://www.infopay.com/phptest.php?username=accucomtest&password=test104&firstname=Steve&middle_initial=&lastname=Dunn&city=&state=ma&zip=&client_reference=test&phone=&housenumber=&streetname=.');

curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_FAILONERROR, true);
curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

curl_close($ch);

echo $result;