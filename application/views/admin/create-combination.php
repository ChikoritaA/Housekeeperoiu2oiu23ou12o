<!DOCTYPE html>
<html lang="en">
	<head>
		
		<!--*******************
		css meta titlal include
		********************-->
		<?php include'include/css.php' ;?>
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
			<?php include'include/sidebar.php' ;?>
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
						<h2 class="text-black font-w600 mb-0">Create Combination</h2>
					</div>
					
					<form method="" action="" class="form">
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-body">
										
										<div class="row">
											<div class="col-xl-12">
												<h3>Create Shift</h3>
												</div><!---col-xl-12-->
												<div class="col-md-4 col-xl-4 col-xxl-4 mb-3">
													<label>From</label>
													<div class="input-group clockpicker">
														<input type="time" class="form-control" value="09:30">
													</div>
												</div>
												<div class="col-md-4 col-xl-4 col-xxl-4 mb-3">
													<label>To</label>
													<div class="input-group clockpicker">
														<input type="time" class="form-control" value="09:30">
													</div>
												</div>
												<div class="col-md-3 col-xl-3 col-xxl-3 mb-3 clearfix">
													<label>&nbsp;</label>
													<div class="input-group">
														<button class="custom-btn">Add  <i class="la la-arrow-right la-lg"></i></button>
													</div>
												</div>
												<div class="col-xl-12 mt-4 mb-4">
													<h3>Shift List</h3>
													</div><!---col-xl-12-->
													<div class="col-xl-12 mt-4 mb-4">

														<div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th class="width80"><strong>#</strong></th>
                                                <th><strong>Shift</strong></th>
                                                <th><strong>Action</strong></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>01</strong></td>
                                                <td>08. am to 11. am  3 Hours</td>
                                                <td>
                                                 <button type="button" class="btn  btn-square btn-danger"><i class="la la-trash"></i> Delete
												 </button>
											    </td>
                                            </tr>

                                            <tr>
                                                <td><strong>01</strong></td>
                                                <td>08. am to 11. am  3 Hours</td>
                                                <td>
                                                 <button type="button" class="btn  btn-square btn-danger"><i class="la la-trash"></i> Delete
												 </button>
											    </td>
                                            </tr>
										
										
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

                                    
                                    <!----form--->

                                    <form method="" action="" class="form">
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-body">
										
										<div class="row">
											<div class="col-xl-12">
												<h3>Create Areta code</h3>
												</div><!---col-xl-12-->
												<div class="col-md-4 col-xl-4 col-xxl-4 mb-3">
													<label>Area Name</label>
													<div class="input-group">
														<input type="text" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4 col-xl-4 col-xxl-4 mb-3">
													<label>Area Code</label>
													<div class="input-group">
														<input type="text" class="form-control" required>
													</div>
												</div>
												<div class="col-md-3 col-xl-3 col-xxl-3 mb-3 clearfix">
													<label>&nbsp;</label>
													<div class="input-group">
														<button class="custom-btn">Add  <i class="la la-arrow-right la-lg"></i></button>
													</div>
												</div>
												<div class="col-xl-12 mt-4 mb-4">
													<h3>Shift List</h3>
													</div><!---col-xl-12-->
													<div class="col-xl-12 mt-4 mb-4">

														<div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th class="width80"><strong>Sr.No.</strong></th>
                                                <th><strong>Area Name</strong></th>
                                                <th><strong>Area Code</strong></th>
                                                <th><strong>Action</strong></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>01</strong></td>
                                                <td>Abdullah alSalim suburb</td>
                                                <td>1</td>
                                                <td>
                                                 <button type="button" class="btn  btn-square btn-danger"><i class="la la-trash"></i> Delete
												 </button>
											    </td>
                                            </tr>

                                            <tr>
                                                <td><strong>02</strong></td>
                                                <td>Bayan</td>
                                                <td>2</td>
                                                <td>
                                                 <button type="button" class="btn  btn-square btn-danger"><i class="la la-trash"></i> Delete
												 </button>
											    </td>
                                            </tr>
										
										
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



                                    <!----form--->

                                    <form method="" action="" class="form">
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-body">
										
										<div class="row">
											<div class="col-xl-12">
												<h3>Create subscription day combination</h3>
												</div><!---col-xl-12-->
												<div class="col-md-5 col-xl-5 col-xxl-5  mt-3 mb-3">
													<label>Create subscription day combination</label>
													 <div class="form-group">
                                            <label></label>
                                            <select class="form-control default-select form-control-lg" id="">
                                                <option>Once a Week</option>
                                                <option>Twice a Week</option>
                                                <option>Three time a Week</option>
                                                
                                            </select>
                                        </div>
												</div>


<div class="col-xl-12 mt-4 mb-4">

<div class="control-group">  
  <div class="controls">  
     <div class="entry mb-2"> 


<div class="row">

	<div class="col-xl-4 mt-4 mb-4">
<div class="form-group">
<label>Day One</label>
<select class="form-control" id="">
<option value="Monday">Monday</option>
<option value="Tuesday">Tuesday</option>
<option value="Wednesday">Wednesday</option>
<option value="Thursday">Thursday</option>
<option value="Friday">Friday</option>
<option value="Saturday">Saturday</option>
<option value="SundaySunday">Sunday</option>
</select>
</div>
</div> 	


<div class="col-xl-4 mt-4 mb-4">
<div class="form-group">
<label>Day Two</label>
<select class="form-control" id="">
<option value="Monday">Monday</option>
<option value="Tuesday">Tuesday</option>
<option value="Wednesday">Wednesday</option>
<option value="Thursday">Thursday</option>
<option value="Friday">Friday</option>
<option value="Saturday">Saturday</option>
<option value="SundaySunday">Sunday</option>
</select>
</div>
</div> 


<div class="col-xl-4 mt-4 mb-4">
	<div class="form-group mt-4">
    <label>&nbsp;</label>

	  <button class="btn btn-success btn-add mt-2" type="button">  

        <i class="fa fa-plus"> </i>  

      </button>  
</div>

</div> 
</div>
</div>


</div><!---row---->
</div>
</div>



                                                 
                                              
											
												<div class="col-xl-12 mt-4 mb-4">
													<h3>Subscription List</h3>
													</div><!---col-xl-12-->
													<div class="col-xl-12 mt-4 mb-4">

														<div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th class="width80"><strong>Sr.No.</strong></th>
                                                <th><strong>Day Combination</strong></th>
                                                
                                                <th><strong>Action</strong></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>01</strong></td>
                                                <td>Su. Mon.</td>
                                               
                                                <td>
                                                 <button type="button" class="btn  btn-square btn-danger"><i class="la la-trash"></i> Delete
												 </button>
											    </td>
                                            </tr>

                                            <tr>
                                                <td><strong>02</strong></td>
                                                <td>Fri. Wed</td>
                                                
                                                <td>
                                                 <button type="button" class="btn  btn-square btn-danger"><i class="la la-trash"></i> Delete
												 </button>
											    </td>
                                            </tr>
										
										
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


								</div>
							</div>
							<!--**********************************
							Content body end
							***********************************-->
							<!--**********************************
							Footer and Js include
							***********************************-->
							
							<?php include'include/footer.php' ;?>
							<!--**********************************
							Footer and Js include
							***********************************-->

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




						</body>

					</html>