<?php 
include 'header.php';

$error = "";
	$id=get('id');
	$BranchName=get('BranchName');
	$Decription=get('Decription');
	$UserID = $_SESSION['UserID'];
	
	
	//Update Branch
	if(isset($_POST['btnSaveUpdate'])){
		
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
      
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Update Branch</h1>
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
               
                        <div class="panel-heading">
                            <?php echo $error; ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        	<th>ID</th>
                                            <th>ProductID</th>
                                            <th>BuyPrice</th>
											<th>OtherCost</th>
											<th>SalePrice</th>
											<th>Qty</th>
											<th>QtyInstock</th>
											<th>TotalBuyPrice</th>
											<th>Decription</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
										 <?php

										 $select=$db->query("SELECT 
															PB.ProductID AS ProductID ,
															PB.BranchID AS BranchID ,
															PB.BuyPrice AS BuyPrice,
															PB.OtherCost AS OtherCost,
															PB.SalePrice AS SalePrice,
															PB.Qty AS Qty,
															PB.QtyInstock AS QtyInstock,
															PB.TotalBuyPrice AS TotalBuyPrice ,
															PB.Decription AS Decription	
															FROM tblproductsbranch PB
															INNER JOIN tblbranch B ON PB.BranchID=B.BranchID
															WHERE B.BranchID='".$id."'
															");
										 $rowselect=$db->dbCountRows($select);
										
										 
										 //Call Select Product Category
  									     
										 if($rowselect>0){
											$result="";
											$i=1;
											while($row=$db->fetch($select)){
												$id=$row->BranchID;
												$ProductID = $row->ProductID;
												$BuyPrice = $row->BuyPrice;		
												$OtherCost=$row->OtherCost;
												$SalePrice=$row->SalePrice;
												$Qty=$row->Qty;
												$QtyInstock=$row->QtyInstock;
												$TotalBuyPrice=$row->TotalBuyPrice;
												$Decription=$row->Decription;
												
												echo'<tr class="gradeA">
														<td>'.$i++.'</td>
														<td>'.$ProductID.'</td>
														<td>'.$BuyPrice.'</td>
														<td>'.$OtherCost.'</td>
														<td>'.$SalePrice.'</td>
														<td>    
														<input name="txtQty" class="form-control"  value="'.$Qty.'" required />
														</td>
														<td>'.$QtyInstock.'</td>
														<td>'.$TotalBuyPrice.'</td>
														<td>'.$Decription.'</td>
														
												</tr>';
											}
										
										}
									   ?>	
                                        
                                    </tbody>
                                </table>
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                  
            
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
    
        <!-- /#page-wrapper -->
          
