<!-- Main Header Nav -->

<header class="header-nav menu_style_home_one style2 home3 navbar-scrolltofixed stricky main-menu">

<div class="container-fluid p0">

<!-- Ace Responsive Menu -->

<nav>

<!-- Menu Toggle btn-->

<div class="menu-toggle">

<img class="nav_logo_img img-fluid" src="<?php echo base_url();?>assets/images/

house-keeper-black.png" alt="logo.png">

<button type="button" id="menu-btn">

<span class="icon-bar"></span>

<span class="icon-bar"></span>

<span class="icon-bar"></span>

</button>

</div>

<a href="<?php echo base_url();?>" class="navbar_brand float-left dn-smd">

<img class="logo1 w-80" src="<?php echo base_url();?>assets/images/

house-keeper-black.png" alt="">

<img class="logo2 w-80" src="<?php echo base_url();?>assets/images/

house-keeper-black.png" alt="">



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

<!-- <li class="last">

<a href="<?php echo base_url();?>home/service_list"><span class="title">Services</span></a>

</li> -->

<li class="last">

<a href="<?php echo base_url();?>home/contact"><span class="title">Contact</span></a>

</li>
<?php 
$userid   = $this->session->userdata('user_name');
$emp_id   = $this->session->userdata('emp_id');
$admin_id = $this->session->userdata('admin_id');

if(!empty($userid)){ ?>

<li class="list-inline-item list_s">
	<a class="btn" href="<?php echo base_url();?>user"> <span class="dn-1199">Hi, <?php echo $this->session->userdata('user_name'); ?></span></a>
</li>


<?php 
  //}else if(!empty($emp_id)){
 ?>

<!-- <li class="list-inline-item list_s">
	<a class="btn" href="<?php //echo base_url();?>employee/dashboard"> <span class="dn-1199">Hi, <?php// echo $this->session->userdata('emp_name'); ?></span></a>
</li> -->


<?php //}else if(!empty($admin_id)){ ?>

<!-- <li class="list-inline-item list_s">
	<a class="btn" href="<?php echo base_url();?>admin/dashboard"> <span class="dn-1199">Hi, <?php //echo $this->session->userdata('username'); ?></span></a>
</li> -->


<?php }else{  ?>

<li class="list-inline-item list_s"><a href="<?php echo base_url();?>home/user_login" class="btn flaticon-user"> <span class="dn-lg">Login</span></a></li>
<li class="list-inline-item list_s"><a href="<?php echo base_url();?>home/user_signup" class="btn flaticon-edit"> <span class="dn-lg">Signup</span></a></li>


<?php } ?>


</ul>

</nav>

</div>

</header>







<!-- Main Header Nav For Mobile -->

<div id="page" class="stylehome1 h0">

<div class="mobile-menu">

<div class="header stylehome1">

<div class="main_logo_home2 text-center">



<span class="mt20">HouseKeepers</span>

</div>

<ul class="menu_bar_home2">

<li class="list-inline-item list_s"></li>

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

<li class="last">

<a href="<?php echo base_url();?>home/contact"><span class="title">Contact</span></a>

</li>

<?php 
$userid = $this->session->userdata('user_name');
if(empty($userid)){
?>

<li><a href="<?php echo base_url();?>home/user_login"><span class="flaticon-user"></span> Login</a></li>

<li><a href="<?php echo base_url();?>home/user_signup"><span class="flaticon-edit"></span> Signup</a></li>
<?php }else{ ?>

<li><a href="<?php echo base_url();?>user"><span class="flaticon-user"></span> Hi, <?php echo $this->session->userdata('user_name'); ?></a></li>
<?php } ?>


</ul>

</nav>

</div>

