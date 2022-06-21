<!DOCTYPE html>

<html dir="ltr" lang="en">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="keywords" content="">

<meta name="description" content="">

<meta name="" content="">

<!-- css file -->

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/dashbord_navitaion.css">

<!-- Responsive stylesheet -->

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.css">

<!-- Title -->

<title>House Keepers</title>

<!-- Favicon -->

<link href="<?php echo base_url();?>assets/images/logo.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />

<link href="<?php echo base_url();?>assets/images/logo.ico" sizes="128x128" rel="shortcut icon" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">



</head>

<body>

<div class="wrapper">

	<div class="preloader"></div>



   <!--=====header-n-js======-->

<?php include(APPPATH.'views/include/dashboard-header.php'); ?>



  <!--=====/Fotter-n-js=====-->



  	<!-- Our Dashbord -->

	<section class="our-dashbord dashbord bgc-f7 pb100">

		<div class="container-fluid">

			<div class="row">

				<div class="col-lg-3 col-xl-2 dn-992 pl0"></div>

				<div class="col-lg-9 col-xl-10 maxw100flex-992">

					<div class="row mx-0">

						<div class="col-lg-12">



							  <!--=====header-n-js======-->

                       <?php include(APPPATH.'views/include/mobile-dashboard-sidebar.php'); ?>



                       <!--=====/Fotter-n-js=====-->



							

						</div>

						<div class="col-lg-12 mb10">

							<div class="">

								<h2 class="breadcrumb_title">Cleaner Details</h2>

								

							</div>

						</div> 



						 <div class="row w-100">



						 	<div class="col-xl-4">

						 		<div class="my_dashboard_review mb40">

								<h3 class="">Profile Photo</h3>

                 <div class="profile-img text-center">
									<img src="<?php echo base_url();?>uploads/idcard/<?php echo $udetail->profile;?>" class="img-fluid" style="height:250px;width:220px;">
								</div>

								</div>


							</div>

						   

						   

						   <div class="col-xl-8">

                      <div class="row">



                      	<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

							<div class="my_dashboard_review mb40">

								<h3 class="">Cleaner Name</h3>

									<p class="font-weight-bold"><?php echo $udetail->fullname;?></p>

								</div>

							</div>





							<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

							<div class="my_dashboard_review mb40">

								<h3 class="">Mobile</h3>

									<p class="font-weight-bold"><?php echo $udetail->phone;?></p>

								</div>

							</div>





							<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

							<div class="my_dashboard_review mb40">

								<h3 class="">Email id</h3>

									<p class="font-weight-bold"><?php echo $udetail->email;?></p>

								</div>

							</div>



							<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">

							<div class="my_dashboard_review mb40">

								<h3 class="">Type</h3>

									<p class="font-weight-bold"><?php echo $udetail->job_type;?></p>

								</div>

							</div>







                      </div>	



						   </div>		



						 </div>	



						 </div>


</div>
</div>

					</div>

					

				</div>

			</div>

		</div>

		   <!--=======Copyright========-->
		       <?php include(APPPATH.'views/include/copyright.php'); ?>
		       <!--=======//Copyright========-->

	</section>







 <!--=====Fotter-n-js======-->

<?php include(APPPATH.'views/include/dashboard-footer.php'); ?>



   

  <!--=====/Fotter-n-js=====-->

  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>





<script type="text/javascript">

$(document).ready(function() {

    $('#example').DataTable();

} );

</script>





</body>



</html>