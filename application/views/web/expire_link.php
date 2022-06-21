<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	<title>Expire </title>

	<style type="text/css">
          .rs{
          	position: relative;
          }

          .custom-btn{
          	
          }

          .custom-btn {
    background: #d7c9a3;
    padding: 15px 45px;
    border-radius: 25px;
    text-decoration: none;
    color: #fff;
}

.custom-btn:hover {
    background: #000;
    padding: 15px 45px;
    border-radius: 25px;
    text-decoration: none;
    color: #d7c9a3;

}

.rs {
    background-position: center center;
    background-image: url(<?php echo base_url();?>assets/images/expired.jpg);
    background-repeat: no-repeat;
    min-height: 450px;
    background-size: contain;
}
.pos {
    padding-top: 400px;
}
	</style>
</head>
<body>
	 <section>
   <div class="row mx-0">
   	<div class="col-8 text-center mx-auto rs">
	<!-- <img class="w-75 img-fluid" src="<?php echo base_url();?>assets/admin_assets/images/404.gif"> -->
	<!-- <img class="w-75 img-fluid" src="<?php echo base_url();?>assets/admin_assets/images/404-imgs.gif"> -->
    
    <div class="pos">
	<h4>OOPS! your link is expire!</h4><br>
	 <a class="custom-btn" href="<?php echo base_url();?>" class="btn btn-primary">Go to Home</a>
	</div>
</div>
	
</section>
</div>
</body>
</html>