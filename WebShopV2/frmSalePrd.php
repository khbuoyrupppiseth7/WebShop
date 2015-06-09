
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
		
		$insert=$db->query("INSERT INTO tblprdsaletem (
							IP
							, ProductID
							, ProductName
							, ProductCategoryID
							, ProductCode
							, QTY
							, BuyPrice
							, SalePrice
							, PrdCopied
							, isStock
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
							'1'
							);
							");
			
			if($insert){
				cRedirect('index.php');
			}
		$error = "Error Internet Connection!";
		}

 // product Check Out-------------------------------------------------------------------------------
		if(isset($_POST['btnCheckout'])){
			$cboBranch = post('cboBranch');
			
			if($U_Brandid == $cboBranch)
			{
				$autoid = time();
				/*Create Invoice Customer Sale*/
				$copy=$db->query(" INSERT INTO tbl_customerorder ( 
									CustomerOrderID,
									BranchID,
									InvoiceNo,
									CustomerOrderDate,
									UserID
									)
									VALUES
									(
									'".$autoid."',
									'".$cboBranch."',
									'".$autoid."',
									'".$date_now."',
									'".$U_id."'
									)");
			 // -----------------------------------------------------
			 // Create Invoice Detail
				$InvoiceDetail = $db->query("SELECT 
											IP,
											ProductID,
											ProductName,
											BranchID,
											ProductCategoryID,
											ProductCode,
											QTY,
											BuyPrice,
											SalePrice,
											QTY * SalePrice As Total,
											isStock
											FROM `tblprdsaletem`;");
				$rowinvoicedetail=$db->dbCountRows($InvoiceDetail);
				if($rowinvoicedetail>0){
					$i=1;
					while($row=$db->fetch($InvoiceDetail)){
						$ProductID = $row->ProductID;
						$QTY = $row->QTY;
						$BuyPrice = $row->BuyPrice;
						$SalePrice = $row->SalePrice;
						$Total = $row->Total;
						$isStock = $row->isStock;
						
						$insertCustomerOrderdetail = $db->query("
							INSERT INTO `tbl_customerorderdetail`
							(
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
							'".time().$i++."',
							'".$cboBranch."',
							'".$autoid."',
							'".$ProductID."',
							'".$QTY."',
							'".$SalePrice."',
							'".$BuyPrice."',
							'0',
							'0',
							'0',
							'".$Total."',
							'Powered by 7Technology'
							)	
						");
						if($isStock == 1)
						{
							$deductQty= $db->query("UPDATE tblproductsbranch SET Qty =  Qty - ".$QTY." WHERE ProductID = '".$ProductID."' ");
						}
						else
						{
							$deductQty= $db->query("UPDATE tblproductsbranch SET Qty =  Qty - 0 WHERE ProductID = '".$ProductID."' ");
						}
					}
				}
			}
			
		// check Condition that is new branch --------------------------
			else
			{
				$autoid = time();
				/*Create Invoice Customer Sale*/
				$copy=$db->query(" INSERT INTO tbl_customerorder ( 
									CustomerOrderID,
									BranchID,
									InvoiceNo,
									CustomerOrderDate,
									Decription,
									UserID,
									SelltoOtherBranch
									)
									VALUES
									(
									'".$autoid."',
									'".$cboBranch."',
									'".$autoid."',
									'".$date_now."',
									'".$U_id."-".$cboBranch."',
									'".$U_id."',
									'".$cboBranch."'
									)");
			 // -----------------------------------------------------
			 // Create Invoice Detail
				$InvoiceDetail = $db->query("SELECT 
											IP,
											ProductID,
											ProductName,
											BranchID,
											ProductCategoryID,
											ProductCode,
											QTY,
											BuyPrice,
											SalePrice,
											QTY * SalePrice As Total,
											isStock
											FROM `tblprdsaletem`;");
				$rowinvoicedetail=$db->dbCountRows($InvoiceDetail);
				if($rowinvoicedetail>0){
					// echo $rowinvoicedetail;
				 
					$i=1;
					$j=1;
					while($row=$db->fetch($InvoiceDetail)){
				
						$ProductID = $row->ProductID;
						$QTY = $row->QTY;
						
						$BuyPrice = $row->BuyPrice;
						$SalePrice = $row->SalePrice;
						$Total = $row->Total;
						$isStock = $row->isStock;
						
						$insertCustomerOrderdetail = $db->query("
							INSERT INTO `tbl_customerorderdetail`
							(
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
							'".time().$i++.$j++."',
							'".$cboBranch."',
							'".$autoid."',
							'".$ProductID."',
							'".$QTY."',
							'".$SalePrice."',
							'".$BuyPrice."',
							'0',
							'0',
							'0',
							'".$Total."',
							'Powered by 7Technology'
							)	
						");
						
						if($isStock == 1)
						{
							//Check for Old branch and new products
							$checkprd = $db->query("SELECT ProductID as Prdid FROM `tblproductsbranch` WHERE ProductID = '".$ProductID."' and BranchID = '".$cboBranch."';");
							$Numcheckprd=$db->dbCountRows($checkprd);
							
							if($Numcheckprd>0){
								$i=1;
								$j=2;
							//	while($rowcheckprd=$db->fetch($checkprd)){
									$rowcheckprd=$db->fetch($checkprd);
									$Prdid = $rowcheckprd-> Prdid;
									
									if($ProductID == $Prdid)
									{
										$addQty= $db->query("UPDATE tblproductsbranch SET Qty =  Qty + ".$QTY." WHERE ProductID = '".$ProductID."' and BranchID = '".$cboBranch."' ");
										$deductQty= $db->query("UPDATE tblproductsbranch SET Qty =  Qty - ".$QTY." WHERE ProductID = '".$ProductID."' AND BranchID = '".$U_Brandid."'; ");	
									}
									
									else
									{
										$inserttobranch=$db->query("INSERT INTO tblproductsbranch(
										ProductID, 
										BranchID,
										FromBranchID,
										FromPrdID,
										BuyPrice,
										SalePrice,
										Qty,
										Decription
										)
										VALUES
										(
										'".$ProductID."',
										'".$cboBranch."',
										'".$U_Brandid."',
										'".$ProductID."',
										'".$BuyPrice."',
										'".$SalePrice."',
										'".$QTY."',
										'IDUser:".$U_id." and Sell to Branch: '".$cboBranch."'
										)");
										$deductQty= $db->query("UPDATE tblproductsbranch SET Qty =  Qty - ".$QTY." WHERE ProductID = '".$ProductID."' AND BranchID = '".$U_Brandid."'; ");	
									}
								}
								else{
									$inserttobranch=$db->query("INSERT INTO tblproductsbranch(
											ProductID, 
											BranchID,
											FromBranchID,
											FromPrdID,
											BuyPrice,
											SalePrice,
											Qty,
											Decription
											)
											VALUES
											(
											'".$ProductID."',
											'".$cboBranch."',
											'".$U_Brandid."',
											'".$ProductID."',
											'".$BuyPrice."',
											'".$SalePrice."',
											'".$QTY."',
											'".$U_id."-".$cboBranch."'
											)");
										// echo $QTY;
											$deductQty= $db->query("UPDATE tblproductsbranch SET Qty = Qty - ".$QTY." WHERE ProductID = '".$ProductID."' AND BranchID = '".$U_Brandid."'; ");	
								}
						}
						else // check for is not stock
						{
								//Check for Old branch and new products
							$checkprd = $db->query("SELECT ProductID as Prdid FROM `tblproductsbranch` WHERE ProductID = '".$ProductID."' and BranchID = '".$cboBranch."';");
							$Numcheckprd=$db->dbCountRows($checkprd);
							
							if($Numcheckprd>0){
								$i=1;
								$j=2;
							//	while($rowcheckprd=$db->fetch($checkprd)){
									$rowcheckprd=$db->fetch($checkprd);
									$Prdid = $rowcheckprd-> Prdid;
									
									if($ProductID == $Prdid)
									{
										$addQty= $db->query("UPDATE tblproductsbranch SET Qty =  Qty + 0 WHERE ProductID = '".$ProductID."' and BranchID = '".$cboBranch."' ");
										$deductQty= $db->query("UPDATE tblproductsbranch SET Qty =  Qty - 0 WHERE ProductID = '".$ProductID."' AND BranchID = '".$U_Brandid."'; ");	
									}
									
									else
									{
										$inserttobranch=$db->query("INSERT INTO tblproductsbranch(
										ProductID, 
										BranchID,
										FromBranchID,
										FromPrdID,
										BuyPrice,
										SalePrice,
										Qty,
										Decription
										)
										VALUES
										(
										'".$ProductID."',
										'".$cboBranch."',
										'".$U_Brandid."',
										'".$ProductID."',
										'".$BuyPrice."',
										'".$SalePrice."',
										'".$QTY."',
										'IDUser:".$U_id." and Sell to Branch: '".$cboBranch."'
										)");
										$deductQty= $db->query("UPDATE tblproductsbranch SET Qty =  Qty - 0 WHERE ProductID = '".$ProductID."' AND BranchID = '".$U_Brandid."'; ");	
									}
								}
								else{
									$inserttobranch=$db->query("INSERT INTO tblproductsbranch(
											ProductID, 
											BranchID,
											FromBranchID,
											FromPrdID,
											BuyPrice,
											SalePrice,
											Qty,
											Decription
											)
											VALUES
											(
											'".$ProductID."',
											'".$cboBranch."',
											'".$U_Brandid."',
											'".$ProductID."',
											'".$BuyPrice."',
											'".$SalePrice."',
											'".$QTY."',
											'".$U_id."-".$cboBranch."'
											)");
										// echo $QTY;
											$deductQty= $db->query("UPDATE tblproductsbranch SET Qty = Qty - 0 WHERE ProductID = '".$ProductID."' AND BranchID = '".$U_Brandid."'; ");	
								}			

						}
						
						//$deductQty= $db->query("UPDATE tblproductsbranch SET Qty =  Qty - ".$QTY." WHERE ProductID = '".$ProductID."' ");	
					}
					
				}
				// Check if products has ready -------------------------
							
			}
			
			if($copy){
				$delete=$db->query("DELETE FROM `tblprdsaletem` WHERE IP = '".$ip."'");
				
				//cRedirect('frmSalePrd.php');
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
                       
                        <small><i class="fa fa-dashboard"></i>Panel Sale ( Sale in Branch " <?php echo $U_Branchname; ?> ")</small>
                    </h1>
                    <!--<ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        
                        <li class="active">Sale</li>
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
                                                    
                                                   <!-- <div class="col-md-3">
                                                      	
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                                            Choose branch
                                                            <span class="caret"></span>                                                          </button>
                                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                           
                                                            <?php
                                                               
															   /* $select=$db->query("SELECT BranchID, BranchName FROM `tblbranch`;");
                                                                
																$rowselect=$db->dbCountRows($select);
                                                                if($rowselect>0){
                                                                    while($row=$db->fetch($select)){
                                                                    $BranchID = $row->BranchID;
                                                                    $BranchName = $row->BranchName;
                                                                        echo'<li role="presentation"><a role="menuitem" tabindex="-1" href="frmSalePrd.php?branchid='.$BranchID.'">'.$BranchName.'</a></li>';
                                                                    } 
                                                                }*/
                                                           ?>
                                                          </ul>
                                                    </div>-->
                                                    
                                                    <div class="col-md-6 pull-center" >
                                                      	
                                                            <button type="button" class="btn btn-default" aria-label="Left Align">
  <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"> 
  
														<?php
                                                            $select=$db->query("SELECT COUNT(ProductID) AS TotalOrder FROM `tblprdsaletem` WHERE IP = '".$ip."';");
                                                            $rowselect=$db->dbCountRows($select);
                                                            if($rowselect>0){
                                                                
                                                                while($row=$db->fetch($select)){
                                                                $TotalOrder = $row->TotalOrder;
                                                            
                                                                    echo'QTY Products: ' . $TotalOrder;
                                                                }
                                                                
                                                            }
                                                       ?>
  </span></button>
													<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                                            Total All Cart
                                                            <span class="caret"></span>
                                                   </button>
                                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                           
                                                          <?php
                                                                $select=$db->query("SELECT ProductID , ProductName, QTY FROM `tblprdsaletem`  WHERE IP = '".$ip."' Order by ProductName;");
                                                                $rowselect=$db->dbCountRows($select);
                                                                if($rowselect>0){
                                                                    while($row=$db->fetch($select)){
																	$ProductID = $row->ProductID;
                                                                    $ProductName = $row->ProductName;
                                                                    $QTY = $row->QTY;
																		echo'<li role="presentation"><a role="menuitem" tabindex="-1" 
																		href="frmSalePrd-Editeachone.php?ProductID='.$ProductID.'">'.$ProductName.' ( '.$QTY.' ) </a> </li>';
                                                                    } 
																	echo '</ul>';
																	echo '<button type="button" class="glyphicon glyphicon-random btn btn-primary"  data-toggle="modal" data-target=".bs-example-modal-sm"> Save</button>';
                                                                }
																else
																{
																		echo '</ul>';
																		echo '<button type="button" class="glyphicon glyphicon-random btn btn-default"> Save</button>';
																}
                                                           ?>
                                                                                                               
                                                    </div>
                                                       <!-- Check Out Form -->
                                                        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                  <form method="post" enctype="multipart/form-data">
                                                                  <!--<div class="form-group">
                                                                        <label>Choose Branch</label>
                                                                        <select class="form-control" name="cboBranch">
                                                                           
                                                                       <?php
                                                                         	/*$select=$db->query("SELECT BranchID, BranchName FROM `tblbranch`;");
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
                                              <div class="checkbox">
                                                        <div class="form-group">
                                                                        <label>Choose Branch</label>
                                                                        <select class="form-control" name="cboBranch">
                                                                          
                                                                       <?php
                                                                         	$select=$db->query("SELECT BranchID, BranchName FROM `tblbranch` where BranchID!= 0;");
                                                                            $rowselect=$db->dbCountRows($select);
                                                                            if($rowselect>0){
                                                                                
                                                                                while($row=$db->fetch($select)){
                                                                                $BranchID = $row->BranchID;
                                                                                $BranchName = $row->BranchName;
																				if($BranchID == $U_Brandid)
																				{
																					echo'<option value="'.$BranchID.'" selected >Cutomer</option>';
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
                                                      <label>
                                                       Choose Branch for Sale!
                                                      </label>
                                                      <input type="submit" name="btnCheckout" class="btn btn-primary" value="Save" />
                                                    </div>
                                                         </form>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- Check Out Form -->
                                                    
                                                    <form  role="search">
                                                    <div class="col-md-3 pull-right">
                                                      	
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" placeholder="Search" value="<?php echo $sarchprd; ?>" name="sarchprd" autofocus>
                                                                <div class="input-group-btn">
                                                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                                                </div>
                                                            </div>
                                                    </div>
                                                     </form>
                                                    
                                                </div>                                            </th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            
                                            <th class="col-md-2 text-left">Category</th>
                                            <th class="col-md-3 text-left">Name</th>
                                            <th class="col-md-1 text-center">QTY</th>
                                            
                                            <th class="col-md-1 text-center">SalePrice</th>  
                                            <th class="col-md-1 text-center">Action</th>
                                            
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
										if($sarchprd != "")
										{
											$select=$db->query("SELECT 
															`tblproducts`.ProductID,
															`tblproducts`.ProductName,
															`tblproducts`.ProductCode,
															`tblproducts`.ProductCategoryID,
															tblproductcategory.ProductCategoryName,
															tblproductsbranch.Qty - COALESCE((SELECT Qty FROM tblprdsaletem WHERE ProductID = `tblproducts`.ProductID),0) AS Qty,
															tblproductsbranch.BuyPrice,
															tblproductsbranch.SalePrice,
															tblproductsbranch.isStock
															FROM `tblproducts`
															INNER JOIN tblproductcategory
															ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
															INNER JOIN tblproductsbranch
															ON tblproducts.ProductID = tblproductsbranch.ProductID
														WHERE ( `tblproducts`.ProductName LIKE N'%".$sarchprd."%' 
														OR `tblproducts`.ProductCode LIKE N'%".$sarchprd."%')
														and tblproductsbranch.BranchID = '".$U_Brandid."' 
														and tblproductsbranch.Qty >0;
														");
										}
										else
										{
											$select=$db->query("SELECT 
															`tblproducts`.ProductID,
															`tblproducts`.ProductName,
															`tblproducts`.ProductCode,
															`tblproducts`.ProductCategoryID,
															tblproductcategory.ProductCategoryName,
															tblproductsbranch.Qty - COALESCE((SELECT Qty FROM tblprdsaletem WHERE ProductID = 				`tblproducts`.ProductID),0) AS Qty,
															tblproductsbranch.BuyPrice,
															tblproductsbranch.SalePrice,
															tblproductsbranch.isStock
															FROM `tblproducts`
															INNER JOIN tblproductcategory
															ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
															INNER JOIN tblproductsbranch
															ON tblproducts.ProductID = tblproductsbranch.ProductID
														WHERE tblproductsbranch.BranchID = '".$U_Brandid."' 
														And tblproductsbranch.Qty >0;
														");
										}
											
											$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												while($row=$db->fetch($select)){
												$ProductID = $row->ProductID;
												$ProductCategoryID = $row->ProductCategoryID;
												$ProductName = $row->ProductName;
												$ProductCategoryName = $row->ProductCategoryName;
												$ProductCode = $row->ProductCode;
												$Qty = $row->Qty;
												$BuyPrice = $row->BuyPrice;
												$SalePrice = $row->SalePrice;
												$x = $i++;
												$isStock = $row->isStock;
												if($isStock == 1)
												{
													echo'<tr class="even">
															<td>'.$ProductCategoryName.'</td>
															<td>'.$ProductName.'</td>
															<td class="col-md-1 text-center">'.$Qty.'</td>
															
															<td class="col-md-1 text-right">$ '.$SalePrice.'</td> 
															<td class="col-md-1 text-center">
															<a href="clickSalePrd.php?ProductID='.$ProductID.'
															&ProductName='.$ProductName.'
															&ProductCategoryID='.$ProductCategoryID.'
															&ProductCode='.$ProductCode.'
															&QTY='.$Qty.'
															&BuyPrice='.$BuyPrice.'
															&SalePrice='.$SalePrice.'
															&sarchprd='.$sarchprd.'
															&isStock='.$isStock.'
															">
															<button type="button" class="btn btn-default" aria-label="Left Align">
															  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
															</button></a>
															</td>
														</tr>';
													}
													else
													{
														echo'<tr class="even">
															<td>'.$ProductCategoryName.'</td>
															<td>'.$ProductName.'</td>
															<td class="col-md-1 text-center"> 1 </td>
															
															<td class="col-md-1 text-right">$ '.$SalePrice.'</td> 
															<td class="col-md-1 text-center">
															<a href="clickSalePrd.php?ProductID='.$ProductID.'
															&ProductName='.$ProductName.'
															&ProductCategoryID='.$ProductCategoryID.'
															&ProductCode='.$ProductCode.'
															&QTY= 1
															&BuyPrice='.$BuyPrice.'
															&SalePrice='.$SalePrice.'
															&sarchprd='.$sarchprd.'
															&isStock='.$isStock.'
															">
															<button type="button" class="btn btn-default" aria-label="Left Align">
															  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
															</button></a>
															</td>
														</tr>';
													}
													
													
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
                                           <tr class="even">
														<td  align="center" colspan="4"><font size="+1" color="#CC0000"> Products Order </font></td>
														<td  align="center" ><font size="+1" color="#CC0000"> Total</font></td>
														
											</tr>
                                            <?php
										
											$select=$db->query("SELECT ProductID,
																ProductName,
																QTY,
																BuyPrice,
																SalePrice,
																ProductCategoryName,
																QTY * SalePrice AS total
																FROM tblprdsaletem
																INNER JOIN tblproductcategory ON
																tblprdsaletem.ProductCategoryID = tblproductcategory.ProductCategoryID
															 ");

											$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												while($row=$db->fetch($select)){
												$ProductID = $row->ProductID;
												$ProductName = $row->ProductName;
												$ProductCategoryName = $row->ProductCategoryName;
											
												$Qty = $row->QTY;
												$BuyPrice = $row->BuyPrice;
												$SalePrice = $row->SalePrice;
												$total = round($row->total, 2);
												
												$x = $i++;
												echo'<tr class="even">
														
														<td>'.$ProductCategoryName.'</td>
														<td>'.$ProductName.'</td>
														<td class="col-md-1 text-center">'.$Qty.'</td>
														<td class="col-md-1 text-right" >$ '.$SalePrice.'</td> 
														<td class="col-md-1 text-right"><a href="frmSalePrd-Editeachone.php?ProductID='.$ProductID.'">$ '.$total.'</a></td>
														
													</tr>';
													/*<td class="center">
														<a href="frmSalePrd-Editeachone.php?ProductID='.$ProductID.'">
														<button type="button" class="btn btn-default" aria-label="Left Align">
  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
</button></a>
														</td>*/
												
													
												} 
												
											}
											$select=$db->query("SELECT SUM(QTY) AS QTY, SUM(SalePrice) AS SalePrice, SUM(QTY * SalePrice) AS Total FROM `tblprdsaletem`;											");

											$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												while($row=$db->fetch($select)){
												$Qty = $row->QTY;												
												$BuyPrice = $row->Total;
												$SalePrice = round($row->SalePrice, 2);
												$total = round($row->Total, 2);
												
												echo'<tr class="odd">
														
														<td colspan="2" class="text-right no-border"><b>Total:</b></td>
														<td class="col-md-1 text-center">'.$Qty.'</td>
														<td class="col-md-1 text-right" >$ '.$SalePrice.'</td> 
														<td class="col-md-1 text-right"><a>$ '.$total.'</a></td>
														
													</tr>';	
											}
										}
									   ?>    
                                         
                                    </tbody >
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
                          <!--<div class="form-group">
                                <label>Choose Category</label>
                                <select class="form-control" name="cboPrdCate">
                                   
                               <?php
                                 	/*$select=$db->query("SELECT ProductCategoryID, ProductCategoryName FROM `tblproductcategory`;");
								  	$rowselect=$db->dbCountRows($select);
                                    if($rowselect>0){
                                        
                                        while($row=$db->fetch($select)){
                                        $ProductCategoryID = $row->ProductCategoryID;
                                        $ProductCategoryName = $row->ProductCategoryName;
                                            echo'<option value='.$ProductCategoryID.'>'.$ProductCategoryName.'</option>';
                                        }
                                        
                                    }*/
                               ?>
                                </select>
                                
                          </div>-->
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