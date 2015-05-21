<?php include 'header.php';
				
		$ProductID = get('ProductID');	
		$ProductName = get('ProductName');
		$ProductCategoryID = get('ProductCategoryID');
		$ProductCode = get('ProductCode');
		$QTY = get('QTY');
		$BuyPrice = get('BuyPrice');
		$SalePrice = get('SalePrice');	
		$sarchprd = get('sarchprd');	
		$selete =$db->query("SELECT ProductID FROM `tblprdtem` WHERE ProductID = '".$ProductID."'; ");
		$rowselect=$db->dbCountRows($selete);
        if($rowselect>0){
			$insert = $db->query("UPDATE tblprdtem SET QTY = QTY + 1 WHERE ProductID = '".$ProductID."'");
			//echo 'http://www.yahoo.com/';
		}
		else
		{	
			//echo 'http://www.google.com/';
								
			$insert=$db->query("INSERT INTO tblprdtem (
							IP
							, ProductID
							, ProductName
							, ProductCategoryID
							, ProductCode
							, QTY
							, BuyPrice
							, SalePrice
							,BranchID)
							VALUES(
							'".$ip."',
							'".$ProductID."',
							N'".sql_quote($ProductName)."',
							N'".sql_quote($ProductCategoryID)."',
							N'".sql_quote($ProductCode)."',
							N'".sql_quote($QTY)."',
							N'".sql_quote($BuyPrice)."',
							N'".sql_quote($SalePrice)."',
							N'".sql_quote($U_Brandid)."'
							);
							");
			}
			
			if($insert){
				cRedirect('index.php?sarchprd='.$sarchprd);
			}
			else
			{
			$error = "Error Internet Connection!";
			}
	
?>
