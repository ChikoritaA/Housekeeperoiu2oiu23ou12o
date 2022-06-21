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

<h2 class="text-black font-w600 mb-0">Transaction</h2>

</div>



<form method="" action="" class="form">

<div class="row">

<div class="col-xl-12">

<div class="card">

<div class="card-body">



<div class="row">



<div class="col-12">
<!-- alert start -->
<?php if($this->session->flashdata('plan_cansel')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('plan_cansel'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('plan_cansel'); } ?>
<!-- end -->


<div class="table-responsive">

<table id="trans" class="display">

		<thead>

		<tr>

		
    
		<th>Client Name</th>
		<th>Cleaner Name</th>
		<th>Order Date</th>
		<th>Order id</th>
		<th>Package</th>
		<th>Amount </th>
		<th>Expiry Date</th>
		<th>Client Profile</th>
		<th>Status</th>
		<th>Action</th>

		</tr>

		</thead>

      <tbody>

      	<?php if(is_array($get_trans)): ?>

						<?php 
						//$i = 1;
						date_default_timezone_set('Asia/Kolkata');
                        $curent_date = date('Y-m-d');
						foreach($get_trans as $transaction ){ 

							$job_id    = $transaction['job_id'];
							$user_id   = $transaction['user_id'];
							$package   = $transaction['package'];
							$is_done   = $transaction['is_done'];
              
                            //get schedul job data 
							$getjobdata = $this->Model->getData('job_scheduler',array('scheduler_id'=>$job_id));
							$emp_id = $getjobdata->emp_id;

							//get employee data 
							$getudata = $this->Model->getData('cleanner',array('emp_id'=>$emp_id));
							$fullname = $getudata->fullname;

							//user name
							$getuserdata = $this->Model->getData('users',array('user_id'=>$user_id));
							$uname = $getuserdata->fullname;
							
							//expiry date of plan
							
							$get_exp = "SELECT * FROM `job_avalability` WHERE job_id='$job_id' ORDER BY id DESC LIMIT 1";
							$expget  = $this->Model->getSqlData($get_exp);
							//print_r($expget);
                            foreach($expget as $vals){                 
							$book_date    = $vals['book_date'];
							

						?>


			<tr>

			
			<td><?php echo $uname;?></td>
			<td><?php echo $fullname;?></td>

			<td><?php echo $transaction['timestamp'];?></td>

			<td><?php echo $transaction['order_id'];?></td>
			<td><?php if($transaction['package'] =='0'){ echo "At A Time"; } else if($transaction['package'] =='1'){ echo "Once a week"; } else if($transaction['package'] =='2'){ echo "Twice A Week"; } else if($transaction['package'] =='3'){ echo "Thrice A Week"; }?></td>
			<td><?php echo $transaction['price'];?> KD</td>
			<td><?php echo $book_date; ?></td>
			<td><a href="<?php echo base_url();?>admin/user_details/<?php echo $user_id;?>" class=""><i class="fa fa-eye"></i></a></td>
			
			<td><?php if($is_done=='1'){ echo '<i class="badge badge-info">Active</i>';}else if($is_done=='2'){echo '<i class="badge badge-warning">Cancelled</i>';} ?></td>
			
			<?php if($package !='0' && $is_done =='1'){ 
			if($curent_date > $book_date){	
			?>
			<td><a data-href="<?php echo base_url();?>admin/cansel_subscription/<?php echo $job_id;?>" class="btn btn-danger" data-toggle="modal" data-target="#cansel_sub">Cansel</a>

			<a data-href="<?php echo base_url();?>admin/continue_subscription/<?php echo $job_id;?>" class="btn btn-success" data-toggle="modal" data-target="#cansel_sub">continue</a></td>

            <?php }else{ ?>

			<td><a href="javascript:(void);" class="btn btn-success">None</a></td>

			<?php } }else{ ?>
			<td><a href="javascript:(void);" class="btn btn-success">None</a></td>
            <?php } ?>
				</tr>
			
			<?php  }  } ?>
            <?php endif; ?>


		</tbody>

		</table>

		</div>

</div>


</div> <!----row--->

</div><!----card-body--->

</div>

</div>





</div>



</form>

<!--/form-->


<!-- Modal -->

<div class="modal fade" id="cansel_sub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                </div>
            
                <div class="modal-body">
                    <p>Are you sure!</p>
                    <!-- <p class="debug-url"></p> -->
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-success btn-ok">Ok</a>
                </div>
            </div>
        </div>
    </div>
<!---Modal ---> 


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

<!-- Datatable -->

<script src="<?php echo base_url();?>assets/admin_assets/vendor/datatables/js/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url();?>assets/admin_assets/js/plugins-init/datatables.init.js"></script>
<script>
	$(document).ready(function() {
    $('#trans').DataTable( {
        "order": [[ 5, "asc" ]]
    } );
} );
</script>

<script>
$('#cansel_sub').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>

</body>
</html>