<!DOCTYPE html>
<html lang="en">

<head>
    
     <!--*******************
        css meta titlal include
        ********************-->

    <?php include(APPPATH.'views/admin/include/css.php'); ?>

       <!--*******************
         css meta titlal include
          ********************-->


	
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

     

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include(APPPATH.'views/admin/include/sidebar.php'); ?>

        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="form-head mb-4">
					<h2 class="text-black font-w600 mb-0">Dashboard</h2>
				</div>
				<div class="row">
					
					
				</div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer and Js include
        ***********************************-->

               
        <?php include(APPPATH.'views/admin/include/footer.php'); ?>
      
        <!--**********************************
             Footer and Js include
        ***********************************-->

</body>

</html>