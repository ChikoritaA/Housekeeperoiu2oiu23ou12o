<!DOCTYPE html>
<html lang="en">
<head>
<!--*******************
css meta titlal include
********************-->
<?php include(APPPATH.'views/admin/include/css.php'); ?>
<!-- 
<link href="<?php echo base_url();?>assets/admin_assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
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
<h2 class="text-black font-w600 mb-0">Manage Employee</h2>
</div>
<form method="" action="" class="form">
<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">
<!-- alert start -->
<?php if($this->session->flashdata('emp_errr')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('emp_errr'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('emp_errr'); } ?>

<?php if($this->session->flashdata('emp_succ')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('emp_succ'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('emp_succ'); } ?>

<!-- end -->
<div class="row">
<div class="col-12">
<div class="table-responsive">

<table id="example33" class="">
<thead>
<tr>
<th>#</th>
<th>Emplopee Name</th>
<th>Emplopee Type</th>
<th>Area</th>
<th>View Details</th>
</tr>
</thead>
<tbody>
<tr>

<?php if(is_array($emp_list)): ?>
<?php 
$i = 1;
foreach($emp_list as $employee ){ 
?>

<td><?php echo $i;?></td>
<td><?php echo $employee['fullname'];?></td>
<td><?php echo $employee['job_type'];?></td>
<td><?php if($employee['area_code'] == ''){ echo "Null"; }else{ echo $employee['area_code'] ;} ?></td>
<td>
<div class="d-flex">
<a href="<?php echo base_url();?>admin/employee_details/<?php echo $employee['emp_id'];?>" class="btn btn-square btn-dark text-white"><i class="fa fa-eye"></i>&nbsp;View</a>
&nbsp;
<a data-href="<?php echo base_url();?>admin/employee_delete/<?php echo $employee['emp_id'];?>" data-toggle="modal" data-target="#confirm-delete" class="btn  btn-square btn-danger text-white"><i class="fa fa-trash"></i>&nbsp;Delete</a>


       


</div>												
</td>												
</tr>

<?php $i++; } ?>
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
</div>
</div>

<!-- Modal -->

 <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
            
                <div class="modal-body">
                    <p>Are you sure, you want to delete this employee!</p>
                    <!-- <p class="debug-url"></p> -->
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-success btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>
<!---Modal --->     

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
$('#confirm-delete').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

//$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});




</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#example33').DataTable();
} );

</script>

</body>
</html>