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

<style type="text/css">
body.modal-open {
    padding-right: 0px;
}
</style>

</head>

<body>

<div class="wrapper">

	<div class="preloader"></div>



   <!--=====header-n-js======-->

<?php include(APPPATH.'views/include/dashboard-header.php'); ?>



  <!--=====/Fotter-n-js=====-->



  	<!-- Our Dashbord -->

	<section class="our-dashbord dashbord bgc-f7 pb50" id="my_booking_page">

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


              
              <!----Tabs---->
              <div class="col-lg-12 px-0">

              	<ul class="nav nav-tabs" id="" role="tablist">
								<li class="nav-item col-6 px-0">
							    	<a class="nav-link active" data-toggle="tab" href="#my-bookings">My Bookings</a>
							    </li>
								<li class="nav-item col-6 px-0">
							    	<a class="nav-link" data-toggle="tab" href="#transaction">My Orders</a>
							    </li>
								
							</ul>

							<!-- Tab panes -->
							<div class="tab-content mt-3 mb-3" id="">
							    <div id="my-bookings" class="container tab-pane active px-0 mx-0">
								         <div class="row">
								         	<div class="col-lg-9 col-12 mb10">
							<div class="">
								<h2 class="breadcrumb_title">My Booking</h2>
							</div>
						</div> 

						<div class="col-lg-3 col-12 mb10">
							<div class="">
							  <input type="text" name="filter" id="filter" placeholder="Search by name...">
							</div>
						</div> 


								<div class="col-lg-12 px-0">

						 <!-- alert start  -->
						 <?php if($this->session->flashdata('deny')){ ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<?php echo $this->session->flashdata('deny'); ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>

						<?php $this->session->unset_userdata('deny'); } ?>

						 <?php if($this->session->flashdata('sucdeny')){ ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
						<?php echo $this->session->flashdata('sucdeny'); ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>
						<?php $this->session->unset_userdata('sucdeny'); } ?>
					   	<!-- alert -->
              
			          <div class="my_dashboard_review mb80 px-0 bg-transparent border-none load_booking">
                <!-- here is dynamic booking  -->
			          </div> 


            
					</div>	



								         </div><!--./row-->	
							    </div>
							    <div id="transaction" class="container tab-pane fade px-0 mx-0">
									   
									   <div class="row">

									   	<div class="col-lg-9 col-12 mb10">
					              <div class="">
					                <h2 class="breadcrumb_title">My Orders</h2>
					              </div>
					            </div> 

					            <div class="col-lg-3 col-12 mb10">
					              <div class="">
					                <input type="text" name="filter" id="history-filter" placeholder="Search by name...">
					              </div>
					            </div> 

									   	<div class="col-lg-12 px-0">
									   		<div class="my_dashboard_review mb80 px-0 bg-transparent border-none load_history" id="history_page">
									   	  </div>
									   	</div>

									   </div><!---./row--->	

							    </div>
							   
							</div>

              </div>	

               <!----./Tabs---->


               	</div>
               </div>

			</div>

		</div>


    <!-- Modal -->

  <div class="modal fade" id="confirm-deny">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Cancel Booking</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

                        
        <div class="modal-body">
            <p>Are you sure, you want to cancel this booking?</p>
            <!-- <p class="debug-url"></p> -->
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <a class="btn btn-success btn-ok">Ok</a>
        </div>
    </div>
</div>
</div>
<!-- Modal -->


		      

	</section>

	 <!--=======Copyright========-->
           <?php include(APPPATH.'views/include/copyright.php'); ?>
           <!--=======//Copyright========-->



 <!--=====Fotter-n-js======-->

 <?php include(APPPATH.'views/include/dashboard-footer.php'); ?>

   

<!--=====/Fotter-n-js=====-->
<script>

  $(document).ready(function(){

  load_data();

  function load_data(query)
  {

  $.ajax({
   url:"<?php echo base_url(); ?>user/list_booking",
   method:"POST",
   data:{query:query},
   success:function(data){
    $('.load_booking').html(data);
   }
  })

  }

  $('#filter').keyup(function(){
  var search = $(this).val();
  //alert(search);
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
 });

  

</script>




<!----Get Transaction---->

<script>

  $(document).ready(function(){

  load_data();

  function load_data(query)
  {

  $.ajax({
   url:"<?php echo base_url(); ?>user/list_history",
   method:"POST",
   data:{query:query},
   success:function(data){
    $('.load_history').html(data);
   }
  })

  }

  $('#history-filter').keyup(function(){
  var search = $(this).val();
  //alert(search);
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
 });

  

</script>



<script>
$('#confirm-deny').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

});
</script>




</body>

</html>