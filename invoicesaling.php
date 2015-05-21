
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
                       
                        <small><a><i class="fa fa-dashboard"></i> Sale History</a></small>
                    </h1>
                    <!--<ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        
                        <li class="active">Dashboard</li>
                    </ol>-->
                </section>

                <!-- Main content -->
               
                 <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th colspan="11">
                                                <div class="row">
                                                    
                                                    
                                                   <a href="invoicesaling_toOtherBranch.php">
                                                    <div class="col-md-3 pull-left">
                                                    	
                                                       <button type="button" class="btn btn-default" aria-label="Left Align">
  <span class="glyphicon glyphicon-new-window" aria-hidden="true"> 
  														
                                                     </div>
                                                   </a> 
                                                     <form class="form-inline">
                                                     <div class="col-md-7 pull-right">
                                                      <div class="form-group">
                                                       
                                                        <input type="text" class="form-control" data-beatpicker="true" id="exampleInputName2" name="txtFrom" 
                                                        <?php 
															if ($txtFrom == "")
															{
																 echo 'value="'.$date.'"';
															}
															else
															{
																 echo 'value="'.$txtFrom.'"';
															}
														?>
                                                       >
                                                      </div>
                                                      <div class="form-group">
                                                       
                                                        <input type="text"  class="form-control" data-beatpicker="true" id="exampleInputEmail2" name="txtTo"
                                                        <?php 
															if ($txtTo == "")
															{
																 echo 'value="'.$date.'"';
															}
															else
															{
																 echo 'value="'.$txtTo.'"';
															}
														?>
                                                        >
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
                                 <?php
								 	if($_SESSION['Level']=='1'){
										echo ' <thead>
                                        <tr>
                                            
                                            <th class="col-md-2 text-center">Date</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Sale to Branch</th>
                                            <th class="col-md-1 text-center">QTY</th>
                                            <th class="col-md-1 text-center">Sale Price</th>
                                            <th class="col-md-1 text-center">Buy Price</th>
                                            <th class="col-md-1 text-center">Total Salling</th>
                                            <th class="col-md-1 text-center">Total Buying</th>
                                            <th class="col-md-1 text-center">Other Price</th>
											<th class="col-md-1 text-center">Description</th>
                                            <th class="col-md-1 text-center">INCOME</th>  
                                        </tr>
                                    </thead>
                                    <tbody>';
                                      
										
										    $select=$db->query("SELECT tbl_customerorder.CustomerOrderID, 
															tbl_customerorderdetail.CustomerOrderDetailID,
															tbl_customerorder.InvoiceNo,
															tbl_customerorder.CustomerOrderDate,
															tblproducts.ProductID,
															tbl_customerorderdetail.BranchID,
															tblproducts.ProductName,
															COALESCE((tbl_customerorderdetail.OtherCost),0) AS OtherCost,
																COALESCE((tbl_customerorderdetail.BuyPrice),0) AS BuyPrice,
																COALESCE((tbl_customerorderdetail.SalePrice),0) AS SalePrice,
																COALESCE((tbl_customerorderdetail.Qty),0) AS Qty,
															COALESCE((tbl_customerorderdetail.BuyPrice),0) * COALESCE((tbl_customerorderdetail.Qty),0)  AS Total_Buying,
															COALESCE((tbl_customerorderdetail.SalePrice),0) * COALESCE((tbl_customerorderdetail.Qty),0) AS Total_Salling,
															DATE_FORMAT( tbl_customerorder.CustomerOrderDate,'%d %b %Y %h:%m:%s') as SaleDate,
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
												$ProductName = $row->ProductName;
												$Qty = $row->Qty;
												$BuyPrice = round($row->BuyPrice,2);
												$SalePrice = round($row->SalePrice,2);
												$SaleDate = $row->SaleDate;
												$CalcMin = $row->CalcMin;
												$OtherCost = round($row->OtherCost,2);
												$BranchName = $row->BranchName;
												$Total_Buying = round($row->Total_Buying,2);
												$Total_Salling = round($row->Total_Salling,2);
												$Income = round($Total_Salling - ($Total_Buying + $OtherCost),2) ;
												$BranchID = $row->BranchID;
												$Decription = $row->Decription;
												
													if($CalcMin <=120){
														echo'<tr class="even">
																<td>'.$SaleDate.'</td>
																<td>'.$ProductName.'</td>
																<td>'.$BranchName.'</td>
																<td class="text-center">'.$Qty.'</td>
																<td class="text-right">$ '.$SalePrice.'</td>
																<td class="text-right">$ '.$BuyPrice.'</td>
																<td class="text-right">$ '.$Total_Salling.'</td>
																<td class="text-right">$ '.$Total_Buying.'</td>
																<td class="text-right">$ '.$OtherCost.'</td>
																<td class="text-right"> '.$Decription.'</td>
																<td class="text-right"> $ <a href="frmAfterSaling.php?Buydetailid='.$CustomerOrderDetailID.'&ProductID='.$ProductID.'&branchid='.$BranchID.'&ProductsName='.$ProductName.'&Qty='.$Qty.'&othecost='.$OtherCost.'&desc='.$Decription.'">'.$Income.' </a></td>
															</tr>';	
																
													}
													else
													{
														echo'<tr class="even">
																<td>'.$SaleDate.'</td>
																<td>'.$ProductName.'</td>
																<td>'.$BranchName.'</td>
																<td class="text-center">'.$Qty.'</td>
																<td class="text-right">$ '.$SalePrice.'</td>
																<td class="text-right">$ '.$BuyPrice.'</td>
																<td class="text-right">$ '.$Total_Salling.'</td>
																<td class="text-right">$ '.$Total_Buying.'</td>
																<td class="text-right">$ '.$OtherCost.'</td>
																<td class="text-right"> '.$Decription.'</td>
																<td class="text-right">$ '.$Income.'</td>
															</tr>';	
															
													}
												
													
												} 
											$select1=$db->query("SELECT 
																COALESCE((tbl_customerorderdetail.OtherCost),0) AS OtherCost,
																COALESCE((tbl_customerorderdetail.BuyPrice),0) AS BuyPrice,
																COALESCE((tbl_customerorderdetail.SalePrice),0) AS SalePrice,
																COALESCE((tbl_customerorderdetail.Qty),0) AS QTY
															FROM tbl_customerorder
															INNER JOIN tbl_customerorderdetail
															ON tbl_customerorder.CustomerOrderID = tbl_customerorderdetail.CustomerOrderID
															INNER JOIN tblproducts
															ON tbl_customerorderdetail.ProductID = tblproducts.ProductID
															LEFT JOIN tblbranch
															ON tblbranch.BranchID = tbl_customerorder.SelltoOtherBranch
											WHERE (tblproducts.ProductName LIKE '%".$sarchprd."%' OR tblproducts.ProductCode LIKE '%".$sarchprd."%' )
											AND (tbl_customerorder.CustomerOrderDate BETWEEN '".$txtFrom." 01:01:01' AND '".$txtTo." 23:59:59')
											AND tbl_customerorder.UserID = '".$U_id."'
											ORDER BY tbl_customerorder.CustomerOrderDate DESC");
									
											$rowselect1=$db->dbCountRows($select1);
											if($rowselect1>0){
												$i = 1;
												$TotalIncome = 0;
												while($row=$db->fetch($select1)){
													$OtherCost = $row->OtherCost;
													$BuyPrice = $row->BuyPrice;
													$SalePrice = $row->SalePrice;
													$QTY = $row->QTY;
													$TotalIncome += ($SalePrice * $QTY) - (($BuyPrice*$QTY)+ $OtherCost);
													
													
												}
												echo '<tr class="odd gradeX">
																<td colspan="10" class="text-right">Total</td>
															   
																<td class="text-right"> $ '.round($TotalIncome,2).'</td>
															</tr>';
											}	
												
											
												
											}
											
											else
											{
												echo '<tr class="even">
														<td  colspan="11"><font size="+1" color="#CC0000"> No Products Selected.</font></td>
													
														</td>
													</tr>';	
											}
										
                                   		echo ' </tbody>';
									}
									else
									{
										echo ' <thead>
                                        <tr>
                                            
                                            <th class="col-md-2 text-center">Date</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Sale to Branch</th>
                                            <th class="col-md-1 text-center">QTY</th>
                                            <th class="col-md-1 text-center">Sale Price</th>
                                            <th class="col-md-1 text-center">Other Price</th>
                                        	<th class="col-md-1 text-center">Total Salling</th>
										</tr>
                                    </thead>
                                    <tbody>';
                                      
										
										    $select=$db->query("SELECT tbl_customerorder.CustomerOrderID, 
															tbl_customerorderdetail.CustomerOrderDetailID,
															tbl_customerorder.InvoiceNo,
															tbl_customerorder.CustomerOrderDate,
															tblproducts.ProductID,
															tblproducts.ProductName,
															COALESCE((tbl_customerorderdetail.OtherCost),0) AS OtherCost,
																COALESCE((tbl_customerorderdetail.BuyPrice),0) AS BuyPrice,
																COALESCE((tbl_customerorderdetail.SalePrice),0) AS SalePrice,
																COALESCE((tbl_customerorderdetail.Qty),0) AS Qty,
															COALESCE((tbl_customerorderdetail.BuyPrice),0) * COALESCE((tbl_customerorderdetail.Qty),0)  AS Total_Buying,
															COALESCE((tbl_customerorderdetail.SalePrice),0) * COALESCE((tbl_customerorderdetail.Qty),0) AS Total_Salling,
															DATE_FORMAT( tbl_customerorder.CustomerOrderDate,'%d %b %Y %h:%m:%s') as SaleDate,
															TIMESTAMPDIFF(MINUTE,tbl_customerorder.CustomerOrderDate,NOW()) AS CalcMin,
															tbl_customerorder.UserID,
															tbl_customerorder.SelltoOtherBranch,
															tblbranch.BranchName
															FROM tbl_customerorder
															INNER JOIN tbl_customerorderdetail
															ON tbl_customerorder.CustomerOrderID = tbl_customerorderdetail.CustomerOrderID
															INNER JOIN tblproducts
															ON tbl_customerorderdetail.ProductID = tblproducts.ProductID
															LEFT JOIN tblbranch
															ON tblbranch.BranchID = tbl_customerorder.SelltoOtherBranch
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
												$ProductName = $row->ProductName;
												$Qty = $row->Qty;
												$BuyPrice = $row->BuyPrice;
												$SalePrice = $row->SalePrice;
												$SaleDate = $row->SaleDate;
												$CalcMin = $row->CalcMin;
												$OtherCost = $row->OtherCost;
												$BranchName = $row->BranchName;
												$Total_Buying = $row->Total_Buying;
												$Total_Salling = $row->Total_Salling;
												$Income = $Total_Salling - ($Total_Buying + $OtherCost) ;
												
													if($CalcMin <=120){
														echo'<tr class="even">
																<td>'.$SaleDate.'</td>
																<td>'.$ProductName.'</td>
																<td>'.$BranchName.'</td>
																<td class="text-center">'.$Qty.'</td>
																<td class="text-right">$ '.$SalePrice.'</td>
																<td class="text-right">$ '.$OtherCost.'</td>
																<td class="text-right">$ '.$Total_Salling.'</td>
															</tr>';	
																
													}
													else
													{
														echo'<tr class="even">
																<td>'.$SaleDate.'</td>
																<td>'.$ProductName.'</td>
																<td>'.$BranchName.'</td>
																<td class="text-center">'.$Qty.'</td>
																<td class="text-right">$ '.$SalePrice.'</td>
																<td class="text-right">$ '.$OtherCost.'</td>
																<td class="text-right">$ '.$Total_Salling.'</td>
																
															</tr>';	
															
													}
												} 
											$select1=$db->query("SELECT 
																COALESCE((tbl_customerorderdetail.OtherCost),0) AS OtherCost,
																COALESCE((tbl_customerorderdetail.BuyPrice),0) AS BuyPrice,
																COALESCE((tbl_customerorderdetail.SalePrice),0) AS SalePrice,
																COALESCE((tbl_customerorderdetail.Qty),0) AS QTY
															FROM tbl_customerorder
															INNER JOIN tbl_customerorderdetail
															ON tbl_customerorder.CustomerOrderID = tbl_customerorderdetail.CustomerOrderID
															INNER JOIN tblproducts
															ON tbl_customerorderdetail.ProductID = tblproducts.ProductID
															LEFT JOIN tblbranch
															ON tblbranch.BranchID = tbl_customerorder.SelltoOtherBranch
											WHERE (tblproducts.ProductName LIKE '%".$sarchprd."%' OR tblproducts.ProductCode LIKE '%".$sarchprd."%' )
											AND (tbl_customerorder.CustomerOrderDate BETWEEN '".$txtFrom." 01:01:01' AND '".$txtTo." 23:59:59')
											AND tbl_customerorder.UserID = '".$U_id."'
											ORDER BY tbl_customerorder.CustomerOrderDate DESC");
									
											$rowselect1=$db->dbCountRows($select1);
											if($rowselect1>0){
												$i = 1;
												$TotalIncome = 0;
												while($row=$db->fetch($select1)){
													$OtherCost = $row->OtherCost;
													$BuyPrice = $row->BuyPrice;
													$SalePrice = $row->SalePrice;
													$QTY = $row->QTY;
													$TotalIncome += ($SalePrice * $QTY);
													
													
												}
												echo '<tr class="odd gradeX">
																<td colspan="7" class="text-right">Total</td>
															   
																<td class="text-right"> $ '.$TotalIncome.'</td>
															</tr>';
											}	
												
											
												
											}
											
											else
											{
												echo '<tr class="even">
														<td  colspan="11"><font size="+1" color="#CC0000"> No Products Selected.</font></td>
													
														</td>
													</tr>';	
											}
										
                                   		echo ' </tbody>';
									}
								 ?>
                                  
                                  
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