<?php
	include 'header.php';
	$autoid = time();
	
	$ProductID = get('txtProductID');	
	$ProductName = get('txtPrdName');
	$ProductCategoryID = get('txtProductCategoryID');
	$ProductCode = get('txtProductCode');
	$QTY = get('txtQty');
	$BuyPrice = get('txtbuyprice');
	$SalePrice = get('txtsaleprice');	
	$sarchprd = get('sarchprd');
	
	$txtDesc = get('txtDesc');
	$txtOtherCost = get('txtOtherCost');
	/*Create Invoice Customer Sale*/
	$InsertToCustomerOrder=$db->query(" INSERT INTO tbl_customerorder ( 
						CustomerOrderID,
						BranchID,
						InvoiceNo,
						CustomerOrderDate,
						UserID
						)
						VALUES
						(
						'".$autoid."',
						'".$U_Brandid."',
						'".$autoid."',
						'".$date_now."',
						'".$U_id."'
						)");
						
 	$insertCustomerOrderdetail = $db->query("INSERT INTO `tbl_customerorderdetail`(
				CustomerOrderDetailID,
				BranchID,
				CustomerOrderID,
				ProductID,
				Qty,
				SalePrice,
				BuyPrice,
				perDicount,
				AmtDiscount,
				LastSalePrice,
				Total,
				Decription
				)
				VALUES
				(
				'".time().'2'."',
				'".$U_Brandid."',
				'".$autoid."',
				'".$ProductID."',
				'1',
				'".$SalePrice."',
				'".$BuyPrice."',
				'0',
				'0',
				'0',
				'',
				'Powered by 7Technology'
				)	
			");
						
	 $deductQty= $db->query("UPDATE tblproductsbranch SET Qty =  Qty - 1 , OtherCost = ".$txtOtherCost.", Decription=N'".$txtDesc."' WHERE ProductID = '".$ProductID."' ");
	 if($InsertToCustomerOrder){
		 cRedirect('index.php');
	 }
			 
?>