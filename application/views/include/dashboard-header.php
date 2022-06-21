<header class="header-nav menu_style_home_one style2 menu-fixed main-menu">

		<div class="container-fluid p0">

		    <!-- Ace Responsive Menu -->

		    <nav>

		        <!-- Menu Toggle btn-->

		        <div class="menu-toggle">

		            <img class="nav_logo_img img-fluid" src="<?php echo base_url();?>assets/images/header-logo.png" alt="header-logo.png">

		            <button type="button" id="menu-btn">

		                <span class="icon-bar"></span>

		                <span class="icon-bar"></span>

		                <span class="icon-bar"></span>

		            </button>

		        </div>

		        <a href="#" class="navbar_brand float-left dn-smd">

		            <img class="logo1 img-fluid" src="<?php echo base_url();?>assets/images/header-logo2.png" alt="header-logo.png">

		            <img class="logo2 img-fluid" src="<?php echo base_url();?>assets/images/header-logo2.png" alt="header-logo2.png">

		           

		        </a>

		        <!-- Responsive Menu Structure-->

		        <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->

		        <ul id="respMenu" class="ace-responsive-menu text-right" data-menu-style="horizontal">

		         

		              <li class="last">

		                 <a href="<?php echo base_url();?>"><span class="title">Home</span></a>

		            </li>

		            <li class="last">

		                <a href="<?php echo base_url();?>home/about_page"><span class="title">About Us</span></a>

		            </li>

		           <!--  <li class="last">

		                <a href="<?php echo base_url();?>home/service_list"><span class="title">Services</span></a>

		            </li> -->

		             <li class="last">

		                <a href="<?php echo base_url();?>home/contact"><span class="title">Contact</span></a>

		            </li>

	                <li class="user_setting">

						<div class="dropdown">

	                		<a class="btn dropdown-toggle" href="#" data-toggle="dropdown"><img class="rounded-circle" src="<?php echo base_url();?>/assets/admin_assets/images/profile/17.jpg" alt="e1.png"> <span class="dn-1199">Hi, <?php echo $this->session->userdata('user_name'); ?></span></a>

						    <div class="dropdown-menu">
						    	<div class="user_setting_content">
								<a class="dropdown-item" href="<?php echo base_url();?>user/profile"><i class="fa fa-cog"></i> Settings </a>
								<a class="dropdown-item" href="<?php echo base_url();?>user/user_logout"><i class="flaticon-logout"></i> Log out </a>


						    	</div>

						    </div>

						</div>

			        </li>

	                

		    </nav>

		</div>

	</header>







	<!-- Main Header Nav For Mobile -->

	<div id="page" class="stylehome1 h0">

		<div class="mobile-menu">

			<div class="header stylehome1">

				<div class="main_logo_home2 text-center" style="display: unset;">

		            <img class="nav_logo_img img-fluid w-25" src="<?php echo base_url();?>assets/images/house-keeper-black.png" alt="header-logo2.png">

		            <!-- <span class="mt20">House Keepers</span> -->

				</div>

				<ul class="menu_bar_home2">

	                <li class="list-inline-item"><a href="#menu"><span></span></a></li>

				</ul>

			</div>

		</div><!-- /.mobile-menu -->

		<nav id="menu" class="stylehome1">

			<ul>



				 <li class="last">

		                <a href="<?php echo base_url();?>"><span class="title">Home</span></a>

		            </li>

		            <li class="last">

		                <a href="<?php echo base_url();?>home/about_page"><span class="title">About Us</span></a>

		            </li>

		            <!-- <li class="last">

		                <a href="<?php echo base_url();?>home/service_list"><span class="title">Services</span></a>

		            </li> -->

				

				<li><a href="<?php echo base_url();?>home/contact">Contact</a></li>

				<?php 
				$userid = $this->session->userdata('user_name');
				if(empty($userid)){
				?>

				<li><a href="<?php echo base_url();?>home/user_login"><span class="flaticon-user"></span> Login</a></li>

				<li><a href="<?php echo base_url();?>home/user_signup"><span class="flaticon-edit"></span> Register</a></li>
				<?php }else{ ?>

				<li><a href="<?php echo base_url();?>user"> <span class="flaticon-user"> Hi, <?php echo $this->session->userdata('user_name'); ?></span></a></li>

			    <?php } ?>



				

			</ul>

		</nav>

	</div>





 <div class="dashboard_sidebar_menu dn-992">

	    <ul class="sidebar-menu">

	   		<li class="header">House Keepers</li>

	   		<!-- <li class="treeview"><a href="<?php echo base_url();?>user"><i class="flaticon-layers"></i><span> Dashboard</span></a></li> -->

	      	<li class="treeview"><a href="<?php echo base_url();?>user/my_booking"><i class="fa fa-clipboard"></i><span> My Orders</span></a></li>

	      <!-- 	<li><a href="<?php echo base_url();?>user/transactions"><i class="fa fa-history"></i> <span>Transaction</span></a></li> -->

		    <li><a href="<?php echo base_url();?>user/profile"><i class="fa fa-cog"></i> <span>Settings</span></a></li>

		    <li><a href="<?php echo base_url();?>user/user_logout"><i class="flaticon-logout"></i> <span>Logout</span></a></li>

	    </ul>

    </div>

