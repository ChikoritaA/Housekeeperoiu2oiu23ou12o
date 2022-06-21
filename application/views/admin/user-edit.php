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

input[type="file"] {
display: block;
}
.imageThumb {
max-height: 75px;
border: 2px solid;
padding: 1px;
cursor: pointer;
}
.pip {
display: inline-block;
margin: 10px 10px 0 0;
}
.remove {
display: block;
background: #444;
border: 1px solid black;
color: white;
text-align: center;
cursor: pointer;
}
.remove:hover {
background: white;
color: black;
}
.image-box{
background: #ededed;
width: 220px;
height: 150px;
overflow:hidden;
}
.image-box img{
padding: 10px;
width: 220px;
height: 150px;
max-width: initial;
}
.file-upload {
position: relative;
overflow: hidden;
margin: 10px;
}
.file-upload {
position: relative;
overflow: hidden;
text-align:center;
color:#000;
font-size:1.2em;
background: transparent;
border: 2px solid #d7c9a3;
padding:6px;
-ms-transition: all 0.2s ease;
-webkit-transition: all 0.2s ease;
transition: all 0.2s ease;
margin-left: 45px;
border-radius: 4px;
}
.file-upload:hover{
background:#d7c9a3;
-webkit-box-shadow: 0px 0px 10px 0px rgba(255,255,255,0.75);
-moz-box-shadow: 0px 0px 10px 0px rgba(255,255,255,0.75);
box-shadow: 0px 0px 10px 0px rgba(255,255,255,0.75);
color:#fff;
}
.file-upload input.file-input {
position: absolute;
top: 0;
right: 0;
margin: 0;
padding: 0;
font-size: 20px;
cursor: pointer;
opacity: 0;
filter: alpha(opacity=0);
height:100%;
}


.file-upload-2 {
position: relative;
overflow: hidden;
text-align:center;
color:#000;
font-size:1.2em;
background: transparent;
border: 2px solid #d7c9a3;
padding:6px;
-ms-transition: all 0.2s ease;
-webkit-transition: all 0.2s ease;
transition: all 0.2s ease;
margin-left: 45px;
border-radius: 4px;
}
.file-upload-2:hover{
background:#d7c9a3;
-webkit-box-shadow: 0px 0px 10px 0px rgba(255,255,255,0.75);
-moz-box-shadow: 0px 0px 10px 0px rgba(255,255,255,0.75);
box-shadow: 0px 0px 10px 0px rgba(255,255,255,0.75);
color:#fff;
}
.file-upload-2 input.file-input-2 {
position: absolute;
top: 0;
right: 0;
margin: 0;
padding: 0;
font-size: 20px;
cursor: pointer;
opacity: 0;
filter: alpha(opacity=0);
height:100%;
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
<h2 class="text-black font-w600 mb-0">Edit User</h2>
</div>
<!-- alert start -->
<?php if($this->session->flashdata('u_err')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('u_err'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('u_err'); } ?>

<?php if($this->session->flashdata('u_succ')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('u_succ'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('u_succ'); } ?>
<!-- alert end -->

<form method="post" action="<?php echo base_url();?>admin/upd_user" class="form" enctype="multipart/form-data">
<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-md-6 col-xl-6 col-xxl-6 mb-3">
<label>Full Name</label>
<div class="input-group">
<input type="text" name="fullname" value="<?php echo $user_list->fullname;?>" class="form-control" onKeyPress="return ValidateAlpha(event);" maxlength="25">

</div>
<small class="text-danger"><?php echo form_error('fullname');?></small>

</div>


<div class="col-md-6 col-xl-6 col-xxl-6 mb-3">
<label>Email id</label>
<div class="input-group">
<input type="email" name="email" value="<?php echo $user_list->email;?>" class="form-control" maxlength="35">

</div>
<small class="text-danger"><?php echo form_error('email');?></small>


</div>
<div class="col-md-6 col-xl-6 col-xxl-6 mb-3"> 
<label>Mobile Number</label>
<div class="input-group">
<input type="text" name="phone" value="<?php echo $user_list->phone;?>" class="form-control"  onkeypress="return onlyNumberKey(event)" maxlength="15" size="50%"/>

</div>
<small class="text-danger"><?php echo form_error('phone');?></small>

</div>

<!-- <div class="col-md-6 col-xl-6 col-xxl-6 mb-3"> 
<label>Select Area</label>
<select class="form-control default-select form-control-lg" name="address">
<option value="">Select</option> -->
<?php 
// $areaname = $this->Model->getAlData('area_code_list');

// foreach($areaname as $area_code){ ?>
    

<!-- <option value="<?php //echo $area_code->area_uniqid;?>,<?php //echo $area_code->area_name;?>" <?php// if ($user_list->addrs_id == $area_code->area_uniqid) echo ' selected="selected"'; ?>><?php //echo $area_code->area_name;?></option> -->

<?php // } ?>

<!-- </select>
<small class="text-danger"><?php //echo form_error('address');?></small>

</div> -->


<!-- <div class="col-md-12 col-xl-12 col-xxl-12 mb-3"> 
<label>Full Address</label>
<div class="input-group">
<input type="text" name="fulladdress" value="<?php //echo $user_list->fulladdress;?>" class="form-control"  maxlength="50" size="50%"/>

</div>
<small class="text-danger"><?php //echo form_error('fulladdress');?></small>

</div> -->

<!--edit data-->
<?php 

  $user_id   = $user_list->user_id;
  $chkextra  = $this->Model->CountWhereRecord('user_addrs',array('uid'=>$user_id));

  $extra_add = "SELECT * FROM `user_addrs` WHERE uid='$user_id'";

  $extra_add = $this->Model->getSqlData($extra_add);

if($chkextra > 0){ 

foreach ($extra_add as  $getaex) {
    
?>
<div class="col-lg-12 col-xl-12">

<a class='' data-href="<?php echo base_url();?>admin/remove_address/<?php echo $getaex['id'];?>/<?php echo $user_list->user_id;?>" data-toggle="modal" data-target="#confirm-delete" style="cursor: pointer">- Remove</a>
   
<div class="row">

<!-- ad typ -->
<div class="col-lg-4 col-xl-4">
<div class="my_profile_setting_input form-group my_dashboard_review">

<label for="formGroupExampleInput11">Nick Name</label>
<input type="text" name="ad_type[]" class="form-control newaddrs" value="<?php echo $getaex['chk_type'];?>" placeholder="Home,Office,Other" maxlength="35">

<!-- <label for="formGroupExampleInput11">For</label>
<select name="ad_type[]" class="form-control default-select form-control-lg">
<option value=""> Select </option>
<option value="Home" <?php //echo ($getaex['chk_type'] == 'Home')?" selected=' selected'":""?>> Home </option>
<option value="Office" <?php //echo ($getaex['chk_type'] == 'Office')?" selected=' selected'":""?>> Office </option>
</select> -->

<small class="text-danger"><?php echo form_error('ad_type');?></small>
</div>
</div>
<!-- ad typ -->



<!-- area -->
<div class="col-lg-4 col-xl-4">
 <div class="form-group my_profile_setting_input my_dashboard_review"> 
<label for="formGroupExampleInput11">Area</label>
<select name="area_arr[]" class="form-control default-select form-control-lg">
<option value="">Select </option>
<?php 

$areaname = $this->Model->getAlData('area_code_list');

foreach($areaname as $area_code){ ?>

<option value="<?php echo $area_code->area_uniqid;?>,<?php echo $area_code->area_name;?>" <?php echo ($getaex['chk_uniqid_fromarea'] == $area_code->area_uniqid)?" selected=' selected'":""?>><?php echo $area_code->area_name;?></option>

<?php } ?>

</select>
<small class="text-danger"><?php echo form_error('area_arr');?></small>
</div>
</div>

<!-- end area -->

<!-- adds -->
<div class="col-lg-4 col-xl-4">
<div class="my_profile_setting_input form-group my_dashboard_review">

<label for="formGroupExampleInput11">Address</label>
<input type="text" name="newaddrs[]" class="form-control newaddrs" value="<?php echo $getaex['address'];?>" placeholder="Address" maxlength="50">
</div>
</div>
<!-- adds -->


</div>

</div>





<?php }} ?>
<!--edit arra data -->


<!--add more button  -->
<div class="col-lg-12 col-xl-12">
<div class="input-group">
    <label for="">&nbsp;</label><br/>
    <a class="adds" style="cursor: pointer">+ Add More Address</a>
</div>
</div>
<!--hidden fileds onclick show
-->
<div class="col-lg-12 col-xl-12 after-add-more" style="display: none;">
<div class="row">


<!-- ad typ -->
<div class="col-lg-4 col-xl-4">
<div class="my_profile_setting_input form-group my_dashboard_review">

<label for="formGroupExampleInput11">Nick Name</label>
<input type="text" name="ad_type[]" class="form-control newaddrs" value="" placeholder="Home,Office,Other" maxlength="35">


<!-- <label for="formGroupExampleInput11">For</label>
<select name="ad_type[]" class="form-control default-select form-control-lg">

<option value=""> Select </option>
<option value="Home"> Home </option>
<option value="Office"> Office </option>
</select> -->
<small class="text-danger"><?php echo form_error('ad_type');?></small>
</div>
</div>
<!-- ad typ -->



<!-- area -->
<div class="col-lg-4 col-xl-4">
 <div class="form-group my_profile_setting_input my_dashboard_review"> 
<label for="formGroupExampleInput11">Area</label>
<select name="area_arr[]" class="form-control default-select form-control-lg" >
<!-- <option value="">Select </option> -->
<?php 

$areaname = $this->Model->getAlData('area_code_list');

foreach($areaname as $area_code){ ?>

<option value="<?php echo $area_code->area_uniqid;?>,<?php echo $area_code->area_name;?>"><?php echo $area_code->area_name;?></option>

<?php } ?>

</select>
<small class="text-danger"><?php echo form_error('area_arr');?></small>
</div>
</div>

<!-- end area -->
<!-- adds -->
<div class="col-lg-4 col-xl-4">
<div class="my_profile_setting_input form-group my_dashboard_review">

<label for="formGroupExampleInput11">Address</label>
<input type="text" name="newaddrs[]" class="form-control newaddrs" value="" placeholder="Address" maxlength="50">
</div>
</div>
<!-- adds -->


</div> 
</div>




<div class="col-md-12 col-xl-12 col-xxl-12 mb-12 mx-auto clearfix">


<div class="input-group">
<input type="hidden" name="user_id" value="<?php echo $user_list->user_id;?>">
<button type="submit" class="custom-btn">Submit</button>
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
                    <p>Are you sure, you want to delete this address!</p>
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

<script>

	$(document).ready(function() {

    $("body").on("click",".adds",function(){ 
    

     if($('.after-add-more').is(':visible')) {
       $('.after-add-more').hide()
       }
      else {
           $('.after-add-more').show()
      }


    });
    });
</script>



<script>

function detailssubmit() {

alert("Your details were Submitted");

}
</script>


<script>

$(function() {
	if($('.job_type').val() == 'driver'){

    $('.area').show(); 

    }else{
    $('.area').hide(); 

    }
    $('.job_type').change(function(){
        if($('.job_type').val() == 'driver') {
            $('.area').show(); 
        } else {
            $('.area').hide(); 
        } 
    });
});

</script>

<script type="text/javascript">
$('.file-input').change(function(){
var curElement = $('.image');
console.log(curElement);
var reader = new FileReader();
reader.onload = function (e) {
// get loaded data and render thumbnail.
curElement.attr('src', e.target.result);
};
// read the image file as a data URL.
reader.readAsDataURL(this.files[0]);
});
</script>

<script type="text/javascript">
$('.file-input-2').change(function(){
var curElement = $('.image2');
console.log(curElement);
var reader = new FileReader();
reader.onload = function (e) {
// get loaded data and render thumbnail.
curElement.attr('src', e.target.result);
};
// read the image file as a data URL.
reader.readAsDataURL(this.files[0]);
});
</script>
<script>



function onlyNumberKey(evt){
// Only ASCII character in that range allowed
var ASCIICode = (evt.which) ? evt.which : evt.keyCode
if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
return false;
return true;
}

function ValidateAlpha(evt){
var keyCode = (evt.which) ? evt.which : evt.keyCode
if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
return false;
return true;
}

</script>

<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

//$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});
</script>

</body>
</html>