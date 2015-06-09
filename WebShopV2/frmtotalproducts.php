
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
						SELECT ProductID, '".$U_Brand."', BuyPrice,'0', SalePrice, Qty, '0', BuyPrice * Qty
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
                       
                        <small><a ><i class="fa fa-dashboard"></i> All Products Info</a></small>
                    </h1>
                    <!--<ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Buy Info</a></li>
                        
                        <li class="active">Dashboard</li>
                    </ol>-->
                </section>

                <!-- Main content -->
               
                 <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th colspan="7">
                                                <div class="row">
                                                    
                                                     <form class="form-inline">
                                                     <div class="col-md-12 pull-right">
                                                     
                                                      <div class="form-group">
                                                           
                                                            <select class="form-control" name="BranchID" >
                                                            	
                                                          <?php
														  		
																	
																	$select=$db->query("SELECT BranchID, BranchName FROM `tblbranch` order by BranchID;");
																	$rowselect=$db->dbCountRows($select);
																	if($rowselect>0){
																		while($row=$db->fetch($select)){
																		$BranchID = $row->BranchID;
																		$BranchName = $row->BranchName;
																																			
																			 if($getBranchID == $BranchID)
																			{
																				echo'<option value='.$BranchID.' selected>'.$BranchName.'</option>';
																			}
																			else
																			{
																				echo'<option value='.$BranchID.'>'.$BranchName.'</option>';
																			}
																		} 
																		
																	}
	
                                                           ?>
                                                          	
                                                            </select>
                                                      </div>
                                                      <div class="input-group">
                                                       <input type="text" class="form-control" placeholder="Search Products" value="<?php echo $sarchprd; ?>" name="sarchprd" autofocus>
                                                    <div class="input-group-btn">
                                                        <button name="btnSearch" value="true" class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                                      
                                                    </div>
                                                    </div>
            
                                                    </form>
                                                    
                                                </div>
                                               
                                            </th>
                                           
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <th class="col-md-2 text-center">Name</th>
                                            <th class="col-md-2 text-center">Branch</th>
                                            <th class="col-md-1 text-center">Last Buying</th>
                                            <th class="col-md-1 text-center">Last Salling</th>  
                                            <th class="col-md-1 text-center">QTY In Stock</th>
                                            <th class="col-md-1 text-center">Other Cost</th>
                                            <th class="col-md-1 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
											
											 if($getBranchID == 0)
											 {
											 	$select=$db->query("SELECT tblproductsbranch.ProductID,
															tblbranch.BranchName,
															tblproducts.ProductName,
															tblproducts.ProductCode,
															tblproductsbranch.BuyPrice,
															tblproductsbranch.SalePrice,
															tblproductsbranch.Qty,
															`tblproductsbranch`.OtherCost
															FROM `tblproductsbranch`
															INNER JOIN tblbranch
															ON tblbranch.BranchID = tblproductsbranch.BranchID
															INNER JOIN tblproducts
															ON tblproductsbranch.ProductID = tblproducts.ProductID
															WHERE ( tblproducts.ProductName LIKE N'%".$sarchprd."%' OR tblproducts.ProductCode LIKE N'%".$sarchprd."%')
															AND tblproductsbranch.Qty >0
															ORDER BY tblbranch.BranchID ASC
															 ");
											 }
											 else
											 {
											 	$select=$db->query("SELECT tblproductsbranch.ProductID,
															tblbranch.BranchName,
															tblproducts.ProductName,
															tblproductsbranch.BuyPrice,
															tblproductsbranch.SalePrice,
															tblproducts.ProductCode,
															tblproductsbranch.Qty,
															`tblproductsbranch`.OtherCost
															FROM `tblproductsbranch`
															INNER JOIN tblbranch
															ON tblbranch.BranchID = tblproductsbranch.BranchID
															INNER JOIN tblproducts
															ON tblproductsbranch.ProductID = tblproducts.ProductID
															WHERE ( tblproducts.ProductName LIKE N'%".$sarchprd."%' OR tblproducts.ProductCode LIKE N'%".$sarchprd."%')
															And tblproductsbranch.BranchID = '".$getBranchID."'
															AND tblproductsbranch.Qty >0
															ORDER BY tblbranch.BranchID ASC
													 		");
											 }

											$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												while($row=$db->fetch($select)){
												$PrdBranchID = $row->ProductID;
												$BranchName= $row->BranchName;
												$ProductName = $row->ProductName;
												$ProductCode = $row->ProductCode;
												$BuyPrice = $row->BuyPrice;
												$SalePrice = $row->SalePrice;
												$Qty = $row->Qty;
												$OtherCost = $row->OtherCost;
												$x = $i++;
												echo'<tr class="even">
														<td>'.$ProductName.'</td>
														<td> '.$BranchName.'</td>
														<td class="col-md-1 text-right"> $ '.$BuyPrice.'</td>
														<td class="col-md-1 text-right"> $ '.$SalePrice.'</td>
														<td class="col-md-1 text-center">'.$Qty.'</td>
														<td class="col-md-1 text-center">'.$OtherCost.'</td>
														<td class="col-md-1 text-center">
														<a href="frmbuyPrice.php?PrdBranchID='.$PrdBranchID.'&PrdBranchName='.$ProductName.'&PrdBranchCode='.$ProductCode.'&PrdBranchPrice='.$SalePrice.'&buyprice='.$BuyPrice.'&SPrdBrandID='.$getBranchID.',&othecost='.$OtherCost.' ">
														<button type="button" class="glyphicon glyphicon-pencil btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"></button>
														</a>
														</td>
													</tr>';
													
													
												} 
											}
											else
											{
												echo '<tr class="even">
														<td  colspan="8"><font size="+1" color="#CC0000"> No Products Selected.</font></td>
													
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
                        
                          <!--<div class="form-group">
                                <label>Choose Branch</label>
                                <select class="form-control" name="cboBranch">
                                   
                               <?php
                                 /*	$select=$db->query("SELECT BranchID, BranchName FROM `tblbranch`;");
								  	$rowselect=$db->dbCountRows($select);
                                    if($rowselect>0){
                                        
                                        while($row=$db->fetch($select)){
                                        $BranchID = $row->BranchID;
                                        $BranchName = $row->BranchName;
                                            echo'<option value='.$BranchID.'>'.$BranchName.'</option>';
                                        }
                                        
                                    }*/
                               ?>
                                </select>
                                
                          </div>-->
                          <div class="form-group">
                                <label>Choose Category</label>
                                <select class="form-control" name="cboPrdCate">
                                   
                               <?php
                                 	$select=$db->query("SELECT ProductCategoryID, ProductCategoryName FROM `tblproductcategory`;");
								  	$rowselect=$db->dbCountRows($select);
                                    if($rowselect>0){
                                        
                                        while($row=$db->fetch($select)){
                                        $ProductCategoryID = $row->ProductCategoryID;
                                        $ProductCategoryName = $row->ProductCategoryName;
                                            echo'<option value='.$ProductCategoryID.'>'.$ProductCategoryName.'</option>';
                                        }
                                        
                                    }
                               ?>
                                </select>
                                
                          </div>
                          <div class="form-group">
                            	<label>Product Name: </label>
                                <input name="txtprdname" class="form-control" placeholder="Enter text" required />
                          </div>
                          <div class="form-group">
                                <label>Products Code:</label>
                                <input name="txtcode" class="form-control" placeholder="Enter text" />
                          </div>
                          <div class="form-group">
                                <label>Products QTY:</label>
                                <input name="txtqty" class="form-control" placeholder="Enter text" />
                          </div>
                          <div class="form-group">
                                <label>Buy Price:</label>
                                <div class="input-group"> 
                                <span class="input-group-addon">$</span>
                                <input type="number" name="txtbuyprice" value="1" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
                            	</div>
                          </div>
                          <div class="form-group">
                                <label>Sale Price:</label>
                                <div class="input-group"> 
                                <span class="input-group-addon">$</span>
                                <input type="number" value="1" name="txtsaleprice" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
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