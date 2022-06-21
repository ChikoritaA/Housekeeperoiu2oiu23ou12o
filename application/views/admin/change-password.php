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
i{
  cursor:pointer;
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
<h2 class="text-black font-w600 mb-0">Change Password</h2>
</div>

<!-- alert start -->
<?php if($this->session->flashdata('pass_err')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('pass_err'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('pass_err'); } ?>

<?php if($this->session->flashdata('pass_succ')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('pass_succ'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('pass_succ'); } ?>
<!-- alert end -->


<form method="post" action="<?php echo base_url();?>admin/upd_password" class="form">
<div class="row">
<div class="col-xl-8 mx-auto">
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-md-12 col-xl-12 col-xxl-12 mb-3">
<label>New Password</label>

 <div class="input-group mb-2 mr-sm-2">
    
    <input type="password" name="password" class="form-control" id="password" placeholder="Enter Your New Password" value="<?php echo set_value('password');?>">

    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fa fa-eye-slash" id="pass1"></i></div>
    </div>

  </div>
    <small class="text-danger"><?php echo form_error('password');?></small>

</div>

<div class="col-md-12 col-xl-12 col-xxl-12 mb-3">
<label>Confirm password</label>
 <div class="input-group mb-2 mr-sm-2">
   <input type="password" name="cpassword" class="form-control" value="<?php echo set_value('cpassword');?>" id="password2" placeholder="Enter Your Confirm Password">

   <div class="input-group-prepend">
      <div class="input-group-text"><i class="fa fa-eye-slash" id="pass2"></i></div>
    </div>

  </div>
    <small class="text-danger"><?php echo form_error('cpassword');?></small>

</div>



<div class="col-md-12 col-xl-12 col-xxl-12 mb-12 mx-auto clearfix">


<div class="input-group">
<button type="submit" class="custom-btn">Change</button>
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

<script type="text/javascript">
$(function(){
  
  $('#pass1').click(function(){
       
        if($(this).hasClass('fa-eye-slash')){
           
          $(this).removeClass('fa-eye-slash');
          
          $(this).addClass('fa-eye');
          
          $('#password').attr('type','text');
            
        }else{
         
          $(this).removeClass('fa-eye');
          
          $(this).addClass('fa-eye-slash');  
          
          $('#password').attr('type','password');
        }
    });
});
</script>

<script type="text/javascript">
$(function(){
  
  $('#pass2').click(function(){
       
        if($(this).hasClass('fa-eye-slash')){
           
          $(this).removeClass('fa-eye-slash');
          
          $(this).addClass('fa-eye');
          
          $('#password2').attr('type','text');
            
        }else{
         
          $(this).removeClass('fa-eye');
          
          $(this).addClass('fa-eye-slash');  
          
          $('#password2').attr('type','password');
        }
    });
});
</script>



</body>
</html>