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
<h2 class="text-black font-w600 mb-0">Edit Employee</h2>
</div>
<!-- alert start -->
<?php if($this->session->flashdata('emp_err')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('emp_err'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('emp_err'); } ?>

<?php if($this->session->flashdata('emp_succ')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('emp_succ'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('emp_succ'); } ?>
<!-- alert end -->

<form method="post" action="<?php echo base_url();?>admin/upd_employee" class="form" enctype="multipart/form-data">
<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-md-6 col-xl-6 col-xxl-6 mb-3">
<label>Employee Name</label>
<div class="input-group">
<input type="text" name="fullname" value="<?php echo $emp_detail->fullname;?>" class="form-control" maxlength="15">

</div>
<small class="text-danger"><?php echo form_error('fullname');?></small>

</div>
<div class="col-md-6 col-xl-6 col-xxl-6 mb-3">
<label>Job Type</label>
<div class="form-group">
<select class="form-control job_type" name="job_type">
<option value="">Select</option>
<option value="cleaner" <?=$emp_detail->job_type == 'cleaner' ? ' selected="selected"' : '';?>>Cleaner</option>
<option value="driver" <?=$emp_detail->job_type == 'driver' ? ' selected="selected"' : '';?>>Driver</option>
</select>
<small class="text-danger"><?php echo form_error('job_type');?></small>

</div>

</div>
<div class="col-md-12 col-xl-12 col-xxl-12 mb-3 area">
<label>Select Area</label>
<select class="form-control default-select form-control-lg" name="area_code">
<option value="">Select</option>
<?php 
foreach($area as $area_code){ ?>
<option value="<?php echo $area_code['area_code'];?>" <?=$emp_detail->area_code == $area_code['area_code'] ? ' selected="selected"' : '';?>><?php echo $area_code['area_code'];?></option>
<?php }?>
</select>
<small class="text-danger"><?php echo form_error('area_code');?></small>

</div>
<div class="col-md-6 col-xl-6 col-xxl-6 mb-3">
<label>Email id</label>
<div class="input-group">
<input type="email" name="email" value="<?php echo $emp_detail->email;?>" class="form-control">

</div>
<small class="text-danger"><?php echo form_error('email');?></small>


</div>
<div class="col-md-6 col-xl-6 col-xxl-6 mb-3"> 
<label>Mobile Number</label>
<div class="input-group">
<input type="text" name="phone" value="<?php echo $emp_detail->phone;?>" class="form-control"  min="0" maxlength="11" size="50%"/>

</div>
<small class="text-danger"><?php echo form_error('phone');?></small>

</div>
<div class="col-md-6 col-xl-6 col-xxl-6 mb-3"> 
<label>Upload Your Id Card</label>
<div class="row">
<div class="col-md-6"> 
<div class="image-box">
<img class="image" src="<?php if(empty($emp_detail->identity_card)){ echo base_url('assets/images/upload-dami.png');}else{ echo base_url('uploads/idcard/'.$emp_detail->identity_card); } ?>">
</div>
</div>
<div class="col-md-6"> 
<button class="file-upload">            
<input type="file" name="identity_card" class="file-input" accept="image/png, image/gif, image/jpeg,image/jpg">Choose File
</button>
</div>	
<small class="text-danger"><?php echo form_error('identity_card');?></small>

</div>		

</div>

<div class="col-md-6 col-xl-6 col-xxl-6 mb-3"> 
<label>Upload Your passport size Photo</label>

<div class="row">
<div class="col-md-6"> 
<div class="image-box">
<img class="image2" src="<?php if(empty($emp_detail->profile)){ echo base_url('assets/images/upload-dami.png');}else{ echo base_url('uploads/idcard/'.$emp_detail->profile); } ?>">
</div>
</div>

<div class="col-md-6"> 
<button class="file-upload-2">            
<input type="file" name="profile" class="file-input-2" accept="image/png, image/gif, image/jpeg,image/jpg">Choose File
</button>
</div>
<small class="text-danger"><?php echo form_error('profile');?></small>

</div>	

</div>

<div class="col-md-12 col-xl-12 col-xxl-12 mb-12 mx-auto clearfix">


<div class="input-group">
<input type="hidden" name="emp_id" value="<?php echo $emp_detail->emp_id;?>">
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

</body>
</html>