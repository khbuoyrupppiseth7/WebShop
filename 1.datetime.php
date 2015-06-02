
<?php include 'header.php';?>

<?php
	// Add new product to Produtct Tem
	if(isset($_POST['btnAddNewPrd'])){
		$txtprdname = $_POST['txtprdname'];
		$txtcode	=	post('txtcode');
		$txtqty    =	post('txtqty');
		$ProductCategoryID    =	post('cboPrdCate');
		$txtbuyprice	=	post('txtbuyprice');
		$txtsaleprice	=	post('txtsaleprice');
		$cboBranch = post('cboBranch');
			// Check if Products Dupplicate.
			$CheckPrd = $db->query("SELECT `tblproductsbranch`.BranchID, `tblproductsbranch`.ProductID, tblproducts.ProductName
									FROM `tblproductsbranch`
									INNER JOIN tblproducts
									ON tblproductsbranch.ProductID = tblproducts.ProductID
									WHERE BranchID = '".$U_Brandid."' AND ProductName = '".$txtprdname."'
									");
			$rowCheckPrd=$db->dbCountRows($CheckPrd);
			if($rowCheckPrd>0){
				$row=$db->fetch($CheckPrd);
					$ProductID = $row->ProductID;
					$ProductName = $row->ProductName;
					$insert=$db->query("INSERT INTO tblprdtem (
							IP
							, ProductID
							, ProductName
							, ProductCategoryID
							, ProductCode
							, QTY
							, BuyPrice
							, SalePrice
							,BranchID
							)
							VALUES(
							'".$ip."',
							'".$ProductID."',
							N'".$ProductName."',
							N'".sql_quote($ProductCategoryID)."',
							N'".sql_quote($txtcode)."',
							N'".sql_quote($txtqty)."',
							N'".sql_quote($txtbuyprice)."',
							N'".sql_quote($txtsaleprice)."',
							'".$U_Brandid."'
							);
							");	
			}
			else
			{
				$insert=$db->query("INSERT INTO tblprdtem (
							IP
							, ProductID
							, ProductName
							, ProductCategoryID
							, ProductCode
							, QTY
							, BuyPrice
							, SalePrice
							, PrdCopied,
							BranchID
							)
							VALUES(
							'".$ip."',
							'".time()."',
							N'".sql_quote($txtprdname)."',
							N'".sql_quote($ProductCategoryID)."',
							N'".sql_quote($txtcode)."',
							N'".sql_quote($txtqty)."',
							N'".sql_quote($txtbuyprice)."',
							N'".sql_quote($txtsaleprice)."',
							'1',
							'".$U_Brandid."'
							);
							");
			
			}
			
		/*
		
		$insert=$db->query("INSERT INTO tblprdtem (
							IP
							, ProductID
							, ProductName
							, ProductCategoryID
							, ProductCode
							, QTY
							, BuyPrice
							, SalePrice
							, PrdCopied,
							BranchID
							)
							VALUES(
							'".$ip."',
							'".time()."',
							N'".sql_quote($txtprdname)."',
							N'".sql_quote($ProductCategoryID)."',
							N'".sql_quote($txtcode)."',
							N'".sql_quote($txtqty)."',
							N'".sql_quote($txtbuyprice)."',
							N'".sql_quote($txtsaleprice)."',
							'1',
							'".$cboBranch."'
							);
							");*/
			
			/*if($insert){
				cRedirect('index.php');
			}*/
		$error = "Error Internet Connection!";
		}
		
		if(isset($_POST['btnCheckout'])){
			$cboBranch = post('cboBranch');

			$buyid = time();
			
			$InsertToTableBuy= $db->query("INSERT INTO tblproducts_buy (BuyID, BuyDate, UserID, Decription) 
VALUES('".$buyid."','".$date_now."','".$U_id."','');");

			$InsertToTableBuyDetail = $db->query("SELECT ProductID, QTY, BuyPrice, BranchID, SalePrice FROM tblprdtem ");
			$rowselect=$db->dbCountRows($InsertToTableBuyDetail);
			if($rowselect>0){
				$x = 1;
				while($row=$db->fetch($InsertToTableBuyDetail)){
					$ProductID = $row->ProductID;
					$QTY = $row->QTY;
					$BuyPrice = $row->BuyPrice;
					$BranchID = $row->BranchID;
					$SalePrice = $row->SalePrice;
					
					$sfrombranch = $db->query("SELECT ProductID, BranchID FROM `tblproductsbranch` WHERE ProductID = '".$ProductID."' AND BranchID = '".$BranchID."'");
					$cfrombranch=$db->dbCountRows($sfrombranch);
					if($cfrombranch>0){
						$row=$db->fetch($sfrombranch);
						
						/*Update Qty of ProductsBranch if products already Exit*/
						$updateprdqty = $db->query("UPDATE `tblproductsbranch` SET
												BuyPrice = (SELECT BuyPrice FROM tblprdtem WHERE ProductID = '".$ProductID."' ) ,
												SalePrice = (SELECT SalePrice FROM tblprdtem WHERE ProductID = '".$ProductID."' ) ,
												Qty = Qty + (SELECT Qty FROM tblprdtem WHERE ProductID = '".$ProductID."' ) 
												WHERE ProductID = '".$ProductID."'
												");
	
						/*Insert to tblproducts_buydetail*/
						$newinsert = $db->query("INSERT INTO tblproducts_buydetail
												( BuyDetailID,
												BuyID, 
												UserID,
												ProductID,
												Qty,
												BuyPrice,
												Decription )
												VALUES
												(
												'".time().$x++ ."',
												'".$buyid."',
												'".$U_id."',
												'".$ProductID."',
												'".$QTY."',
												'".$BuyPrice."',
												''
												)");
							
					}
					else
					{
						
												
						$insertfor_old_prd=$db->query("INSERT INTO tblproductsbranch (ProductID, BranchID, BuyPrice, OtherCost, SalePrice, Qty)
							VALUES (".$ProductID.", ".$U_Brandid.", BuyPrice,'".$BuyPrice."', ".$SalePrice.", ".$QTY.")");
							
						/*Insert to tblproducts_buydetail*/
						$newinsert = $db->query("INSERT INTO tblproducts_buydetail
												( BuyDetailID,
												BuyID, 
												UserID,
												ProductID,
												Qty,
												BuyPrice,
												Decription )
												VALUES
												(
												'".time().$x++ ."',
												'".$buyid."',
												'".$U_id."',
												'".$ProductID."',
												'".$QTY."',
												'".$BuyPrice."',
												''
												)");
						
						
					}
	
				}
				
			}
			/*Move from tableprdtem to products*/
			
			$copy=$db->query("INSERT INTO tblproducts (ProductID, ProductName, ProductCategoryID, ProductCode,QTY, BuyPrice, SalePrice) 
SELECT ProductID, ProductName, ProductCategoryID, ProductCode, QTY, BuyPrice, SalePrice
FROM tblprdtem WHERE tblprdtem.PrdCopied = '1' ");

			/*Move from tableprdtem to productsBranch*/
			$copy1=$db->query("INSERT INTO tblproductsbranch (ProductID, BranchID, BuyPrice, OtherCost, SalePrice, Qty, QtyInstock, TotalBuyPrice)
						SELECT ProductID, ".$U_Brandid.", BuyPrice,'0', SalePrice, Qty, '0', Qty
						FROM tblprdtem WHERE tblprdtem.PrdCopied = '1' ");
			
			if($copy){
				$delete=$db->query("DELETE FROM `tblprdtem` WHERE IP = '".$ip."'");
				$delete=$db->query("DELETE FROM `tblproductsbranch` WHERE BuyPrice IS NULL");
				
				//cRedirect('index.php');
			}
		}
		
		
	
?>

    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
         <?php include 'nav.php';?>
        
            <!-- Left side column. contains the logo and sidebar -->
            <?php include 'menu.php';?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    </h1>
                   
                </section>

                <!-- Main content -->
               
                 <div class="panel-body">
                            <div class="dataTable_wrapper">
                            	<div class="container">
                                        <div class="row">
                                            <div class='col-sm-6'>
                                                <input type='text' class="form-control" id='datetimepicker4' />
                                            </div>
                                            <script type="text/javascript">
                                                $(function () {
                                                    $('#datetimepicker4').datetimepicker();
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <input type="text" class="some_class" value="" id="some_class_1"/>
                            </div>
                            <!-- /.table-responsive -->
                      </div>
                        <!-- /.panel-body -->
                
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
<?php include 'footer.php';?>