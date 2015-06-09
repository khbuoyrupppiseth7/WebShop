
<?php include 'header.php';?>

<?php
	// Add new product to Produtct Tem
	if(isset($_POST['btnSave'])){
		$txtName   =	post('txtName');
		$txtDesc   =	post('txtDesc');
		$UpdateCate=$db->query("UPDATE tblproductcategory SET
								ProductCategoryName = N'".$txtName ."',
								Decription = N'".$txtDesc."'
								WHERE ProductCategoryID = '".$getBranchID."';");
		
		if($UpdateCate){
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
                       
                        <small>Edit branch</small>
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
                                            <th>Branch Name</th>
                                            
                                            <th>Description</th>
                                            
                                            <th class="">Action</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <form role="form" method="post">
                                        <?php
											
											echo'<tr class="even">
														<td><input name="txtName" value="'.$getBranchName.'" class="form-control" placeholder="Enter text" /></td>
														
														<td><input name="txtDesc" value="'.$getBranchDesc.'" class="form-control" placeholder="Enter text" /></td>
														
														<td class="center">
														
														<input type="submit" name="btnSave" class="btn btn-primary" value="Save" />

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
                        <h4 class="modal-title" id="exampleModalLabel">Sale</h4>
                         
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