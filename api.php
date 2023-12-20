<?php
$search = $_GET['chanson'];
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://shazam.p.rapidapi.com/search?term=.$search.&locale=en-US&offset=0&limit=5",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: shazam.p.rapidapi.com",
		"X-RapidAPI-Key: 42005216a6msh161f31e74b16a59p1de906jsna4dcf7ac625c"
	],
]);
$response = curl_exec($curl);
$responsejson = json_decode($response, true);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
	echo "cURL Error #:" . $err;
} else {
    // if (isset($responsejson["tracks"]))
	// {
    //     foreach ($responsejson["tracks"]["hits"] as $hit) {
    //         echo ("Artiste : ".$hit['track']['subtitle'] . '<br>');
    //         echo ("Titre : ".$hit['track']['title'] . '<br>');
	// 		echo("<img src=".$hit['track']['images']['coverart'].">". '<br>');
	// 	}
	// }
	var_dump($response);
}
?>