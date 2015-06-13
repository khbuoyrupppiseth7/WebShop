<?php
	include 'header.php';
	$autoid = time();
	
	$txtRuleID = get('txtRuleID');	
	$txtProductID = get('txtProductID');
	$cboPrd = get('cboPrd');
	$txtmin = get('txtmin');
	$txtmax = get('txtmax');	
	$txtdaymin = get('txtdaymin');
	$txtdaymax = get('txtdaymax');
	$txtatm = get('txtatm');	
	$txtDesc = get('txtDesc');
	
	$updateRule=$db->query("UPDATE tblrule SET   Min=".$txtmin.", Max=".$txtmax.", DayMin=".$txtdaymin.", DayMax=".$txtdaymax.", Atm=".$txtatm.", Description=N'".$txtDesc."' 
WHERE RuleID = '".$txtRuleID."'");
		if($updateRule)
		{
			echo "<script type='text/javascript'>alert('Update Successful!')</script>";
			cRedirect('frmRule.php');
		}
		else
		{
			echo "<script type='text/javascript'>alert('Error!')</script>";
		}
	
	/*if($cboPrd == 0)
	{
		$updateRule=$db->query("UPDATE tblrule SET   Min=".$txtmin.", Max=".$txtmax.", DayMin=".$txtdaymin.", DayMax=".$txtdaymax.", Atm=".$txtatm.", Description=N'".$txtDesc."' 
WHERE RuleID = '".$txtRuleID."'");
		if($updateRule)
		{
			echo "<script type='text/javascript'>alert('Update Successful!')</script>";
			cRedirect('frmRule.php');
		}
		else
		{
			echo "<script type='text/javascript'>alert('Error!')</script>";
		}
	}
	else
	{
		$updateRule=$db->query("UPDATE tblrule SET   Min=".$txtmin.", Max=".$txtmax.", DayMin=".$txtdaymin.", DayMax=".$txtdaymax.", Atm=".$txtatm.", Description=N'".$txtDesc."' 
WHERE RuleID = '".$txtRuleID."'");
		if($updateRule)
		{
			echo "<script type='text/javascript'>alert('Update Successful!')</script>";
			cRedirect('frmRule.php');
		}
		else
		{
			echo "<script type='text/javascript'>alert('Error!')</script>";
		}
	}*/
	/*Create Invoice Customer Sale*/
	
	

?>