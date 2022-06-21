<!DOCTYPE html>

<html lang="en">

	<head>

		<!--*******************

		css meta titlal include

		********************-->

       <?php include(APPPATH.'views/admin/include/css.php'); ?>

		 <link href="<?php echo base_url();?>assets/admin_assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

		<!--*******************

		css meta titlal include

		********************-->

		<style type="text/css">
			.card-body {
    padding: 10px 20px;
}
		</style>

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

						<h2 class="text-black font-w600 mb-0">User Details</h2>

					</div>


	<div class="row">

		<div class="col-xl-4">
			<div class="card">
			 <div class="card-body ">  
				<h2 class="mt-2">Name</h2>
				 <h5><?php echo $user_list->fullname;?></h5>
				</div>
			</div>
		</div>  <!---card--->

       <div class="col-xl-4">
			<div class="card">
			 <div class="card-body ">  
				<h2 class="mt-2">Email</h2>
				 <h5><?php echo $user_list->email;?></h5>
				</div>
			</div>
		</div>  <!---card--->
 

      <div class="col-xl-4">
			<div class="card">
			 <div class="card-body ">  
				<h2 class="mt-2">Mobile Number</h2>
				 <h5><?php echo $user_list->phone;?></h5>
				</div>
			</div>
		</div>  <!---card--->


		<div class="col-xl-4">
			<div class="card">
			 <div class="card-body ">  
				<h2 class="mt-2">Full Address</h2>
				 <h5><?php echo $user_list->fulladdress;?> </h5>
				</div>
			</div>
		</div>  <!---card--->


      <div class="col-xl-4">
			<div class="card">
			 <div class="card-body ">  
				<h2 class="mt-2">Address</h2>
				 <h5><?php echo $user_list->address;?></h5>
				</div>
			</div>
		</div>  

		<?php
		//$acode = $user_list->addrs_id;
		//$aname = $this->Model->getData('area_code_list',array('area_uniqid'=>$acode));

		?>
		<!-- <div class="col-xl-4">
			<div class="card">
			 <div class="card-body ">  
				<h2 class="mt-2">Area Code</h2>
				 <h5><?php //echo $aname->area_code;?></h5>
				</div>
			</div>
		</div>    -->


   </div> <!----row---->
         <div class="row mt-3">

         	<div class="col-lg-8 mx-auto">
              <div class="row">
                <div class="col-xl-4 text-center mb-2">
          <a class="btn  btn-square btn-success text-white btn-block" href="<?php echo base_url();?>admin/manage_job/<?php echo $user_list->user_id;?>"><i class="la la-eye"></i> View Jobs</a>
         </div>	

         <div class="col-xl-4 text-center mb-2">
          <a class="btn  btn-square btn-dark text-white btn-block" href="<?php echo base_url();?>admin/transaction/<?php echo $user_list->user_id;?>"><i class="la la-eye"></i> View Transaction</a>
         </div>	
          
		 <!-- for admin hide block btn -->
         
          
         <?php if($user_list->status =='1' || $user_list->status =='0'){ ?>
		<div class="col-xl-4 text-center mb-2">
          <a class="btn  btn-square btn-danger text-white btn-block" data-href="<?php echo base_url();?>admin/block_user/<?php echo $user_list->user_id;?>" data-toggle="modal" data-target="#confirm-delete"><i class="la la-trash"></i> Block this user</a>
         </div>	
         <?php }else { ?>

         <div class="col-xl-4 text-center mb-2">
          <a class="btn  btn-square btn-danger text-white btn-block" data-href="<?php echo base_url();?>admin/unblock_user/<?php echo $user_list->user_id;?>" data-toggle="modal" data-target="#confirm-delete"><i class="la la-trash"></i> Unblock this user</a>
         </div>	

         <?php }  ?>

         

                </div><!--inner row-->          
            </div><!--Col Center-->		


           </div> <!--/row-->

               </div> 
		</div>

</div>

							<!--**********************************

							Content body end

							***********************************-->

							<!--**********************************

							Footer and Js include

							***********************************-->

	
<!-- Modal -->

 <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Block</h4>
                </div>
            
                <div class="modal-body">
                    <p>Are you sure!</p>
                    <!-- <p class="debug-url"></p> -->
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-success btn-ok">Submit</a>
                </div>
            </div>
        </div>
    </div>
<!---Modal --->     
						

 <?php include(APPPATH.'views/admin/include/footer.php'); ?>

<!--**********************************

Footer and Js include

***********************************-->

							<!-- Datatable -->

<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="js/plugins-init/datatables.init.js"></script>
<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

//$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});
</script>
</body>
</html>