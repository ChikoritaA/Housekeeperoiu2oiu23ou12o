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
<?php if($this->session->flashdata('psucc')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('psucc'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('psucc'); } ?>
<!-- alert end -->

<?php
  $get_reward_price = $this->Model->getData('reward_price',array('id'=>1));
  $discount         = $get_reward_price->discount;
?>

<form method="post" action="<?php echo base_url();?>admin/update_reward_price" class="form">

<div class="row">
<div class="col-xl-12">
<h3>Set Reward Price</h3>
</div><!---col-xl-12-->
<div class="col-md-4 col-xl-4 col-xxl-4 mb-3">
<label>Price</label>
<div class="input-group align-items-center">
<input type="text" name="discount" class="form-control" value="<?php echo $discount;?>" onkeypress="return onlyNumberKey(event)" maxlength="11" size="50%" placeholder="Price">&nbsp;&nbsp; KD
</div>
<small class="text-danger"><?php echo form_error('discount');?></small>

</div>

<div class="col-md-3 col-xl-3 col-xxl-3 mb-3 clearfix">
<label>&nbsp;</label>
<div class="input-group">
<button type="submit" class="custom-btn">Update <i class="la la-arrow-right la-lg"></i></button>
</div>
</div>

</div>
</form><!--/form-->
</div><!----card-body--->
</div>
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

<script>

function onlyNumberKey(evt) {
// Only ASCII character in that range allowed

var ASCIICode = (evt.which) ? evt.which : evt.keyCode

if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))

return false;

return true;

}

</script>

</body>
</html>