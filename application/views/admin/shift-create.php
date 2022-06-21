<!DOCTYPE html>

<html lang="en">

<head>

<?php include(APPPATH.'views/admin/include/css.php'); ?>
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

<h2 class="text-black font-w600 mb-0">Create Shift</h2>

</div> -->


<div class="card">
<div class="row">

<div class="col-xl-12">

<div class="card-body">

<!-- alert start -->
<?php if($this->session->flashdata('shift_err')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('shift_err'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('shift_err'); } ?>


<?php if($this->session->flashdata('shift_su')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('shift_su'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('shift_su'); } ?>
<!-- alert end -->


<form method="post" action="<?php echo base_url();?>admin/create_shift" class="form">


<!--/form-->

<div class="row">

<div class="col-xl-12">

<h3>Create Shift</h3>

</div><!---col-xl-12-->

<div class="col-md-4 col-xl-4 col-xxl-4 mb-3">

<label>From</label>

<div class="input-group clockpicker">

<input type="time" name="from_time1" class="form-control" onchange="from_timeChange()" id="from_time1" value="<?php echo set_value('from_time1');?>">
<input type="hidden" name="from_time" id="from_time" value="<?php echo set_value('from_time');?>">
</div>
<small class="text-danger"><?php echo form_error('from_time1');?></small>


</div>

<div class="col-md-4 col-xl-4 col-xxl-4 mb-3">

<label>To</label>

<div class="input-group clockpicker">

<input type="time" name="to_time1" class="form-control" onchange="toTimeChange()" id="to_time1" value="<?php echo set_value('to_time1');?>">
<input type="hidden" name="to_time" id="to_time" value="<?php echo set_value('to_time');?>">

</div>
<small class="text-danger"><?php echo form_error('to_time1');?></small>


</div>

<div class="col-md-3 col-xl-3 col-xxl-3 mb-3 clearfix">

<label>&nbsp;</label>

<div class="input-group">

<button type="submit" class="custom-btn">Add  <i class="la la-arrow-right la-lg"></i></button>

</div>

</div>



</div>
</form>
</div></div>
</div></div>


<div class="card">
    <div class="card-body">
<div class="row">


  <div class="col-xl-12">

<h3>Shift List</h3>

</div><!---col-xl-12-->
  

<div class="col-xl-12 mt-4 mb-4">
<!-- alert start -->
<?php if($this->session->flashdata('shift_er')){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('shift_er'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('shift_er'); } ?>


<?php if($this->session->flashdata('shift_succ')){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php echo $this->session->flashdata('shift_succ'); ?>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<?php $this->session->unset_userdata('shift_succ'); } ?>
<!-- alert -->


<div class="table-responsive">
 <table id="shift" class="display table" >
        <thead>
            <tr>
                <th>#</th>
                <th>From</th>
                <th>To</th>
                <th>Hour</th>
                <th>Action</th>
               
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($shift_list)): ?>

        	<?php 
			$i = 1;
			foreach($shift_list as $shift ){ 
		    ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $shift['from_time'];?></td>
                <td><?php echo $shift['to_time'];?></td>  
                <td><?php echo $shift['hours'];?> Hours</td>
               
		         <td>
		         	
                <button class="btn  btn-square btn-danger" data-href="<?php echo base_url();?>admin/del_shift/<?php echo $shift['shift_id'];?>" data-toggle="modal" data-target="#confirm-delete"><i class="la la-trash"></i> Delete</button>

		        </td>
              
                
            </tr>
            <?php $i++; } ?>
            <?php endif; ?>

        </tbody>
      </table>


</div>



</div>

</div> <!----row--->

</div><!----card-body--->

</div><!----card--->



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
                    <p>Are you sure, you want to delete this shift!</p>
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

<script src=" https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#shift').DataTable();
} );

</script>

<!--**********************************

Footer and Js include

***********************************-->
<script>
//for from
var inputEle = document.getElementById('from_time1');
function from_timeChange() {
  var timeSplit = inputEle.value.split(':'),
    hours,
    minutes,
    meridian;
  hours = timeSplit[0];
  minutes = timeSplit[1];
  if (hours > 12) {
    meridian = 'PM';
    hours -= 12;
  } else if (hours < 12) {
    meridian = 'AM';
    if (hours == 0) {
      hours = 12;
    }
  } else {
    meridian = 'PM';
  }

  var time_new = hours + ':' + minutes + ' ' + meridian;
  document.getElementById('from_time').value = time_new;
  //alert(hours + ':' + minutes + ' ' + meridian);
}

//for to
var to_time = document.getElementById('to_time1');
function toTimeChange() {
  var timeSplit_to = to_time.value.split(':'),
    hours,
    minutes,
    meridian;
  hours   = timeSplit_to[0];
  minutes = timeSplit_to[1];
  if (hours > 12) {
    meridian = 'PM';
    hours -= 12;
  } else if (hours < 12) {
    meridian = 'AM';
    if (hours == 0) {
      hours = 12;
    }
  } else {
    meridian = 'PM';
  }

  var time_new1 = hours + ':' + minutes + ' ' + meridian;
  document.getElementById('to_time').value = time_new1;
  //alert(hours + ':' + minutes + ' ' + meridian);
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