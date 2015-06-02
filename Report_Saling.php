
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
											'".time()."',
											'".$buyid."',
											'".$U_id."',
											'".$ProductID."',
											'".$QTY."',
											'".$BuyPrice."',
											'Hello, World.'
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
                       <div class="row">
                           <a >
                            <div class="col-md-3 pull-left">
                                របាយការណ៍ទិញ លក់
                             </div>
                           </a> 
                         <form class="form-inline">
                         <div class="col-md-7 pull-right">
                          <div class="form-group">
                           
                            <input type="text" class="form-control some_class" <?php 
                                    if ($txtFrom == "")
                                    {
                                         echo 'value="'.$date_now.'"';
                                    }
                                    else
                                    {
                                         echo 'value="'.$txtFrom.'"';
                                    }
                                ?>  name="txtFrom" id="some_class_1"/>
                          </div>
                          <div class="form-group">
                           
                             <input type="text" class="form-control some_class" <?php 
                                    if ($txtFrom == "")
                                    {
                                         echo 'value="'.$date_now.'"';
                                    }
                                    else
                                    {
                                         echo 'value="'.$txtTo.'"';
                                    }
                                ?>  name="txtTo" id="some_class_1"/>
                          </div>
                          <div class="input-group">
                           <input type="text" class="form-control" placeholder="Search Products" value="<?php echo $sarchprd; ?>" name="sarchprd" autofocus>
                        <div class="input-group-btn">
                            <button name="btnSearch" value="true" class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                          
                        </div>
                        </div>

                        </form>
                        
                    </div>
                    </h1>
                    <!--<ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        
                        <li class="active">Dashboard</li>
                    </ol>-->
                </section>

                <!-- Main content -->
               
                 <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover sortable" id="dataTables-example">
                                    
                                 <?php
								 	if($_SESSION['Level']=='1'){
										echo ' <thead>
                                        <tr>
                                            <th class="col-md-1 text-left">Category</th>
                                            <th class="col-md-1 text-left">Name</th>
                                            <th class="col-md-1 text-center">Code</th>
                                            <th class="col-md-1 text-center">Buy Price</th>
                                            <th class="col-md-1 text-center">Buy Date</th>
                                            <th class="col-md-1 text-center">Sale Price</th>
                                            <th class="col-md-1 text-center">Sale Date</th>
                                            <th class="col-md-1 text-center">Other Cost</th>
                                            <th class="col-md-1 text-center">INCOME</th>  
                                        </tr>
                                    </thead>
                                    <tbody>';
                                      	$select=$db->query("SELECT 
														tblproductcategory.ProductCategoryName,
														tblproducts.ProductName,
														tblproducts.ProductCode,
														COALESCE((tblproducts_buydetail.BuyPrice),0) AS BuyPrice,
														tblproducts_buy.BuyDate,
														COALESCE((tbl_customerorderdetail.SalePrice),0) AS SalePrice,
														DATE_FORMAT( tbl_customerorder.CustomerOrderDate,'%d %b %Y %h:%m:%s') as SaleDate,
														COALESCE((tbl_customerorderdetail.OtherCost),0) AS OtherCost,
														COALESCE((tbl_customerorderdetail.SalePrice),0)-COALESCE((tblproducts_buydetail.BuyPrice),0)-COALESCE((tbl_customerorderdetail.OtherCost),0) AS Income,
														tbl_customerorder.CustomerOrderID, 
														tbl_customerorderdetail.CustomerOrderDetailID,
														tbl_customerorder.InvoiceNo,
														tbl_customerorder.CustomerOrderDate,
														tblproducts.ProductID,
														tbl_customerorderdetail.BranchID,
														COALESCE((tbl_customerorderdetail.Qty),0) AS Qty,
														COALESCE((tblproducts_buydetail.BuyPrice),0) * COALESCE((tbl_customerorderdetail.Qty),0)  AS Total_Buying,
														COALESCE((tbl_customerorderdetail.SalePrice),0) * COALESCE((tbl_customerorderdetail.Qty),0) AS Total_Salling,
														TIMESTAMPDIFF(MINUTE,tbl_customerorder.CustomerOrderDate,NOW()) AS CalcMin,
														tbl_customerorder.UserID,
														tbl_customerorder.SelltoOtherBranch,
														tblbranch.BranchName,
														tbl_customerorderdetail.Decription
														FROM tbl_customerorder
													INNER JOIN tbl_customerorderdetail
														ON tbl_customerorder.CustomerOrderID = tbl_customerorderdetail.CustomerOrderID
													INNER JOIN tblproducts
														ON tbl_customerorderdetail.ProductID = tblproducts.ProductID
													LEFT JOIN tblbranch
														ON tblbranch.BranchID = tbl_customerorder.SelltoOtherBranch
													INNER JOIN tblproductcategory
														ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
													INNER JOIN tblproducts_buydetail
														ON tblproducts.ProductID = tblproducts_buydetail.ProductID
													INNER JOIN tblproducts_buy 
														ON tblproducts_buy.BuyID = tblproducts_buydetail.BuyID
											WHERE (tblproducts.ProductName LIKE '%".$sarchprd."%' OR tblproducts.ProductCode LIKE '%".$sarchprd."%' )
											AND (tbl_customerorder.CustomerOrderDate BETWEEN '".$txtFrom."' AND '".$txtTo."')
											AND tbl_customerorder.UserID = '".$U_id."'
											ORDER BY tbl_customerorder.CustomerOrderDate DESC");
									
											$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												while($row=$db->fetch($select)){
												$CustomerOrderDetailID = $row->CustomerOrderDetailID;
												$InvoiceNo = $row->InvoiceNo;
												$CustomerOrderDate = $row->CustomerOrderDate;
												$ProductID = $row->ProductID;
												$Qty = $row->Qty;
												
												$CalcMin = $row->CalcMin;
												$BranchName = $row->BranchName;
												$Total_Buying = round($row->Total_Buying,2);
												$Total_Salling = round($row->Total_Salling,2);
												$BranchID = $row->BranchID;
												$Decription = $row->Decription;
												
												$ProductCategoryName = $row->ProductCategoryName;
												$ProductName = $row->ProductName;
												$ProductCode = $row->ProductCode;
												$BuyPrice = round($row->BuyPrice,2);
												$BuyDate = $row->BuyDate;
												$SalePrice = round($row->SalePrice,2);
												$SaleDate = $row->SaleDate;
												$OtherCost = round($row->OtherCost,2);
												$Income = round($row->Income,2) ;
												
													if($CalcMin <=120){
														echo'<tr class="even">
																<td class="col-md-1 text-left">'.$ProductCategoryName .'</td>
																<td class="col-md-1 text-left">'.$ProductName.'</td>
																<td class="col-md-1 text-left">'.$ProductCode.'</td>
																<td class="col-md-1 text-right">$ '.$BuyPrice.'</td>
																<td class="col-md-2 text-center">'.$BuyDate.'</td>
																<td class="col-md-1 text-right">$ '.$SalePrice.'</td>
																<td class="col-md-2 text-center">'.$SaleDate.'</td>
																<td class="col-md-1 text-right">$ ';
																//echo "<input type=\"button\" onclick=\"myOtherCost('".$CustomerOrderDetailID."')\" value=\"$ ".$OtherCost."\" />";
																echo "<a onclick=\"myOtherCost('".$CustomerOrderDetailID."','".$OtherCost."','".$Decription."')\">".$OtherCost."</a>";
																echo '</td>
																<td class="col-md-1 text-right"> <a href="frmbuyPrice.php?PrdBranchID='.$ProductID.'&PrdBranchName='.$ProductName.'&PrdBranchCode='.$ProductCode.'&PrdBranchPrice='.$SalePrice.'&buyprice='.$BuyPrice.'&SPrdBrandID='.$getBranchID.',&othecost='.$OtherCost.' ">'.$Income.'</a></td>
															</tr>';	
																
													}
													else
													{
														echo'<tr class="even">
																<td class="col-md-1 text-left">'.$ProductCategoryName .'</td>
																<td class="col-md-1 text-left">'.$ProductName.'</td>
																<td class="col-md-1 text-left">'.$ProductCode.'</td>
																<td class="col-md-1 text-right">$ '.$BuyPrice.'</td>
																<td class="col-md-2 text-center">'.$BuyDate.'</td>
																<td class="col-md-1 text-right">$ '.$SalePrice.'</td>
																<td class="col-md-2 text-center">'.$SaleDate.'</td>
																<td class="col-md-1 text-right">$ '.$OtherCost.'</td>
																<td class="col-md-1 text-right"> '.$Income.'</td>
															</tr>';	
													}
												
													
												} 
											$select1=$db->query("SELECT 
COALESCE((tbl_customerorderdetail.SalePrice),0)-COALESCE((tbl_customerorderdetail.BuyPrice),0)-COALESCE((tbl_customerorderdetail.OtherCost),0) AS totalIncome		
													FROM tbl_customerorder
													INNER JOIN tbl_customerorderdetail
														ON tbl_customerorder.CustomerOrderID = tbl_customerorderdetail.CustomerOrderID
													INNER JOIN tblproducts
														ON tbl_customerorderdetail.ProductID = tblproducts.ProductID
													LEFT JOIN tblbranch
														ON tblbranch.BranchID = tbl_customerorder.SelltoOtherBranch
													INNER JOIN tblproductcategory
														ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
													INNER JOIN tblproducts_buydetail
														ON tblproducts.ProductID = tblproducts_buydetail.ProductID
													INNER JOIN tblproducts_buy 
														ON tblproducts_buy.BuyID = tblproducts_buydetail.BuyID
											WHERE (tblproducts.ProductName LIKE '%".$sarchprd."%' OR tblproducts.ProductCode LIKE '%".$sarchprd."%' )
											AND (tbl_customerorder.CustomerOrderDate BETWEEN '".$txtFrom."' AND '".$txtTo."')
											AND tbl_customerorder.UserID = '".$U_id."'
											");
									
											$rowselect1=$db->dbCountRows($select1);
											if($rowselect1>0){
												$i = 1;
												$TotalIncome = 0;
												while($row=$db->fetch($select1)){
													
													$TotalIncome += $row->totalIncome;
													
												}
											echo '<tr class="odd gradeX">
															<td colspan="8" class="text-right">Total</td>
														   
															<td class="text-right"> $ '.round($TotalIncome,2).'</td>
														</tr>';
												
											}	
											
											else
											{
												echo '<tr class="even">
														<td  colspan="11"><font size="+1" color="#CC0000"> No Products Selected.</font></td>
													
														</td>
													</tr>';	
											}
												
											
												
											}
											
											
										
                                   		echo ' </tbody>';
									}
									else
									{
										echo ' <thead>
										   <tr>
												<th class="col-md-1 text-left">Category</th>
												<th class="col-md-1 text-left">Name</th>
												<th class="col-md-1 text-center">Code</th>
												<th class="col-md-1 text-center">Sale Price</th>
												<th class="col-md-1 text-center">Sale Date</th>
												<th class="col-md-1 text-center">Other Cost</th>
												
											</tr>
										</thead>
										<tbody>';
                                      		$select=$db->query("SELECT 
														tblproductcategory.ProductCategoryName,
														tblproducts.ProductName,
														tblproducts.ProductCode,
														COALESCE((tblproducts_buydetail.BuyPrice),0) AS BuyPrice,
														tblproducts_buy.BuyDate,
														COALESCE((tbl_customerorderdetail.SalePrice),0) AS SalePrice,
														DATE_FORMAT( tbl_customerorder.CustomerOrderDate,'%d %b %Y %h:%m:%s') as SaleDate,
														COALESCE((tbl_customerorderdetail.OtherCost),0) AS OtherCost,
														COALESCE((tbl_customerorderdetail.SalePrice),0)-COALESCE((tblproducts_buydetail.BuyPrice),0)-COALESCE((tbl_customerorderdetail.OtherCost),0) AS Income,
														tbl_customerorder.CustomerOrderID, 
														tbl_customerorderdetail.CustomerOrderDetailID,
														tbl_customerorder.InvoiceNo,
														tbl_customerorder.CustomerOrderDate,
														tblproducts.ProductID,
														tbl_customerorderdetail.BranchID,
														COALESCE((tbl_customerorderdetail.Qty),0) AS Qty,
														COALESCE((tblproducts_buydetail.BuyPrice),0) * COALESCE((tbl_customerorderdetail.Qty),0)  AS Total_Buying,
														COALESCE((tbl_customerorderdetail.SalePrice),0) * COALESCE((tbl_customerorderdetail.Qty),0) AS Total_Salling,
														TIMESTAMPDIFF(MINUTE,tbl_customerorder.CustomerOrderDate,NOW()) AS CalcMin,
														tbl_customerorder.UserID,
														tbl_customerorder.SelltoOtherBranch,
														tblbranch.BranchName,
														tbl_customerorderdetail.Decription
														FROM tbl_customerorder
													INNER JOIN tbl_customerorderdetail
														ON tbl_customerorder.CustomerOrderID = tbl_customerorderdetail.CustomerOrderID
													INNER JOIN tblproducts
														ON tbl_customerorderdetail.ProductID = tblproducts.ProductID
													LEFT JOIN tblbranch
														ON tblbranch.BranchID = tbl_customerorder.SelltoOtherBranch
													INNER JOIN tblproductcategory
														ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
													INNER JOIN tblproducts_buydetail
														ON tblproducts.ProductID = tblproducts_buydetail.ProductID
													INNER JOIN tblproducts_buy 
														ON tblproducts_buy.BuyID = tblproducts_buydetail.BuyID
											WHERE (tblproducts.ProductName LIKE '%".$sarchprd."%' OR tblproducts.ProductCode LIKE '%".$sarchprd."%' )
											AND (tbl_customerorder.CustomerOrderDate BETWEEN '".$txtFrom." 01:01:01' AND '".$txtTo." 23:59:59')
											AND tbl_customerorder.UserID = '".$U_id."'
											ORDER BY tbl_customerorder.CustomerOrderDate DESC");
									
											$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												while($row=$db->fetch($select)){
												$CustomerOrderDetailID = $row->CustomerOrderDetailID;
												$InvoiceNo = $row->InvoiceNo;
												$CustomerOrderDate = $row->CustomerOrderDate;
												$ProductID = $row->ProductID;
												$Qty = $row->Qty;
												
												$CalcMin = $row->CalcMin;
												$BranchName = $row->BranchName;
												$Total_Buying = round($row->Total_Buying,2);
												$Total_Salling = round($row->Total_Salling,2);
												$BranchID = $row->BranchID;
												$Decription = $row->Decription;
												
												$ProductCategoryName = $row->ProductCategoryName;
												$ProductName = $row->ProductName;
												$ProductCode = $row->ProductCode;
												$BuyPrice = round($row->BuyPrice,2);
												$BuyDate = $row->BuyDate;
												$SalePrice = round($row->SalePrice,2);
												$SaleDate = $row->SaleDate;
												$OtherCost = round($row->OtherCost,2);
												$Income = round($row->Income,2) ;
												
													if($CalcMin <=120){
														echo'<tr class="even">
																<td class="col-md-1 text-left">'.$ProductCategoryName .'</td>
																<td class="col-md-1 text-left">'.$ProductName.'</td>
																<td class="col-md-1 text-left">'.$ProductCode.'</td>
																<td class="col-md-1 text-right">$ '.$SalePrice.'</td>
																<td class="col-md-2 text-center">'.$SaleDate.'</td>
																<td class="col-md-1 text-right">';
																echo "<a onclick=\"myOtherCost('".$CustomerOrderDetailID."','".$OtherCost."','".$Decription."')\">".$OtherCost."</a>";
																echo '</td>
																
															</tr>';	
																
													}
													else
													{
														echo'<tr class="even">
																<td class="col-md-1 text-left">'.$ProductCategoryName .'</td>
																<td class="col-md-1 text-left">'.$ProductName.'</td>
																<td class="col-md-1 text-left">'.$ProductCode.'</td>
																<td class="col-md-1 text-right">$ '.$SalePrice.'</td>
																<td class="col-md-2 text-center">'.$SaleDate.'</td>
																<td class="col-md-1 text-right">$ '.$OtherCost.'</td>
																
															</tr>';	
															
													}
												} 
											}
										
                                   		echo ' </tbody>';
									}
								 ?>
                                  
                                  
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                     
             
               
               <div class="modal fade" id="Order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">                    
                  <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">New Product</h4>
                         
                      </div>
                      <div class="modal-body">
                        <form enctype="multipart/form-data" action="saveOtherCose.php">
                          <input type="hidden" name="txtCustomerOrderDetailID" id="CustomerOrderDetailID">
                          <div class="form-group">
                                <label>Other Cost:</label>
                                <div class="input-group"> 
                                <span class="input-group-addon">Price</span>
                                
                                <input type="text"  name="txtsaleprice" onKeyUp="ChangetoKhmer()" id="dolar" onKeyPress="return isNumberKey(event)"  class="form-control" />
                                <input type="text" name="txtsaleprice1" onKeyUp="ChangetoDolar()" id="khmer" onKeyPress="return isNumberKey(event)"  class="form-control"  />
                            	</div>
                          </div>
                          
                          
                          <div class="form-group">
                                <label>Description:</label>
                                <div class="input-group"> 
                                <span class="input-group-addon"></span>
                                <textarea class="form-control" name="txtDesc" id="txtdesc" rows="3"></textarea>
                            	</div>
                          </div>
                         
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                            <input type="submit" name="btnSaveSalling" class="btn btn-primary" value="Save" />
                          </div>
                      </form>
                      
                    </div>
                  </div>
                </div>
                <!-- End New User -->
                
                       <script type="text/javascript">				
				
					  		var dolar = document.getElementById("dolar");
							var khmer = document.getElementById("khmer");
							var txtdesc = document.getElementById("txtdesc");
							var CustomerOrderDetailID = document.getElementById("CustomerOrderDetailID");
							
							function myOtherCost(getCustomerOrderDetailID,getOtherCost,getDecription)
							{
								$('#Order').modal('show');
								//alert(getProductID)
								dolar.value = getOtherCost;
								txtdesc.value = getDecription;
								CustomerOrderDetailID.value = getCustomerOrderDetailID;
								
								khmer.value = parseFloat(dolar.value) * 40 ;
							}
										
							function ChangetoKhmer() {
									
									if(dolar.value == '')
									{
										khmer.value = 0;
									}
									else
									{
										khmer.value = parseFloat(dolar.value) * 40 ;
									}
								}
							function ChangetoDolar(){
								
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
                      </div>
                        <!-- /.panel-body -->
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
<?php include 'footer.php';?>