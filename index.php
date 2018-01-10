<?PHP
$target
session_start();
if (isset($_GET['key'])){
 $_SESSION['key'] = $_GET['key'];
 echo "<a href='index.php'>Next</a>";
}
if (empty($_SESSION['key'])){
 echo "<form>Key <input name='key'><input type='submit'></form> Key is stored in _SESSION";
 die();
}
 
 
 /*
Algorithms are marked with following numbers:
1 = SHA256
*/
function pull($url){
 $curl = curl_init();
 curl_setopt($curl, CURLOPT_POST, 1);
 curl_setopt($curl, CURLOPT_URL, $url);  
 //echo "<li>API: $url</li>";
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
$key = $_SESSION['key'];
$orders_json = pull("https://api.nicehash.com/api?method=orders.get&myid=$id&key=$key&location=1&algo=1");
$array = json_decode($orders_json, true)
?>
<table border="1" cellpadding="0" cellspacing="2">
<?PHP
  echo "<tr>";
     
      echo "<td>limit_speed</td>";
      echo "<td>alive</td>";
      echo "<td>price</td>";
      echo "<td>id</td>";
      echo "<td>type</td>";
      echo "<td>workers</td>";
      echo "<td>algo</td>";
      echo "<td>accepted_speed</td>";
   
    echo "</tr>";
 foreach ($array as $key => $value) {
    foreach ($value as $key2 => $value2) {
    
     foreach ($value2 as $key3 => $value3) {
      if ($value3['accepted_speed'] > 0){
      echo "<tr>";
      echo "<td>$value3[limit_speed]</td>";
      echo "<td>$value3[alive]</td>";
      echo "<td>$value3[price]</td>";
      echo "<td>$value3[id]</td>";
      echo "<td>$value3[type]</td>";
      echo "<td>$value3[workers]</td>";
      echo "<td>$value3[algo]</td>";
      echo "<td>$value3[accepted_speed]</td>";
      $total = $total + $value3[accepted_speed];
      echo "</tr>";
      }
  }
  }
}
?>
</table>
<title><?PHP echo number_format($total);?> H/s</title>
<meta http-equiv="refresh" content="15">
