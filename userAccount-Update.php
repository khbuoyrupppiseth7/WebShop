<?php include 'header.php';

//================ Get Field From Page User =================
	$id=get('id');
	$select=$db->query("SELECT 
						acc.UserID AS UserID,
						acc.BranchID AS BranchID,
						b.BranchName AS BranchName,
						acc.UserName AS UserName,	
						acc.`Password` AS `Password`,
						acc.`Level` AS `Level`,
						acc.Decription AS Decription,
						acc.`Status` AS `Status`
						FROM tblusers acc
						INNER JOIN tblbranch b
						ON acc.BranchID = b.BranchID
						WHERE acc.UserID = '".$id."'");

	$numrow=$db->dbCountRows($select);
	if($numrow>0){
		$row=$db->fetch($select);
		$BranchID = $row->BranchID;
		$BranchName1 = $row->BranchName;
		$UserName = $row->UserName;
		$Level = $row->Level;
		$UserDesc =  $row->Decription;
		$Status = $row->Status;
	}
//==================== Insert New User =======================
if(isset($_POST['btnSave'])){
		$cboBranch		=   $_POST['cboBranch'];
		$txtUserName	=	post('txtUserName');
		$txtLevel		=	post('txtLevel');
		$txtDescription	=	post('txtDescription');
		$txtStatus	    =	post('txtStatus');	
		
		$update=$db->query("CALL sp_UserAccount_Update('".$id."',
							'".$cboBranch."',
							N'".sql_quote($txtUserName)."',
							'".sql_quote($txtLevel)."',
							N'".sql_quote($txtDescription)."',
							'".sql_quote($txtStatus)."'
							)");
			
		if($update){
				cRedirect('userAccount.php');
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
										<label>Choose Branch</label>
										<select class="form-control" name="cboBranch" autocomplete="on">
										  
										<?php
										// echo'<option value='.$BranchID.'>'.$BranchName.'</option>';
											echo'<option value='.$BranchID.'>'.$BranchName1.'</option>';
										  $select=$db->query("SELECT BranchID, BranchName FROM tblbranch WHERE BranchID != ".$BranchID."");
											$rowselect=$db->dbCountRows($select);
											
											if($rowselect>0){
												while($row=$db->fetch($select)){
												
												$BranchID = $row->BranchID;
												$BranchName = $row->BranchName;
													echo'<option value='.$BranchID.'>'.$BranchName.'</option>';
												}
												
											}										
										?>
										</optgroup>
										</select>
										
										</div>
									 
										<div class="form-group">
                                            <label>User Name</label>
                                            <input name="txtUserName" class="form-control" value="<?php echo $UserName; ?>" placeholder="User Name" />
										</div>
                                      
                                        <div class="form-group">
                                            <label>Level</label>
                                            <div class="radio">
                                              <label>
                                                <input type="radio" name="txtLevel" id="optionsRadios1" value="1" 
                                                <?php if($Level == 1) echo 'checked'; ?>
                                                 >
                                                Admin
                                              </label>
                                            </div>
                                            <div class="radio">
                                              <label>
                                                <input type="radio" name="txtLevel" id="optionsRadios2" value="2"
                                                 <?php if($Level == 2) echo 'checked'; ?>
                                                >
                                                User
                                              </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="txtDescription"  rows="3">
											<?php  echo $UserDesc; ?>
											</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                          
                                            <div class="radio">
                                              <label>
                                                <input type="radio" name="txtStatus" id="optionsRadios1" value="1" 
												 <?php if($Status == 1) echo 'checked'; ?>>
                                                Active
                                              </label>
                                            </div>
                                            <div class="radio">
                                              <label>
                                                <input type="radio" name="txtStatus" id="optionsRadios2" value="0"
                                                 <?php if($Status == 0) echo 'checked'; ?>>
                                                Suspend
                                              </label>
                                            </div>
                                            
                                        </div>
                                   
                            <div class="modal-footer">
                            <a href="userAccount.php">
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