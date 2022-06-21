<!DOCTYPE html>

<html lang="en">

<head>



<!--*******************

css meta titlal include

********************-->

<?php include(APPPATH.'views/admin/include/css.php'); ?>



<link href="<?php echo base_url();?>assets/admin_assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

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

<h2 class="text-black font-w600 mb-0">Manage Jobs</h2>

</div>



<form method="" action="" class="form">

<div class="row">

<div class="col-xl-12">

<div class="card">

<div class="card-body">



<div class="row">



<div class="col-12">


<!-- alert start -->
<?php if($this->session->flashdata('err_assign')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('err_assign'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('err_assign'); } ?>


<?php if($this->session->flashdata('succ_assign')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('succ_assign'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('succ_assign'); } ?>
<!-- alert end -->


<div class="table-responsive">

<table id="example3" class="display">

		<thead>

		<tr>

		<th>#</th>
		<th>Employee Name</th>
		<th>Client Name</th>
		<th>Plan</th>
		<th>Shift</th>
		<th>Area Code</th>
		<th>Day</th>
		<th>Start Date</th>
		<th>Assign Other</th>
    <th>Action</th>


		</tr>

		</thead>

      <tbody>

      	<?php if(is_array($all_job)): ?>

                <?php 
                $i = 1;
                foreach($all_job as $all_jobs_data ){ 

                $job_id      = $all_jobs_data['job_id'];
                $book_date   = $all_jobs_data['book_date'];
                $day         = $all_jobs_data['day'];
                $user_id     = $all_jobs_data['user_id'];
                $emp_id      = $all_jobs_data['emp_id'];
                $status      = $all_jobs_data['status'];
                $uniqid      = $all_jobs_data['uniqid'];

                $job_primary_id      = $all_jobs_data['id'];


                //get schedul job data 
                $getjobdata = $this->Model->getData('job_scheduler',array('scheduler_id'=>$job_id));
                //$emp_id     = $getjobdata->emp_id;
                $shift      = $getjobdata->shift;
                $area       = $getjobdata->area_code;
                $plan_type  = $getjobdata->plan_type;

                $get_job_emp_id = $getjobdata->emp_id;
               
                if($get_job_emp_id == $emp_id){
                
                
                //get employee data 
                $getempdata = $this->Model->getData('cleanner',array('emp_id'=>$get_job_emp_id));
                $empname    = $getempdata->fullname;
                  
                }else{
                
                  
                //get employee data 
                $getempdata = $this->Model->getData('cleanner',array('emp_id'=>$emp_id));
                $empname    = $getempdata->fullname;

                }

                //get users data 
                
                $getudata = $this->Model->getData('users',array('user_id'=>$user_id));
                $fullname = $getudata->fullname;
                
                

                //get shift data 
                $getshiftdata = $this->Model->getData('shift',array('shift_id'=>$shift));
                $shift_f = $getshiftdata->from_time;
                $shift_t = $getshiftdata->to_time;
                $shift_h = $getshiftdata->hours;
                
                ?>


			<tr>

			      <td><?php echo $i; ?> </td>
           
            <td><?php echo $empname;?></td>
            <td><?php echo $fullname;?></td>
            <td><?php if($plan_type == '0'){ echo "At A Time"; } else if($plan_type == '1'){ echo "Once A Week";}else if($plan_type == '2'){ echo "Twice A Week";}else if($plan_type == '3'){ echo "Thrice A Week";}?></td>
            <td><?php echo $shift_f;?> to <?php echo $shift_t;?> <?php echo $shift_h;?> hrs</td>
           
            
            <td><?php echo $area;?></td>
            <td><?php echo $day;?></td>
            <td><?php echo $book_date;?></td>

		
	   <td>
			<div class="form-group">
      <!-- <a href="#" class="btn custom-btn">Click</a> -->
			<select class="form-control selectpicker" data-show-subtext="false" data-live-search="true" id="assign_emp" onchange="go_emp_assign(this)">

      <option value="">Select</option>

      <?php 
      foreach($emp_list as $employee){ ?>
      <option value="<?php echo base_url();?>admin/assign_newemployee/<?php echo $employee['emp_id'];?>/<?php echo $job_id;?>/<?php echo $job_primary_id;?>" <?php echo ($emp_id == $employee['emp_id'])?" selected=' selected'":""?>><?php echo $employee['fullname'];?></option>
      <?php } ?>
      
			</select>

			</div>

			</td>

      <td>
        
        <?php if($status == '1'){ ?>


      <a href="javascript:(void)" class="text-danger" data-href="<?php echo base_url();?>admin/denyjob_day/<?php echo $job_primary_id?>/<?php echo $user_id;?>" data-toggle="modal" data-target="#confirm-deny"><i class="fa fa-trash text-danger font-22"></i></a>


      <?php } else{ ?>

      <a href="javascript:(void)" class="text-danger"><i class="fa fa-trash text-danger font-22"></i></a>


      <?php } ?>

      </td>




			</tr>
      


			<?php  $i++; } ?>
      <?php endif; ?>


		</tbody>

		</table>

		</div>

</div>


</div> <!----row--->

</div><!----card-body--->

</div>

</div>





</div>



</form>

<!--/form-->


 <!-- Modal -->

  <div class="modal fade" id="confirm-deny">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Cancel Booking</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

                        
        <div class="modal-body">
            <p>Are you sure, you want to cancel this booking?</p>
            <!-- <p class="debug-url"></p> -->
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <a class="btn btn-success btn-ok">Ok</a>
        </div>
    </div>
</div>
</div>
<!-- Modal -->




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

<!-- Datatable -->

<script src="<?php echo base_url();?>assets/admin_assets/vendor/datatables/js/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url();?>assets/admin_assets/js/plugins-init/datatables.init.js"></script>



<script type="text/javascript">



$(function() {



$(document).on('click', '.btn-add', function(e) {



e.preventDefault();



var controlForm = $('.controls:first'),



currentEntry = $(this).parents('.entry:first'),



newEntry = $(currentEntry.clone()).appendTo(controlForm);



newEntry.find('input').val('');



controlForm.find('.entry:not(:last) .btn-add')



.removeClass('btn-add').addClass('btn-remove')



.removeClass('btn-success').addClass('btn-danger')



.html('<span class="fa fa-trash text-white"> </span>');



}).on('click', '.btn-remove', function(e) {



$(this).parents('.entry:first').remove();



e.preventDefault();



return false;



});



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

</script>

<script>

function detailssubmit() {

alert("Your details were Submitted");

}

</script>





<script>



jQuery('select').change(function() {

console.log(jQuery('option').val())

if (jQuery(this).val() == 'driver') {

jQuery('.area').show();

} 

else {

jQuery('.area').hide();

}



});



</script>

<script type="text/javascript">
$(document).ready(function() {

if (window.File && window.FileList && window.FileReader) {

$("#files").on("change", function(e) {

var files = e.target.files,

filesLength = files.length;

for (var i = 0; i < filesLength; i++) {

var f = files[i]

var fileReader = new FileReader();

fileReader.onload = (function(e) {

var file = e.target;

$("<span class=\"pip\">" +

"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +

"<br/><span class=\"remove\">Remove image</span>" +

"</span>").insertAfter("#files");

$(".remove").click(function(){

$(this).parent(".pip").remove();

});

});

fileReader.readAsDataURL(f);

}

console.log(files);

});

} else {

alert("Your browser doesn't support to File API")

}

});

</script>



<script type="text/javascript">
$(document).ready(function() {

if (window.File && window.FileList && window.FileReader) {

$("#files-2").on("change", function(e) {

var files = e.target.files,

filesLength = files.length;

for (var i = 0; i < filesLength; i++) {

var f = files[i]

var fileReader = new FileReader();

fileReader.onload = (function(e) {

var file = e.target;

$("<span class=\"pip\">" +

"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +

"<br/><span class=\"remove\">Remove image</span>" +

"</span>").insertAfter("#files-2");

$(".remove").click(function(){

$(this).parent(".pip").remove();

});


});

fileReader.readAsDataURL(f);

}

console.log(files);

});

} else {

alert("Your browser doesn't support to File API")

}

});

</script>


<script>
function go_emp_assign(selval){
var value = selval.options[selval.selectedIndex].value;
window.location.href=value;
}
</script>

<script>
$('#confirm-deny').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

});
</script>



</body>
</html>