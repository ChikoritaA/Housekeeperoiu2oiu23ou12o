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


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">



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
<h2 class="text-black font-w600 mb-0">Book A Job</h2>
</div>

<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-xl-12">
<h3></h3>
</div><!---col-xl-12-->
<div class="col-xl-12">

<!-- alert start -->
<?php if($this->session->flashdata('newer')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('newer'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('newer'); } ?>
<!-- alert end -->


<div class="custom-tab-1">
<ul class="nav nav-tabs">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#one"><i class="la la-user mr-2"></i> For New User</a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#twice"><i class="la la-users mr-2"></i> Already Have A User</a>
</li>

</ul>
<div class="tab-content">
<div class="tab-pane fade active show" id="one" role="tabpanel">

<form method="post" action="<?php echo base_url();?>admin/new_userbooking">	
<div class="pt-4">
<h4></h4>

<div class="control-group">  
<div class="controls">  
<div class="entry mb-2"> 
<div class="row">

    <div class="col-md-6 col-xl-6 col-xxl-6 mb-3">
    <label>Full Name</label>
    <div class="input-group">
    <input type="text" name="fullname" value="<?php echo set_value('fullname');?>" class="form-control" onkeypress="return ValidateAlpha(event);" maxlength="25">
    </div>
    <small class="text-danger"><?php echo form_error('fullname');?></small>
    </div>

    <div class="col-md-6 col-xl-6 col-xxl-6 mb-3">
    <label>Email</label>
    <div class="input-group">
    <input type="email" name="email" value="<?php echo set_value('email');?>" class="form-control" maxlength="35">
    </div>
    <small class="text-danger"><?php echo form_error('email');?></small>
    </div>

     <div class="col-md-6 col-xl-6 col-xxl-6 mb-3">
    <label>Password</label>
    <div class="input-group">
    <input type="password" name="password" value="<?php echo set_value('password');?>" class="form-control" maxlength="15">
    </div>
    <small class="text-danger"><?php echo form_error('password');?></small>
    </div>

    <div class="col-md-6 col-xl-6 col-xxl-6 mb-3">
    <label>Mobile Number</label>
    <div class="input-group">
    <input type="text" name="phone" value="<?php echo set_value('phone');?>" class="form-control" onkeypress="return onlyNumberKey(event)" maxlength="15" size="50%" placeholder="Mobile Number">
    </div>
    <small class="text-danger"><?php echo form_error('phone');?></small>

    </div>

    <div class="col-md-6 col-xl-6 col-xxl-6 mb-3">
    <label>Area</label>
    <div class="input-group">
     <select class="form-control selectpicker" data-show-subtext="false" data-live-search="true" name="address">
    <option value="">Select Area</option>
    <?php 
        $areaname = $this->Model->getAlData('area_code_list');
        foreach($areaname as $area_code){ ?>
        <option value="<?php echo $area_code->area_uniqid;?>,<?php echo $area_code->area_name;?>" <?php echo (set_value('address')== $area_code->area_uniqid.",".$area_code->area_name)?" selected=' selected'":""?>><?php echo $area_code->area_name;?></option>
        <?php } ?>
    </select>
    </div>
    <small class="text-danger"><?php echo form_error('address');?></small>
    </div>

     <div class="col-md-6 col-xl-6 col-xxl-6 mb-3">
        <label>&nbsp;</label>
    <input type="hidden" name="sch_id" value="<?php echo $mykeys['sch_id'];?>">
    <input type="hidden" name="search_id" value="<?php echo $mykeys['serach_id'];?>">
    <button type="submit" class="custom-btn mt-3">Book Now</button>
</div>
    


</div><!---row---->

</div>
</div>
</div>


</div>
</form>
</div>
<div class="tab-pane fade" id="twice">
<form method="post" action="<?php echo base_url();?>admin/bookfor">
<div class="pt-4">
<h4></h4>

<div class="control-group">  
<div class="controls-2">  
<div class="entry mb-2"> 
<div class="row">

<div class="col-md-6 col-xl-6 col-xxl-6 mb-3">
    <label>Select User</label>
    <div class="input-group">
     <select class="form-control selectpicker" data-show-subtext="false" data-live-search="true" name="user">
       <?php 
        foreach($u_list as $user){ ?>
        <option value="<?php echo $user['user_id'];?>" <?php echo (set_value('name')== $user['fullname'])?" selected=' selected'":""?>><?php echo $user['fullname'];?></option>
        <?php } ?>
    </select>
    </div>
    <small class="text-danger"></small>
    </div>

    <div class="col-md-6 col-xl-6 col-xxl-6 mb-3">
    <label>&nbsp;</label>
    <input type="hidden" name="sch_id" value="<?php echo $mykeys['sch_id'];?>">
    <input type="hidden" name="search_id" value="<?php echo $mykeys['serach_id'];?>">
    <button type="submit" class="custom-btn mt-3">Book Now</button>
</div>
    


</div><!---row---->
</div>
</div>


</div>
</form>
</div>

</div>
</div>
</div>
</div> <!----row--->
</div><!----card-body--->
</div>
</div>
</div>
</div>
</div>
</div>
</div><!---row--->





<!-- Modal -->

 <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
            
                <div class="modal-body">
                    <p>Are you sure delete this shift !</p>
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
    $('#subscriptionlist').DataTable();
} );

</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#subscriptionlist_twice_a_Week').DataTable();
} );

</script> 

<script type="text/javascript">
$(document).ready(function() {
    $('#thrice_a_week').DataTable();
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
// Only ASCII character in that range allowed

var ASCIICode = (evt.which) ? evt.which : evt.keyCode

if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))

return false;

return true;

}

function ValidateAlpha(evt)
    {
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
         
        return false;
            return true;
    }


</script>
</body>
</html>