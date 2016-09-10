
    <!-- Sidebar -->
    <div class="sidebar sidebar-fixed">
        <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

        <div class="sidebar-inner">
        
            <!--- Sidebar navigation -->
            <!-- If the main navigation has sub navigation, then add the class "has_submenu" to "li" of main navigation. -->
            <ul class="navi">

                <!-- Use the class nred, ngreen, nblue, nlightblue, nviolet or norange to add background color. You need to use this in <li> tag. -->

                <li><a href="<?php echo base_url()."admin";?>"><i class="icon-desktop"></i> Dashboard</a></li>
                <li><a href="<?php echo base_url()."all-jobs";?>"><i class="icon-list"></i> All Jobs</a></li>
                <li><a href="<?php echo base_url()."all-providers";?>"><i class="icon-list"></i> Job Providers</a></li>
                <li><a href="<?php echo base_url()."all-seekers";?>"><i class="icon-list"></i> Job Seekers</a></li>
                <li><a href="<?php echo base_url()."ambassadeur/index";?>"><i class="icon-list"></i> Ambassadeurs</a></li>

               
                 <li class="has_submenu">
                    <a href="#">
                        <i class="icon-th"></i> Reports
                    </a>
                    <ul>
                        <li><a href="<?php echo base_url()."all-jobs";?>">Administrators</a></li>
                        <li><a href="<?php echo base_url()."all-providers";?>">Job Providers</a></li>
                        <li><a href="<?php echo base_url()."all-seekers";?>">Job Seekers</a></li>
                    </ul>
                </li>
                 <li class="has_submenu">
                   <a href="#">
                        <i class="icon-th"></i> Advertisers
                    </a>
                     <ul>
                        <li><a href="<?php echo base_url()."all-companies";?>">Companies</a></li>
                        <li><a href="<?php echo base_url()."all-advertisments";?>">Advertisments</a></li>
                    </ul>
                </li>
				

            </ul>
        </div>
    </div>
    <!-- Sidebar ends -->
