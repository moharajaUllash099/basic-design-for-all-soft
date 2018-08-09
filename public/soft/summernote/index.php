<?php
$domain = $_SERVER['HTTP_HOST'];
$http = isset($_SERVER['HTTPS'])? "https" : "http";
//redirect($http.$domain);
header('Location: '.$http.'://'.$domain);
?>