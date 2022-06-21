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
<style type="text/css">
.dataTables_wrapper .dataTables_paginate{
background:transparent;}

.form-control:focus{
box-shadow:none;}

a{color:#fff;}
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
<?php include(APPPATH.'views/admin/include/cleaner-sidebar.php'); ?>

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
<h5 class="text-black font-w600 mb-0">Client Profile </h5>
</div>


<div class="row">

<div class="col-xl-3">
<div class="card">
<div class="card-body ">  
<h5 class="mt-2">Name</h5>
<p><?php echo $udetails->fullname;?></p>
</div>
</div>
</div>  <!---card--->




<div class="col-xl-3">
<div class="card">
<div class="card-body ">  
<h5 class="mt-2">Email</h5>
<p><?php echo $udetails->email;?></p>
</div>
</div>
</div>  <!---card--->


<div class="col-xl-3">
<div class="card">
<div class="card-body ">  
<h5 class="mt-2">Phone</h5>
<p><?php echo $udetails->phone;?> </p>
</div>
</div>
</div>  <!---card--->





<?php

 $availability_id    = $this->uri->segment(4);
 $chkadata11         = $this->Model->getData('job_avalability',array('uniqid'=> $availability_id));
 $oid = $chkadata11->order_id;

 //get main addresss
$chkadata23        = $this->Model->getData('transaction',array('order_id'=> $oid));
$main_address      = $chkadata23->main_address;

?>
<div class="col-xl-3">
<div class="card">
<div class="card-body ">  
<h5 class="mt-2">Address</h5>
<p><?php echo $main_address;?></p>
</div>
</div>
</div>  <!---card--->







</div>


<div class="row">
<div class="col-xl-12">
<div class="form-head mb-4">
<h5 class="text-black font-w600 mb-0">Add your Note </h5>
</div>



<div class="row">
<div class="col-12">
<!-- alert start -->
<?php if($this->session->flashdata('note')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('note'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('note'); } ?>
<!-- alert end -->

<form method="post" action="<?php echo base_url();?>employee/add_note">
<div class="form-group">
<textarea name="note" class="form-control" rows="4" id="comment" required=""></textarea>

</div>

<div class="form-group text-left float-left">
<input type="hidden" name="user_id" value="<?php echo $this->uri->segment(3);?>">
<input type="hidden" name="availability_id" value="<?php echo $this->uri->segment(4);?>">
<button type="submit" class="custom-btn">Submit</button>
</div>

</form>


</div>





</div>
</div>


</div>

<?php foreach($notes as $noted_data) { ?>

<div class="card">
<div class="card-body ">  
<div class="row">

<div class="col-xl-10 border-right">

<p><?php  echo $noted_data['note']; ?></p>

</div> 

<div class="col-xl-2 text-center">
<h4>Note by</h4>  
<strong><?php  echo $noted_data['note_by']; ?></strong>

</div> 

</div>



</div>  
</div>

<?php } ?>


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