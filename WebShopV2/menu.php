<aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php  echo $U_Acc; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                       
                                             
						<?php
						if($_SESSION['Level']=='1'){
							echo '<li class="treeview">
								   <a >
										1. <span>Buy Products</span>
										<i class="fa fa-angle-left pull-right"></i>
								   </a>
											<ul class="treeview-menu">
												<li><a href="index.php">1.1 Buy Products </a></li>
												<li><a href="invoicebuying.php">1.2 Report Buying</a></li>
											</ul>
								</li>';
							echo '<li class="treeview">
								   <a >
									2. <span>Sale Products</span>
										<i class="fa fa-angle-left pull-right"></i>
								   </a>
										<ul class="treeview-menu">
											<li><a href="frmSalePrd.php">2.1 Sale Products </a></li>
											<li><a href="invoicesaling.php">2.2 Report Salling</a></li>
										    <li><a href="invoicesalingofuser.php">2.2 Report User Salling</a></li>
										</ul>
									</li>';
							echo'<li class="treeview">
								<a >3. <span>Setting</span>
								<i class="fa fa-angle-left pull-right"></i>
								</a>
										<ul class="treeview-menu">
											<li><a href="frmbranch.php">3.1 Branch</a></li>
											<li><a href="frmtotalproducts.php?BranchID=0">3.2 All Products</a></li>
											<li><a href="frmCategory.php">3.3 Category</a></li>
											<li><a href="frmRule.php">3.4 Rule</a></li>
										</ul>
							</li>';
							
							
								echo '<li class="treeview">
										<a href="userAccount.php">
											4. <span>User Account</span>
											<i class="fa fa-angle-left pull-right"></i>
										</a>
												<ul class="treeview-menu">
													
													<li><a href="userAccount.php">4.1 User </a></li>
													
												   
													
													<li><a href="UserChangePassword.php">4.2 Change Password</a></li>
													<li><a href="logout.php">4.3 Logout</a></li>
												</ul>
									</li>';	
									
							}
							else
							{
								echo '<li class="treeview">
								   <a >
										1. <span>Buy Products</span>
										<i class="fa fa-angle-left pull-right"></i>
								   </a>
											<ul class="treeview-menu">
												<li><a href="index.php">1.1 Buy Products </a></li>
												
											</ul>
								</li>';
								echo '<li class="treeview">
									   <a >
											2. <span>Sale Products</span>
											<i class="fa fa-angle-left pull-right"></i>
									   </a>
												<ul class="treeview-menu">
													<li><a href="frmSalePrd.php">2.1 Sale Products </a></li>
													<li><a href="invoicesaling.php">2.2 Report Salling</a></li>
													<li><a href="frmtotalproducts_user.php">2.3 All Products</a></li>
														
												
												</ul>
									</li>';
								echo '<li class="treeview">
										<a href="userAccount.php">
											3. <span>User Account</span>
											<i class="fa fa-angle-left pull-right"></i>
										</a>
												<ul class="treeview-menu">
													<li><a href="UserChangePassword.php">3.1 Change Password</a></li>
													<li><a href="logout.php">3.2 Logout</a></li>
												</ul>
									</li>';	
							}
						
						?>
						
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>