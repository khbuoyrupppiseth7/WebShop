<?php include 'header.php';

//================ Get Field From Page Category =================
	$id=get('id');
	$Category=get('Category');
	$Decription=get('Decription');
	$UserID = $_SESSION['UserID'];

//==================== Insert New Branch =======================
if(isset($_POST['btnSave'])){
		$txtCategory	=	post('txtCategory');
		$txtDescrpiton	=	post('txtDescrpiton');
			
		if($UserID=="1"){
			$update=$db->query("CALL sp_Category_Update(
					'".$id."',
					N'".sql_quote($txtCategory)."',
					N'".sql_quote($txtDescrpiton)."'
					)			
		");
			if($update){
							cRedirect('ProductCategory.php');
						
							
					}
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
                                <label>Category Name</label>
								<input name="txtCategory" class="form-control"  value="<?php echo $Category; ?>" placeholder="Enter text" required />
                            </div>
       
							<div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="txtDescrpiton" id="editor1" rows="3">
								<?php echo $Decription; ?>
								</textarea>
                            </div>
										
                            <div class="modal-footer">
                            <a href="ProductCategory.php">
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