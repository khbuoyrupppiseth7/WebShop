
<?php include 'header.php';?>

<?php
	// Add new product to Produtct Tem
	if(isset($_POST['btnAddNewBranch'])){
		$txtCateName = $_POST['txtCateName'];
		$txtDesc	=	post('txtDesc');
		
		
		$insert=$db->query("INSERT INTO tblproductcategory (ProductCategoryID, ProductCategoryName, Decription)
					VALUES('".time()."','".$txtCateName."','".$txtDesc."')");
			
			if($insert){
				cRedirect('frmCategory.php');
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
                        <div class="row">
                             
                                <div class="col-md-3 pull-left">
                                    
                                   <button type="button" class="btn btn-info" aria-label="Left Align">
                                    Category
                                   </button>
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
                    </h1>
                    <!--<ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        
                        <li class="active">Branch</li>
                    </ol>-->
                </section>

                <!-- Main content -->
               
                 <div class="panel-body">
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
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover sortable" id="dataTables-example">
                                   
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
                                    
                                        <script>
                                            $('#edit-modal').on('show.bs.modal', function(e) {
                                                
                                                var $modal = $(this),
                                                    esseyId = e.relatedTarget.id;
                                                
                                    //            $.ajax({
                                    //                cache: false,
                                    //                type: 'POST',
                                    //                url: 'backend.php',
                                    //                data: 'EID='+essay_id,
                                    //                success: function(data) 
                                    //                {
                                                        $modal.find('.edit-content').html(esseyId);
                                    //                }
                                    //            });
                                                
                                            })
                                        </script>
                                    <thead>
                                        <tr>
                                            
                                            <th class="col-md-2">Category Name</th>
                                            <th>Description</th>
                                            <th class="col-md-2 text-center">Action</th>  
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
											$select=$db->query("SELECT ProductCategoryID, ProductCategoryName, Decription FROM `tblproductcategory`;");
										}
										else
										{
											$select=$db->query("SELECT ProductCategoryID, ProductCategoryName, Decription FROM `tblproductcategory`
															WHERE ProductCategoryName LIKE N'%".$sarchprd."%' 
															 ");
										}
											
											$rowselect=$db->dbCountRows($select);
											if($rowselect>0){
												$i = 1;
												while($row=$db->fetch($select)){
												$ProductCategoryID = $row->ProductCategoryID;
												$ProductCategoryName = $row->ProductCategoryName;
												$Decription = $row->Decription;
												
												$x = $i++;
												echo'<tr class="even">
														<td>'.$ProductCategoryName.'</td>
														<td>'.$Decription.'</td>
														<td class="center">
														
														<a href="frmCategory-Update.php?BranchID='.$ProductCategoryID.'&BranchName='.$ProductCategoryName.'&BranchDesc='.$Decription.'">
														<button type="button" class="glyphicon glyphicon-pencil btn btn-primary" ></button> </a>';
														echo'</td>
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
               <!-- New User -->
               <div class="modal fade" id="NewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">                    
                  <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">New Category</h4>
                         
                      </div>
                      <div class="modal-body">
                       <form role="form" method="post"> 
                          <div class="form-group">
                            	<label>Category Name: </label>
                                <input name="txtCateName" class="form-control" placeholder="Enter text" required />
                          </div>
                         
                          <div class="form-group">
                                <label>Description:</label>    
                                <textarea name="txtDesc" class="form-control" rows="3" ></textarea>
                          </div>
                     
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                            <input type="submit" name="btnAddNewBranch" class="btn btn-primary" value="Save" />
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