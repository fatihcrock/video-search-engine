<?php 
 
require_once('vimeo.php');
 
$key = "0b8e248dbb828205d522a321e52d642a1b83fc9b";
$secret = "bfba17404444f0ce9962c0b0a349ac55b5ce43bd";
 
$query = $_POST['q'];
$limit = 12; // number of videos to display for each search


$vimeo = new phpVimeo($key, $secret);
$response = $vimeo->call('vimeo.videos.search', array('per_page' => $limit, 'query' => 'teoman', 'sort' => 'relevant'));
 
var_dump($response);
?>