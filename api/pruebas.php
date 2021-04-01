<?php

echo "Metodo  HTTP:".$_SERVER['REQUEST_METHOD'];
echo "Metodo URL:".$_SERVER['REQUEST_URI'];
$request = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_ENCODED);
echo $request;
$ch = curl_init('http://marketbonn.000webhostapp.com');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE'); // curl_setopt($ch, CURLOPT_PUT, true); - for PUT
curl_setopt($ch, CURLOPT_POSTFIELDS, 'some_data');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0); // DO NOT RETURN HTTP HEADERS
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // RETURN THE CONTENTS OF THE CALL
$result = curl_exec($ch);
echo $result;