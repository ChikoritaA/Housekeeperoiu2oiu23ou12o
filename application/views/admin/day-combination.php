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
<!-- <div class="form-head mb-4">
<h2 class="text-black font-w600 mb-0">Day Combination</h2>
</div> -->

<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-xl-12">
<!-- <h3>Create subscription day combination</h3> -->
<h3>Create Day Combinations</h3>
</div><!---col-xl-12-->
<div class="col-xl-12 mt-2">

<!-- alert start -->
<?php if($this->session->flashdata('day_err')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('day_err'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('day_err'); } ?>


<?php if($this->session->flashdata('day_succ')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('day_succ'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('day_succ'); } ?>

<!-- alert end -->
<?php 
$tab_id   = $this->uri->segment(2);
?>
<div class="custom-tab-1">
<ul class="nav nav-tabs">
<li class="nav-item">
<a class="nav-link <?php if($tab_id=='day_combination' || $tab_id=='single_day_combination' ){ echo 'active'; }?>" data-toggle="tab" href="#one"><i class="la la-calendar mr-2"></i> Once A Week</a>
</li>
<li class="nav-item">
<a class="nav-link <?php if($tab_id=='twice_day_combination'){ echo 'active'; }?>" data-toggle="tab" href="#twice"><i class="la la-calendar mr-2"></i> Twice A Week</a>
</li>
<li class="nav-item">
<a class="nav-link <?php if($tab_id=='thirce_day_combination'){ echo 'active'; }?>" data-toggle="tab" href="#three"><i class="la la-calendar mr-2"></i>  Thrice A Week</a>
</li>
</ul>
<div class="tab-content">
<div class="tab-pane fade <?php if($tab_id=='single_day_combination'){ echo 'active show'; }else if($tab_id=='day_combination'){ echo 'active show'; }?>" id="one" role="tabpanel">

<form method="post" action="<?php echo base_url();?>admin/single_day_combination">	
<div class="pt-4">
<h4>Once A Week</h4>

<div class="control-group">  
<div class="controls">  
<div class="entry mb-2"> 
<div class="row">
<div class="col-xl-4 mt-4 mb-4">
<div class="form-group">
<label>Days</label>
<select class="form-control" name="single_day">
<option value="">Select</option>
<option value="Monday">Monday</option>
<option value="Tuesday">Tuesday</option>
<option value="Wednesday">Wednesday</option>
<option value="Thursday">Thursday</option>
<option value="Friday">Friday</option>
<option value="Saturday">Saturday</option>
<option value="Sunday">Sunday</option>
</select>
</div>
<small class="text-danger"><?php echo form_error('single_day');?></small>

</div> 	
 
<div class="col-xl-4 mt-4 mb-4">
<div class="form-group">
<label>&nbsp;</label>
<button type="submit" class="custom-btn">Add</button>
</div> 
</div>
</div><!---row---->

<div class="row mt-2 mb-2">
<div class="col-xl-12">
<h3>List</h3>
</div>

<div class="col-xl-12">
<!-- alert start -->
<?php if($this->session->flashdata('day_del1')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('day_del1'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('day_del1'); } ?>


<?php if($this->session->flashdata('subday1')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('subday1'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('subday1'); } ?>
<!-- end -->

</div> <!---col--->
<div class="table-responsive">
 <table id="subscriptionlist" class="display table" >
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Day Combination</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            <?php if(is_array($day_subs)): ?>

            <?php 
            $i = 1;
            foreach($day_subs as $subs_day ){ 
            if(($subs_day->type) == '1'){   
            ?>
         <tr>
         <td><?php echo $i;?></td>
         <td><?php echo $subs_day->day;?></td>
         <td>
        
         <a class="btn  btn-square btn-danger text-white" data-href="<?php echo base_url();?>admin/del_subsday/<?php echo $subs_day->sub_id;?>" data-toggle="modal" data-target="#confirm-delete"><i class="la la-trash"></i> Delete</a>


         </td>
         </tr>
        <?php $i++; } }?>
        <?php endif; ?>
         

                        
        </tbody>
      </table>


</div>

</div><!---row---->

</div>
</div>
</div>


</div>
</form>
</div>
<div class="tab-pane fade <?php if($tab_id=='twice_day_combination'){ echo 'active show'; }?>" id="twice">

<form method="post" action="<?php echo base_url();?>admin/twice_day_combination">
<div class="pt-4">
<h4>Twice A week</h4>

<div class="control-group">  
<div class="controls-2">  
<div class="entry mb-2"> 
<div class="row">
<div class="col-xl-4 mt-4 mb-4">
<div class="form-group">
<label>Day one</label>
<select class="form-control" name="twice_day1">
<option value="">Select</option>
<option value="Monday" <?php echo (set_value('twice_day1')=='Monday')?" selected=' selected'":""?>>Monday</option>
<option value="Tuesday" <?php echo (set_value('twice_day1')=='Tuesday')?" selected=' selected'":""?>>Tuesday</option>
<option value="Wednesday" <?php echo (set_value('twice_day1')=='Wednesday')?" selected=' selected'":""?>>Wednesday</option>
<option value="Thursday" <?php echo (set_value('twice_day1')=='Thursday')?" selected=' selected'":""?>>Thursday</option>
<option value="Friday" <?php echo (set_value('twice_day1')=='Friday')?" selected=' selected'":""?>>Friday</option>
<option value="Saturday" <?php echo (set_value('twice_day1')=='Saturday')?" selected=' selected'":""?>>Saturday</option>
<option value="Sunday" <?php echo (set_value('twice_day1')=='Sunday')?" selected=' selected'":""?>>Sunday</option>
</select>
</div>
<small class="text-danger"><?php echo form_error('twice_day1');?></small>

</div> 	
<div class="col-xl-4 mt-4 mb-4">
<div class="form-group">
<label>Day Two</label>
<select class="form-control" name="twice_day2">
<option value="">Select</option>
<option value="Monday" <?php echo (set_value('twice_day2')=='Monday')?" selected=' selected'":""?>>Monday</option>
<option value="Tuesday" <?php echo (set_value('twice_day2')=='Tuesday')?" selected=' selected'":""?>>Tuesday</option>
<option value="Wednesday" <?php echo (set_value('twice_day2')=='Wednesday')?" selected=' selected'":""?>>Wednesday</option>
<option value="Thursday" <?php echo (set_value('twice_day2')=='Thursday')?" selected=' selected'":""?>>Thursday</option>
<option value="Friday" <?php echo (set_value('twice_day2')=='Friday')?" selected=' selected'":""?>>Friday</option>
<option value="Saturday" <?php echo (set_value('twice_day2')=='Saturday')?" selected=' selected'":""?>>Saturday</option>
<option value="Sunday" <?php echo (set_value('twice_day2')=='Sunday')?" selected=' selected'":""?>>Sunday</option>
</select>
</div>
<small class="text-danger"><?php echo form_error('twice_day2');?></small>

</div> 
<div class="col-xl-4 mt-4 mb-4">
<div class="form-group">
<label>&nbsp;</label>
<button type="submit" class="custom-btn">Add</button>
</div> 
</div> 
</div><!----row-->

<div class="row mt-2 mb-2">
<div class="col-xl-12">
<h3>List</h3>
</div>
<div class="col-xl-12">
<!-- alert start -->
<?php if($this->session->flashdata('day_del2')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('day_del2'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('day_del2'); } ?>

<?php if($this->session->flashdata('subday2')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('subday2'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('subday2'); } ?>
<!-- end -->

    <div class="table-responsive">
<table id="subscriptionlist_twice_a_Week" class="display table" >
<thead>
<tr>
<th>Sr.No.</th>
<th>Day Combination</th>
<th>Action</th>
</tr>
</thead>
<tbody>
 <?php if(is_array($day_subs)): ?>

            <?php 
            $i = 1;
            foreach($day_subs as $subs_day ){ 
            if(($subs_day->type) == '2'){   
            ?>
         <tr>
         <td><?php echo $i;?></td>
         <td><?php echo $subs_day->day;?></td>
         <td>
        
         <a class="btn  btn-square btn-danger text-white" data-href="<?php echo base_url();?>admin/del_subsday/<?php echo $subs_day->sub_id;?>" data-toggle="modal" data-target="#confirm-delete"><i class="la la-trash"></i> Delete</a>


         </td>
         </tr>
        <?php $i++; } }?>
        <?php endif; ?>
</tbody>
</table>
</div>
</div>
</div><!----row-->


</div>
</div>
</div>


</div>
</form>
</div>
<div class="tab-pane fade <?php if($tab_id=='thirce_day_combination'){ echo 'active show'; }?>" id="three">

<form method="post" action="<?php echo base_url();?>admin/thirce_day_combination">
<div class="pt-4">
<h4>Thrice A Week</h4>

<div class="control-group">  
<div class="controls-3">  
<div class="entry mb-2"> 
<div class="row">
<div class="col-xl-3 mt-3 mb-3">
<div class="form-group">
<label>Day One</label>
<select class="form-control" name="thrice_day1">
<option value="">Select</option>
<option value="Monday" <?php echo (set_value('thrice_day1')=='Monday')?" selected=' selected'":""?>>Monday</option>
<option value="Tuesday" <?php echo (set_value('thrice_day1')=='Tuesday')?" selected=' selected'":""?>>Tuesday</option>
<option value="Wednesday" <?php echo (set_value('thrice_day1')=='Wednesday')?" selected=' selected'":""?>>Wednesday</option>
<option value="Thursday" <?php echo (set_value('thrice_day1')=='Thursday')?" selected=' selected'":""?>>Thursday</option>
<option value="Friday" <?php echo (set_value('thrice_day1')=='Friday')?" selected=' selected'":""?>>Friday</option>
<option value="Saturday" <?php echo (set_value('thrice_day1')=='Saturday')?" selected=' selected'":""?>>Saturday</option>
<option value="Sunday" <?php echo (set_value('thrice_day1')=='Sunday')?" selected=' selected'":""?>>Sunday</option>
</select>
</div>
<small class="text-danger"><?php echo form_error('thrice_day1');?></small>

</div> 	
<div class="col-xl-3 mt-3 mb-3">
<div class="form-group">
<label>Day Two</label>
<select class="form-control" name="thrice_day2">
<option value="">Select</option>
<option value="Monday" <?php echo (set_value('thrice_day2')=='Monday')?" selected=' selected'":""?>>Monday</option>
<option value="Tuesday" <?php echo (set_value('thrice_day2')=='Tuesday')?" selected=' selected'":""?>>Tuesday</option>
<option value="Wednesday" <?php echo (set_value('thrice_day2')=='Wednesday')?" selected=' selected'":""?>>Wednesday</option>
<option value="Thursday" <?php echo (set_value('thrice_day2')=='Thursday')?" selected=' selected'":""?>>Thursday</option>
<option value="Friday" <?php echo (set_value('thrice_day2')=='Friday')?" selected=' selected'":""?>>Friday</option>
<option value="Saturday" <?php echo (set_value('thrice_day2')=='Saturday')?" selected=' selected'":""?>>Saturday</option>
<option value="Sunday" <?php echo (set_value('thrice_day2')=='Sunday')?" selected=' selected'":""?>>Sunday</option>
</select>
</div>
<small class="text-danger"><?php echo form_error('thrice_day2');?></small>

</div> 

<div class="col-xl-3 mt-3 mb-3">
<div class="form-group">
<label>Day Three</label>
<select class="form-control" name="thrice_day3">
<option value="">Select</option>
<option value="Monday" <?php echo (set_value('thrice_day3')=='Monday')?" selected=' selected'":""?>>Monday</option>
<option value="Tuesday" <?php echo (set_value('thrice_day3')=='Tuesday')?" selected=' selected'":""?>>Tuesday</option>
<option value="Wednesday" <?php echo (set_value('thrice_day3')=='Wednesday')?" selected=' selected'":""?>>Wednesday</option>
<option value="Thursday" <?php echo (set_value('thrice_day3')=='Thursday')?" selected=' selected'":""?>>Thursday</option>
<option value="Friday" <?php echo (set_value('thrice_day3')=='Friday')?" selected=' selected'":""?>>Friday</option>
<option value="Saturday" <?php echo (set_value('thrice_day3')=='Saturday')?" selected=' selected'":""?>>Saturday</option>
<option value="Sunday" <?php echo (set_value('thrice_day3')=='Sunday')?" selected=' selected'":""?>>Sunday</option>
</select>
</div>
<small class="text-danger"><?php echo form_error('thrice_day3');?></small>

</div>

<div class="col-xl-3 mt-3 mb-3">
<div class="form-group">
<label>&nbsp;</label>
<button type="submit" class="custom-btn">Add</button>
</div> 
</div> 
</div><!---row--->

<div class="row mt-2 mb-2">
<div class="col-xl-12">
<h3>List</h3>
</div>
<div class="col-xl-12">

<!-- alert start -->
<?php if($this->session->flashdata('day_del3')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('day_del3'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('day_del3'); } ?>


<?php if($this->session->flashdata('subday3')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('subday3'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('subday3'); } ?>
<!-- end -->
<div class="table-responsive">
<table id="thrice_a_week" class="display table" >
<thead>
<tr>
<th>Sr.No.</th>
<th>Day Combination</th>
<th>Action</th>
</tr>
</thead>
<tbody>
 <?php if(is_array($day_subs)): ?>

            <?php 
            $i = 1;
            foreach($day_subs as $subs_day ){ 
            if(($subs_day->type) == '3'){   
            ?>
         <tr>
         <td><?php echo $i;?></td>
         <td><?php echo $subs_day->day;?></td>
         <td>
        
         <a class="btn  btn-square btn-danger text-white" data-href="<?php echo base_url();?>admin/del_subsday/<?php echo $subs_day->sub_id;?>" data-toggle="modal" data-target="#confirm-delete"><i class="la la-trash"></i> Delete</a>


         </td>
         </tr>
        <?php $i++; } }?>
        <?php endif; ?>
</tbody>
</table>
</div>
</div>
</div> <!--row-->    
</div>
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
</div><!---row--->


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
                    <p>Are you sure, you want to delete this day !</p>
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

</script>  thrice_a_week

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
</body>
</html>