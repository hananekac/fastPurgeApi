<?php 
include 'akamai-open-edgegrid-client.phar';

$client_token = "CLIENT_TOKEN_HERE";
$client_secret = "CLIENT_SECRET_HERE";
$access_token = "ACCESS_TOKEN_HERE"; 
$host = "HOST_HERE";

$data = json_encode(array(
			"hostname" => "www.example.com",
			"objects" =>
					array("/article/page_to_clear_cache.html"))
		);


$client = new Akamai\Open\EdgeGrid\Client([
	'base_uri' => $host
]);

$client->setAuth($client_token, $client_secret, $access_token);

$result = $client->post('/ccu/v3/invalidate/url/production',
                [ 
                'body' => $data, 
                'headers' => ['Content-Type' => 'application/json'] 
                ]
                
);

if($result->getStatusCode() == 201)
	echo "purge done with success";
else 
	echo "Error : ".$result->getReasonPhrase();



