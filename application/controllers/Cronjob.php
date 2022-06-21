<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Cronjob extends CI_Controller {

public function __construct() 
{
    parent::__construct(); 
      
    date_default_timezone_set('Asia/Kolkata');
    $this->load->database();
    $this->load->model('Model');
    $this->load->library(array('form_validation','session'));
    $this->load->helper(array('form','url'));
}

public function cronjob_email()
{  


$transaction = "SELECT * FROM `transaction` WHERE status='1' ORDER BY id DESC";

$get_trans   = $this->Model->getSqlData($transaction);

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
  $get_exp = "SELECT * FROM `job_avalability` WHERE job_id='$job_id' AND order_id='$order_id' ORDER BY id DESC LIMIT 1";


  $expget  = $this->Model->getSqlData($get_exp);

  //print_r($expget);

  foreach($expget as $vals){    

  $book_date    = $vals['book_date'];
  $datebefore   = date('Y-m-d', strtotime('-7 days', strtotime($book_date))); 
  $cdate        = date('Y-m-d');

  if($cdate > $datebefore){

  if($notification_mail == '0' && $package !='0'){
  //mail function 
  require_once APPPATH.'third_party/sendgrid/sendgrid-php.php';
  $email = new \SendGrid\Mail\Mail();
  $email->setfrom("info@housekeeperskw.com", "Housekeeping");
  $email->setSubject("Upgrade Your Subscription Plan");
  $email->addTo($uemail , $uname);
  $mailtemp['name'] = $uname;
  //$urls_for_renewal = 'https://sharukh.dbtechserver.online/housekeeper/home/direct_book/'.$job_id;
  $urls_for_renewal = 'https://sharukh.dbtechserver.online/housekeeper/home/cansel_book/'.$job_id;
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
  }else
  {
    echo "plan is not expire";
  }



  }
}

}


function donejob_active()
{
//when at a time plan is done after that related data is active and also at a time service is active for admin and user.

$cdate       = date('Y-m-d');
$transaction = "SELECT * FROM `transaction` WHERE status='1' ORDER BY id DESC";
$get_trans   = $this->Model->getSqlData($transaction);

  foreach($get_trans as $transaction ){ 

  $job_id             = $transaction['job_id'];
  $is_done            = $transaction['is_done'];
  $user_id            = $transaction['user_id'];
  $order_id           = $transaction['order_id'];
  $package            = $transaction['package'];
  $plan_start         = $transaction['plan_start'];
  $day_name           = date('l', strtotime($plan_start));

  //get scheduler data from schid
  $emp_data    = $this->Model->getData('job_scheduler',array('scheduler_id' => $job_id));
  $emp_id      =  $emp_data->emp_id;
  $shift       =  $emp_data->shift;
  $price       =  $emp_data->price;
  
   if($package =='0' && $cdate > $plan_start){


  //get check day exist or not in same days
  $getchek_related_job = "SELECT * FROM `job_scheduler` WHERE FIND_IN_SET('$day_name',day_name) AND emp_id ='$emp_id' AND shift='$shift'";

  $chkschedule         = $this->Model->getSqlData($getchek_related_job);
  
  foreach($chkschedule as $related_jobs ){
  
    $rel_empid    = $related_jobs['emp_id'] ;
    $rel_sch_id   = $related_jobs['scheduler_id'] ;

     //related jobs are active when user booking day is done.
    $rel_status =  array('status'=>1);

    $this->Model->updateData('job_scheduler',$rel_status,array('scheduler_id'=>$rel_sch_id));

    } 

    $status_main =  array('status'=>1);
    $this->Model->updateData('job_scheduler',$status_main,array('scheduler_id'=>$job_id));   


   }

 }

  
}


function add_auto_renewal()
{
// When plan is expire then data is automatically inserted for next month.

$transaction = "SELECT * FROM `transaction` WHERE status='1' ORDER BY id DESC";
//get data from order job data

$get_trans   = $this->Model->getSqlData($transaction);

  foreach($get_trans as $transaction ){ 

  $job_id             = $transaction['job_id'];
  $is_done            = $transaction['is_done'];
  $user_id            = $transaction['user_id'];
  $order_id           = $transaction['order_id'];
  $notification_mail  = $transaction['notification_mail'];
  $package            = $transaction['package'];
  
  //when all plan is subscription based.
  if($package !='0'){

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
  $get_exp = "SELECT * FROM `job_avalability` WHERE job_id='$job_id' AND order_id='$order_id' ORDER BY id DESC LIMIT 1";

  $expget  = $this->Model->getSqlData($get_exp);

  foreach($expget as $vals){    

  $book_date    = $vals['book_date'];
  $datebefore   = date('Y-m-d', strtotime('-2 days', strtotime($book_date))); 
  $cdate        = date('Y-m-d');

  if($cdate > $datebefore){
  
  // when current date is grater than book date - 2 day then add next month data

  $schedule_id = $job_id;
  $start_date  = $cdate;
  $day_name    = date('l', strtotime($start_date));
  
  $uid         = $user_id;
  $order_id    = uniqid();

  //get scheduler data from schid
  $emp_data    =  $this->Model->getData('job_scheduler',array('scheduler_id' => $schedule_id));
  $emp_id      =  $emp_data->emp_id;
  $package     =  $emp_data->plan_type;
  $shift       =  $emp_data->shift;
  $price       =  $emp_data->price;
  $area_code   =  $emp_data->area_uniq;
  $get_day_pre =  $emp_data->day;
  
  if($package == '1'){ 
  //start subscription data
  
  $week0      = $start_date;
  $week_name0 = $day_name;

   //get day for twice 
  $day_data = $this->Model->getData('subscription_day',array('sub_id' => $get_day_pre));

  $daysin_str  =  $day_data->day;
  
  if($week_name0 == $daysin_str){

  $week1      = $week0;
  $week_name1 = $week_name0;

  }else{


  //check alternate date and days
  for ($a = 1; $a < 8; $a++) {
    
    //get date
    $get_exact_date = date('Y-m-d', strtotime($week0. ' + '.$a.' days'));

    $get_exact_days = date('l', strtotime($get_exact_date));
          
        if ($daysin_str == $get_exact_days) {
          
           break;

          }
      }//loop close


  $week1      = $get_exact_date;
  $week_name1 = $get_exact_days;

  }


  $week2      = date('Y-m-d', strtotime($week1. ' + 7 days'));
  $week_name2 = date('l', strtotime($week2));
  
  $week3      = date('Y-m-d', strtotime($week2. ' + 7 days'));
  $week_name3 = date('l', strtotime($week3));
  
  $week4      = date('Y-m-d', strtotime($week3. ' + 7 days'));
  $week_name4 = date('l', strtotime($week4));
  
  $uniqid  = uniqid();
  


$week_date  = array($week1,$week2,$week3,$week4);
$week_days  = array($week_name1,$week_name2,$week_name3,$week_name4);


// now add multi row daata for monthly subscription
 for ($i=0; $i <4; $i++) {
  
   $datamulti = array(
          'timestamp'  => $timestamp ,
          'job_id'     => $schedule_id ,
          'plan_type'  => $package ,
          'order_id'   => $order_id ,
          'user_id'    => $uid ,
          'emp_id'     => $emp_id ,
          'book_date'  => $week_date[$i] ,
          'day'        => $week_days[$i] ,
          'status'     => 1, //after payment success status update
          'job_shift'  => $shift,
          'uniqid'     => $uniqid

          );

   $this->Model->insertData('job_avalability',$datamulti);
   
   }

  


  }else if($package == '2'){ 
  
  //start subscription data for twice day

  $day_data = $this->Model->getData('subscription_day',array('sub_id' => $get_day_pre));
  //get day for twice 

  $daysin_str  =  $day_data->day;
  $get_twice   = explode (",", $daysin_str); 
  
  $get_twice1  = $get_twice[0];
  $get_twice2  = $get_twice[1];

  $week1      = $start_date;
  $week_name1 = $day_name;
  $uniqid     = uniqid();

  if($week_name1 == $get_twice1 || $week_name1 == $get_twice2){
    
    $firstday_date1 = $week1;
    $firstday_day1  = $week_name1;
    
   
  }else{

  //check alternate date and days
  for ($a = 1; $a < 8; $a++) {
    
    //get date
    
    $get_exact_date = date('Y-m-d', strtotime($week1. ' + '.$a.' days'));

    $get_exact_days = date('l', strtotime($get_exact_date));
          
        if ($get_twice1 == $get_exact_days || $get_twice2 == $get_exact_days) {
          
           break;

          }
      }//loop close

      $firstday_date1 = $get_exact_date;
      $firstday_day1  = $get_exact_days;

  }


  
  if($firstday_day1 == $get_twice1){
  

    for ($x = 1; $x < 8; $x++) {
    
    //get twice day and date
    //$get_twic_dayndate = date('Y-m-d', strtotime($week1. '+'. $x. 'days'));
    $get_twic_dayndate = date('Y-m-d', strtotime($firstday_date1. ' + '.$x.' days'));

    $get_twic_days = date('l', strtotime($get_twic_dayndate));
          
        if ($get_twice2 == $get_twic_days) {
          
           break;

          }
      }//loop close

    }//end if
    else{
   

        for ($x = 1; $x < 8; $x++) {
    
            //get twice day and date
            //$get_twic_dayndate = date('Y-m-d', strtotime($week1. '+'. $x. 'days'));
            $get_twic_dayndate = date('Y-m-d', strtotime($firstday_date1. ' + '.$x.' days'));

            $get_twic_days = date('l', strtotime($get_twic_dayndate));
                  
                if ($get_twice1 == $get_twic_days) {
                  
                   break;

                  }
              }//loop close

        
        }

   
   
   $second_day_date1 = $get_twic_dayndate;
   $second_day_week1 = $get_twic_days;
  
   //second week data
  $firstday_date2 = date('Y-m-d', strtotime($firstday_date1. '+ 7 days'));
  $firstday_day2  = date('l', strtotime($firstday_date2));
  
  $second_day_date2 = date('Y-m-d', strtotime($second_day_date1. '+ 7 days'));
  $second_day_week2 = date('l', strtotime($second_day_date2));


  //third week data
  $firstday_date3 = date('Y-m-d', strtotime($firstday_date2. '+ 7 days'));
  $firstday_day3  = date('l', strtotime($firstday_date3));
  
  $second_day_date3 = date('Y-m-d', strtotime($second_day_date2. '+ 7 days'));
  $second_day_week3 = date('l', strtotime($second_day_date3));


  //four week data
  $firstday_date4 = date('Y-m-d', strtotime($firstday_date3. '+ 7 days'));
  $firstday_day4  = date('l', strtotime($firstday_date4));
  
  $second_day_date4  = date('Y-m-d', strtotime($second_day_date3. '+ 7 days'));
  $second_day_week4  = date('l', strtotime($second_day_date4));

   //insert data one day array data for looping
  $for_onedate =  array($firstday_date1,$firstday_date2,$firstday_date3,$firstday_date4,$second_day_date1,$second_day_date2,$second_day_date3,$second_day_date4);
  
  $for_oneday  = array($firstday_day1,$firstday_day2,$firstday_day3,$firstday_day4,$second_day_week1,$second_day_week2,$second_day_week3,$second_day_week4);

  for ($i=0; $i <8; $i++) {
    
  $data_ad_day1 = array(
         
                  'timestamp'  => $timestamp ,
                  'plan_type'  => $package ,
                  'job_id'     => $schedule_id ,
                  'order_id'   => $order_id ,
                  'user_id'    => $uid ,
                  'emp_id'     => $emp_id ,
                  'book_date'  => $for_onedate[$i] ,
                  'day'        => $for_oneday[$i] ,
                  'status'     => 1, 
                  'job_shift'  => $shift,
                  'uniqid'     => $uniqid

                  );

    $this->Model->insertData('job_avalability',$data_ad_day1);

    } 
  
  
  }else if($package == '3'){ 
  
  //start subscription data for thrice day

  $day_data = $this->Model->getData('subscription_day',array('sub_id' => $get_day_pre));
  //get day for twice 

  $daysin_str  =  $day_data->day;
  $get_twice   = explode (",", $daysin_str); 
  $get_twice1  = $get_twice[0];
  $get_twice2  = $get_twice[1];
  $get_twice3  = $get_twice[2];

  $week1      = $start_date;
  $week_name1 = $day_name;
  $uniqid     = uniqid();

  if($week_name1 == $get_twice1 || $week_name1 == $get_twice2 || $week_name1 == $get_twice3){

   $firstday_date1 = $week1;
   $firstday_day1  = $week_name1;


  }else{

    for ($a = 1; $a < 8; $a++) {
    //get date
    $get_exact_date = date('Y-m-d', strtotime($week1. ' + '.$a.' days'));

    $get_exact_days = date('l', strtotime($get_exact_date));
          
        if ($get_twice1 == $get_exact_days || $get_twice2 == $get_exact_days || $get_twice3 == $get_exact_days) {
          
           break;

          }
      }//loop close

      $firstday_date1 = $get_exact_date;
      $firstday_day1  = $get_exact_days;



  }


  //get tiwce and thrice date and day
  
  if($firstday_day1 == $get_twice1){
  

    for ($x = 1; $x < 8; $x++) {
    
    //get twice day and date
    
    $get_twic_dayndate = date('Y-m-d', strtotime($firstday_date1. ' + '.$x.' days'));

    $get_twic_days = date('l', strtotime($get_twic_dayndate));
          
        if ($get_twice2 == $get_twic_days) {
          
           break;
          
          }

      }//loop close

      for ($k = 1; $k < 8; $k++) {
           
           $thirce_date = date('Y-m-d', strtotime($get_twic_dayndate. ' + '.$k.' days'));

           $thirce_days = date('l', strtotime($thirce_date));
            
            if ($get_twice3 == $thirce_days) {
          
                break;
             }

           }
    //end if
    }else if($firstday_day1 == $get_twice2){
    
     for ($x = 1; $x < 8; $x++) {
    
    //get twice day and date
    
    $get_twic_dayndate = date('Y-m-d', strtotime($firstday_date1. ' + '.$x.' days'));

    $get_twic_days = date('l', strtotime($get_twic_dayndate));
          
        if ($get_twice3 == $get_twic_days) {
          
           break;
          
          }

      }//loop close

      for ($k = 1; $k < 8; $k++) {
           
           $thirce_date = date('Y-m-d', strtotime($get_twic_dayndate. ' + '.$k.' days'));

           $thirce_days = date('l', strtotime($thirce_date));
            
            if ($get_twice1 == $thirce_days) {
          
                break;
             }

           }
    //end else if

    }else if($firstday_day1 == $get_twice3){

         for ($x = 1; $x < 8; $x++) {
    
    //get twice day and date
    
    $get_twic_dayndate = date('Y-m-d', strtotime($firstday_date1. ' + '.$x.' days'));

    $get_twic_days = date('l', strtotime($get_twic_dayndate));
          
        if ($get_twice1 == $get_twic_days) {
          
           break;
          
          }

      }//loop close

      for ($k = 1; $k < 8; $k++) {
           
           $thirce_date = date('Y-m-d', strtotime($get_twic_dayndate. ' + '.$k.' days'));

           $thirce_days = date('l', strtotime($thirce_date));
            
            if ($get_twice2 == $thirce_days) {
          
                break;
             }

           }
    //end if

    }

   
   $second_day_date1 = $get_twic_dayndate;
   $second_day_week1 = $get_twic_days;

   $thrice_date1 = $thirce_date;
   $thrice_days1 = $thirce_days;
  
   //second week data
  $firstday_date2 = date('Y-m-d', strtotime($firstday_date1. '+ 7 days'));
  $firstday_day2  = date('l', strtotime($firstday_date2));
  
  $second_day_date2 = date('Y-m-d', strtotime($second_day_date1. '+ 7 days'));
  $second_day_week2 = date('l', strtotime($second_day_date2));
  
  $thrice_date2 = date('Y-m-d', strtotime($thrice_date1. '+ 7 days'));
  $thrice_days2 = date('l', strtotime($thrice_date2));

  //third week data
  $firstday_date3 = date('Y-m-d', strtotime($firstday_date2. '+ 7 days'));
  $firstday_day3  = date('l', strtotime($firstday_date3));
  
  $second_day_date3 = date('Y-m-d', strtotime($second_day_date2. '+ 7 days'));
  $second_day_week3 = date('l', strtotime($second_day_date3));

  $thrice_date3 = date('Y-m-d', strtotime($thrice_date2. '+ 7 days'));
  $thrice_days3 = date('l', strtotime($thrice_date3));


  //four week data
  $firstday_date4 = date('Y-m-d', strtotime($firstday_date3. '+ 7 days'));
  $firstday_day4  = date('l', strtotime($firstday_date4));
  
  $second_day_date4  = date('Y-m-d', strtotime($second_day_date3. '+ 7 days'));
  $second_day_week4  = date('l', strtotime($second_day_date4));

  $thrice_date4 = date('Y-m-d', strtotime($thrice_date3. '+ 7 days'));
  $thrice_days4 = date('l', strtotime($thrice_date4));



   //insert data one day array data for looping
  $for_onedate =  array($firstday_date1,$firstday_date2,$firstday_date3,$firstday_date4,$second_day_date1,$second_day_date2,$second_day_date3,$second_day_date4,$thrice_date1,$thrice_date2,$thrice_date3,$thrice_date4);
  
  $for_oneday  = array($firstday_day1,$firstday_day2,$firstday_day3,$firstday_day4,$second_day_week1,$second_day_week2,$second_day_week3,$second_day_week4,$thrice_days1,$thrice_days2,$thrice_days3,$thrice_days4);

  for ($i=0; $i <12; $i++) {
    
  $data_thrice = array(
         
                  'timestamp'  => $timestamp ,
                  'plan_type'  => $package ,
                  'job_id'     => $schedule_id ,
                  'order_id'   => $order_id ,
                  'user_id'    => $uid ,
                  'emp_id'     => $emp_id ,
                  'book_date'  => $for_onedate[$i] ,
                  'day'        => $for_oneday[$i] ,
                  'status'     => 1, 
                  'job_shift'  => $shift,
                  'uniqid'     => $uniqid

                  );

    $this->Model->insertData('job_avalability',$data_thrice);

    }

   
  }//end thrice

  $data = array(
          'timestamp'  => $timestamp ,
          'package'    => $package ,
          'shift'      => $shift ,
          'area'       => $area_code ,
          'user_id'    => $uid ,
          'order_id'   => $order_id ,
          'job_id'     => $schedule_id ,
          'plan_start' => $start_date ,
          'status'     => 1 
          );
  
  
  $this->Model->insertData('transaction',$data);
  
  
      } 
     }
    }
   }
}


function test_cron()
{
  

 $data = array( 

        'timestamp' => date('Y-m-d H:i:s'),
 
        'title'     => "title for test",

        'descp'     => "demo data"


        );  



  $this->Model->insertData('faq', $data);

  echo "success add";

}



//end of file
}