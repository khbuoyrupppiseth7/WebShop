<?php
	include 'header.php';
	$autoid = time();
	
	$ProductID = get('txtProductID');	
	$txtOtherCost = get('txtOtherCost');
	$txtDesc = get('txtDesc');
	
	/*Create Invoice Customer Sale*/
	$InsertToCustomerOrder=$db->query("UPDATE tblproductsbranch SET OtherCost = '".$txtOtherCost."', Decription=N'".$txtDesc."' WHERE ProductID = '".$ProductID."'");
	
	if($InsertToCustomerOrder)
	{
		cRedirect('index.php');
	}

?>