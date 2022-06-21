<!DOCTYPE html>

<html lang="en">

<head>



<!--*******************

css meta titlal include

********************-->

<?php include(APPPATH.'views/admin/include/css.php'); ?>


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

<h2 class="text-black font-w600 mb-0">All Users</h2>

</div>

<!-- alert start -->
<?php if($this->session->flashdata('del_u')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('del_u'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('del_u'); } ?>

<?php if($this->session->flashdata('del_usucc')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('del_usucc'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('del_usucc'); } ?>
<!-- end -->
  
  

<div class="card">

<div class="card-body">
<div class="row">

<div class="col-xl-12">


<div class="table-responsive">

<table id="usserlist" class="display">

<thead>

<tr>

<th>#</th>
<th>Fullname</th>
<th>Email</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php if(is_array($user_list)): ?>

<?php 
$i = 1;
foreach($user_list as $users ){ 
?>
<tr>

<td><?php echo $i;?></td>
<td><?php echo $users->fullname;?></td>
<td><?php echo $users->email;?></td>
<td><?php if($users->status == '1'){ echo "<span class='badge badge-success'>Active</span>";}else if($users->status == '0'){ echo "<span class='badge badge-info'>Inactive</span>"; }else{ echo "<span class='badge badge-danger'>Block</span>"; }?>
</td>
<td>

<a href="<?php echo base_url();?>admin/user_edit/<?php echo $users->user_id;?>" class="btn btn-square btn-info text-white"><i class="fa fa-edit"></i>&nbsp;</a>
<a href="<?php echo base_url();?>admin/user_details/<?php echo $users->user_id;?>" class="btn btn-square btn-dark text-white"><i class="fa fa-eye"></i>&nbsp;</a>
<a class="btn  btn-square btn-danger text-white" data-href="<?php echo base_url();?>admin/del_user/<?php echo $users->user_id;?>" data-toggle="modal" data-target="#confirm-delete"><i class="la la-trash"></i>&nbsp;</a>
 

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
                    <p>Are you sure, you want to delete this user!</p>
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

<script src=" https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
$('#usserlist').DataTable();
} );

</script>
<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

//$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});
</script>
</body>
</html>