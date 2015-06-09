<?php 
	include 'header.php';
 	include 'menu.php'; 
	
	$db=new MyConnection();
	$db->connect();
	$id=get('id');
			$delete=$db->query("Call sp_Category_Delete('".$id."')");
	
			if($delete)
			{
				cRedirect('ProductCategory.php');
			}
			else
			{
				echo mysql_error();
			}
			
	
	
	include 'footer.php'; 
	 
	 
	 /*
echo "<td>
        <a href='DeleteImage.php?ID=".$row[0]."&IMAGE=".$row[1]."&PATH=".$path." ' onclick=\"return confirm('Do you want to delete this group?');\"><img src='IMAGES/deletegroup.png' /></a> 
        
       </td>";*/
?>


