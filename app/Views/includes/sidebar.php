<div class="sidebar-menu ">
            <div class="sidebar-header">
                <div class="logo">
                    <a href=""><img src="<?php echo base_url('peso_logo.png'); ?>" alt="logo"></a>
                </div>
            </div>




            <div class="main-menu " >
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">

                            
                            <?php 

                            $request = \Config\Services::request();

                            $last = $request->uri->getSegments();
                            $page = $request->uri->getSegment(2);
                            $first_page = $request->uri->getSegment(1);
                            $third_page = $request->uri->getSegment(3);
                            if (session()->get('user_type') == 'admin') {
                            
                             ?>


                            
                            <li class="<?= $page == 'dashboard' || $page == 'rfa-dashboard' ? 'active' : ''?>">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pie-chart"></i><span>Dashboard</span>
                                </a>
                                <ul class="collapse">
                                    <li class="<?= $page == 'dashboard' ? 'active' : ''?>"><a href="<?php echo base_url('admin/dashboard') ?>" >PMAS Dashboard</a></li>    
                                    <li class="<?= $page == 'rfa-dashboard' ? 'active' : ''?>"><a href="<?php echo base_url('admin/rfa-dashboard') ?>" >RFA Dashboard</a></li>    
                                   
                               
                                </ul>
                            </li>
                            <span style="color: #fff;" class="ml-1 p-2 mb-5">PMAS </span>
                            <!-- <li class="<?= $page == 'dashboard' ? 'active' : ''?>"><a href="<?php echo base_url('admin/dashboard') ?>" ><i class="fa fa-dashboard"></i> <span>Dashboard </span></a></li> -->
                           
                           
                          


                            <li  class="<?= $page == 'responsibility-center' || $page == 'responsible-section' || $page == 'type-of-activity' || $page == 'cso' ? 'active' : ''?>" >
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-eye"></i><span>See More</span>
                                </a>
                                <ul class="collapse">

                                <li class="<?= $page == 'cso' ? 'active' : ''?>"><a href="<?php echo base_url('admin/cso') ?>"><i class="fa fa-sitemap"></i> <span>CSO </span></a></li>
                                    
                                <li class="<?= $page == 'responsibility-center' ? 'active' : ''?>"><a href="<?php echo base_url('admin/responsibility-center') ?>"><i class="fa fa-chevron-right"></i> <span>Responsibilty Center</span></a></li>
                                <li class="<?= $page == 'responsible-section' ? 'active' : ''?>"><a href="<?php echo base_url('admin/responsible-section') ?>"><i class="fa fa-chevron-right"></i> <span>Responsible Section</span></a></li>
                                <li class="<?= $page == 'type-of-activity' ? 'active' : ''?>"><a href="<?php echo base_url('admin/type-of-activity') ?>"><i class="fa fa-chevron-right"></i> <span>Type of Activity</span></a></li>
                                   
                               
                                </ul>
                            </li>


                             <li  class="<?= $page == 'pending-transactions' ? 'active' : ''?>"><a href="<?php echo base_url('admin/pending-transactions') ?>"><i class="fa fa-hourglass-start"></i> <span>Pending Transactions</span> <span class="badge badge-danger count_pending">0</span></a></li>

                            <span style="color: #fff;" class="ml-1 p-2 mb-5">PMAS Report</span>
                             <li class="<?= $page == 'completed-transactions' ? 'active' : ''?>"><a href="<?php echo base_url('admin/completed-transactions') ?>"><i class="fa fa-file"></i> <span>Completed Transactions </span></a></li>



                           <!--  <li class="<?= $page == 'responsibility-center' ? 'active' : ''?>"><a href="<?php echo base_url('admin/responsibility-center') ?>"><i class="fa fa-chevron-right"></i> <span>Responsibilty Center</span></a></li>
                            <li class="<?= $page == 'responsible-section' ? 'active' : ''?>"><a href="<?php echo base_url('admin/responsible-section') ?>"><i class="fa fa-chevron-right"></i> <span>Responsible Section</span></a></li>
                            <li class="<?= $page == 'type-of-activity' ? 'active' : ''?>"><a href="<?php echo base_url('admin/type-of-activity') ?>"><i class="fa fa-chevron-right"></i> <span>Type of Activity</span></a></li>
                            <span style="color: #fff;" class="ml-1 p-2 mb-5">PMAS Report</span>
                             <li class="<?= $page == 'completed-transactions' ? 'active' : ''?>"><a href="<?php echo base_url('admin/completed-transactions') ?>"><i class="fa fa-file"></i> <span>Completed Transactions </span></a></li> -->
                            
                            
                            <hr> 
                            <span style="color: #fff;" class="ml-1 p-2 mb-5">RFA</span>
                             <!-- <li class="<?= $page == 'clients' ? 'active' : ''?>"><a href="<?php echo base_url('admin/clients') ?>"><i class="fa fa-user"></i> <span>Clients</span></a></li>
                            <li class=" <?= $page == 'type-of-request' ? 'active' : ''?>"><a href="<?php echo base_url('admin/type-of-request') ?>"><i class="fa fa-chevron-right"></i> <span>Type Of Request</span></a></li> -->

                             <li class="<?= $page == 'clients' || $page == 'type-of-request' ? 'active' : ''?>">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-eye"></i><span>See more</span>
                                </a>
                                <ul class="collapse">
                                    <li class="<?= $page == 'clients' ? 'active' : ''?>"><a href="<?php echo base_url('admin/clients') ?>"><i class="fa fa-user"></i> <span>Clients</span></a></li>
                                    <li class=" <?= $page == 'type-of-request' ? 'active' : ''?>"><a href="<?php echo base_url('admin/type-of-request') ?>"><i class="fa fa-chevron-right"></i> <span>Type Of Request</span></a></li>   
                                   
                               
                                </ul>
                            </li>
                            
                            <li class=" <?= $page == 'pending-rfa' ? 'active' : ''?>"><a href="<?php echo base_url('admin/pending-rfa') ?>"><i class="fa fa-hourglass-start"></i> <span>Pending RFA</span><span class="badge badge-danger count_pending_rfa">0</span></a></li>
                            <span style="color: #fff;" class="ml-1 p-2 mb-5">RFA Report</span>
                            <li class=" <?= $page == 'completed-rfa' ? 'active' : ''?>"><a href="<?php echo base_url('admin/completed-rfa') ?>"><i class="fa fa-file"></i> <span>Completed RFA</span></a></li>
                            
                            <hr> 
                            <span style="color: #fff;" class="ml-1 p-2 mb-5">Others</span>
                            <li class="scroll-down <?= $page == 'users' ? 'active' : ''?>"><a href="<?php echo base_url('admin/users') ?>"><i class="fa fa-users"></i> <span>Users</span></a></li>
                            <li class=" <?= $page == 'back-up-database' ? 'active' : ''?>"><a href="<?php echo base_url('admin/back-up-database') ?>"><i class="fa fa-database"></i> <span>Backup Database</span></a></li>
                            <!-- <li class="scroll-down <?= $page == 'activity-logs' ? 'active' : ''?>"><a href="<?php echo base_url('admin/activity-logs') ?>"><i class="fa fa-history"></i> <span>Activity Logs</span></a></li> -->
                            
                            <!--  <li><a href="<?php echo base_url() ?>Wallpaper"><i class="ti-map-alt"></i> <span>Login Wallpaper</span></a></li> -->

                             <br>
                             <br>
                             <br>
                             <br>

                         <?php }else if (session()->get('user_type') == 'user') { ?>

                            
                            <li class="<?= $page == 'dashboard' || $page == 'rfa-dashboard' ? 'active' : ''?>">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pie-chart"></i><span>Dashboard</span>
                                </a>
                                <ul class="collapse">
                                    <li class="<?= $page == 'dashboard' ? 'active' : ''?>"><a href="<?php echo base_url('user/dashboard') ?>" >PMAS Dashboard</a></li>    
                                    <li class="<?= $page == 'rfa-dashboard' ? 'active' : ''?>"><a href="<?php echo base_url('user/rfa-dashboard') ?>" >RFA Dashboard</a></li>    
                                   
                               
                                </ul>
                            </li>
                            <span style="color: #fff;" class="ml-1 p-2 mb-5">PMAS</span>
                            <!-- <li class="<?= $page == 'dashboard' ? 'active' : ''?>"><a href="<?php echo base_url('user/dashboard') ?>" ><i class="fa fa-dashboard"></i> <span>Dashboard </span></a></li> -->
                            <li class="<?= $page == 'completed-transactions' ? 'active' : ''?>"><a href="<?php echo base_url('user/completed-transactions') ?>"><i class="fa fa-file"></i> <span>Completed Transactions </span></a></li>
                            <li  class="<?= $page == 'pending-transactions' ? 'active' : ''?>"><a href="<?php echo base_url('user/pending-transactions') ?>"><i class="fa fa-hourglass-start"></i> <span>Pending Transactions</span> <span class="badge badge-danger count_pending">0</span></a></li>
                            
                            
                            <hr> 
                            <span style="color: #fff;" class="ml-1 p-2 mb-5">RFA</span>
                            <li class="<?= $page == 'clients' ? 'active' : ''?>"><a href="<?php echo base_url('user/clients') ?>"><i class="fa fa-history"></i> <span>Clients</span></a></li>
                            <li class="<?= $page == 'completed-rfa' ? 'active' : ''?>"><a href="<?php echo base_url('user/completed-rfa') ?>"><i class="fa fa-history"></i> <span>Completed RFA</span></a></li>
                            <li class="<?= $page == 'pending-rfa' ? 'active' : ''?>"><a href="<?php echo base_url('user/pending-rfa') ?>"><i class="fa fa-history"></i> <span>Pending/Encoded RFA</span><span class="badge badge-danger count_pending_rfa">0</span></a></li>
                    
                             <li class="<?= $page == 'referred' ? 'active' : ''?>"><a href="<?php echo base_url('user/referred') ?>"><i class="fa fa-history"></i> <span>Referred To You</span><span class="badge badge-danger count_reffered_rfa">0</span></a></li>

           
                           
                            <hr> 
                           

                             <br>
                             <br>
                             <br>
                             <br>

                        <?php   } ?>

             
                        </ul>
                    </nav>
                </div>
            </div>
        </div>