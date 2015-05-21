<?php include 'header.php';?>

<?php
	// Add new product to Produtct Tem
	if(isset($_POST['btnSearch'])){
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
                       
                        <small> <i class="fa fa-dashboard"></i>Buying History</small>
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
                                            <th colspan="8">
                                                <div class="row">
                                                    
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
                                    <thead>
                                        <tr>
                                            
                                            <th class="col-md-2 text-center">Date</th>
                                            <th class="text-center">Name</th>
                                            <th class="col-md-2 text-center">Branch</th>
                                            <th class="col-md-1 text-center">QTY</th>
                                            <th class="col-md-1 text-center">Price</th>
                                            <th class="col-md-1 text-center">Other Price</th>
                                            <th class="text-center">Order</th>  
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
													tblproducts_buydetail.BuyDetailID,
													tblproducts_buydetail.ProductID,
													tblproducts.ProductName,
													tblbranch.BranchName,
													tblproducts_buydetail.Qty,
													tblproducts_buydetail.OtherCost,
													tblproducts_buydetail.BuyPrice,
													DATE_FORMAT(tblproducts_buy.BuyDate,'%d %b %Y %h:%m:%s') as BuyingDate,
													TIMESTAMPDIFF(MINUTE,tblproducts_buy.BuyDate,NOW()) AS CalcMin,
													tblbranch.BranchName
													FROM `tblproducts_buy`
													INNER JOIN tblproducts_buydetail
													ON tblproducts_buy.BuyID = tblproducts_buydetail.BuyID
													INNER JOIN tblproducts
													ON tblproducts.ProductID =  tblproducts_buydetail.ProductID 
													INNER JOIN tblproductsbranch
													ON tblproducts_buydetail.ProductID = tblproductsbranch.ProductID
													INNER JOIN tblbranch
													ON tblproductsbranch.BranchID = tblbranch.BranchID
													WHERE ( tblproducts.ProductName LIKE '%".$sarchprd."%'
													OR tblproducts.ProductCode LIKE '%".$sarchprd."%' )
													AND ( tblproducts_buy.BuyDate BETWEEN '".$txtFrom." 01:01:01' AND '".$txtTo." 23:59:59')
													And tblproducts_buy.UserID = '".$U_id."'
													ORDER By  tblproducts_buy.BuyDate DESC
													;
													");
											}
											else
											{
												$select=$db->query("SELECT 
													tblproducts_buydetail.BuyDetailID,
													tblproducts_buydetail.ProductID,
													tblproducts.ProductName,
													tblbranch.BranchName,
													tblproducts_buydetail.Qty,
													tblproducts_buydetail.OtherCost,
													tblproducts_buydetail.BuyPrice,
													DATE_FORMAT(tblproducts_buy.BuyDate,'%d %b %Y %h:%m:%s') as BuyingDate,
													TIMESTAMPDIFF(MINUTE,tblproducts_buy.BuyDate,NOW()) AS CalcMin,
													tblbranch.BranchName
													FROM `tblproducts_buy`
													INNER JOIN tblproducts_buydetail
													ON tblproducts_buy.BuyID = tblproducts_buydetail.BuyID
													INNER JOIN tblproducts
													ON tblproducts.ProductID =  tblproducts_buydetail.ProductID 
													INNER JOIN tblproductsbranch
													ON tblproducts_buydetail.ProductID = tblproductsbranch.ProductID
													INNER JOIN tblbranch
													ON tblproductsbranch.BranchID = tblbranch.BranchID
													WHERE ( tblproducts.ProductName LIKE '%%'
													OR tblproducts.ProductCode LIKE '%%' )
													AND ( tblproducts_buy.BuyDate BETWEEN '".$txtFrom." 01:01:01' AND '".$txtTo." 23:59:59')
													And tblproducts_buy.UserID = '".$U_id."'
													AND tblbranch.BranchID = '".$U_Brandid."'
													ORDER By  tblproducts_buy.BuyDate DESC
													;");
											}
											
												
											$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												while($row=$db->fetch($select)){
												$BuyDetailID = $row->BuyDetailID;
												$ProductID = $row->ProductID;
												$ProductName = $row->ProductName;
												$BranchName = $row->BranchName;
												$Qty = $row->Qty;
												$OtherCost = $row->OtherCost;
												$BuyPrice = $row->BuyPrice;
												$CalcMin = $row->CalcMin;
												
												$BuyingDate = date("F d, Y H:i:s",strtotime($row->BuyingDate));
												
												//$BuyingDate = $row->BuyingDate;
												
												
												if($CalcMin <= 120)
													echo'<tr class="even">
															<td class="col-md-2">'.$BuyingDate.'</td>
															<td>'.$ProductName.'</td>
															<td class="col-md-1 text-left">'.$BranchName.'</td>
															<td class="col-md-1 text-center">'.$Qty.'</td>
															<td class="col-md-1 text-right">$ '.$BuyPrice.'</td>
															<td class="col-md-1 text-right">$ '.$OtherCost.'</td>
															<td class="col-md-1 text-center"><a href="frmAfterBuying.php?Buydetailid='.$BuyDetailID.'&ProductID='.$ProductID.'&ProductsName='.$ProductName.'&Qty='.$Qty.'&buyprice='.$BuyPrice.'&othecost='.$OtherCost.'"><button class="btn btn-default" type="submit" ><i class="glyphicon glyphicon glyphicon-pencil"></i></button> </a></td>
														</tr>';
												
												else
												{
													echo'<tr class="even">
															<td class="col-md-2">'.$BuyingDate.'</td>
															<td>'.$ProductName.'</td>
															<td class="col-md-1 text-left">'.$BranchName.'</td>
															<td class="col-md-1 text-center">'.$Qty.'</td>
															<td class="col-md-1 text-right">$ '.$BuyPrice.'</td>
															<td class="col-md-1 text-right">$ '.$OtherCost.'</td>
															<td class="col-md-1 text-center"></td>
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