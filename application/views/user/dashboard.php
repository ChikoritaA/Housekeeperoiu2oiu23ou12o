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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
<!-- Title -->

<title>House Keepers</title>

<!-- Favicon -->

<link href="<?php echo base_url();?>assets/images/logo.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />

<link href="<?php echo base_url();?>assets/images/logo.ico" sizes="128x128" rel="shortcut icon" />


</head>

<body>

<div class="wrapper">

	<div class="preloader"></div>



   <!--=====header-n-js======-->

<?php include(APPPATH.'views/include/dashboard-header.php'); ?>



  <!--=====/Fotter-n-js=====-->



  	<!-- Our Dashbord -->

	<section class="our-dashbord dashbord bgc-f7 pb50">

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

								<h2 class="breadcrumb_title">Dashbord</h2>
						</div>

						</div> <!---col-lg-12---->

					</div><!---row--->


					<div class="row mx-0">

						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">

							<div class="custom_designcard">

								<img src="<?php echo base_url();?>assets/images/Activ-jobs-ico.png">

								<div class="detais">

									<div class="timer"><?php echo $upcoming_job;?></div>

									<p>Upcoming Jobs</p>

								</div>

							</div>	

						</div><!---col--->

						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">

							<div class="custom_designcard">

								<img src="<?php echo base_url();?>assets/images/New-Jobs-ico.png">

								<div class="detais">

									<div class="timer"><?php echo $complete_job;?></div>

									<p>Complete Jobs</p>
								</div>

							</div>	

						</div><!---col--->

           
           <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">

							<div class="custom_designcard">

								<img src="<?php echo base_url();?>assets/images/TotalBalance-ico.png">

								<div class="detais">

									<div class="timer"><?php echo $allbooking;?></div>

									<p>All Booking Jobs</p>
								</div>

							</div>	

						</div><!---col--->



						




				 </div>		<!--row-->

	




				</div>

			</div>

		</div>



	</section>

<section class="text-center">


					

</section>

 <!--=======Copyright========-->
           <?php include(APPPATH.'views/include/copyright.php'); ?>
           <!--=======//Copyright========-->






 <!--=====Fotter-n-js======-->

<?php include(APPPATH.'views/include/dashboard-footer.php'); ?>

   

  <!--=====/Fotter-n-js=====-->



  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {

    $('#services-table').DataTable();

} );

</script>

</body>



</html>