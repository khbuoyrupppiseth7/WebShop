
<?php include 'header.php';?>

<?php
	// Add new product to Produtct Tem
	if(isset($_POST['btnAddNewPrd'])){
		$txtQty    =	post('txtQty');
		$txtbuyprice	=	post('txtBuyPrice');
		$txtsaleprice	=	post('txtSalePrice');
		$txtPrdName = post('txtPrdName');
		$txtPrdCode = post('txtPrdCode');

		$insert=$db->query("UPDATE `tblprdtem`
								SET ProductName = '".$txtPrdName."',
								ProductCode = '".$txtPrdCode."',
								QTY = '".$txtQty."',
								BuyPrice = '".$txtbuyprice."',
								SalePrice = '".$txtsaleprice."',
								UpdateTem = '1'
								WHERE ProductID = '".$getProductID."' AND IP = '".$ip."'
							");
			
			if($insert){
				cRedirect('index.php');
			}
		
		$error = "Error Internet Connection!";
		
	}
	
	
	if(isset($_POST['btnDeletePrd'])){
		$delete=$db->query("DELETE FROM `tblprdtem`
							WHERE ProductID = '".$getProductID."' AND IP = '".$ip."'
							");
			
			if($delete){
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
                                            <th colspan="7">
                                                <div class="row">
                                                    
                                                    <div class="col-md-3">
                                                      	<button type="button" class="glyphicon glyphicon-plus btn btn-primary"  data-toggle="modal" data-target="#NewUser"></button>
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                                            Choose branch
                                                            <span class="caret"></span>
                                                          </button>
                                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                           
                                                            <?php
                                                                $select=$db->query("SELECT BranchID, BranchName FROM `tblbranch`;");
                                                                $rowselect=$db->dbCountRows($select);
                                                                if($rowselect>0){
                                                                    while($row=$db->fetch($select)){
                                                                    $BranchID = $row->BranchID;
                                                                    $BranchName = $row->BranchName;
                                                                        echo'<li role="presentation"><a role="menuitem" tabindex="-1" href="frmOrder.php?branchid='.$BranchID.'">'.$BranchName.'</a></li>';
                                                                    } 
                                                                }
                                                           ?>
                                                            
                                                          </ul>
                                                    </div>
                                                    
                                                    <div class="col-md-6 pull-center">
                                                      	
                                                            <button type="button" class="btn btn-default" aria-label="Left Align">
  <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"> 
  
														<?php
                                                            $select=$db->query("SELECT COUNT(ProductID) AS TotalOrder FROM `tblprdtem` WHERE IP = '".$ip."';");
                                                            $rowselect=$db->dbCountRows($select);
                                                            if($rowselect>0){
                                                                
                                                                while($row=$db->fetch($select)){
                                                                $TotalOrder = $row->TotalOrder;
                                                            
                                                                    echo'Total: ' . $TotalOrder;
                                                                }
                                                                
                                                            }
                                                       ?>
  </span>
</button>
													<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                                            All Cart
                                                            <span class="caret"></span>
                                                          </button>
                                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                           
                                                            <?php
                                                                $select=$db->query("SELECT ProductID , ProductName, QTY FROM `tblprdtem`  WHERE IP = '".$ip."' Order by ProductName;");
                                                                $rowselect=$db->dbCountRows($select);
                                                                if($rowselect>0){
                                                                    while($row=$db->fetch($select)){
																	$ProductID = $row->ProductID;
                                                                    $ProductName = $row->ProductName;
                                                                    $QTY = $row->QTY;
																		echo'<li role="presentation"><a role="menuitem" tabindex="-1" 
																		href="frmBuyPrd-Editeachone.php?ProductID='.$ProductID.'">'.$ProductName.' ( '.$QTY.' ) </a> </li>';
                                                                    } 
                                                                }
                                                           ?>
                                                            
                                                          </ul>
                                                       
                                                    </div>
                                                    
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
                                                    
                                                </div>
                                            </th>
                                           
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>QTY</th>
                                            <th>BuyPrice</th>
                                            <th>SalePrice</th>
                                            
                                            <th class="">Save</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <form role="form" method="POST" enctype="multipart/form-data">
                                        <?php
										
											$select=$db->query("SELECT IP ,ProductID, ProductName, ProductCode,  QTY, BuyPrice, SalePrice , isStock
FROM `tblprdtem`
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
												$isStock = $row->isStock;
												
												
												$x = $i++;
												echo'<tr class="even">
														<td><input name="txtPrdName" value="'.$ProductName.'" class="form-control" placeholder="Enter text" /></td>
														<td><input name="txtPrdCode" value="'.$ProductCode.'" class="form-control" placeholder="Enter text" /></td>
														<td><input name="txtQty" onKeyUp="checkInput(this)" value="'.$QTY.'" class="form-control" placeholder="Enter text" /></td>
														<td class="center"><input name="txtBuyPrice" onkeypress="return isNumberKey(event)" value="'.$BuyPrice.'" class="form-control" placeholder="Enter text" /></td>
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
                       
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
<?php include 'footer.php';?>