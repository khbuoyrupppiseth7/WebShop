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
							echo '<li >
								   <a href="index.php">
										<span>Buy & Sale Products</span>
										
								   </a>
											
								</li>';
							/*echo '<li class="treeview">
								   <a >
									2. <span>Sale Products</span>
										<i class="fa fa-angle-left pull-right"></i>
								   </a>
										<ul class="treeview-menu">
											<li><a href="frmSalePrd.php">2.1 Sale Products </a></li>
											<li><a href="invoicesaling.php">2.2 Report Salling</a></li>
										    <li><a href="invoicesalingofuser.php">2.2 Report User Salling</a></li>
										</ul>
									</li>';*/
							echo'<li class="treeview">
								<a > <span>Setting</span>
								<i class="fa fa-angle-left pull-right"></i>
								</a>
										<ul class="treeview-menu">
											<li><a href="frmbranch.php">Branch</a></li>
											<li><a href="frmCategory.php">Category</a></li>
											
										</ul>
							</li>';
							
							
								echo '<li class="treeview">
										<a href="userAccount.php">
										    <span>User Account</span>
											<i class="fa fa-angle-left pull-right"></i>
										</a>
												<ul class="treeview-menu">
													<li><a href="userAccount.php">User Account </a></li>
													<li><a href="UserChangePassword.php">Change Password</a></li>
													<li><a href="logout.php">Logout</a></li>
												</ul>
									</li>';	
									
							}
							else
							{
								echo '<li>
								   <a href="index.php">
									    <span>Buy Products</span>
										<i class="fa fa-angle-left pull-right"></i>
								   </a>
										
								</li>';
								
								echo '<li class="treeview">
										<a href="userAccount.php">
											 <span>User Account</span>
											<i class="fa fa-angle-left pull-right"></i>
										</a>
												<ul class="treeview-menu">
													<li><a href="UserChangePassword.php">Change Password</a></li>
													<li><a href="logout.php">Logout</a></li>
												</ul>
									</li>';	
							}
						
						?>
						
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>