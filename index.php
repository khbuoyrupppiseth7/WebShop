
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
			// Check if Products Dupplicate.
			$CheckPrd = $db->query("SELECT `tblproductsbranch`.BranchID, `tblproductsbranch`.ProductID, tblproducts.ProductName
									FROM `tblproductsbranch`
									INNER JOIN tblproducts
									ON tblproductsbranch.ProductID = tblproducts.ProductID
									WHERE BranchID = '".$U_Brandid."' AND ProductName = '".$txtprdname."'
									");
			$rowCheckPrd=$db->dbCountRows($CheckPrd);
			if($rowCheckPrd>0){
				$row=$db->fetch($CheckPrd);
					$ProductID = $row->ProductID;
					$ProductName = $row->ProductName;
					$insert=$db->query("INSERT INTO tblprdtem (
							IP
							, ProductID
							, ProductName
							, ProductCategoryID
							, ProductCode
							, QTY
							, BuyPrice
							, SalePrice
							,BranchID
							)
							VALUES(
							'".$ip."',
							'".$ProductID."',
							N'".$ProductName."',
							N'".sql_quote($ProductCategoryID)."',
							N'".sql_quote($txtcode)."',
							N'".sql_quote($txtqty)."',
							N'".sql_quote($txtbuyprice)."',
							N'".sql_quote($txtsaleprice)."',
							'".$U_Brandid."'
							);
							");	
			}
			else
			{
				$insert=$db->query("INSERT INTO tblprdtem (
							IP
							, ProductID
							, ProductName
							, ProductCategoryID
							, ProductCode
							, QTY
							, BuyPrice
							, SalePrice
							, PrdCopied,
							BranchID
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
							'".$U_Brandid."'
							);
							");
			
			}
			
		/*
		
		$insert=$db->query("INSERT INTO tblprdtem (
							IP
							, ProductID
							, ProductName
							, ProductCategoryID
							, ProductCode
							, QTY
							, BuyPrice
							, SalePrice
							, PrdCopied,
							BranchID
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
							'".$cboBranch."'
							);
							");*/
			
			/*if($insert){
				cRedirect('index.php');
			}*/
		$error = "Error Internet Connection!";
		}
		
		if(isset($_POST['btnCheckout'])){
			$cboBranch = post('cboBranch');

			$buyid = time();
			
			$InsertToTableBuy= $db->query("INSERT INTO tblproducts_buy (BuyID, BuyDate, UserID, Decription) 
VALUES('".$buyid."','".$date_now."','".$U_id."','');");

			$InsertToTableBuyDetail = $db->query("SELECT ProductID, QTY, BuyPrice, BranchID, SalePrice FROM tblprdtem ");
			$rowselect=$db->dbCountRows($InsertToTableBuyDetail);
			if($rowselect>0){
				$x = 1;
				while($row=$db->fetch($InsertToTableBuyDetail)){
					$ProductID = $row->ProductID;
					$QTY = $row->QTY;
					$BuyPrice = $row->BuyPrice;
					$BranchID = $row->BranchID;
					$SalePrice = $row->SalePrice;
					
					$sfrombranch = $db->query("SELECT ProductID, BranchID FROM `tblproductsbranch` WHERE ProductID = '".$ProductID."' AND BranchID = '".$BranchID."'");
					$cfrombranch=$db->dbCountRows($sfrombranch);
					if($cfrombranch>0){
						$row=$db->fetch($sfrombranch);
						
						/*Update Qty of ProductsBranch if products already Exit*/
						$updateprdqty = $db->query("UPDATE `tblproductsbranch` SET
												BuyPrice = (SELECT BuyPrice FROM tblprdtem WHERE ProductID = '".$ProductID."' ) ,
												SalePrice = (SELECT SalePrice FROM tblprdtem WHERE ProductID = '".$ProductID."' ) ,
												Qty = Qty + (SELECT Qty FROM tblprdtem WHERE ProductID = '".$ProductID."' ) 
												WHERE ProductID = '".$ProductID."'
												");
	
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
							
					}
					else
					{
						
												
						$insertfor_old_prd=$db->query("INSERT INTO tblproductsbranch (ProductID, BranchID, BuyPrice, OtherCost, SalePrice, Qty)
							VALUES (".$ProductID.", ".$U_Brandid.", BuyPrice,'".$BuyPrice."', ".$SalePrice.", ".$QTY.")");
							
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
						
						
					}
	
				}
				
			}
			/*Move from tableprdtem to products*/
			
			$copy=$db->query("INSERT INTO tblproducts (ProductID, ProductName, ProductCategoryID, ProductCode,QTY, BuyPrice, SalePrice) 
SELECT ProductID, ProductName, ProductCategoryID, ProductCode, QTY, BuyPrice, SalePrice
FROM tblprdtem WHERE tblprdtem.PrdCopied = '1' ");

			/*Move from tableprdtem to productsBranch*/
			$copy1=$db->query("INSERT INTO tblproductsbranch (ProductID, BranchID, BuyPrice, OtherCost, SalePrice, Qty, QtyInstock, TotalBuyPrice)
						SELECT ProductID, ".$U_Brandid.", BuyPrice,'0', SalePrice, Qty, '0', Qty
						FROM tblprdtem WHERE tblprdtem.PrdCopied = '1' ");
			
			if($copy){
				$delete=$db->query("DELETE FROM `tblprdtem` WHERE IP = '".$ip."'");
				$delete=$db->query("DELETE FROM `tblproductsbranch` WHERE BuyPrice IS NULL");
				
				//cRedirect('index.php');
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
                       
                        <small> &nbsp;</small>
                       
                        <div class="col-md-6 pull-center" >
                            <button type="button" class="btn btn-default" aria-label="Left Align">
                            	Buy to Branch 
                            </button>                         	
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
                           <form method="post" enctype="multipart/form-data">
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
                                    //echo '<button type="button" class="glyphicon glyphicon-random btn btn-primary"  data-toggle="modal" data-target=".bs-example-modal-sm"> CheckOut</button>';
                                
                                    echo '<button type="submit" name="btnCheckout" class="glyphicon glyphicon-random btn btn-primary"  > Save</button>';
                                    echo '</form>';
                                
                                }
                                else
                                {
                                        echo '</ul>';
                                        echo '<button type="button" class="glyphicon glyphicon-random btn btn-default"> Save</button>';
                                }
                           ?>
                            
                        

                       
                    </div>
                        
                            <div class="col-md-3 pull-right">
                                <form  role="search" enctype="multipart/form-data">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" value="<?php echo $sarchprd; ?>" name="sarchprd" autofocus>
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                        </div>
                                    </div>
                               </form>
                            </div>
                        
                    </h1>
                    
                   
                </section>

                <!-- Main content -->
               
                 <div class="panel-body">
                            <div class="dataTable_wrapper">
                            	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                   	<tbody>
                                    
                                    <form enctype="multipart/form-data" action="savedirectbuying.php">
                                    	<tr>
                                            <th>
                                            	<select class="form-control" name="cboPrdCate1">
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
                                            </th>
                                            <th><input name="txtprdname1" class="form-control" placeholder="Enter text" required autofocus /></th>
                                            <th><input name="txtcode1" class="form-control" placeholder="Enter text" required /></th>
                                            <th><input type="number" name="txtbuyprice1"  onkeypress="return isNumberKey(event)"value="0" min="0" step="0.01" required data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" /></th>
                                            <th><input type="number" value="0" name="txtsaleprice1" onKeyPress="return isNumberKey(event)" min="0" required step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" /></th>  
                                           
                                          	<th><input type="submit" name="btnSaveDirect" class="btn btn-primary" value="Save" /></th>  
                                        	</form>
                                        </tr>
                                    </tbody>
                                 </table>
                                <table class="table table-striped table-bordered table-hover sortable" id="dataTables-example">
                                   	
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Name </th>
                                            <th>Code</th>
                                            <th>BuyPrice</th>
                                            <th>SalePrice</th>  
                                          	<th>Order Action</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <form enctype="multipart/form-data" action="savedirectbuying.php">
                                    	
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
											$select=$db->query("CALL spSearchPrdBuy('".$sarchprd."')");
											
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
														
														<td class="center"> $'.$BuyPrice.'</td>
														<td class="center"> $'.$SalePrice.'</td> 
														
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
											$db->disconnect();
											$db->connect();
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
                                <input name="txtprdname" class="form-control" placeholder="Enter text" required autofocus />
                          </div>
                          <div class="form-group">
                                <label>Products Code:</label>
                                <input name="txtcode" class="form-control" placeholder="Enter text" />
                          </div>
                          <div class="form-group">
                                <label>Products QTY:</label>
                                <input name="txtqty" onKeyUp="checkInput(this)" class="form-control" value="1" placeholder="Enter text" required />
                          </div>
                          <div class="form-group">
                                <label>Buy Price:</label>
                                <div class="input-group"> 
                                <span class="input-group-addon">$</span>
                                <input type="number" name="txtbuyprice"  onkeypress="return isNumberKey(event)"value="0" min="0" step="0.01" required data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
                            	</div>
                          </div>
                          <div class="form-group">
                                <label>Sale Price:</label>
                                <div class="input-group"> 
                                <span class="input-group-addon">$</span>
                                <input type="number" value="0" name="txtsaleprice" onKeyPress="return isNumberKey(event)" min="0" required step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
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