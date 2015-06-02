<?php
	include 'header.php';

	$txtCustomerOrderDetailID = get('txtCustomerOrderDetailID');	
	$txtsaleprice = get('txtsaleprice');
	$txtDesc = get('txtDesc');
	
		/*Create Invoice Customer Sale*/
		$InsertToCustomerOrder=$db->query(" UPDATE tbl_customerorderdetail SET 
		OtherCost='".$txtsaleprice."', 
		Decription='".$txtDesc."'
		WHERE CustomerOrderDetailID = '".$txtCustomerOrderDetailID."'");
		
		if($InsertToCustomerOrder){
				cRedirect('Report_Saling.php');
		 }								
?>