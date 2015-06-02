<?php
	include 'header.php';
	$buyid = time();
	$PrdID = time().'2';
	$BuyDetailID = time().'3';
	
	/*$InsertTotblBuy= $db->query("INSERT INTO tblproducts_buy (BuyID, BuyDate, UserID, Decription) 
VALUES('".$buyid."','".$date_now."','".$U_id."','');");

	$inserTotblBuyDetail = $db->query("INSERT INTO tblproducts_buydetail
												( BuyDetailID,
												BuyID, 
												UserID,
												ProductID,
												Qty,
												BuyPrice,
												Decription )
												VALUES
												(
												'".time().'1'."',
												'".$buyid."',
												'".$U_id."',
												'".time().'2'."',
												1,
												'".$txtbuyprice1."',
												''
												)");*/
	$insertTotblProducts=$db->query("INSERT INTO tblproducts(ProductID, ProductName, ProductCategoryID, ProductCode, Qty, BuyPrice, SalePrice, Decription)
							VALUES( '".$PrdID."', '".$txtprdname1."','".$cboPrdCate1."','".$txtcode1."',1,".$txtbuyprice1.",".$txtsaleprice1.",'Desc');");

	$inserttobuyBranch=$db->query("INSERT INTO tblproductsbranch (ProductID, BranchID, BuyPrice, OtherCost, SalePrice, Qty)
							VALUES ('".$PrdID."', '".$U_Brandid."',".$txtbuyprice1.",0 , ".$txtsaleprice1.", 1)");
	$InsertTotblBuy= $db->query("INSERT INTO tblproducts_buy (BuyID, BuyDate, UserID, Decription) 
VALUES('".$buyid."','".$date_now."','".$U_id."','');");	
	
	$inserTotblBuyDetail = $db->query("INSERT INTO tblproducts_buydetail
												( BuyDetailID,
												BuyID, 
												UserID,
												ProductID,
												Qty,
												BuyPrice,
												Decription )
												VALUES
												(
												'".$BuyDetailID."',
												'".$buyid."',
												'".$U_id."',
												'".$PrdID."',
												1,
												'".$txtbuyprice1."',
												''
												)");
												
	if($inserTotblBuyDetail){
		cRedirect('frmSalePrd.php');
	}					

?>