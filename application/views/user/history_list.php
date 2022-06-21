  <!--//main-row--->
  <div id="results">
  <?php if(!empty($get_trans)){ ?>

  <?php if(is_array($get_trans)): ?>

  <?php 
  $i = 1;
  foreach($get_trans as $transaction ){ 

  $job_id             = $transaction['job_id'];
  $is_done            = $transaction['is_done'];
  $user_id            = $transaction['user_id'];
  $order_id           = $transaction['order_id'];
  $notification_mail  = $transaction['notification_mail'];
  $package            = $transaction['package'];

  //get schedul job data 
  $getjobdata = $this->Model->getData('job_scheduler',array('scheduler_id'=>$job_id));
  $emp_id = $getjobdata->emp_id;

  //get employee data 
  $getudata = $this->Model->getData('cleanner',array('emp_id'=>$emp_id));
  $fullname = $getudata->fullname;

  //get user data 
  $getudata = $this->Model->getData('users',array('user_id'=>$user_id));
  $uname  = $getudata->fullname;
  $uemail = $getudata->email;

  //expiry date of plan
  $get_exp = "SELECT * FROM `job_avalability` WHERE job_id='$job_id' AND order_id='$order_id' AND status='1' ORDER BY id DESC LIMIT 1";
  $expget  = $this->Model->getSqlData($get_exp);
  //print_r($expget);
  foreach($expget as $vals){                 
  $book_date    = $vals['book_date'];
  $datebefore   = date('Y-m-d', strtotime('-7 days', strtotime($book_date))); 
  $cdate  = date('Y-m-d');
  if($cdate > $datebefore){

  if($notification_mail == '0' && $package !='0'){
  //mail function 
  require_once APPPATH.'third_party/sendgrid/sendgrid-php.php';
  $email = new \SendGrid\Mail\Mail();
  $email->setfrom("info@housekeeperskw.com", "Housekeeping");
  $email->setSubject("Upgrade Your Subscription Plan");
  $email->addTo($uemail , $uname);
  $mailtemp['name'] = $uname;
  $urls_for_renewal = 'https://sharukh.dbtechserver.online/housekeeper/home/direct_book/'.$job_id;
  $dta = array('package'=>$package,'expire_date'=>$book_date,'renew'=>$urls_for_renewal);
  $mailtemp['expire_data'] = $dta;

  $content = $this->load->view('mail/notification',$mailtemp,true);
  $email->addContent("text/html",$content);
  
  $sercre_key = $this->config->item("Sandgrid_keys");

  $sendgrid = new \SendGrid(($sercre_key));

  $response = $sendgrid->send($email);
  //end mail 

  $statuschng  = array( 
  'notification_mail' => 1
  );  

  $this->Model->updateData('transaction', $statuschng,array('order_id'=>$order_id));


  }
  }
  ?>



  <div class="row my-1 px-0 mx-0 align-items-center d-flex bg-white mb-1 bdr-hadow results">

  <div class="col-11 px-1">

  <div class="row">

  <div class="col-12">
  <p class="font-18 px-0 mb-0 custom-heading-clr"><strong><?php echo ucwords($fullname);?></strong></p>
  </div>

  <div class="col-3">
  <span class="nam"><strong class="custom-heading-clr">Order Date</strong> <br><?php echo $transaction['timestamp'];?></span>
  </div>	

  <div class="col-3">
  <span class="nam"><strong class="custom-heading-clr">Package</strong><br> <?php if($transaction['package'] =='0'){ echo "At A Time"; } else if($transaction['package'] =='1'){ echo "Once A Week"; } else if($transaction['package'] =='2'){ echo "Twice A Week"; } else if($transaction['package'] =='3'){ echo "Thrice A Week"; }?></span>
  </div>

  <div class="col-3">
  <span class="nam"><strong class="custom-heading-clr">Amount</strong><br> <?php echo $transaction['price'];?> KD</span>
  </div>

  <div class="col-3">
  <span class="nam"><strong class="custom-heading-clr">Status</strong><br> <?php if($is_done=='1'){ echo '<i class="badge badge-info">Active</i>';}else if($is_done=='2'){echo '<i class="badge badge-warning">Cancelled</i>';} ?></span>
  </div>

  <div class="col-12">
  <span class="nam"><strong class="custom-heading-clr">Order id</strong>  <?php echo $transaction['order_id'];?></span>
  </div>

  <div class="col-12">
  <span class="nam"><strong class="custom-heading-clr">Expiry Date</strong>  <span class="text-danger"><?php echo $book_date; ?></span></span>
  </div>



  </div>	<!--inner row--->



  </div>	<!----// col-10---->

  <div class="col-1">

  <a href="<?php echo base_url();?>user/cleaner_profile/<?php echo $emp_id;?>"><span class="flaticon-view"></span></a>

  </div>		




  </div><!--//main-row--->

  <?php $i++; }} ?>
  <?php endif; ?>

  <?php 
    
    }else{

    echo '<div class="col-12 mx-auto">
          <center>
           <img class="img-fluid w-25" src="https://sharukh.dbtechserver.online/housekeeper/assets/images/no-data.png">
          <h2 class="text-capitalize">Oops! no data found please search again...</h2>
          </center>
          </div>';

   }
  ?>


  </div>
  <!-- result -->
