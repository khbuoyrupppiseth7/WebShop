<?php
session_start();
include('connectionclass/connect.php');
include('connectionclass/function.php');
include('connectionclass/metencrypt.php');
$db=new MyConnection();
$db->connect();
mysql_query("SET NAMES 'UTF8'");
$error="";
if(isset($_POST['btnsave'])){

	$txtusername = $_POST['txtusername'];
	$password = $_POST['txtpassword'];
	
	$encrypted_txt = encrypt_decrypt('encrypt', $password);
	
	$select=$db->query("CALL spUserAccClearData('".$txtusername."','".$encrypted_txt."');");
		
	$numrow=$db->dbCountRows($select);
	
	if($numrow>0)
	{
		$db->disconnect();
		$db->connect();
		//$delete=$db->query("DELETE FROM `tblproductsbranch`");
		
		$delete1=$db->query("DELETE FROM `tblprdsaletem`;");
		
		$delete2=$db->query("DELETE FROM tbl_customerorder;");
		
		$delete3=$db->query("DELETE FROM tbl_customerorderdetail;");
		
		$delete4=$db->query("DELETE FROM `tblproductsbranch`;");
		
		$delete5=$db->query("DELETE FROM `tblproducts_buy`;");
		
		$delete6=$db->query("DELETE FROM `tblproducts_buydetail`;");
		
		$delete7=$db->query("DELETE FROM `tblproducts`;");
		
		$delete8=$db->query("DELETE FROM tblproductcategory;");
		
		$delete9=$db->query("DELETE FROM `tblbranch` WHERE BranchID != '123';");

		if($delete1)
		{
			//cRedirect('index.php');
			$error="<center><strong style='color:red;'><blink>All Data have clear. &nbsp;&nbsp;<a href='logout.php'>Click Back </a></blink></strong></center>";
		}
		else
		{
			$error="<center><strong style='color:red;'><blink>Error while Clear Data</blink></strong></center>";
		}
	}
	else
	{
		$error="<center><strong style='color:red;'><blink>Incorrect Username or Password !</blink></strong></center>";
	}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>7Technology</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body >

        <div class="form-box" id="login-box">
            <div class="header">Clear Data</div>
            <form role="form" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="txtusername" class="form-control" placeholder="User Name"/>
                    </div>
                    <div class="form-group">
                        <input name="txtpassword" type="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group"> 
                         <?php echo $error; ?>
                    </div>
                    <div class="form-group">
                                    <input class="btn btn-lg btn-primary btn-block" placeholder="Password" name="btnsave" type="submit" value="Clear">
                     </div>
                    
                </div>
                
            </form>

        </div>

    <?php include 'footer.php';?>