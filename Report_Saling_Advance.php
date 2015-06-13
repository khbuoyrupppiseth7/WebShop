
<?php include 'header.php';

$getcheckUser1 = get('checkUser1'); $getcheckUser2 = get('checkUser2');$getcheckUser3 = get('checkUser3'); $getcheckUser4 = get('checkUser4');$getcheckUser5 = get('checkUser5'); $getcheckUser6 = get('checkUser6');$getcheckUser7 = get('checkUser7'); $getcheckUser8 = get('checkUser8');$getcheckUser9 = get('checkUser9'); $getcheckUser10 = get('checkUser10');$getcheckUser11 = get('checkUser11'); $getcheckUser12 = get('checkUser12');$getcheckUser13 = get('checkUser13'); $getcheckUser14 = get('checkUser14');$getcheckUser15 = get('checkUser15'); $getcheckUser16 = get('checkUser16');$getcheckUser17 = get('checkUser17'); $getcheckUser18 = get('checkUser18');$getcheckUser19 = get('checkUser19'); 
$getcheckUser20 = get('checkUser20');$getcheckUser21 = get('checkUser21'); $getcheckUser22 = get('checkUser22');$getcheckUser23 = get('checkUser23'); $getcheckUser24 = get('checkUser24');$getcheckUser25 = get('checkUser25'); $getcheckUser26 = get('checkUser26');$getcheckUser27 = get('checkUser27'); $getcheckUser28 = get('checkUser28');
$getcheckUser29 = get('checkUser29'); $getcheckUser30 = get('checkUser30');$getcheckUser31 = get('checkUser31'); $getcheckUser32 = get('checkUser32');$getcheckUser33 = get('checkUser33'); $getcheckUser34 = get('checkUser34');$getcheckUser35 = get('checkUser35'); $getcheckUser36 = get('checkUser36');$getcheckUser37 = get('checkUser37'); 
$getcheckUser38 = get('checkUser38');$getcheckUser39 = get('checkUser39'); $getcheckUser40 = get('checkUser40');$getcheckUser41 = get('checkUser41'); $getcheckUser42 = get('checkUser42');$getcheckUser43 = get('checkUser43'); $getcheckUser44 = get('checkUser44');$getcheckUser45 = get('checkUser45'); $getcheckUser46 = get('checkUser46');
$getcheckUser47 = get('checkUser47'); $getcheckUser48 = get('checkUser48');$getcheckUser49 = get('checkUser49'); $getcheckUser50 = get('checkUser50');
$getcheckUser51 = get('checkUser51');$getcheckUser52 = get('checkUser52');$getcheckUser53 = get('checkUser53');$getcheckUser54 = get('checkUser54');$getcheckUser55 = get('checkUser55');$getcheckUser56 = get('checkUser56');$getcheckUser57 = get('checkUser57');$getcheckUser58 = get('checkUser58');$getcheckUser59 = get('checkUser59');$getcheckUser60 = get('checkUser60');$getcheckUser61 = get('checkUser61');$getcheckUser62 = get('checkUser62');$getcheckUser63 = get('checkUser63');$getcheckUser64 = get('checkUser64');$getcheckUser65 = get('checkUser65');$getcheckUser66 = get('checkUser66');$getcheckUser67 = get('checkUser67');$getcheckUser68 = get('checkUser68');$getcheckUser69 = get('checkUser69');$getcheckUser70 = get('checkUser70');
	
	$multiUser = "'".$getcheckUser1."',"."'".$getcheckUser2."',"."'".$getcheckUser3."',"."'".$getcheckUser5."',"."'".$getcheckUser6."',"."'".$getcheckUser7."',"."'".$getcheckUser8."',"."'".$getcheckUser9."',"."'".$getcheckUser10."',"."'".$getcheckUser11."',"."'".$getcheckUser12."',"."'".$getcheckUser13."',"."'".$getcheckUser14."',"."'".$getcheckUser15."',"."'".$getcheckUser16."',"."'".$getcheckUser17."',"."'".$getcheckUser18."',"."'".$getcheckUser19."',"."'".$getcheckUser20."',"."'".$getcheckUser21."',"."'".$getcheckUser22."',"."'".$getcheckUser23."',"."'".$getcheckUser24."',"."'".$getcheckUser25."',"."'".$getcheckUser26."',"."'".$getcheckUser27."',"."'".$getcheckUser28."',"."'".$getcheckUser29."',"."'".$getcheckUser30."',"."'".$getcheckUser31."',"."'".$getcheckUser32."',"."'".$getcheckUser33."',"."'".$getcheckUser34."',"."'".$getcheckUser35."',"."'".$getcheckUser36."',"."'".$getcheckUser37."',"."'".$getcheckUser38."',"."'".$getcheckUser39."',"."'".$getcheckUser40."',"."'".$getcheckUser41."',"."'".$getcheckUser42."',"."'".$getcheckUser43."',"."'".$getcheckUser44."',"."'".$getcheckUser45."',"."'".$getcheckUser46."',"."'".$getcheckUser47."',"."'".$getcheckUser48."',"."'".$getcheckUser49."',"."'".$getcheckUser50."',"."'".$getcheckUser51."',"."'".$getcheckUser52."',"."'".$getcheckUser53."',"."'".$getcheckUser54."',"."'".$getcheckUser55."',"."'".$getcheckUser56."',"."'".$getcheckUser57."',"."'".$getcheckUser58."',"."'".$getcheckUser59."',"."'".$getcheckUser60."',"."'".$getcheckUser61."',"."'".$getcheckUser62."',"."'".$getcheckUser63."',"."'".$getcheckUser64."',"."'".$getcheckUser65."',"."'".$getcheckUser66."',"."'".$getcheckUser67."',"."'".$getcheckUser68."',"."'".$getcheckUser69."',"."'".$getcheckUser70."'";

?>

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
                              <font size="3">  របាយការណ៍ទិញ លក់</font>
                             </div>
                           </a> 
                          
                       
                         <div class="col-md-9 pull-right"  >
                          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#NewUser" ><span class="glyphicon glyphicon-th" aria-hidden="true" title="Advance Search"></span></button>
                         </div> 
                        
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
									
										// Show product detail that has been sold
                                      	$select=$db->query("SELECT 
														tblproductcategory.ProductCategoryName,
														tblproducts.ProductName,
														tblproducts.ProductCode,
														COALESCE((tblproducts_buydetail.BuyPrice),0) AS BuyPrice,
														tblproducts_buy.BuyDate,
														COALESCE((tbl_customerorderdetail.SalePrice),0) AS SalePrice,
														DATE_FORMAT( tbl_customerorder.CustomerOrderDate,'%d %b %Y %h:%m:%s') as SaleDate,
														COALESCE((tblproductsbranch.OtherCost),0) AS OtherCost,
														COALESCE((tbl_customerorderdetail.SalePrice),0)-COALESCE((tblproducts_buydetail.BuyPrice),0)-COALESCE((tblproductsbranch.OtherCost),0) AS Income,
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
														tblproductsbranch.Decription
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
													INNER JOIN tblproductsbranch
														ON tblproducts.ProductID = tblproductsbranch.ProductID
											WHERE (tblproducts.ProductName LIKE '%".$sarchprd."%' OR tblproducts.ProductCode LIKE '%".$sarchprd."%' )
											AND (tbl_customerorder.CustomerOrderDate BETWEEN '".$txtFrom."' AND '".$txtTo."') 
											AND tbl_customerorder.UserID IN (".$multiUser.")
											ORDER BY tbl_customerorder.CustomerOrderDate DESC");
									// Product detail that hasn't sell
									$select4=$db->query("SELECT tblproductsbranch.ProductID,
																			tblproductcategory.ProductCategoryName,
																			tblproducts.ProductName,
																			tblproducts.ProductCode,
																			tblproductsbranch.BuyPrice,
																			tblproducts_buy.BuyDate,
																			tblproductsbranch.OtherCost, 
																			tblproductsbranch.SalePrice,
																			tblproductsbranch.Qty,
																			tblproductsbranch.Decription
																		 FROM tblproductsbranch
																		INNER JOIN tblproducts_buydetail
																		ON tblproducts_buydetail.ProductID = tblproductsbranch.ProductID
																		INNER JOIN tblproducts_buy
																		ON tblproducts_buy.BuyID = tblproducts_buydetail.BuyID
																		INNER JOIN tblproducts
																		ON tblproducts.ProductID = tblproductsbranch.ProductID
																		INNER JOIN tblproductcategory
																		ON tblproductcategory.ProductCategoryID = tblproducts.ProductCategoryID
																		WHERE tblproducts_buy.BuyDate BETWEEN '".$txtFrom."' AND '".$txtTo."'
																		AND tblproductsbranch.Qty = 1
																		AND tblproducts_buy.UserID IN (".$multiUser.")
															");
									
									// Show Product doesn't sell				
									$select3=$db->query("SELECT tblproductsbranch.ProductID, 
																			tblproductsbranch.BuyPrice, 
																			tblproductsbranch.OtherCost, 
																			tblproductsbranch.SalePrice,
																			tblproductsbranch.Qty,
																			tblproductsbranch.Decription
																		 FROM tblproductsbranch
																		INNER JOIN tblproducts_buydetail
																		ON tblproducts_buydetail.ProductID = tblproductsbranch.ProductID
																		INNER JOIN tblproducts_buy
																		ON tblproducts_buy.BuyID = tblproducts_buydetail.BuyID
																		WHERE tblproducts_buy.BuyDate BETWEEN '".$txtFrom."' AND '".$txtTo."'
																		AND tblproductsbranch.Qty = 1
																		AND tblproducts_buy.UserID IN (".$multiUser.")
															");
									// Show Product  sell					
									$select2=$db->query("SELECT tblproductsbranch.ProductID, 
																			tblproductsbranch.BuyPrice, 
																			tblproductsbranch.OtherCost, 
																			tblproductsbranch.SalePrice,
																			tblproductsbranch.Qty,
																			tblproductsbranch.Decription
																		 FROM tblproductsbranch
																		INNER JOIN tblproducts_buydetail
																		ON tblproducts_buydetail.ProductID = tblproductsbranch.ProductID
																		INNER JOIN tblproducts_buy
																		ON tblproducts_buy.BuyID = tblproducts_buydetail.BuyID
																			INNER JOIN tbl_customerorderdetail
																			ON tbl_customerorderdetail.ProductID = tblproductsbranch.ProductID
																			INNER JOIN tbl_customerorder
																			ON tbl_customerorderdetail.CustomerOrderID = tbl_customerorder.CustomerOrderID
																		WHERE tbl_customerorder.CustomerOrderDate BETWEEN '".$txtFrom."' AND '".$txtTo."'
																		AND tblproductsbranch.Qty = 0
																		AND tbl_customerorder.UserID IN (".$multiUser.")
															");
									
									// Total Income
									$select1=$db->query("SELECT 
COALESCE((tbl_customerorderdetail.SalePrice),0)-(COALESCE((tblproducts_buydetail.BuyPrice),0)+COALESCE((tblproductsbranch.OtherCost),0)) AS totalIncome		
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
																	INNER JOIN tblproductsbranch
																		ON tblproducts.ProductID = tblproductsbranch.ProductID
															WHERE (tblproducts.ProductName LIKE '%".$sarchprd."%' OR tblproducts.ProductCode LIKE '%".$sarchprd."%' )
															AND (tbl_customerorder.CustomerOrderDate BETWEEN '".$txtFrom."' AND '".$txtTo."')
															AND tbl_customerorder.UserID IN (".$multiUser.")
															");
									
									
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
																echo "<a onclick=\"myOtherCost('".$ProductID."','".$OtherCost."','".$Decription."')\">".$OtherCost."</a>";
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
																<td class="col-md-1 text-right" ><h5 title="'.$Decription.'">$ '.$OtherCost.'</h5></td>
																<td class="col-md-1 text-right"> '.$Income.'</td>
															</tr>';	
													}
												
													
												} 
											// Show product doesn't sell
											
												
													
													$rowselect4=$db->dbCountRows($select4);
													if($rowselect4>0){
														while($row4=$db->fetch($select4)){
															echo '<tr class="odd gradeX" style="color:#FF0000;">';
															echo '<td class="col-md-1 text-left">'.$row4->ProductCategoryName.'</td>
																<td class="col-md-1 text-left">'.$row4->ProductName.'</td>
																<td class="col-md-1 text-left">'.$row4->ProductCode.'</td>
																<td class="col-md-1 text-right">$ '.$row4->BuyPrice.'</td>
																<td class="col-md-2 text-center">'.$row4->BuyDate.'</td>
																<td class="col-md-1 text-right">$ '.$row4->SalePrice.'</td>
																<td class="col-md-2 text-center"> - </td>
																<td class="col-md-1 text-right">$ '.$row4->OtherCost.' </td>
																<td class="col-md-1 text-right"> - </td>';
																echo '</tr>';			
														}
													}
													
													
											
											// End Block Total
											// ------------------------------------------------------------------------------------
											
											echo '<tr class="odd gradeX">';
															
															
													
															$rowselect3=$db->dbCountRows($select3);
															if($rowselect3>0){
																echo '<td colspan="2" class="text-left">Products Not Sole = '.$rowselect3.'</td>';
															}
															else
															{
																echo '<td colspan="2" class="text-left">Products Not Sole = 0</td>';
															}
															
															// Show total income.
															$rowselect2=$db->dbCountRows($select2);
															if($rowselect2>0){
																echo '<td colspan="2" class="text-left">Products Sole = '.$rowselect2.'</td>';
															}
															else
															{
																echo '<td colspan="2" class="text-left">Products Sole = 0</td>';
															}
															
															
													
															$rowselect1=$db->dbCountRows($select1);
															if($rowselect1>0){
																$i = 1;
																$reTotalIncome = 0;
																while($row0=$db->fetch($select1)){
																	
																	$reTotalIncome += $row0->totalIncome;
																	
																}
															echo '<td colspan="4" class="text-right">Total</td>
														   
															<td class="text-right"> $ '.round($reTotalIncome,2).'</td>
															
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
																echo "<a onclick=\"myOtherCost('".$ProductID."','".$OtherCost."','".$Decription."')\">".$OtherCost."</a>";
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
<!-- New User -->
               <div class="modal fade" id="NewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">                    
                  <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">New Branch</h4>
                         
                      </div>
                      <form enctype="multipart/form-data" action="Report_Saling_Advance.php">
                      
                      <div class="modal-body">
                     	<div class="form-group">
                        <?php
						
						$db->disconnect();
						$db->connect();
					  	$seUser=$db->query("SELECT UserID, UserName FROM `tblusers`;");
					  	$rUser=$db->dbCountRows($seUser);
						if($rUser>0){
							$i = 1;
							while($row=$db->fetch($seUser)){
							$UserID = $row->UserID;
							$UserName = $row->UserName;
								echo '<input type="checkbox" name="checkUser'.$i++.'" value="'.$UserID.'">'.$UserName.' &nbsp; ';
							}
						}
						else
						{
							echo '<input type="checkbox" name="value1" value="1">0 &nbsp; ';
						}
						
						?>
                            
                        </div>
                        <div class="form-group inline">
                           
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
                        <!--<div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            <button name="btnSearch" value="true" class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                          </div>-->
                    </div>
                    </form>
                  </div>
                </div>
                <script type="text/javascript">
				  jQuery(document).ready(function($) {
					$('#myModal .btn').last().on('click', function(){
						var MyModal = $('#myModal');
						function get_value() {
							var allVals = [];
							$('input:checkbox:checked').each(function() {
								allVals.push($(this).val()); //Use the $('this') selector
							});
				
							$('a.btn').after("<p>" + allVals + "</p>");
						}
						MyModal.modal('hide').on('hidden', function(){
						   get_value();
				
						})
				
					});
				  });
				</script>
                <!-- End New User -->
        <!-- add new calendar event modal -->
<?php include 'footer.php';?>