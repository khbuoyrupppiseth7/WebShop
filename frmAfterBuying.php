
<?php include 'header.php';?>

<?php
	// Add new product to Produtct Tem
	if(isset($_POST['btnAddNewPrd'])){
		$txtQty    =	post('txtQty');
		$txtPrice = post('txtPrice');
		$txtotherCost = post('txtotherCost');
			
				$insert=$db->query("UPDATE `tblproducts_buydetail` SET
									Qty = '".$txtQty."', 
									BuyPrice = '".$txtPrice."', 
									OtherCost = '".$txtotherCost."'
									WHERE BuyDetailID = '".$getBuydetailid."' ");
				
				// Update Products Set Increase
				$Updatestock1=$db->query("UPDATE tblproductsbranch SET Qty = ( Qty - ".$getQty." ) + ".$txtQty." , BuyPrice = ".$txtPrice.", OtherCost= ".$txtotherCost."
				WHERE ProductID = '".$getProductID."';");
				
				if($insert){
				    cRedirect('invoicebuying.php');
				}
			
			/*if($txtQty<$getQty)
			{
				$insert=$db->query("UPDATE tblproducts_buydetail SET Qty = ".$txtQty." , BuyPrice = ".$txtPrice."  , OtherCost = ".$txtotherCost."
				WHERE BuyDetailID = '".$getBuydetailid."'; ");
				
				// Update Products Set Increase
				$Updatestock1=$db->query("UPDATE tblproductsbranch SET Qty = ( Qty - ".$getQty." ) + ".$txtQty." , BuyPrice = ".$txtPrice.", OtherCost= ".$txtotherCost."
				WHERE ProductID = '".$getBuydetailid."';");
				
				if($insert){
				    cRedirect('invoicebuying.php');
				}
				
			}
			else if($txtQty>$getQty)
			{
				$insert=$db->query("UPDATE tblproducts_buydetail SET Qty = ".$txtQty." , BuyPrice = ".$txtPrice."  , OtherCost = ".$txtotherCost."
				WHERE BuyDetailID = '".$getBuydetailid."' ");
				
				$Updatestock=$db->query("UPDATE tblproductsbranch SET Qty = ( Qty - ".$getQty." ) + ".$txtQty." , BuyPrice = ".$txtPrice.", OtherCost= ".$txtotherCost."
				WHERE ProductID = '".$getProductID."';");
				
				if($insert){
				  cRedirect('invoicebuying.php');
				}
				
			}
			else
			{
				$insert=$db->query("UPDATE tblproducts_buydetail SET BuyPrice = ".$txtPrice.", OtherCost= ".$txtotherCost."
				WHERE BuyDetailID = '".$getBuydetailid."' ");
				$Updatestock=$db->query("UPDATE tblproductsbranch SET BuyPrice = ".$txtPrice.", OtherCost= ".$txtotherCost."
				WHERE ProductID = '".$getProductID."';");
				cRedirect('invoicebuying.php');
			}
			
			
		
		$error = "Error Internet Connection!";*/
		
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
                                            
                                            <th>QTY</th>
                                            <th>Price</th>
                                            <th>Other Price</th>
                                            <th class="">Action</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <form role="form" method="post" enctype="multipart/form-data">
                                        <?php
											
											echo'<tr class="even">
														<td>'.$getProductsName.'</td>
														
														<td><input name="txtQty" value="'.$getQty.'" onKeyUp="checkInput(this)" class="form-control" placeholder="Enter text" /></td>
														<td><input name="txtPrice" value="'.$getBuyprice.'" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Enter text" /></td>
														<td><input name="txtotherCost" value="'.$getothecost.'" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Enter text" /></td>
														
														<td class="center">
														
														<input type="submit" name="btnAddNewPrd" class="btn btn-primary" value="Save" />

														</td>
													</tr>';
												
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
                            
                            <input type="submit" name="btnUpdate" class="btn btn-primary" value="Save" />
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