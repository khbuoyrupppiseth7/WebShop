<?php 
  function redirect($page)
	{
		header("Status: 202 OK");
		$url = "Location: http://" . $_SERVER['HTTP_HOST']."/".$page;
		header($url);
		exit;
	}
	function cRedirect($page) 
	{
		echo "\n\n<script language=\"javascript\">
				location.href='$page';
			</script>";	
	}
	function sql_quote( $value ) 
	{ 
	if( get_magic_quotes_gpc() ) 
		{ 
      	$value = stripslashes( $value );
		} 
		if( function_exists( "mysql_real_escape_string" ) ) 
				{ 
      			$value = mysql_real_escape_string( $value ); 
				} 
				else 
					{ 
      					$value = addslashes( $value ); 
					} 
	return $value; 
}
function post($var) 
{
	if (isset($_POST[$var])) 
	{
		return (trim($_POST[$var]));
	}
	else 
	{
		return '';
	}
}
function get($var) 
{
	if (isset($_GET[$var])) {
		return (trim($_GET[$var]));
	}
	else 
	{
		return '';
	}
}
function session($var)
{
	if (isset($_SESSION[$var])) 
	{
		return (trim($_SESSION[$var]));
	}
	else 
	{
		return '';
	}
}
$defauldate = date('Y-m-d');
function companystatus($status)
{
	$var = $status;
	if($var == 0)
		{
		echo "Post New";
		}
	if($var == 1)
		{
		echo "Active";
		}	
	if($var == 2)
		{
		echo "<span style=\"color:red\">Inactive</div>";
		}	
	if($var ==3)
		{
		echo "Pending";
		}		
		
}

function imageUpload($picture_name,$path){
		if(isset($_FILES[$picture_name]['name'])){
			if($_FILES[$picture_name]["error"]>0){
				return("error");
				}
			else{
				if(($_FILES[$picture_name]["type"] == "image/gif")
				|| ($_FILES[$picture_name]["type"] == "image/jpeg")
				|| ($_FILES[$picture_name]["type"] == "image/jpg")
				|| ($_FILES[$picture_name]["type"] == "image/pjpeg")
				|| ($_FILES[$picture_name]["type"] == "image/x-png")
				|| ($_FILES["file"]["type"] == "image/png")){
					if (file_exists($path . $_FILES[$picture_name]["name"]))
					  {
					  return("existed");
					  }
					else
					  {
					  if(move_uploaded_file($_FILES[$picture_name]["tmp_name"],$path.$_FILES[$picture_name]["name"])){
					  //return($_FILES[$picture_name]["name"]);
					  return true;
					  }
					  }
					}
				else{
					return("invalid");
					}
				}
		  }
		else{
			return false;	  
		 }
}
function fileUpload($file_name,$path){
		if(isset($_FILES[$file_name]['name'])){
			if($_FILES[$file_name]["error"]>0){
				return("error");
				}
			else{	if (file_exists($path . $_FILES[$file_name]["name"]))
					  {
					  return("existed");
					  }
					 else{
					 if(move_uploaded_file($_FILES[$file_name]["tmp_name"],$path.$_FILES[$file_name]["name"])){
					  return true;
					 }
					}
				}
			}
		else{
			return false;	  
		 }
	}
date_default_timezone_set('Asia/Bangkok');
?>