<?php
session_start();
$db_host = "localhost";
$db_name = "online_cbt";
$db_user = "root";
$db_pass = "";

try{
	$db_conn = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
	$db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	echo $e->getMessage();
}
include_once('class.student.php');
include_once('class.admin.php');
$student = new Student($db_conn);
$admin = new admin($db_conn);
?>