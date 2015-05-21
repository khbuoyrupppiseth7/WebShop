
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
		
		$insert=$db->query("INSERT INTO tblprdtem (
							IP
							, ProductID
							, ProductName
							, ProductCategoryID
							, ProductCode
							, QTY
							, BuyPrice
							, SalePrice
							, PrdCopied)
							VALUES(
							'".$ip."',
							'".time()."',
							N'".sql_quote($txtprdname)."',
							N'".sql_quote($ProductCategoryID)."',
							N'".sql_quote($txtcode)."',
							N'".sql_quote($txtqty)."',
							N'".sql_quote($txtbuyprice)."',
							N'".sql_quote($txtsaleprice)."',
							'1'
							);
							");
			
			if($insert){
				cRedirect('index.php');
			}
		$error = "Error Internet Connection!";
		}
		
		if(isset($_POST['btnCheckout'])){
			$cboBranch = post('cboBranch');
			
			/*Move from tableprdtem to products*/
			$copy=$db->query("INSERT INTO tblproducts (ProductID, ProductName, ProductCategoryID, ProductCode,QTY, BuyPrice, SalePrice) 
SELECT ProductID, ProductName, ProductCategoryID, ProductCode, QTY, BuyPrice, SalePrice
FROM tblprdtem WHERE tblprdtem.PrdCopied = '1' ");

			/*Move from tableprdtem to productsBranch*/
			$copy=$db->query("INSERT INTO tblproductsbranch (ProductID, BranchID, BuyPrice, OtherCost, SalePrice, Qty, QtyInstock, TotalBuyPrice)
						SELECT ProductID, '".$cboBranch."', BuyPrice,'0', SalePrice, Qty, '0', BuyPrice * Qty
						FROM tblprdtem WHERE tblprdtem.PrdCopied = '1' ");
			
			$buyid = time();
			
			$InsertToTableBuy= $db->query("INSERT INTO tblproducts_buy (BuyID, BuyDate, UserID, Decription) 
VALUES('".$buyid."',Now(),'".$U_id."','');");

			$InsertToTableBuyDetail = $db->query("SELECT ProductID, QTY, BuyPrice, SalePrice FROM tblprdtem ");
			$rowselect=$db->dbCountRows($InsertToTableBuyDetail);
			if($rowselect>0){
				$x = 1;
				while($row=$db->fetch($InsertToTableBuyDetail)){
					$ProductID = $row->ProductID;
					$QTY = $row->QTY;
					$BuyPrice = $row->BuyPrice;
					
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
					/*Update Qty of Products*/
					$updateproductsqty = $db->query("UPDATE tblproducts 
											SET Qty = Qty + (SELECT Qty FROM tblprdtem WHERE ProductID = '".$ProductID."' )
											WHERE ProductID = '".$ProductID."'
											");
					/*Update Qty of ProductsBranch*/
					$updateproductsqty = $db->query("UPDATE `tblproductsbranch`SET
											BuyPrice = (SELECT BuyPrice FROM tblprdtem WHERE ProductID = '".$ProductID."' ) ,
											OtherCost = '0',
											SalePrice = (SELECT SalePrice FROM tblprdtem WHERE ProductID = '".$ProductID."' ) ,
											Qty = Qty + (SELECT Qty FROM tblprdtem WHERE ProductID = '".$ProductID."' ) ,
											QtyInstock = (SELECT Qty FROM tblproducts WHERE ProductID = '".$ProductID."' ) ,
											TotalBuyPrice = TotalBuyPrice + (SELECT Qty * BuyPrice FROM tblprdtem WHERE ProductID = '".$ProductID."' )
											WHERE ProductID = '".$ProductID."'
											");
				}
				
			}
			
			
			if($copy){
				$delete=$db->query("DELETE FROM `tblprdtem` WHERE IP = '".$ip."'");
				
				cRedirect('index.php');
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
                       
                        <small>Panel Branch Detail</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        
                        <li class="active">Branch Detail of Products</li>
                    </ol>
                </section>

                <!-- Main content -->
               
                 <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th colspan="7">
                                                <div class="row">
                                                     <div class="col-md-3">
                                                     <a href="frmbranch.php">
                                                      	<button type="button" class="glyphicon glyphicon glyphicon-circle-arrow-left btn btn-primary"></button>
                                                        </a>
                                                        </div>
                                                  
                                                       <!-- Check Out Form -->
                                                        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                  <form method="post" enctype="multipart/form-data">
                                                                  <div class="form-group">
                                                                        <label>Choose Branch</label>
                                                                        <select class="form-control" name="cboBranch">
                                                                           
                                                                       <?php
                                                                         	$select=$db->query("SELECT BranchID, BranchName FROM `tblbranch`;");
                                                                            $rowselect=$db->dbCountRows($select);
                                                                            if($rowselect>0){
                                                                                
                                                                                while($row=$db->fetch($select)){
                                                                                $BranchID = $row->BranchID;
                                                                                $BranchName = $row->BranchName;
                                                                                    echo'<option value='.$BranchID.'>'.$BranchName.'</option>';
                                                                                }
                                                                                
                                                                            }
                                                                       ?>
                                                                        </select>
                                                                        
                                                                  </div>
                                                                   <div class="checkbox">
                                                                        <label>
                                                                          <input type="checkbox" checked> Check here to follow us.
                                                                        </label>
                                                                        <input type="submit" name="btnCheckout" class="btn btn-primary" value="Checkout" />
                                                                  	</div>
                                                                     </form>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <!-- Check Out Form -->
                                                    
                                                    <form  role="search">
                                                    <div class="col-md-3 pull-right">
                                                      	
                                                            <div class="input-group">
                                                                <input type="hidden" class="form-control" placeholder="Search" value="<?php echo $getBranchID; ?>" name="BranchID">
                                                                <input type="text" class="form-control" placeholder="Search" value="<?php echo $sarchprd; ?>" name="sarchprd" autofocus>
                                                                <div class="input-group-btn">
                                                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                                                </div>
                                                            </div>
                                                       
                                                    </div>
                                                     </form>
                                                    
                                                </div>
                                            </th>
                                           
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            
                                            <th>Product Name</th>
                                            <th>Buy Price</th>
                                            <th>Sale Price</th>
                                            <th>QTY <?php echo $getBranchID; ?></th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--<tr class="odd gradeX">
                                            <td>Trident</td>
                                            <td>Internet Explorer 4.0</td>
                                            <td>Win 95+</td>
                                            <td class="center">4</td>
                                            <td class="center">4</td>
                                        </tr>
                                        <tr class="even gradeC">
                                            <td>Trident</td>
                                            <td>Internet Explorer 5.0</td>
                                            <td>Win 95+</td>
                                            <td class="center">5</td>
                                            <td class="center">4</td>  
                                        </tr>-->
                                        
                                        <?php
										/*if($sarchprd != " ")
										{
											$select=$db->query("SELECT `tblproductsbranch`.ProductID, 
													`tblproductsbranch`.BuyPrice, 
													`tblproductsbranch`.SalePrice, 
													`tblproductsbranch`.Qty,
													tblproducts.ProductName
													FROM `tblproductsbranch`
													INNER JOIN tblproducts
													ON tblproductsbranch.ProductID = tblproducts.ProductID
													WHERE (tblproducts.ProductName LIKE N'%".$sarchprd."%' OR tblproducts.ProductCode LIKE N'%".$sarchprd."%')
													AND tblproductsbranch.BranchID = '".$getBranchID."'
													");
										}
										else
										{
											$select=$db->query("SELECT `tblproductsbranch`.ProductID, 
													`tblproductsbranch`.BuyPrice, 
													`tblproductsbranch`.SalePrice, 
													`tblproductsbranch`.Qty,
													tblproducts.ProductName
													FROM `tblproductsbranch`
													INNER JOIN tblproducts
													ON tblproductsbranch.ProductID = tblproducts.ProductID
													WHERE tblproductsbranch.BranchID = '".$getBranchID."'
																");				
										}
										*/
										$select=$db->query("SELECT `tblproductsbranch`.ProductID, 
													`tblproductsbranch`.BuyPrice, 
													`tblproductsbranch`.SalePrice, 
													`tblproductsbranch`.Qty,
													tblproducts.ProductName
													FROM `tblproductsbranch`
													INNER JOIN tblproducts
													ON tblproductsbranch.ProductID = tblproducts.ProductID
													WHERE tblproductsbranch.BranchID = '".$getBranchID."'
																");
											$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												while($row=$db->fetch($select)){
												$ProductID = $row->ProductID;
												$ProductName = $row->ProductName;
												$BuyPrice = $row->BuyPrice;
												$SalePrice = $row->SalePrice;
												$Qty = $row->Qty;
												
												$x = $i++;
												/*echo'<tr class="even">
														<td>'.$ProductName.'</td>
														<td>'.$BuyPrice.'</td>
														<td>'.$SalePrice.'</td>
														<td>'.$Qty.'</td>
														<td> - </td>
													</tr>';*/
													
													
												} 
											}
											else
											{
												echo '<tr class="even">
														<td  colspan="8"><font size="+1" color="#CC0000"> No Branch Selected.</font></td>
													
														</td>
													</tr>';	
											}
									   ?>    
                                             
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                      </div>
                        <!-- /.panel-body -->
               <!-- New User -->
               <div class="modal fade" id="NewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">                    
                  <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">New Product</h4>
                         
                      </div>
                      <div class="modal-body">
                        <form role="form" method="post">
                        
                          
                          
                          <div class="form-group">
                            	<label>Branch Name: </label>
                                <input name="txtprdname" class="form-control" placeholder="Enter text" required />
                          </div>
                         
                          <div class="form-group">
                                <label>Description:</label>
                                <div class="input-group"> 
                                <span class="input-group-addon">$</span>
                                <input type="number" value="1" name="txtdesc" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
                            	</div>
                          </div>
                     
                           <!--<div class="form-group">
                                <label>User Limit &nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <label class="radio-inline">
                                    <input type="radio" name="rdstatus" id="optionsRadiosInline1" value="1" checked>Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="rdstatus" id="optionsRadiosInline2" value="0">Suspend
                                </label>
                               
                            </div>
                        -->
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                            <input type="submit" name="btnAddNewPrd" class="btn btn-primary" value="Save" />
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- End New User -->
                
                <!-- Check Out -->

                <!-- End Check Out -->
                
                
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
<?php include 'footer.php';?>