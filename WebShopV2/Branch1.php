<?php include 'header.php';

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
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                
                  <section class="content invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> 
                                
                                <small class="pull-right">Date: 2/10/2014</small>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <div class="row">
                    <a href="Branch-new.php">
					<button class="btn btn-primary" data-toggle="modal" data-target="#NewFloor"><i class="fa fa-file-o"></i> New Branch</button>
                    </a>
                    
                    <form class="navbar-form" role="search">
                      <div class="col-lg-3 pull-right">
                        <div class="input-group">
                          <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Normal <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="dns-advance.php">Advance</a></li>
                              
                            </ul>
                          </div><!-- /btn-group -->
                          <input type="text" class="form-control" placeholder="Search" name="srch-normal" id="search.php?dnsname=name&srch-term">
                          <div class="input-group-btn">
                             <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                          </div><!-- /btn-group -->
                        </div><!-- /input-group -->
                       </div><!-- /.col-lg-3 -->
                       </form>
                     </div><!-- /.row -->
                   
                    <!-- Table row -->
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
                                                                        echo'<li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?branchid='.$BranchID.'">'.$BranchName.'</a></li>';
                                                                    } 
                                                                }
                                                           ?>
                                                            
                                                          </ul>
                                                    </div>
                                                    
                                                    <div class="col-md-6 pull-center" >
                                                      	
                                                            <button type="button" class="btn btn-default" aria-label="Left Align">
  <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"> 
  
														<?php
                                                            $select=$db->query("SELECT COUNT(ProductID) AS TotalOrder FROM `tblprdtem` WHERE IP = '".$ip."';");
                                                            $rowselect=$db->dbCountRows($select);
                                                            if($rowselect>0){
                                                                
                                                                while($row=$db->fetch($select)){
                                                                $TotalOrder = $row->TotalOrder;
                                                            
                                                                    echo'QTY Products: ' . $TotalOrder;
                                                                }
                                                                
                                                            }
                                                       ?>
  </span>
</button>
													<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                                            Total All Cart
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
																	echo '</ul>';
																	echo '<button type="button" class="glyphicon glyphicon-random btn btn-primary"  data-toggle="modal" data-target=".bs-example-modal-sm"> CheckOut</button>';
                                                                }
																else
																{
																		echo '</ul>';
																		echo '<button type="button" class="glyphicon glyphicon-random btn btn-default"> CheckOut</button>';
																}
                                                           ?>
                                                            
                                                        

                                                       
                                                    </div>
                                                       <!-- Check Out Form -->
                                                        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                  <form method="post" enctype="multipart/form-data">
                                                                  <div class="form-group">
                                                                        <label>Choose Branch</label>
                                                                        <select class="form-control" name="cboBranch">
                                                                           
                                                                       <?php
                                                                         	$select=$db->query("SELECT BranchID, BranchName FROM `tblbranch`;");
                                                                            $rowselect=$db->dbCountRows($select);
                                                                            if($rowselect>0){
                                                                                
                                                                                while($row=$db->fetch($select)){
                                                                                $BranchID = $row->BranchID;
                                                                                $BranchName = $row->BranchName;
                                                                                    echo'<option value='.$BranchID.'>'.$BranchName.'</option>';
                                                                                }
                                                                                
                                                                            }
                                                                       ?>
                                                                        </select>
                                                                        
                                                                  </div>
                                                                   <div class="checkbox">
                                                                        <label>
                                                                          <input type="checkbox" checked> Check here to follow us.
                                                                        </label>
                                                                        <input type="submit" name="btnCheckout" class="btn btn-primary" value="Checkout" />
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
                                                    
                                                </div>
                                            </th>
                                           
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>QTY</th>
                                            <th>BuyPrice</th>
                                            <th>SalePrice</th>  
                                          
                                            <th>Order Action</th>  
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
										if($sarchprd == "")
										{
											$select=$db->query("SELECT 
															`tblproducts`.ProductID,
															`tblproducts`.ProductName,
															`tblproducts`.ProductCategoryID,
															tblproductcategory.ProductCategoryName,
															`tblproducts`.ProductCode,
															`tblproducts`.Qty,
															`tblproducts`.BuyPrice,
															`tblproducts`.SalePrice
															 FROM `tblproducts`
															INNER JOIN tblproductcategory
															ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
															WHERE ProductName = N'%".$sarchprd."%' 
															OR ProductCategoryName = N'%".$sarchprd."%' ");
										}
										else
										{
											$select=$db->query("SELECT 
															`tblproducts`.ProductID,
															`tblproducts`.ProductName,
															`tblproducts`.ProductCategoryID,
															tblproductcategory.ProductCategoryName,
															`tblproducts`.ProductCode,
															`tblproducts`.Qty,
															`tblproducts`.BuyPrice,
															`tblproducts`.SalePrice
															 FROM `tblproducts`
															INNER JOIN tblproductcategory
															ON tblproducts.ProductCategoryID = tblproductcategory.ProductCategoryID
															WHERE ProductName LIKE N'%".$sarchprd."%' 
															OR ProductCategoryName LIKE N'%".$sarchprd."%' ");
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
												echo'<tr class="even">
														<td>'.$ProductCategoryName.'</td>
														<td>'.$ProductName.'</td>
														<td>'.$ProductCode.'</td>
														<td>1</td>
														<td class="center">'.$BuyPrice.'</td>
														<td class="center">'.$SalePrice.'</td> 
														
														<td class="center">
														<a href="clickBuyPrd.php?ProductID='.$ProductID.'
														&ProductName='.$ProductName.'
														&ProductCategoryID='.$ProductCategoryID.'
														&ProductCode='.$ProductCode.'
														&QTY= 1
														&BuyPrice='.$BuyPrice.'
														&SalePrice='.$SalePrice.'
														&sarchprd='.$sarchprd.'
														">
														<button type="button" class="btn btn-default" aria-label="Left Align">
  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
</button></a>
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

                    <div class="row">
                        <!-- accepted payments column -->
                        

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-primary pull-right" onClick="window.print();"><i class="fa fa-print"></i> Print</button>
                           
                        </div>
                    </div>
                    
                    
                    
                </section>
                    
            </aside><!-- /.right-side -->
            
            
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
<?php include 'footer.php';?>