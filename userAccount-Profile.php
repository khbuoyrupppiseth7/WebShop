<?php 
include 'header.php';
$error = "";
	$id=get('id');
	//Select User and insert to form
	$select=$db->query("SELECT UserID, ComID,UserFirstName, UserLastName,	UserName,
						UserPwd, UserLevel, UserDesc, UserStatus
						FROM tbluseracc WHERE UserID = '".$id."'");
	//$select=$db->query("Call spUserAccSeleteForUpdate('".$id."')");
	$numrow=$db->dbCountRows($select);
	if($numrow>0){
		$row=$db->fetch($select);
		$UserName = $row->UserName;
		$UserFirstName = $row->UserFirstName;
		$UserLastName = $row->UserLastName;
		$UserLevel = $row->UserLevel;
		$UserDesc = $row->UserDesc;
		$UserStatus = $row->UserStatus;
		if($UserLevel == 3)
		{
			$UserLevel = 'User';
		}
		else if($UserLevel == 2)
		{
			$UserLevel = 'Manager';
		}
		else
		{
			$UserLevel = 'Admin';
		}
		
		if($UserStatus==1)
		{
			$UserStatus = 'Active';
		}
		else
		{
			$UserStatus = 'Suspend.';
		}

	}
	
	
?>
      
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Your Profile</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
               
                        <div class="panel-heading">
                            <?php echo $error; ?>
                        </div>
                        <div class="panel-body">
                            <p> First Name: <?php echo $UserFirstName; ?> </p><p>
                            	Last Name: <?php echo $UserLastName; ?> </p><p>
                                User Name: <?php echo $UserName; ?> </p><p>
                                Limited Name: <?php echo $UserLevel; ?> </p><p>
                                Status: <?php echo $UserStatus; ?> </p><p>
                                Descibtion: <?php echo $UserDesc; ?> </p><p>
                            
                            </p>
                         
                        
                        
                         </div>
                        <!-- /.panel-body -->
                  
            
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
    
        <!-- /#page-wrapper -->
          
<?php include 'footer.php'; ?>
