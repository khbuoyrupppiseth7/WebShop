<?php
	include 'header.php';

	$txtCustomerOrderDetailID = get('txtCustomerOrderDetailID');	
	$txtsaleprice = get('txtsaleprice');
	$txtDesc = get('txtDesc');
	
		/*Create Invoice Customer Sale*/
		$InsertToCustomerOrder=$db->query(" UPDATE tblproductsbranch SET 
		OtherCost='".$txtsaleprice."', 
		Decription='".$txtDesc."'
		WHERE ProductID = '".$txtCustomerOrderDetailID."'");
		
		//UPDATE tblproductsbranch SET OtherCost = '".$txtOtherCost."', Decription=N'".$txtDesc."' WHERE ProductID = '".$ProductID."'
		
		if($InsertToCustomerOrder){
			cRedirect('Report_Saling.php');
		 }								
?>