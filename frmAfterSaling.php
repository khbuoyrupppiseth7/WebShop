
<?php include 'header.php';?>

<?php
	// Add new product to Produtct Tem
	if(isset($_POST['btnAddNewPrd'])){
		$txtQty    =	post('txtQty');
		$txtOtherCost    =	post('txtOtherCost');
		$txtDesc = post('txtDesc');
			
			$insert=$db->query("UPDATE tbl_customerorderdetail SET Qty = ".$txtQty.", OtherCost= N'".$txtOtherCost."' 
			, Decription= N'".$txtDesc."'
									WHERE CustomerOrderDetailID = '".$getBuydetailid."'");
			   
			$UpdateStockNewBranch=$db->query("UPDATE tblproductsbranch SET Qty = ( Qty + ".$getQty." ) - ".$txtQty.", OtherCost= ".$txtOtherCost."
				WHERE ProductID = '".$getProductID."' AND BranchID = '".$U_Brandid."';");
				
			$UpdateStockOldBranch=$db->query("UPDATE tblproductsbranch SET Qty = ( Qty - ".$getQty." ) + ".$txtQty.", OtherCost= ".$txtOtherCost."
			 	WHERE FromBranchID = '".$U_Brandid."' AND FromPrdID = '".$getProductID."' AND BranchID ='".$branchid."';");
			
			if($insert){
				cRedirect('invoicesaling.php');
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
                       
                        <small>Control panel <?php echo $getBuydetailid; ?></small>
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
                                            <th>Other Price</th>
                                            <th>Description</th>
                                            <th class="">Action</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <form role="form" method="post">
                                        <?php
											
											echo'<tr class="even">
														<td>'.$getProductsName.'</td>
														
														<td><input name="txtQty" value="'.$getQty.'" onKeyUp="checkInput(this)" class="form-control" placeholder="Enter text" /></td>
														<td><input name="txtOtherCost" value="'.$getothecost.'" class="form-control"  onkeypress="return isNumberKey(event)" placeholder="Enter text" /></td>
														<td><input name="txtDesc" value="'.$getdesc.'" class="form-control"  placeholder="Enter text" /></td>
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
                        
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
<?php include 'footer.php';?>