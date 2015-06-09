<?php
session_start();


include('connectionclass/connect.php');
include('connectionclass/function.php');
$db=new MyConnection();
$db->connect();
mysql_query("SET NAMES 'UTF8'");
$LoginDate = $_SESSION['startDate'];
$UserID = $_SESSION['UserID'];

$date = new DateTime('now', new DateTimeZone('ICT'));
$_SESSION['LogoutNow'] = $date->format('d-m-Y H:i:s');
$LogoutDate = $_SESSION['LogoutNow'];

/*echo $UserID . '<br>';
echo $LoginDate.'<br>';
echo $LogoutDate;*/

$Insert=$db->query("INSERT INTO tbluserhistory (UserID,UserHistoryStartDate,UserHistoryEndDate) VALUES ('".$UserID."','".$LoginDate."',Now())");

session_destroy();
cRedirect('login.php');
?>