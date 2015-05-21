<?php 
	include 'header.php';
 	include 'menu.php'; 
	
	$db=new MyConnection();
	$db->connect();
	mysql_query("SET NAMES 'UTF8'");
	
	$id=get('id');
	$delete=$db->query("Call spUserAccDelete('".$id."')");
	if($delete){
		cRedirect('userAccount.php');
	}	
	 include 'footer.php'; 
	 
?>
