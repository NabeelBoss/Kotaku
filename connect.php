<?php

$servername = "localhost";
$username = "root";
$userpass = "";
$db = "kotaku";

$con = mysqli_connect($servername,$username,$userpass,$db);

if($con == False){
    echo "Db not Connected";
}


?>