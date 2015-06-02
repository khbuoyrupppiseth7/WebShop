
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
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                              Launch demo modal
                                            </button>
                                            <button type="button" class="btn btn-lg btn-danger" onClick="$('#myModal').modal('show')">Click to toggle popover</button>
                                          
                                           
                                            	<input type="hidden" id="cafeId" value="3" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                                          
                                          
                                                <!-- Modal -->
                                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                            
                                                             <form id="myForm">
                                                                    <input type="text"  id="dolar" onKeyUp="ChangetoKhmer()" />
                                                                    <input type="text"   id="khmer" onKeyUp="ChangetoDolar()" />
                                                                    
                                                                </form>
                                                                </div>
                                                                <script type="text/javascript">
																
                                                                    function ChangetoKhmer() {
                                                                            var dolar = document.getElementById("dolar");
                                                                            var khmer = document.getElementById("khmer");
																			var cafeId = document.getElementById("cafeId");
                                                                            if(dolar.value == '')
                                                                            {
                                                                                khmer.value = 0;
                                                                            }
                                                                            else
                                                                            {
                                                                                khmer.value = parseFloat(dolar.value) * 4000 *  parseFloat(cafeId.value);
                                                                            }
                                                                        }
                                                                    function ChangetoDolar(){
                                                                        var dolar = document.getElementById("dolar");
                                                                        var khmer = document.getElementById("khmer");
                                                                        if(khmer.value == '')
                                                                        {
                                                                            dolar.value = 0;
                                                                        }
                                                                        else
                                                                        {
                                                                            dolar.value = parseFloat(khmer.value) / 40;
                                                                        }
                                                                    }
                                                           </script>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                             
                                        </div>
                                    </div>
                                   
                            </div>
                            <!-- /.table-responsive -->
                      </div>
                        <!-- /.panel-body -->
                
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
<?php include 'footer.php';?>