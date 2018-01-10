<?PHP
include_once('settings.inc.php');
/*
Algorithms are marked with following numbers:
1 = SHA256
*/
function pull($url){
 $curl = curl_init();
 curl_setopt($curl, CURLOPT_POST, 1);
 curl_setopt($curl, CURLOPT_URL, $url);  
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 //curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);
 $result = curl_exec($curl);
 curl_close($curl);
 return $result;
}
/*
Parameters:
- id - API ID;
- key - API Key or ReadOnly API Key;
- location - 0 for Europe (NiceHash), 1 for USA (WestHash);
- algo - Algorithm marked with ID.
*/
$id = 8;
$orders_json = pull("https://api.nicehash.com/api?method=orders.get&my&id=$id&key=$key&location=1&algo=1");
?>
