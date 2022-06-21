<!DOCTYPE html>







<html dir="ltr" lang="en">







<head>







<meta charset="utf-8">







<meta http-equiv="X-UA-Compatible" content="IE=edge">







<meta name="viewport" content="width=device-width, initial-scale=1">







<meta name="keywords" content="">







<meta name="description" content="">







<meta name="" content="">







<!-- css file -->







<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">







<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">







<link rel="stylesheet" href="<?php echo base_url();?>assets/css/dashbord_navitaion.css">







<!-- Responsive stylesheet -->







<link rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.css">







<!-- Title -->







<title>House Keepers</title>







<!-- Favicon -->







<link href="<?php echo base_url();?>assets/images/logo.ico" sizes="128x128" rel="shortcut icon" type="image/x-icon" />







<link href="<?php echo base_url();?>assets/images/logo.ico" sizes="128x128" rel="shortcut icon" />







<style type="text/css">







.input-group-text{







background-color: #f7f7f7;







border: 1px solid #f7f7f7;







}







</style>







</head>







<body>







<div class="wrapper">







<div class="preloader"></div>















<!--=====header-n-js======-->







<?php include(APPPATH.'views/include/dashboard-header.php'); ?>















<!--=====/Fotter-n-js=====-->















<!-- Our Dashbord -->







<section class="our-dashbord dashbord bgc-f7 pb100">







<div class="container-fluid">







<div class="row">







<div class="col-lg-3 col-xl-2 dn-992 pl0"></div>







<div class="col-lg-9 col-xl-10 mx-auto maxw100flex-992">







<div class="row mx-0">







<div class="col-lg-12">















<!--=====header-n-js======-->







<?php include(APPPATH.'views/include/mobile-dashboard-sidebar.php'); ?>















<!--=====/Fotter-n-js=====-->























</div>







<div class="col-lg-12 mb10">







<div class="">







<h2 class="breadcrumb_title">My Profile</h2>







</div>







</div> 















<div class="col-lg-12">







<!--succ alert -->



<?php if($this->session->flashdata('profile_succ')){ ?>



<div class="alert alert-success alert-dismissible fade show" role="alert">



<?php echo $this->session->flashdata('profile_succ'); ?>



<button type="button" class="close" data-dismiss="alert" aria-label="Close">



<span aria-hidden="true">&times;</span>



</button>



</div>



<?php $this->session->unset_userdata('profile_succ'); } ?>



<!--succ alert -->







<?php
$user_id   = $this->session->userdata('user_id');
$udata     = $this->Model->getData('users',array('user_id' => $user_id));
?>



<form method="post" action="<?php echo base_url();?>user/upd_profile">


<div class="row">

<div class="col-lg-6 col-xl-6">
<div class="my_profile_setting_input form-group my_dashboard_review">
<label for="">Fullname</label>
<input type="text" name="fullname" class="form-control" value="<?php echo $udata->fullname;?>" placeholder="Fullname" maxlength="15">
<small class="text-danger"><?php echo form_error('fullname');?></small>
</div>
</div>







<div class="col-lg-6 col-xl-6">
<div class="my_profile_setting_input form-group my_dashboard_review">
<label for="">Email</label>
<input type="email" name="email" class="form-control" value="<?php echo $udata->email;?>" placeholder="Email" maxlength="25">
<small class="text-danger"><?php echo form_error('email');?></small>
</div>
</div>



<div class="col-lg-6 col-xl-6">
<div class="my_profile_setting_input form-group my_dashboard_review">
<label for="formGroupExampleInput10">Mobile</label>

	<input type="text" name="phone" class="form-control" value="<?php echo $udata->phone;?>"  onkeypress="return onlyNumberKey(event)" maxlength="11" size="50%" / placeholder="Mobile Number">



<small class="text-danger"><?php echo form_error('phone');?></small>







</div>











</div>







<!-- <div class="col-lg-6 col-xl-6">
<div class="my_profile_setting_input form-group my_dashboard_review">
<label for="formGroupExampleInput11">Area</label>
<select name="address" class="selectpicker w100 show-tick" data-show-subtext="false" data-live-search="true">
<option value="">Select </option> -->

<?php 
// $areaname = $this->Model->getAlData('area_code_list');
// foreach($areaname as $area_code){ ?>



<!-- <option value="<?php //echo $area_code->area_uniqid;?>,<?php// echo $area_code->area_name;?>" <?php echo ($udata->addrs_id == $area_code->area_uniqid)//?" selected=' selected'":""?>><?php //echo $area_code->area_name;?></option> -->



<?php // } ?>



<!-- </select>
<small class="text-danger"><?php //echo form_error('address');?></small>
</div>
</div> -->







<!-- <div class="col-lg-12 col-xl-12">
<div class="my_profile_setting_input form-group my_dashboard_review">
<label for="formGroupExampleInput11">Full Address</label>
<input type="text" name="fulladdress" class="form-control" value="<?php// echo $udata->fulladdress;?>" placeholder="Full address (apartment/house number, street, floor, etc)" maxlength="35">
<small class="text-danger"><?php //echo form_error('fulladdress');?></small>
</div>
</div> -->





<!-- <div class="col-lg-12 col-xl-12">

<div class="my_profile_setting_input form-group my_dashboard_review">

<label for="formGroupExampleInput11">Address</label>

<input type="text" name="fulladdress2" class="form-control" value="<?php if($udata->fulladdress2 !='0'){ echo $udata->fulladdress2; }?>" placeholder="Address" maxlength="35">

<small class="text-danger"><?php //echo form_error('fulladdress');?></small>

</div>

</div> -->









<?php 

  $chkextra  = $this->Model->CountWhereRecord('user_addrs',array('uid'=>$user_id));



  $extra_add = "SELECT * FROM `user_addrs` WHERE uid='$user_id'";



  $extra_add = $this->Model->getSqlData($extra_add);



if($chkextra > 0){ 



foreach ($extra_add as  $getaex) {

    

?>

<div class="col-lg-12 col-xl-12">



<a class='' data-href="<?php echo base_url();?>user/remove_address/<?php echo $getaex['id'];?>" data-toggle="modal" data-target="#confirm-delete" style="cursor: pointer">- Remove</a>

   

<div class="row">



<!-- ad typ -->

<div class="col-lg-4 col-xl-4">

<div class="my_profile_setting_input form-group my_dashboard_review">


<label for="formGroupExampleInput11">Nick Name</label>

<input type="text" name="ad_type[]" class="form-control newaddrs" value="<?php echo $getaex['chk_type'];?>" placeholder="Home,Office,Other..." maxlength="35">



<!-- <select name="ad_type[]" class="selectpicker w100 show-tick" data-show-subtext="false" data-live-search="true">
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

<select name="area_arr[]" class="selectpicker w100 show-tick" data-show-subtext="false" data-live-search="true">

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



<label for="formGroupExampleInput11">Full Address</label>

<input type="text" name="newaddrs[]" class="form-control newaddrs" value="<?php echo $getaex['address'];?>" placeholder="Address" maxlength="50">

</div>

</div>

<!-- adds -->




</div>



</div>











<?php }} ?>



<div class="col-lg-12 col-xl-12">

<div class="my_profile_setting_input form-group my_dashboard_review">

<div class="form-group change">

    <label for="">&nbsp;</label><br/>

    <a class="adds" style="cursor: pointer">+ Add More Address</a>

</div>

</div>

</div>







<div class="col-lg-12 col-xl-12 after-add-more" style="display: none;">

<div class="row">


<!-- ad typ -->

<div class="col-lg-4 col-xl-4">

<div class="my_profile_setting_input form-group my_dashboard_review">


<label for="formGroupExampleInput11">Nick Name</label>

<input type="text" name="ad_type[]" class="form-control newaddrs" value="" placeholder="Home,Office,Other..." maxlength="35">



<!-- <select name="ad_type[]" class="selectpicker w100 show-tick" data-show-subtext="false" data-live-search="true">
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

<select name="area_arr[]" class="selectpicker w100 show-tick" data-show-subtext="false" data-live-search="true">

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





<div class="col-xl-12">



<div class="my_profile_setting_input">



<input type="hidden" name="user_id" value="<?php echo $udata->user_id;?>">



<button class="btn btn1">Update</button>



</div>







</div>







</div>



</form>



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





</section>





<!--=======Copyright========-->



<?php include(APPPATH.'views/include/copyright.php'); ?>



<!--=======//Copyright========-->





<!--=====Fotter-n-js======-->







<?php include(APPPATH.'views/include/dashboard-footer.php'); ?>





<script type="text/javascript" src="js/smartuploader.js"></script>







<!--=====/Fotter-n-js=====-->





<script>







function onlyNumberKey(evt) {



var ASCIICode = (evt.which) ? evt.which : evt.keyCode







if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))







return false;







return true;







}







</script>



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

    

    

    $("body").on("click",".add-more",function(){ 



        $('.after-add-more').show();  



        var html = $(".after-add-more").first().clone();

      

        //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");

      

          $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");

      

      

        $(".after-add-more").last().after(html);

      

     

       

    });



    $("body").on("click",".remove",function(){ 

        $(this).parents(".after-add-more").remove();

    });

});



</script>



<script>

$('#confirm-delete').on('show.bs.modal', function(e) {

$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));



//$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');

});

</script>



</body>



</html>