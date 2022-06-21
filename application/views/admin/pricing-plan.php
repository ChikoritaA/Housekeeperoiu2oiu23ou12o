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

<h2 class="text-black font-w600 mb-0">Create Pricing Plan</h2>

</div>






<div class="row">

<div class="col-xl-12">

<div class="card">

<div class="card-body">

<!-- alert start -->

<?php if($this->session->flashdata('plan_err')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('plan_err'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('plan_err'); } ?>


<?php if($this->session->flashdata('plan_succ')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('plan_succ'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('plan_succ'); } ?>
<!-- alert end -->

<!----form--->
<form method="post" action="<?php echo base_url();?>admin/crate_pricing_plan" class="form">

<div class="row">

<div class="col-md-3 col-xl-3 col-xxl-3 mb-3">
<label>Plan</label>
<div class="form-group">
<select name="plan" class="form-control default-select form-control-lg">
<option value="">Select</option>
<option value="0" <?php echo (set_value('plan')=='0')?" selected=' selected'":""?>>At A Time</option>
<option value="1" <?php echo (set_value('plan')=='1')?" selected=' selected'":""?>>Once A Week</option>
<option value="2" <?php echo (set_value('plan')=='2')?" selected=' selected'":""?>>Twice A Week</option>
<option value="3" <?php echo (set_value('plan')=='3')?" selected=' selected'":""?>>Thrice A Week</option>
</select>
</div>
<small class="text-danger"><?php echo form_error('plan');?></small>


</div>

<div class="col-md-3 col-xl-3 col-xxl-3 mb-3">
<label>Shift</label>
<div class="form-group">
<select name="shift" class="form-control default-select form-control-lg">
<option value="">Select</option>

<?php 
foreach($shift as $shifts){ ?>
<option value="<?php echo $shifts->shift_id;?>" <?php echo (set_value('shift')== $shifts->shift_id)?" selected=' selected'":""?>><?php echo $shifts->from_time;?> to <?php echo $shifts->to_time;?> <?php echo $shifts->hours;?> hrs</option>
<?php } ?>
</select>
</div>
<small class="text-danger"><?php echo form_error('shift');?></small>

</div>

<div class="col-md-3 col-xl-3 col-xxl-3 mb-3">

<label>Price</label>

<div class="input-group">

<input type="text" name="price" value="<?php echo set_value('price');?>" class="form-control priceid" onkeypress="return onlyNumberKey(event)" maxlength="5">

</div>
<small class="text-danger"><?php echo form_error('price');?></small>


</div>

<div class="col-md-3 col-xl-3 col-xxl-3 mb-3 clearfix">

<label>&nbsp;</label>

<div class="input-group">

<button type="submit" class="custom-btn">Add  <i class="la la-arrow-right la-lg"></i></button>

</div>

</div>
</div>
</form>


</div><!----card-body--->

</div>

</div>

</div>


<div class="row">
    <div class="col-xl-12 mt-4">

<div class="form-head mb-2">

<h2 class="text-black font-w600 mb-0">List</h2>

</div>

</div><!---col-xl-12-->


<div class="col-xl-12 mt-4 mb-4">

<div class="card">

<div class="card-body">
<!-- alert -->
<?php if($this->session->flashdata('pricep_er')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('pricep_er'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('pricep_er'); } ?>


<?php if($this->session->flashdata('plnsuc')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('plnsuc'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('plnsuc'); } ?>
<!-- alert -->




<div class="table-responsive">

<table class="table table-responsive-md" id="pricingplan">

<thead>

<tr>

<th>#</th>

<th>Plan</th>

<th>Shift</th>

<th>Price</th>

<th>Action</th>

</tr>

</thead>

<tbody>
<?php if(is_array($plan_list)): ?>

<?php 
$i = 1;
foreach($plan_list as $plans ){ 

$shift_id  = $plans->shift;

$get_shift = $this->Model->getData('shift',array('shift_id' => $shift_id));



$shift_name = $get_shift->from_time . "&nbsp; To &nbsp;" . $get_shift->to_time .'&nbsp;'. $get_shift->hours ."&nbsp; Hrs";



?>
<tr>

<td><?php echo $i;?></td>
<td><?php if($plans->plan == '0'){ echo "At A Time"; }else if($plans->plan == '1'){ echo "Once A Week"; }else if($plans->plan == '2'){ echo "Twice A Week"; }else if($plans->plan == '3'){ echo "Thrice A Week"; }?></td>
<td><?php echo $shift_name;?></td>
<td><?php echo $plans->price;?> KD</td>

<td>

<button class="btn  btn-square btn-danger" data-href="<?php echo base_url();?>admin/del_price_plan/<?php echo $plans->plan_id;?>" data-toggle="modal" data-target="#confirm-delete"><i class="la la-trash"></i> Delete</button>

</td>

</tr>

<?php $i++; } ?>
<?php endif; ?>

</tbody>

</table>

</div>
</div>    
</div></div>
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
                    <p>Are you sure, you want to delete this pricing plan!</p>
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
    $('#pricingplan').DataTable();
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

$(".priceid").keyup(function(){
    var value = $(this).val();
    value = value.replace(/^(0*)/,"");
    $(this).val(value);
});


</script>

</body>
</html>