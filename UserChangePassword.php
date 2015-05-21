<?php include 'header.php';

$selectuser=$db->query("Select UserID,UserName,Password From tblusers WHERE UserID='".$U_id."'");
$numrow=$db->dbCountRows($selectuser);
	if($numrow>0){
		$row=$db->fetch($selectuser);
		$UserName = $row->UserName;
		$Password=$row->Password;
	}
	
//==================== Insert New Branch =======================
if(isset($_POST['btnSave'])){
		$txtUser	=	post('txtUser');
		$txtold = post('txtold');
		$txtNewPass= post('txtNewPass');
		$encrypt_Newpassword = encrypt_decrypt('encrypt', $txtNewPass);
		
		 if($txtNewPass == "")
		{
			
			echo "<script type='text/javascript'>alert('Please Insert New Password!');</script>";
		}
		else
		{
			$update=$db->query("UPDATE tblusers SET
									UserName='".$txtUser."',
									Password = '".$encrypt_Newpassword."'
									WHERE UserID = '".$U_id."'
								");
				
				if($update){
					//$GLOBALS['msg'] = "Success full";
					echo "<script type='text/javascript'>alert('Success full');</script>";
					cRedirect('logout.php');
				}
				else 
				{
					$GLOBALS['msg'] = "Error for update";
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
                          
							<strong>Your Name </strong>
							<div class="input-group">
							  <span class="input-group-addon"><span class="fa fa-user fa-fw"></span></span>
							  <input type="text" name="txtUser" value="<?php echo $U_Acc; ?>" class="form-control" placeholder="Username">
							</div>
							
							<div style="height:10px; width:auto"></div>
							<strong>Your Password </strong>
							<div class="input-group">
							  <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
							  <input type="password" class="form-control" name="txtold" readonly value="Don`t try hacking this password Because you are silly Person! <[*-*]>" maxlength="25" placeholder="Old Password" >
							  <input type="password" class="form-control"  name="txtNewPass"  maxlength="25" placeholder="New Passowrd" >
							</div>
                            <div class="modal-footer">
                            <a href="#">
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