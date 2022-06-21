<!--**********************************
Nav header start
***********************************-->
<div class="nav-header">
<a href="<?php echo base_url();?>admin/dashboard" class="brand-logo">
<img class="sidebar-logo" src="<?php echo base_url();?>assets/admin_assets/images/house-keeper-black.png" alt="">
</a>
<div class="nav-control">
<div class="hamburger">
<span class="line"></span><span class="line"></span><span class="line"></span>
</div>
</div>
</div>
<!--**********************************
Nav header end
***********************************-->
<!--**********************************
Header start
***********************************-->
<div class="header">
<div class="header-content">
<nav class="navbar navbar-expand">
<div class="collapse navbar-collapse justify-content-between">
<div class="header-left">
<div class="dashboard_bar">

</div>
</div>

<ul class="navbar-nav header-right">
<li class="nav-item dropdown notification_dropdown">
<a class="nav-link  ai-icon" href="javascript:void(0)" role="button" data-toggle="dropdown">


</a>
<div class="dropdown-menu dropdown-menu-right">
<div id="DZ_W_Notification1" class="widget-media dz-scroll p-3 height380">
<ul class="timeline">
<div class="timeline-panel">

</div>
</li>
</ul>
</div>
</div>
</li>
<li class="nav-item dropdown header-profile">
<a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
<div class="header-info">
</div>
<img src="<?php echo base_url();?>assets/admin_assets/images/profile/17.jpg" width="20" alt=""/>
</a>
<div class="dropdown-menu dropdown-menu-right">

<a href="<?php echo base_url();?>admin/logout" class="dropdown-item ai-icon">
<i class="la la-sign-out"></i>
<span class="ml-2">Log out </span>
</a>

<a href="<?php echo base_url();?>admin/change_password" class="dropdown-item ai-icon">
<i class="la la-lock"></i>
<span class="ml-2">Change Password </span>
</a>


</div>
</li>
</ul>
</div>
</nav>
</div>
</div>
<!--**********************************
Header end ti-comment-alt
***********************************-->    <!--**********************************
Header start
***********************************-->
<div class="header">
<div class="header-content">
<nav class="navbar navbar-expand">
<div class="collapse navbar-collapse justify-content-between">
<div class="header-left">
<div class="dashboard_bar">
<div class="input-group search-area d-lg-inline-flex d-none">
</div>
</div>
</div>
<ul class="navbar-nav header-right">

<!-- <li class="nav-item dropdown header-profile">
<a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
<div class="header-info">
</div>
<i class="la la-home f-25"></i>
</a>
<div class="dropdown-menu dropdown-menu-right">

<a href="<?php echo base_url();?>" class="dropdown-item ai-icon">
<i class="la la-home"></i>
<span class="ml-2">Home </span>
</a>

<a href="<?php echo base_url();?>home/about_page" class="dropdown-item ai-icon">
<i class="la la-newspaper-o"></i>
<span class="ml-2">About Us</span>
</a>

<a href="<?php echo base_url();?>home/service_list" class="dropdown-item ai-icon">
<i class="la la-files-o"></i>
<span class="ml-2">Services</span>
</a>

<a href="<?php echo base_url();?>home/contact" class="dropdown-item ai-icon">
<i class="la la-envelope"></i>
<span class="ml-2">Contact</span>
</a>
</div>
</li> -->


<li class="nav-item dropdown header-profile">
<a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
	<img src="<?php echo base_url();?>assets/admin_assets/images/profile/17.jpg" width="20" alt=""/>
<div class="header-info pl-1">
<span class="text-black">Hi,<strong><?php echo $this->session->userdata('username');?></strong></span>
<!-- <p class="fs-12 mb-0">Admin</p> -->
</div>

</a>
<div class="dropdown-menu dropdown-menu-right">
<a href="<?php echo base_url();?>admin/logout" class="dropdown-item ai-icon">

<i class="la la-sign-out"></i>
<span class="ml-2">Log out</span>
</a>

<a href="<?php echo base_url();?>admin/change_password" class="dropdown-item ai-icon">
<i class="la la-lock"></i>
<span class="ml-2">Change Password </span>
</a>

</div>
</li>

</ul>
</div>
</nav>
</div>
</div>
<!--**********************************
Header end ti-comment-alt
***********************************-->
<div class="deznav">
<div class="deznav-scroll">
<ul class="metismenu" id="menu">
<li class=""><a href="<?php echo base_url();?>admin/dashboard" class="ai-icon">
<i class="la la-dashboard"></i>
<span class="nav-text">Dashboard</span>
</a>
</li>
<li>
<a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
<i class="la la-sitemap"></i>
<span class="nav-text">Master</span> 
</a>
<ul aria-expanded="false">
<li><a href="<?php echo base_url();?>admin/shift"><i class="la la-clock-o"></i> Create Shift</a></li>
<li><a href="<?php echo base_url();?>admin/areacode"><i class="
la la-map-marker"></i> Create Area Code</a></li>
<li><a href="<?php echo base_url();?>admin/day_combination"><i class="la la-calendar"></i> Day Combination</a></li>
<li><a href="<?php echo base_url();?>admin/pricing_plan"><i class="
la la-money"></i> Create Pricing Plan
</a></li>
</ul>
</li>
<li><a href="<?php echo base_url();?>admin/employee_onboard" class="ai-icon">
<i class="flaticon-381-notepad"></i>
<span class="nav-text">Onboard Employee</span>
</a>
</li>

<li><a href="<?php echo base_url();?>admin/employee_manage" class="ai-icon">
<i class="la la-user-secret"></i>
<span class="nav-text">Employees</span>
</a>
</li>

<li><a href="<?php echo base_url();?>admin/employee_schedule" class="ai-icon">
<i class="la la-calendar"></i>
<span class="nav-text">Employee Scheduler</span>
</a>
</li>

<li><a href="<?php echo base_url();?>admin/user" class="ai-icon">
<i class="la la-users"></i>
<span class="nav-text">Users</span>
</a>
</li>

<li><a href="<?php echo base_url();?>admin/manage_job" class="ai-icon">
<i class="la la-clipboard"></i>
<span class="nav-text">Manage Jobs</span>
</a>
</li>

<li><a href="<?php echo base_url();?>admin/rewards" class="ai-icon">
<i class="la la-award"></i>
<span class="nav-text">Reward Price</span>
</a>
</li>

<li><a href="<?php echo base_url();?>admin/transaction" class="ai-icon">
<i class="la la-credit-card"></i>
<span class="nav-text">Transaction</span>
</a>
</li>


<li><a href="<?php echo base_url();?>admin/logout" class="ai-icon">
<i class="la la-sign-out"></i>
<span class="nav-text">Log out</span>
</a>
</li>
</ul>
</div>
</div>