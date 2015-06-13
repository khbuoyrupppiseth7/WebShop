<?php
	session_start();
	
	
	if(!$_SESSION['user']){
	//if(!$_SESSION['user'] || $_SESSION['ComID'] != 1){
		header('location:login.php');
	}
	include('connectionclass/connect.php');
	include('connectionclass/function.php');
	include('connectionclass/metencrypt.php');
	$db=new MyConnection();
	$db->connect();
	mysql_query("SET NAMES 'UTF8'");
	
	$U_id = $_SESSION['UserID'];
	$U_Acc = $_SESSION['user'];
	$U_Brandid = $_SESSION['BranchID'];
	$U_Branchname = $_SESSION['BranchName'];
	
	$ip=$_SERVER['REMOTE_ADDR'];
	$branchid = get('branchid');
	//$ip = '192.168.1.1';
	$sarchprd = get('sarchprd');
	$txtFrom = get('txtFrom');
	$txtTo = get('txtTo');
	$getProductID = get('ProductID');
	$getBuydetailid = get('Buydetailid');
	$getProductsName = get('ProductsName');
	$getQty = get('Qty');
	
	$getBranchID = get('BranchID');
	$getBranchName = get('BranchName');
	$getBranchDesc = get('BranchDesc');
	$getBuyprice = get('buyprice');
	$getothecost = get('othecost');
	$getdesc = get('desc');
	
	$getPrdBranchID = get('PrdBranchID');
	$getProductName = get('PrdBranchName');
	$getPrdBranchPrice = get('PrdBranchPrice');
	$getSPrdBrandID = get('SPrdBrandID');
	$getSPrdBrandname = get('SPrdBrandname');
	$getPrdBranchCode = get('PrdBranchCode');
	$getUserID = get('UserID');
	
	// Call Date Location
	date_default_timezone_set('Asia/Bangkok');
	$date_now = date("Y-m-d H:i:s");
	$date = date("Y-m-d");
	$datetomorow = date("Y-m-d" ,date(strtotime("+1 day", strtotime($date))));
	
	/*$db->disconnect();
	$db->connect();*/
	
	$cboPrdCate1 = get('cboPrdCate1');
	$txtprdname1 = get('txtprdname1');
	$txtcode1 = get('txtcode1');
	$txtbuyprice1 = get('txtbuyprice1');
	$txtsaleprice1 = get('txtsaleprice1');
	
	$txtOtherCost = get('txtOtherCost');
	$txtDesc = get('txtDesc');
	
	$gettxtuser = get('txtuser');
	

	
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $date_now; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!--<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
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
        
        <link rel="stylesheet" href="css/BeatPicker.min.css"/>
		<script src="js/jquery-1.11.0.min.js"></script>
        <script src="js/BeatPicker.min.js"></script>
        <script type="text/javascript">
			
			function checkInput(ob) {
			  var invalidChars = /[^0-9]/gi
			  if(invalidChars.test(ob.value)) {
						ob.value = ob.value.replace(invalidChars,"");
				  }
			}
			<!--Ex: <input type="text" onKeyUp="checkInput(this)"/>-->
			
			function isNumberKey(evt)
			   {
				  var charCode = (evt.which) ? evt.which : evt.keyCode;
				  if (charCode != 46 && charCode > 31 
					&& (charCode < 48 || charCode > 57))
					 return false;
		
				  return true;
			   }
			   
			<!--Ex: <INPUT  onkeypress="return isNumberKey(event)" type="text">-->
		</script>
        
		   <script type="text/javascript">
             function goBack() {
             window.history.back()
             }
			 
			 
           </script>
     	<script src="js/shorttable.js"></script>
       <link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
        
    </head>