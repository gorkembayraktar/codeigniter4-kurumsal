<?php 


$proxy = "202.141.233.166";
$port = "48995";
$url = "http://dynupdate.no-ip.com/ip.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYPORT, $port);
curl_setopt($ch, CURLOPT_HEADER, 1);

$exec = curl_exec($ch);

echo curl_error($ch);
print_r(curl_getinfo($ch));
echo $exec;
?>
