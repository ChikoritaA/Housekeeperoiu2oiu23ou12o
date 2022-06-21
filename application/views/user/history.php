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


<style>

.results {
  display: flex;
}

.results p {
  flex: 1;
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




            <div class="col-lg-9 col-12 mb10">
              <div class="">
                <h2 class="breadcrumb_title">My History</h2>
              </div>
            </div> 

            <div class="col-lg-3 col-12 mb10">
              <div class="">
                <input type="text" name="filter" id="filter" placeholder="Search by name...">
              </div>
            </div> 






<div class="col-lg-12 px-0">

<div class="my_dashboard_review mb80 px-0 bg-transparent border-none load_history" id="history_page">


</div>

</div>









</div>



</div>

</div>

</div>

           

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
   url:"<?php echo base_url(); ?>user/list_history",
   method:"POST",
   data:{query:query},
   success:function(data){
    $('.load_history').html(data);
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


</body>



</html>