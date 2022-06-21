<!DOCTYPE html>
<html lang="en">
<head>
<!--*******************
css meta titlal include
********************-->
<?php include(APPPATH.'views/admin/include/css.php'); ?>

<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css"> -->
<!-- 
<link href="<?php echo base_url();?>assets/admin_assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet"> -->

<!--*******************
css meta titlal include
********************-->
<style type="text/css">
.custom-control {
line-height: inherit;
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
<h2 class="text-black font-w600 mb-0">Employee Scheduler</h2>
</div>


<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">
<!-- alert start -->
<?php if($this->session->flashdata('job_err')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('job_err'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('job_err'); } ?>

<?php if($this->session->flashdata('job_suc')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('job_suc'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('job_suc'); } ?>

<!-- alert end -->


<form method="post" action="<?php echo base_url();?>admin/create_schedule">
<div class="row">

<div class="col-md-4 col-xl-4 col-xxl-4 mb-3">
<label>Employee </label>
<div class="input-group">
<select class="form-control selectpicker" data-show-subtext="false" data-live-search="true" name="employee">
<option value="">Select</option>

<?php 
foreach($emp_list as $employee){ ?>
<option value="<?php echo $employee['emp_id'];?>" <?php echo (set_value('employee')== $employee['emp_id'])?" selected=' selected'":""?>><?php echo $employee['fullname'];?></option>
<?php } ?>

</select>
</div>
<small class="text-danger"><?php echo form_error('employee');?></small>

</div><!---col--->

<div class="col-md-4 col-xl-4 col-xxl-4 mb-3">
<label>Package</label>
<div class="input-group">
<select name="plan" id="plan_id" class="form-control default-select">
<option value="">Select</option>
<option value="0" <?php echo (set_value('plan')=='0')?" selected=' selected'":""?>>At A Time</option>
<option value="1" <?php echo (set_value('plan')=='1')?" selected=' selected'":""?>>Once A Week</option>
<option value="2" <?php echo (set_value('plan')=='2')?" selected=' selected'":""?>>Twice A Week</option>
<option value="3" <?php echo (set_value('plan')=='3')?" selected=' selected'":""?>>Thrice A Week</option>
</select>
</div>
<small class="text-danger"><?php echo form_error('plan');?></small>


</div>

<div class="col-md-4 col-xl-4 col-xxl-4 mb-3">
<label>Day</label>
<div class="input-group">
<select class="form-control" name="days" id="days">
<option value="">Select</option>
</select>

</div>
<small class="text-danger"><?php echo form_error('days');?></small>

</div><!---col--->

<div class="col-md-4 col-xl-4 col-xxl-4 mb-3">
<label>Area Code</label>
<div class="input-group">
<select class="form-control selectpicker" data-show-subtext="false" data-live-search="true" name="area_code">
<option value="">Select</option>

<?php 
foreach($area as $area_code){ ?>
<option value="<?php echo $area_code['area_uniqid'];?>" <?php echo (set_value('area_code')== $area_code['area_uniqid'])?" selected='selected'":""?>><?php echo $area_code['area_code'];?></option>
<?php } ?>
</select>
</div>
<small class="text-danger"><?php echo form_error('area_code');?></small>

</div><!---col--->

<div class="col-md-4 col-xl-4 col-xxl-4 mb-3">
<label>Shift</label>
<div class="input-group">
<select class="form-control selectpicker" name="shift">
<option value="">Select</option>

<?php 
foreach($shift as $shift_list){ ?>
<option value="<?php echo $shift_list->shift_id;?>" <?php echo (set_value('shift')== $shift_list->shift_id)?" selected=' selected'":""?>><?php echo $shift_list->from_time;?> to <?php echo $shift_list->to_time;?> <?php echo $shift_list->hours;?> hrs</option>
<?php } ?>
</select>
</div>
<small class="text-danger"><?php echo form_error('shift');?></small>

</div><!---col--->



<div class="col-md-4 col-xl-4 col-xxl-4 mb-3">
<label>Assign Driver </label>
<div class="input-group">
<select class="form-control selectpicker" data-show-subtext="false" data-live-search="true" name="driver">
<option value="">Select</option>

<?php 
foreach($driver_list as $drivers){ ?>
<option value="<?php echo $drivers['emp_id'];?>" <?php echo (set_value('driver')== $drivers['emp_id'])?" selected=' selected'":""?>><?php echo $drivers['fullname'];?></option>
<?php } ?>

</select>
</div>
<small class="text-danger"><?php echo form_error('driver');?></small>

</div><!---col--->




<div class="col-md-4 col-xl-4 col-xxl-4 mb-3 mt-3 mx-auto">

<button type="submit" class="custom-btn mt-3">Assign Job</button>
</div>




</div> <!----row--->
</form>

</div><!----card-body--->
</div>
</div>
</div>
<!-------------->

<div class="col-md-6 form-head mb-4">
<h2 class="text-black font-w600 mb-0">Scheduler List</h2>
</div>



<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">

<!-- alert start -->
<?php if($this->session->flashdata('del_sch')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('del_sch'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('del_sch'); } ?>

<?php if($this->session->flashdata('del_sch_suc')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('del_sch_suc'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('del_sch_suc'); } ?>
<!-- end -->

	<div class="table-responsive">
 <table id="scheduler-list" class="display table" >
        <thead>
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>Package</th>
                <th>Day</th>
                <th>Area Code</th>
                <th>Shift</th>
                <th>Driver</th>
                <th>Status</th>
                <th>Job</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

                <?php if(is_array($schedule)): ?>
                <?php 
                $i = 1;
                foreach($schedule as $plans ){
                
                $empid     = $plans->emp_id ;
                $dayid     = $plans->day ;
                $shiftid   = $plans->shift ;
                $area_uniq = $plans->area_uniq ;
                $driver_id = $plans->driver ;


                //get employee details from employee id
                $empdata  = $this->Model->getData('cleanner',array('emp_id'=>$empid));

                $emp_name = $empdata->fullname;


                //get driveR name
                $drivernm  = $this->Model->getData('cleanner',array('emp_id'=>$driver_id));
                $dname     = $drivernm->fullname;


                //get data of day from day combination
                $day_comb  = $this->Model->getData('subscription_day',array('sub_id'=>$dayid));

                $day_name = $day_comb->day;

                //get area name and code
                $getarea_c    = $this->Model->getData('area_code_list',array('area_uniqid'=>$area_uniq));
                $getarea_code = $getarea_c->area_code;
                $getarea_name = $getarea_c->area_name;

                //get shift name from master shift
                $shiftdata  = $this->Model->getData('shift',array('shift_id'=>$shiftid));
                //cdate
                $cdate = date('Y-m-d');
                $c_day = date('l', strtotime($cdate));

               ?>

        	    <tr>
                <td><?php echo $i;?></td>
                <td><?php echo ucwords($emp_name);?></td>
                <td><?php if($plans->plan_type == '0'){ echo "At A Time"; }else if($plans->plan_type == '1'){ echo "Once A Week"; }else if($plans->plan_type == '2'){ echo "Twice A Week"; }else if($plans->plan_type == '3'){ echo "Thrice A Week"; }?></td>
                <td><?php echo $day_name;?></td>
              
                <td><?php echo $getarea_code;?></td>
                <td><?php echo $shiftdata->from_time;?> to <?php echo $shiftdata->to_time;?> <?php echo $shiftdata->hours;?> hrs</td>
                
                <td><?php echo $dname;?></td>

                <td><?php if(($plans->status)=='2'){ echo '<i class="badge badge-success">Booked</i>'; }else if(($plans->status)=='1'){ echo '<i class="badge badge-info">Active</i>'; }else{ echo '<i class="badge badge-danger">Inactive</i>'; } ?></td>
                
                <?php if(($plans->status)=='1'){ ?>
                <?php if($plans->plan_type == '0' && $day_name == $c_day){ ?>
                <td><a class="btn  btn-square btn-warning text-white" href="<?php echo base_url();?>admin/booknow/<?php echo $plans->scheduler_id;?>" ><i class="la la-book"></i>Book Now</a></td>
                <td>
                <?php }else if($plans->plan_type != '0') {?>
                <td><a class="btn  btn-square btn-warning text-white" href="<?php echo base_url();?>admin/booknow/<?php echo $plans->scheduler_id;?>" ><i class="la la-book"></i>Book Now</a></td>
                <td>
                
                <?php } else{ ?>
                <td><a class="btn  btn-square btn-warning text-white" href="javascript:void(0);" disabled=""><i class="la la-book"></i>Book Now</a></td>
                <td>

                <?php  } }else { ?> 
                <td><a class="btn  btn-square btn-warning text-white" href="javascript:void(0);" disabled=""><i class="la la-book"></i>Book Now</a></td>
                <td>
                <?php } ?>   
                <a class="btn  btn-square btn-danger text-white" data-href="<?php echo base_url();?>admin/del_scheduler/<?php echo $plans->scheduler_id;?>" data-toggle="modal" data-target="#confirm-delete"><i class="la la-trash"></i></a>

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
                    <p>Are you sure, you want to delete this scheduler!</p>
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
    $('#scheduler-list').DataTable();
} );

</script>
<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

//$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});
</script>

<script type="text/javascript">
        $(document).ready(function(){
 
            $('#plan_id').change(function(){ 
                var plan_id=$(this).val();
                if(plan_id == '0'){
                plan_id = '1';
                }
                //alert(plan_id);
                $.ajax({
                    url : "<?php echo base_url('admin/get_subcription_day');?>",
                    method : "POST",
                    data : {plan_id: plan_id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        var html = '';
                        var i;
              for(i=0; i<data.length; i++){
        
                html += '<option value='+data[i].sub_id+ '>'+data[i].day+'</option>';

                }
             
               $('#days').html(html);
         
                }

                });
                return false;
            }); 
             
        });
    </script>


</body>
</html>