
<?php include 'header.php';?>

<?php
	
	if(isset($_POST['btnSaveSalling'])){
	
		$autoid = time();
		$ProductID = get('txtProductID');	
		$ProductName = get('txtprdname');
		$ProductCategoryID = get('txtProductCategoryID');
		$ProductCode = get('txtProductCode');
		$QTY = get('txtQty');
		$BuyPrice = get('txtbuyprice');
		$SalePrice = get('txtsaleprice');	
		
			/*Create Invoice Customer Sale*/
			$InsertToCustomerOrder=$db->query(" INSERT INTO tbl_customerorder ( 
					CustomerOrderID,
					BranchID,
					InvoiceNo,
					CustomerOrderDate,
					UserID
					)
					VALUES
					(
					'".$autoid."',
					'".$U_Brandid."',
					'".$autoid."',
					'".$date_now."',
					'".$U_id."'
					)");
									
			/* $insertCustomerOrderdetail = $db->query("INSERT INTO `tbl_customerorderdetail`(
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
					'".time().'2'."',
					'".$U_Brandid."',
					'".$autoid."',
					'".$ProductID."',
					'1',
					'".$SalePrice."',
					'".$BuyPrice."',
					'0',
					'0',
					'0',
					'',
					'Powered by 7Technology'
					)	
				");
									
			 $deductQty= $db->query("UPDATE tblproductsbranch SET Qty =  Qty - 1 WHERE ProductID = '".$ProductID."' ");*/
			 if($InsertToCustomerOrder){
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
                    		<div class="col-md-3 pull-left">
                               	<a href="Report_Saling.php" title="Report Saling">
                                   <button class="btn btn-success" type="submit">Report &nbsp;<i class="glyphicon glyphicon-print"></i></button>
                                </a>
                            </div>
                            
                           <div class="col-md-3 pull-right">
                                <form  role="search" >
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" value="<?php echo $sarchprd; ?>" name="sarchprd" autofocus>
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                        </div>
                                    </div>
                               </form>
                            </div>
                            &nbsp;
                        
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
                                            <th><input name="txtprdname1" class="form-control" placeholder="Enter Product Name" required autofocus /></th>
                                            <th><input name="txtcode1" class="form-control" placeholder="Enter Code" required /></th>
                                            <th><input type="text" name="txtbuyprice1" placeholder="Enter Price" onKeyPress="return isNumberKey(event)" required class="form-control currency"  /></th>
                                            <th><input type="text"  name="txtsaleprice1" placeholder="Enter Sale Price" required onKeyPress="return isNumberKey(event)"  class="form-control currency"  /></th>  
                                           
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
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                  
                                    	
                                        
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
														<td class="center" onClick="$("#Order").modal("show")>';
														
														echo "<input type=\"button\" onclick=\"myfunction('".$ProductID."','".$ProductName."','".$ProductCategoryID."','".$ProductCode."','1','".$BuyPrice."','".$SalePrice."')\" value=\"$ ".$SalePrice."\" />";
														
												echo '</td>
												
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
               
               <div class="modal fade" id="Order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">                    
                  <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">New Product</h4>
                         
                      </div>
                      <div class="modal-body">
                        <form enctype="multipart/form-data" action="savedirectsalling.php">
                          
                          <input type="hidden" name="txtProductID" id="ProductID">
                          <input type="hidden" name="txtProductCategoryID" id="ProductCategoryID">
                          <input type="hidden" name="txtProductCode" id="ProductCode">
                          <input type="hidden" name="txtQty" value="1">
                          
                          <div class="form-group">
                            	<label>Product Name: </label>
                                <input name="txtprdname" class="form-control" readonly id="txtPrdName" placeholder="Enter text" required autofocus />
                          </div>
                          <div class="form-group">
                                <label>Buy Price:</label>
                                <div class="input-group"> 
                                <span class="input-group-addon">$</span>
                                <input type="text" name="txtbuyprice"  onkeypress="return isNumberKey(event)"   required   class="form-control" id="buyprice" />
                            	</div>
                          </div>
                          <div class="form-group">
                                <label>Sale Price:</label>
                                <div class="input-group"> 
                                <span class="input-group-addon">Price</span>
                                <input type="text"  name="txtsaleprice" onKeyUp="ChangetoKhmer()" id="dolar" onKeyPress="return isNumberKey(event)"   class="form-control " />
                                <input type="text" name="txtsaleprice1" onKeyUp="ChangetoDolar()" id="khmer" onKeyPress="return isNumberKey(event)"  class="form-control "  />
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
							var txtPrdName = document.getElementById("txtPrdName");
							var txtbuyprice = document.getElementById("buyprice");
							var txtProductID = document.getElementById("ProductID");
							var txtProductCategoryID = document.getElementById("ProductCategoryID");
							var txtProductCode = document.getElementById("ProductCode");
							
							//'".$ProductID."','".$ProductName."','".$ProductCategoryID."','".$ProductCode."','1','".$BuyPrice."','".$SalePrice."'
							
							function myfunction(getProductID,getProductName,getProductCategoryID,getProductCode,getQty, getBuyPrice, getSalePrice)
							{
								$('#Order').modal('show');
								//alert(getProductID + getProductID + getProductCategoryID + getQty)
								txtPrdName.value = getProductName;
								txtbuyprice.value = getBuyPrice;
								dolar.value = getSalePrice;
								txtProductID.value = getProductID;
								txtProductCategoryID.value = getProductCategoryID;
								txtProductCode.value = getProductCode;
								
								
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
                
                <!-- Check Out -->

                <!-- End Check Out -->
                
                
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
<?php include 'footer.php';?>