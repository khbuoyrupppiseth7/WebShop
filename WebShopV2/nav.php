 <header class="header">
            <a href="index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                AdminLTE
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">
                                	<?php
										//Call Select for New company
										$select2=$db->query("SELECT count(*)  AS Total, TIMESTAMPDIFF(MONTH, DateFrom , DateTo ) AS TotalMonth
FROM tbldns WHERE TIMESTAMPDIFF(MONTH, DateFrom , DateTo ) <= 1 ;");
										$rowselect2=$db->dbCountRows($select2);
										if($rowselect2>0){
											
											while($row=$db->fetch($select2)){
											$Total = $row->Total;
												echo $Total;
											}
											
										}
										?>
                                
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">
									
                                </li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                                                                
                                        <?php
										//Call Select for New company
										$select2=$db->query("SELECT dnsID, dnsName, CusName, DateFrom, DateTo, TIMESTAMPDIFF(MONTH, DateFrom , DateTo ) AS TotalMonth
								FROM tbldns WHERE TIMESTAMPDIFF(MONTH, DateFrom , DateTo ) <= 1 ;");
										$rowselect2=$db->dbCountRows($select2);
										if($rowselect2>0){
											
											while($row=$db->fetch($select2)){
											$dnsID = $row->dnsID;
											$dnsName = $row->dnsName;
											$CusName = $row->CusName;
											$DateFrom = $row->DateFrom;
											$DateTo = $row->DateTo;
												echo '<li><!-- start message -->
														<a href="#">
															<h4>
																'.$dnsName.'
																<small><i class="fa fa-clock-o"></i>'.$CusName.'</small>
															</h4>
															<p>From '.$DateFrom.' &nbsp;To ' .$DateTo. '</p>
														</a>
													</li><!-- end message -->';
											}
											
										}
										?>
                                        
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Advance<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $U_Acc; ?>
                                        <small>Powered by 7Technology</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!--<li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>-->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="UserChangePassword.php" class="btn btn-default btn-flat">Change Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">