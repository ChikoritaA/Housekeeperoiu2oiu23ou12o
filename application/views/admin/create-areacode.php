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
<!-- <div class="form-head mb-4">
<h2 class="text-black font-w600 mb-0">Create Area code</h2>
</div> -->


<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">

<!-- alert start -->
<?php if($this->session->flashdata('area_err')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('area_err'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('area_err'); } ?>


<?php if($this->session->flashdata('area_succ')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('area_succ'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('area_succ'); } ?>
<!-- alert end -->


<form method="post" action="<?php echo base_url();?>admin/add_areacode" class="form">

<div class="row">
<div class="col-xl-12">
<h3>Create Area code</h3>
</div><!---col-xl-12-->
<div class="col-md-4 col-xl-4 col-xxl-4 mb-3">
<label>Area Name</label>
<div class="input-group">
<input type="text" name="area_name" value="<?php echo set_value('area_name');?>" class="form-control" maxlength="30">
</div>
<small class="text-danger"><?php echo form_error('area_name');?></small>

</div>
<div class="col-md-4 col-xl-4 col-xxl-4 mb-3">
<label>Area Code</label>
<div class="input-group">
<input type="text" name="area_code" value="<?php echo set_value('area_code');?>" class="form-control" onkeypress="return onlyNumberKey(event)" maxlength="5">
</div>
<small class="text-danger"><?php echo form_error('area_code');?></small>

</div>
<div class="col-md-3 col-xl-3 col-xxl-3 mb-3 clearfix">
<label>&nbsp;</label>
<div class="input-group">
<button type="submit" class="custom-btn">Add  <i class="la la-arrow-right la-lg"></i></button>
</div>
</div>

</div>
</form><!--/form-->
</div><!----card-body--->
</div>
</div>
</div>





<div class="card">
<div class="card-body">
<div class="row">
    <div class="col-xl-12">
    <h3>Shift List</h3>
</div>
<div class="col-xl-12">	

<!-- alert start -->
<?php if($this->session->flashdata('area_del')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('area_del'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('area_del'); } ?>

<?php if($this->session->flashdata('area_suc')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('area_suc'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('area_suc'); } ?>

<!-- end -->
       
       <div class="table-responsive">
	   <table id="example22" class="display table" >
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Area Name</th>
                <th>Area Code</th>
                <th>Action</th>
               
            </tr>
        </thead>
        <tbody>
            
            <?php if(is_array($areacode)): ?>

            <?php 
            $i = 1;
            foreach($areacode as $area_list ){ 
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $area_list['area_name'];?></td>
                <td><?php echo $area_list['area_code'];?></td>
             <td>
             	

                <button class="btn  btn-square btn-danger" data-href="<?php echo base_url();?>admin/del_areacode/<?php echo $area_list['area_uniqid'];?>" data-toggle="modal" data-target="#confirm-delete"><i class="la la-trash"></i> Delete</button>

            </td>
            </tr>
            <?php $i++; } ?>
            <?php endif; ?>
        </tbody>
      </table>


</div>
</div>
</div>
</div>
</div>	


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
                    <p>Are you sure, you want to delete this area!</p>
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
<script src=" https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#example22').DataTable();
} );

</script>
<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

//$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});
</script>
<script>

function onlyNumberKey(evt) {
var ASCIICode = (evt.which) ? evt.which : evt.keyCode

if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))

return false;

return true;

}

</script>

</body>
</html>