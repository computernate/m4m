<?php

$id = $_GET["id"];
$size= $_GET["size"];

$url = "https://merchies-shop.com/pages/metasubmit?id=".$id."&quantity=1&cookieid=".$cookieid;
$data = array("id" => "$size", "quantity" => 1, "cookieid"=>$id);
//https://merchies-shop.com/pages/metasubmit?id=33456487858308&quantity=1&cookieid=weddingid
//<id type="integer">33456487858308</id>
//<product-id type="integer">4631467950212</product-id>
//

//url-ify the data for the POST
$fields_string = http_build_query($data);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1');
//So that curl_exec returns the contents of the cURL; rather than echoing it
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPGET, true);
//execute post
$result = curl_exec($ch);
echo $url;
echo $result;

?>
