<?php include 'header.php';
				
		$ProductID = get('ProductID');	
		$ProductName = get('ProductName');
		$ProductCategoryID = get('ProductCategoryID');
		$ProductCode = get('ProductCode');
		$QTY = get('QTY');
		$BuyPrice = get('BuyPrice');
		$SalePrice = get('SalePrice');	
		$sarchprd = get('sarchprd');	
		$selete =$db->query("SELECT ProductID FROM `tblprdsaletem` WHERE ProductID = '".$ProductID."'; ");
		$rowselect=$db->dbCountRows($selete);
        if($rowselect>0){
			$insert = $db->query("UPDATE tblprdsaletem SET QTY = QTY + 1 WHERE ProductID = '".$ProductID."'");
			//echo 'http://www.yahoo.com/';
		}
		else
		{	
			//echo 'http://www.google.com/';
								
			$insert=$db->query("INSERT INTO tblprdsaletem (
							IP
							, ProductID
							, ProductName
							, ProductCategoryID
							, ProductCode
							, QTY
							, BuyPrice
							, SalePrice)
							VALUES(
							'".$ip."',
							'".$ProductID."',
							N'".sql_quote($ProductName)."',
							N'".sql_quote($ProductCategoryID)."',
							N'".sql_quote($ProductCode)."',
							N'1',
							N'".sql_quote($BuyPrice)."',
							N'".sql_quote($SalePrice)."'
							);
							");
			}
			
			if($insert){
				cRedirect('frmSalePrd.php?sarchprd='.$sarchprd);
			}
			else
			{
			$error = "Error Internet Connection!";
			}
	
?>
