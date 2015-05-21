<?php include 'header.php';

//================ Get Field From Page Branch =================
	$id=get('id');
	$BranchName=get('BranchName');
	$Decription=get('Decription');

//==================== Insert New Branch =======================
if(isset($_POST['btnSave'])){
		$txtbranchName	=	post('txtbranchName');
		$txtDescrpiton	=	post('txtDescrpiton');
		
		$update=$db->query("CALL sp_Branch_Update(
					'".$id."',
					N'".sql_quote($txtbranchName)."',
					N'".sql_quote($txtDescrpiton)."'
					)			
		");
			if($update){
							cRedirect('Branch.php');
							//$error = 'Success';
							
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
                <div class="row">
                   <div class="col-xs-8">
                    <form role="form" method="post" enctype="multipart/form-data">
                          
							<div class="form-group">
                                label>Branch Name</label>
								<input name="txtbranchName" class="form-control"  value="<?php echo $BranchName; ?>" placeholder="Enter text" required />
                            </div>
       
							<div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="txtDescrpiton" id="editor1" rows="3">
									<?php echo $Decription; ?>
								</textarea>
                            </div>
										
                            <div class="modal-footer">
                            <a href="Branch.php">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </a>
                            <input type="submit" name="btnSave" class="btn btn-primary" value="Save" />
                          </div>
                      </form>
                     </div>
                    </div>
                </section>

                <!-- Main content -->
                
            </aside><!-- /.right-side -->
            
            
            
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
<?php include 'footer.php';?>