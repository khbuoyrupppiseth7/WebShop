
<?php include 'header.php';?>

<?php
	// Add new product to Produtct Tem
	if(isset($_POST['btnSaveNew'])){
		$cboPrd = $_POST['cboPrd'];
		$txtmin = post('txtmin');
		$txtmax = post('txtmax');
		$txtdaymin = post('txtdaymin');
		$txtdaymax = post('txtdaymax');
		$txtatm = post('txtatm');
		$txtDesc	=	post('txtDesc');
		
		$insert=$db->query("INSERT INTO tblrule (RuleID, ProductID, Min, Max, DayMin, DayMax, Atm, Description) 
							VALUES (
							'".time()."',
							'".$cboPrd."',
							'".$txtmin."',
							'".$txtmax."',
							'".$txtdaymin."',
							'".$txtdaymax."',
							'".$txtatm."',
							'".$txtDesc."');
							");
			
			if($insert){
				cRedirect('frmRule.php');
			}
			else{
			echo mysql_error();
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
                       
                        <small><a ><i class="fa fa-dashboard"></i> Rule</a></small>
                    </h1>
                    <!--<ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        
                        <li class="active">Branch</li>
                    </ol>-->
                </section>

                <!-- Main content -->
                
                <div class="modal fade bs-example-modal-sm" tabindex="0" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Other Cost</h4>
              </div>
              <div class="modal-body">
                	<form enctype="multipart/form-data" action="updateRule.php" >
                          
                          <input type="hidden" name="txtRuleID" id="txtRuleID">
                          <input type="hidden" name="txtProductID" id="txtProductID">
                          
                          <div class="form-group">
                            <label>Products</label>
                              <input type="text" name="cboPrd" class="form-control currency"  disabled id="txtPrdName" />
                              
                          </div>
                          <div class="form-group">
                                <label>Min:</label>      
                                <input type="text" name="txtmin" class="form-control currency"  onkeypress="return isNumberKey(event)" required id="txtmin" /> 	
                          </div>
                          <div class="form-group">
                                <label>Max:</label> 
                                <input type="text" name="txtmax"  onkeypress="return isNumberKey(event)" required  class="form-control currency" id="txtmax" />
                          </div>
                          <div class="form-group">
                                <label>Day Mix:</label>    
                                <input type="text" name="txtdaymin"  onkeypress="return isNumberKey(event)" required  class="form-control currency" id="txtdaymin" />
                          </div>
                          <div class="form-group">
                                <label>Day Max:</label>
                                <input type="text" name="txtdaymax"  onkeypress="return isNumberKey(event)" required  class="form-control currency" id="txtdaymax" />
                          </div>
                          <div class="form-group">
                                <label>ATM:</label>
                                <input type="text" name="txtatm"  onkeypress="return isNumberKey(event)" required  class="form-control currency" id="txtatm" />	
                          </div>
                          <div class="form-group">
                            	<label>Description: </label>
                                <textarea class="form-control" id="txtDesc" name="txtDesc" placeholder="Enter Descriptiion" rows="3"></textarea>
                          </div>
                     
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary"  value="Save" />
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    
                 <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th colspan="9">
                                                <div class="row">
                                                     <div class="col-md-3">
                                                      	<button type="button" class="glyphicon glyphicon-plus btn btn-primary"  data-toggle="modal" data-target="#NewUser"></button>
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
                                    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                    </div>
                                                    <div class="modal-body edit-content">
                                                        ...
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">No</th>
                                            <th class="col-md-1">Product Name</th>
                                            <th class="col-md-1">Min</th>
                                            <th class="col-md-1">DayMin</th>
                                            <th class="col-md-1">Max</th>
                                            <th class="col-md-1">DayMax</th>
                                            <th class="col-md-1">ATM</th>
                                            <th class="col-md-2">Description</th>
                                            
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
										/*if($sarchprd == "")
										{
											$select=$db->query("SELECT ProductCategoryID, ProductCategoryName, Decription FROM `tblproductcategory`;");
										}
										else
										{
											$select=$db->query("SELECT ProductCategoryID, ProductCategoryName, Decription FROM `tblproductcategory`
															WHERE ProductCategoryName LIKE N'%".$sarchprd."%' 
															 ");
										}*/
										$select=$db->query("SELECT tblRule.RuleID, 
											tblRule.ProductID,
											tblproducts.ProductName,
											tblRule.Min, 
											tblRule.Max, 
											tblRule.DayMin, 
											tblRule.DayMax, 
											tblRule.Atm, 
											tblRule.Description FROM `tblrule`
											INNER JOIN tblproducts
											ON tblrule.ProductID = tblproducts.ProductID
											WHERE tblproducts.isStock = 0");
											
											$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												while($row=$db->fetch($select)){
												$RuleID = $row->RuleID;
												$ProductID = $row->ProductID;
												$ProductName = $row->ProductName;
												$Min = $row->Min;
												$Max = $row->Max;
												$DayMin = $row->DayMin;
												$DayMax = $row->DayMax;
												$Atm = $row->Atm;
												$Description = $row->Description;
												$x = $i++;
												echo'<tr class="even">
														<td>'.$i++.'</td>
														<td>'.$ProductName.'</td>
														<td>'.$Min.'</td>
														<td>'.$DayMin.'</td>
														<td>'.$Max.'</td>
														<td>'.$DayMax.'</td>';
														echo "<td><a onclick=\"myOtherCost('".$RuleID."','".$ProductID."','".$ProductName."','".$Min."','".$Max."','".$DayMin."','".$DayMax."','".$Atm."','".$Description."')\">".$Atm."</a></td>";
														echo '<td class="center">'.$Description.'</td>
													</tr>';
													
													
												} 
											}
											else
											{
												echo '<tr class="even">
														<td  colspan="8"><font size="+1" color="#CC0000"> No Branch Selected.</font></td>
													
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
                        <script type="text/javascript">				
							// '".$RuleID."','".$ProductID."','".$ProductName."','".$Min."','".$Max."','".$DayMin."','".$DayMax."','".$Atm."','".$Description."'
							var cboPrd = document.getElementById("cboPrd");
							var txtPrdName = document.getElementById("txtPrdName");
							var txtmin = document.getElementById("txtmin");
							var txtmax = document.getElementById("txtmax");
							var txtdaymin = document.getElementById("txtdaymin");
							var txtdaymax = document.getElementById("txtdaymax");
							var txtatm = document.getElementById("txtatm");
							var txtDesc = document.getElementById("txtDesc");
							
							
							
							var txtRuleID = document.getElementById("txtRuleID");
							var txtProductID = document.getElementById("txtProductID");
							
						
							function myOtherCost(getRuleID,getProductID,getProductName,getMin,getMax,getDayMin,getDayMax,getAtm,getDescription)
							{
								$('.bs-example-modal-sm').modal('show');
								txtRuleID.value = getRuleID;
								txtProductID.value = getProductID;
								txtPrdName.value = getProductName;
								txtmin.value = getMin;
								txtmax.value = getMax;
								txtdaymin.value = getDayMin;
								txtdaymax.value = getDayMax;
								txtatm.value = getAtm;
								txtDesc.value = getDescription;
								
							}
							
						</script>
               <!-- New User -->
               <div class="modal fade" id="NewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">                    
                  <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">New Category</h4>
                         
                      </div>
                      <div class="modal-body">
                       <form role="form" method="post" enctype="multipart/form-data"> 
                          <div class="form-group">
                                <label>Choose Products</label>
                                <select class="form-control" name="cboPrd">
                                   
                               <?php
                                 	$select=$db->query("SELECT ProductID, ProductName FROM `tblproducts` WHERE isStock = 0");
								  	$rowselect=$db->dbCountRows($select);
                                    if($rowselect>0){
                                        
                                        while($row=$db->fetch($select)){
                                        $ProductID = $row->ProductID;
                                        $ProductName = $row->ProductName;
                                            echo'<option value='.$ProductID.'>'.$ProductName.'</option>';
                                        }
                                        
                                    }
                               ?>
                                </select>
                                
                          </div>
                          <div class="form-group">
                                <label>Min:</label>
                                
                                <input type="number" name="txtmin"  onkeypress="return isNumberKey(event)"value="0" min="0" step="0.01" required data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
                            	
                          </div>
                          <div class="form-group">
                                <label>Max:</label>
                                
                                <input type="number" name="txtmax"  onkeypress="return isNumberKey(event)"value="0" min="0" step="0.01" required data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
                            	
                          </div>
                          <div class="form-group">
                                <label>Day Mix:</label>
                                
                                <input type="number" name="txtdaymin"  onkeypress="return isNumberKey(event)"value="0" min="0" step="0.01" required data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
                            	
                          </div>
                          <div class="form-group">
                                <label>Day Max:</label>
                               
                                <input type="number" name="txtdaymax"  onkeypress="return isNumberKey(event)"value="0" min="0" step="0.01" required data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
                            	
                          </div>
                          <div class="form-group">
                                <label>ATM:</label>
                                
                                <input type="number" name="txtatm"  onkeypress="return isNumberKey(event)"value="0" min="0" step="0.01" required data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
                            	
                          </div>
                         
                          <div class="form-group">
                                <label>Description:</label>    
                                <textarea name="txtDesc" class="form-control" rows="3" ></textarea>
                          </div>
                     
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                            <input type="submit" name="btnSaveNew" class="btn btn-primary" value="Save" />
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- End New User -->
                <!-- Modal -->

                
                <!-- Check Out -->

                <!-- End Check Out -->
                
                
                
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
<?php include 'footer.php';?>