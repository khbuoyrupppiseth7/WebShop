
<?php include 'header.php';?>

<?php
	// Add new product to Produtct Tem
	if(isset($_POST['btnAddNewPrd'])){
		$txtQty    =	post('txtQty');
		$txtbuyprice	=	post('txtBuyPrice');
		$txtsaleprice	=	post('txtSalePrice');		
		$insert=$db->query("UPDATE `tblprdsaletem`
								SET QTY = '".$txtQty."',
								BuyPrice = '".$txtbuyprice."',
								SalePrice = '".$txtsaleprice."',
								UpdateTem = '1'
								WHERE ProductID = '".$getProductID."' AND IP = '".$ip."'
							");
			
			if($insert){
				cRedirect('frmSalePrd.php');
			}
		
		$error = "Error Internet Connection!";
		
		}
		
		
	if(isset($_POST['btnDeletePrd'])){	
		$deleted =$db->query("DELETE FROM `tblprdsaletem` WHERE ProductID = '".$getProductID."' AND IP = '".$ip."'
							");
			
			if($deleted){
				cRedirect('frmSalePrd.php');
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
                       
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
               
                 <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>QTY</th>
                                            
                                            <th>SalePrice</th>  
                                            <th class="">Save</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <form role="form" method="post">
                                        <?php
										
											$select=$db->query("SELECT IP ,ProductID, ProductName, ProductCode,  QTY, BuyPrice, SalePrice 
FROM `tblprdsaletem`
WHERE IP = '".$ip."' AND ProductID = '".$getProductID."'");
																			
											
											$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												while($row=$db->fetch($select)){
												$ProductID = $row->ProductID;
												$ProductName = $row->ProductName;
												$ProductCode = $row->ProductCode;
												$QTY = $row->QTY;
												$BuyPrice = $row->BuyPrice;
												$SalePrice = $row->SalePrice;
												$x = $i++;
												echo'<tr class="even">
														<td>'.$ProductName.'</td>
														<td>'.$ProductCode.'</td>
														<td><input name="txtQty" value="'.$QTY.'" onKeyUp="checkInput(this)" class="form-control" placeholder="Enter text" /></td>
														
														<td class="center"><input name="txtSalePrice" onkeypress="return isNumberKey(event)" value="'.$SalePrice.'" class="form-control" placeholder="Enter text" /></td> 
														<td class="center">
															<input type="submit" name="btnAddNewPrd" class="btn btn-primary" value="Save" />
															<input type="submit" name="btnDeletePrd" class="btn btn-danger" value="Delete" />
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
                                      </form>       
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
                        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                         
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
                
                
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
<?php include 'footer.php';?>