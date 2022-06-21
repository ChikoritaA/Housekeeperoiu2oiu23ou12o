<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
public function __construct() 
{
    parent::__construct(); 
    date_default_timezone_set('Asia/Kolkata');
    $this->load->database();
    $this->load->model('Model');
    $this->load->library(array('form_validation','session'));
    $this->load->helper(array('form','url'));
    
    //set 15min session destroyed
    
        if(!empty($this->session->userdata('user_id'))){
        
        $last_user_activity    = $this->session->userdata('last_user_activity');
        $current_user_activity = date('Y-m-d H:i:s');
        
        $timestamp1 = strtotime($last_user_activity);
        $timestamp2 = strtotime($current_user_activity);
        
        $get_hrs     = abs($timestamp2 - $timestamp1)/(60*60);
        
        $fifteen_min = $get_hrs * 60 ;
        
        if($fifteen_min >= 15){
        
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('last_user_activity');
        
        $this->session->unset_userdata('address');
        $this->session->unset_userdata('fulladdress');
        $this->session->unset_userdata('addrs_id');
        $this->session->unset_userdata('area_code');
        
        redirect('home/user_login');
        //redirect to login page
        
        } 
        
        }
        //end function
    
    
}
public function index()
{  
//check if loged in
$this->check_login(); 
$uid = $this->session->userdata('user_id'); 
$data['upcoming_job'] = $this->Model->CountWhereRecord('job_avalability',array('user_id'=>$uid,'status'=>1,'is_done'=>0));
$data['complete_job']  = $this->Model->CountWhereRecord('job_avalability',array('user_id'=>$uid,'status'=>1,'is_done'=>1));
$data['allbooking']   = $this->Model->CountWhereRecord('job_avalability',array('user_id'=>$uid,'status'=>1));
$this->load->view('user/dashboard',$data);
}
function user_signup()
{
$this->form_validation->set_rules('fullname', 'Fullname', 'required');
$this->form_validation->set_rules('email', 'Email id', 'required|valid_email|is_unique[users.email]');
$this->form_validation->set_rules('phone', 'Mobile number ', 'required'); 
$this->form_validation->set_rules('password', 'Password', 'required|max_length[25]|min_length[6]'); 
$this->form_validation->set_rules('cpassword', 'Confirm password', 'required|matches[password]|max_length[25]|min_length[6]');
$this->form_validation->set_rules('address', 'Address', 'required');
$this->form_validation->set_rules('fulladdress', 'Full address', 'required');
$this->form_validation->set_rules('agree', 'T&C', 'required');
if ($this->form_validation->run() != FALSE){
 //here is input variables
 $fullname  = $this->input->post('fullname');
 $email_id  = $this->input->post('email');
 $password  = $this->input->post('password');
 $phone     = $this->input->post('phone');
 $address   = $this->input->post('address');
 $fulladdress = $this->input->post('fulladdress');
 $uniq_id   = uniqid();
 $add       = explode("," , $address);
 $add_uniq  = $add[0];
 $add_name  = $add[1];
$if_exists = $this->Model->CountWhereRecord('users',array('email'=>$email_id));
if($if_exists > 0){
   
 $this->session->set_flashdata('signup_err','Email is already exists');
 redirect('user/user_signup');
 }else{
     
    $data = array( 
        'timestamp'   => date('Y-m-d H:i:s'),
        'user_id'     => $uniq_id,
        'fullname'    => $fullname,
        'email'       => $email_id,
        'password'    => md5($password),
        'phone'       => $phone,
        'address'     => $add_name,
        'fulladdress' => $fulladdress,
        'addrs_id'    => $add_uniq 
        );  
   
   $dns = array('address'=>$fulladdress,'chk_uniqid_fromarea'=>$add_uniq,'chk_name_fromarea'=>$add_uniq,'chk_type'=>'Home','uid'=>$uniq_id);
   $this->Model->insertData('user_addrs', $dns);
   $this->Model->insertData('users', $data);
  //here is mail to user for confirmation
  
  //mail function 
  require_once APPPATH.'third_party/sendgrid/sendgrid-php.php';
  $email = new \SendGrid\Mail\Mail();
  $email->setfrom("info@housekeeperskw.com", "Housekeeping");
  $email->setSubject("User Signup");
  $email->addTo($email_id , $fullname);
  
  $mailtemp['name'] = $fullname;
  $mailtemp['link'] = base_url().'user/verify_user_account/'.$uniq_id;
  
  $content = $this->load->view('mail/user_reg_mail',$mailtemp,true);
  $email->addContent("text/html",$content);

  $sercre_key = $this->config->item("Sandgrid_keys");

  $sendgrid = new \SendGrid(($sercre_key));


  $response = $sendgrid->send($email);
  //end mail 
  $this->session->set_flashdata('signup_succ','You have successfully signed up, Please verify your account by mail!');
  redirect('user/user_signup');
   
}
}else{ 
       
       $this->load->view('web/signup');
    }  
}
function verify_user_account()
{
$user_id = $this->uri->segment(3);
$status = array('status' => 1);  
$this->Model->updateData('users', $status,array('user_id'=>$user_id));
$this->session->set_flashdata('signup_succ','Your account is successfully verified, Please login here!');
redirect('home/user_login');
}
function user_login()
{
//check method
if($this->input->method() === 'post')
{
$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
$this->form_validation->set_rules('password', 'Password', 'required|max_length[30]|min_length[6]');
if ($this->form_validation->run() != FALSE){
 $email    = $this->input->post('email');
 $password = md5($this->input->post('password'));
 $md5pass  = $this->input->post('password');
 $remember = $this->input->post('remember');
 $chklogin = $this->Model->CountWhereRecord('users',array('email'=>$email,'password'=>$password));
if($chklogin > 0){
//check account is block or not 
 $chk_block = $this->Model->CountWhereRecord('users',array('email'=>$email,'password'=>$password,'status'=>1));
$emp_id     = $this->session->userdata('emp_id');
$admin_id   = $this->session->userdata('admin_id');
 
// if(empty($emp_id) && (empty($admin_id))){
if($chk_block > 0){
$users = $this->Model->getData('users',array('email' => $email,'password'=>$password));
$uemail    = $users->email;
$upassword = $md5pass;
$chec_token = $this->session->userdata('checkout_token');
$search_id  = $this->session->userdata('search_id');
// here is check out token for login
//get area code
$addrs_id = $users->addrs_id;
$getarea  = $this->Model->getData('area_code_list',array('area_uniqid' => $addrs_id));
$area_code= $getarea->area_code;
$sess_array = array(
'user_name'         => $users->fullname,
'user_email'        => $users->email,
'user_id'           => $users->user_id,
'address'           => $users->address,
'fulladdress'       => $users->fulladdress,
'addrs_id'          => $addrs_id,
'area_code'         => $area_code,
'last_user_activity'=> date('Y-m-d H:i:s')
);
$this->session->set_userdata($sess_array);
if($remember == 'remember'){
setcookie('user_email', $uemail, time()+(86400 * 7), '/');
setcookie('upassword', $md5pass, time()+(86400 * 7), '/');
$this->session->set_userdata('remember_me', $remember);
//work in hooks
}else{
  //keep me login data destroyed
setcookie('user_email', '', time()-(86400 * 7), '/');
setcookie('upassword', '', time()-(86400 * 7), '/');
$this->session->unset_userdata('remember_me');
}
if(empty($chec_token)){
redirect('user/my_booking');
}else{
//when user do checkout successfully then session will expire for checkout token
//redirect('user/checkout');
redirect('home/service_details/'.$chec_token.'/'.$search_id);
}
}else{
$this->session->set_flashdata('login_err','Your account is blocked,please contact to admin!');
redirect('user/user_login');
}
//close multi session 
// }else{
// $this->session->set_flashdata('login_err','You can not do more than one login in the same browser!');
// redirect('user/user_login');
// }
}else{
$this->session->set_flashdata('login_err','Your email or password does not match!');
redirect('user/user_login');
}
}else{
  
     $this->load->view('web/login');
     
     } 
}else{
$this->load->view('web/login');
} //end method
}
function user_logout()
{
//check if loged in
$this->check_login(); 
$this->session->unset_userdata('user_name');
$this->session->unset_userdata('user_email');
$this->session->unset_userdata('user_id');
$this->session->unset_userdata('last_user_activity');
$this->session->unset_userdata('address');
$this->session->unset_userdata('fulladdress');
$this->session->unset_userdata('addrs_id');
$this->session->unset_userdata('area_code');
if($this->session->userdata('remember_me') !='')
{
   
// setcookie('user_email', '', time()-(86400 * 7), '/');
// setcookie('upassword', '', time()-(86400 * 7), '/');
    
// $this->session->unset_userdata('remember_me');
  
}
//$this->session->sess_destroy();
redirect('home/user_login');
} 
function check_login()
{
   if($this->session->userdata('user_email') =='')
   {
   redirect('home/user_login');
   }
}
function my_booking()
{  
//check if loged in
$this->check_login(); 
$this->load->view('user/my-booking');
}
function list_booking()
{
//check if loged in
$this->check_login(); 
$uid = $this->session->userdata('user_id'); 
$query = $this->input->post('query');
if(empty($query)){
$job_book  = "SELECT * FROM `job_avalability` WHERE user_id='$uid' AND status='1' ORDER BY book_date ASC";
$data['booking'] = $this->Model->getSqlData($job_book);
$this->load->view('user/book_list',$data);
}else{
$find_name    = "SELECT * FROM cleanner WHERE fullname LIKE '%$query%' AND status='1'";
$findn        =  $this->Model->getSqlData($find_name);
foreach ($findn as $vname) {
$emp_id = $vname['emp_id'];
if(!empty($emp_id)){
$job_book  = "SELECT * FROM `job_avalability` WHERE user_id='$uid' AND emp_id='$emp_id' AND status='1' ORDER BY book_date ASC";
$data['booking'] = $this->Model->getSqlData($job_book);
}else{
  $data['booking'] = '';
}
}
@$this->load->view('user/book_list',$data);
}
}
function transactions()
{  
//check if loged in
$this->check_login(); 
$this->load->view('user/history');
}
function list_history()
{
//check if loged in
$this->check_login();
$uid   = $this->session->userdata('user_id'); 
$query = $this->input->post('query');
if(empty($query)){
$transaction       = "SELECT * FROM `transaction` WHERE user_id='$uid' AND status='1' ORDER BY id DESC";
$data['get_trans'] = $this->Model->getSqlData($transaction);
$this->load->view('user/history_list',$data);
}else{
$find_name    = "SELECT * FROM cleanner WHERE fullname LIKE '%$query%' AND status='1'";
$findn        =  $this->Model->getSqlData($find_name);
if(!empty($findn)){
foreach($findn as $vname) {
$emp_id = $vname['emp_id'];
$ifchk  = $this->Model->CountWhereRecord('job_avalability',array('user_id'=>$uid,'emp_id'=>$emp_id,'status'=>1));
if($ifchk > 0){
$transaction       = "SELECT * FROM `transaction` WHERE user_id='$uid' AND status='1' ORDER BY id DESC";
$data['get_trans'] = $this->Model->getSqlData($transaction);
}else{
$data['get_trans'] = '';
}
}
$this->load->view('user/history_list',$data);
}else{
$data['get_trans'] = '';
$this->load->view('user/history_list',$data);
}
}
}
function cleaner_profile()
{
//check if loged in
$this->check_login(); 
$emp_id =  $this->uri->segment(3);
$chkidexist = $this->Model->getData('cleanner',array('emp_id'=>$emp_id));
if(empty($emp_id)){
  redirect('home/not_found');
}else if($chkidexist =='0'){
 
  redirect('home/not_found');
}else{
 
  $data['udetail'] = $this->Model->getData('cleanner',array('emp_id'=>$emp_id));
  $this->load->view('user/cleaner-pofile',$data);
  
}
}
function profile()
{  
//check if loged in
$this->check_login(); 
$this->load->view('user/profile');
}
function upd_profile()
{

$this->form_validation->set_rules('fullname', 'Fullname', 'required');
$this->form_validation->set_rules('email', 'Email id', 'required|valid_email');
$this->form_validation->set_rules('phone', 'Mobile Number ', 'required'); 
//$this->form_validation->set_rules('address', 'Address', 'required');
//$this->form_validation->set_rules('fulladdress', 'Full Address', 'required');

if ($this->form_validation->run() != FALSE){
 
 //here is input variables
 $user_id   = $this->input->post('user_id');
 $fullname  = $this->input->post('fullname');
 $email_id  = $this->input->post('email');
 $phone     = $this->input->post('phone');
 
 //$address   = $this->input->post('address');
 //$fulladdress    = $this->input->post('fulladdress');
 //$fulladdress2   = $this->input->post('fulladdress2');

 $newaddrs  = $this->input->post('newaddrs');
 $area_arr  = $this->input->post('area_arr');
 $ad_type   = $this->input->post('ad_type');

//  $add       = explode("," , $address);
//  $add_uniq  = $add[0];
//  $add_name  = $add[1];

    $data = array( 
        'timestamp'      => date('Y-m-d H:i:s'),
        'fullname'       => $fullname,
        'email'          => $email_id,
        'phone'          => $phone
        //'address'        => $add_name,
        //'addrs_id'       => $add_uniq,
        //'fulladdress'    => $fulladdress,
        //'fulladdress2'   => $fulladdress2
        );  

   //print_r($data);die;

   $this->Model->updateData('users', $data,array('user_id'=>$user_id));
 

if (!empty($ad_type) && !empty($area_arr) && !empty($newaddrs)) {

  $chkextra  = $this->Model->CountWhereRecord('user_addrs',array('uid'=>$user_id));
  
  if($chkextra > 0){
   $this->db->delete('user_addrs', array('uid' => $user_id));
  } 

    foreach($newaddrs as $key=> $newaddrsess){
      $area_arr_drop = $area_arr[$key];
      $area_arr_typ  = $ad_type[$key];
     
     $chk_both       = explode("," , $area_arr_drop);
     $chk_uniqid_fromarea       = $chk_both[0];
     @$chk_name_fromarea         = $chk_both[1]; 
 
    $dns = array('address'=>$newaddrsess,'chk_uniqid_fromarea'=>$chk_uniqid_fromarea,'chk_name_fromarea'=>$chk_name_fromarea,'chk_type'=>$area_arr_typ,'uid'=>$user_id);
    
    if (!empty($newaddrsess)) {
   
    $this->Model->insertData('user_addrs', $dns);
    
    }
    
    }
      
  }

  $this->session->set_flashdata('profile_succ','Your profile is successfully updated!');
  redirect('user/profile');
   
}else{
       
       $this->load->view('user/profile');
     }  
}
function forgot_password()
{
$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
if ($this->form_validation->run() != FALSE){
 $email    = $this->input->post('email');
 $ifemail  = $this->Model->CountWhereRecord('users',array('email'=>$email));
if($ifemail > 0){
 $users_data = $this->Model->getData('users',array('email' => $email));
 $user_name  =  $users_data->fullname;
 $user_email =  $users_data->email;
 $user_id    =  $users_data->user_id;
 
  //send token for otp
  $token = array('email_token'=>1);
  $this->Model->updateData('users',$token,array('user_id'=>$user_id));
  //mail function 
  require_once APPPATH.'third_party/sendgrid/sendgrid-php.php';
  $email = new \SendGrid\Mail\Mail();
  $email->setfrom("info@housekeeperskw.com", "Housekeeping");
  $email->setSubject("Forgot Password");
  $email->addTo($user_email , $user_name);
  
  $mailtemp['name'] = $user_name;
  $mailtemp['forgot'] = base_url().'user/upd_password/'.$user_id;
  
  $content = $this->load->view('mail/user_forgot',$mailtemp,true);
  $email->addContent("text/html",$content);

  $sercre_key = $this->config->item("Sandgrid_keys");

  $sendgrid = new \SendGrid(($sercre_key));

  
  $response = $sendgrid->send($email);
  //end mail 
$this->session->set_flashdata('ch_suc','Your request is successfully sent by mail!');
redirect('user/forgot_password');
}else{
$this->session->set_flashdata('fgerr','Your email does not exist!');
redirect('user/forgot_password');
}
}else{
  $this->load->view('web/forgot-password');
} 
}
function upd_password()
{
 $user_id    = $this->uri->segment(3); 
 $chkid      = $this->Model->CountWhereRecord('users',array('user_id'=>$user_id,'email_token'=>1));
  if(empty($user_id)){
  
    redirect('home/not_found');
  
  }else if($chkid == '0'){
  
    redirect('home/expire');
  
  }else{
   
    $this->load->view('web/change_pswd');   
    
      }
 
}
function emp_changed_pass()
{
  $user_id    = $this->input->post('user_id');
  $password   = $this->input->post('password');
  $cpassword  = $this->input->post('cpassword');
  $length_pass = strlen($password);
 
  $chkid      = $this->Model->CountWhereRecord('users',array('user_id'=>$user_id,'email_token'=>1));
 if(empty($user_id)){
 
 redirect('home/not_found');
 }else if($chkid == '0'){
 
  redirect('home/not_found');
 
}else if($password != $cpassword){
 
 $this->session->set_flashdata('fgerr','Password and confirm password does not match!');
 redirect('user/upd_password/'.$user_id);
 }
 else{
       if($length_pass  < 6){
        $this->session->set_flashdata('fgerr','You have to enter at least 6 digit!');
        redirect('user/upd_password/'.$user_id);
       }else{
     $data = array( 
        'password'    => md5($password),
        'email_token' => 0
        );  
$this->Model->updateData('users', $data,array('user_id'=>$user_id));
$this->session->set_flashdata('signup_succ','Password successfully changed login here!');
redirect('user/user_login');
}
 }
 }
 function checkout(){
 
  $sch_id      = $this->uri->segment(3);
  $search_id   = $this->uri->segment(4);
 //check loged in
 if($this->session->userdata('user_email') =='')
   {
   //store checkout token for login
   $sess_token = array(
            'checkout_token'     => $sch_id,
            'search_id'          => $search_id
            );
   $this->session->set_userdata($sess_token);
   redirect('home/user_login');
   
   }else{
   
    redirect('home/service_details/'.$sch_id.'/'.$search_id);
    //$this->load->view('web/checkout');   
   }
 }
 function pay()
 {
  // data variables and id's
  $timestamp     = date('Y-m-d');
  //$schedule_id = $this->uri->segment(3);
  $schedule_id   = $this->input->post('scheduler_id');
  $start_date    = $this->input->post('start_date');
  $day_name      = date('l', strtotime($start_date));
  $main_address  = $this->input->post('main_address');
  $uid           = $this->session->userdata('user_id');
  $order_id      = uniqid();
  //get scheduler data from schid
  $emp_data    = $this->Model->getData('job_scheduler',array('scheduler_id' => $schedule_id));
  $emp_id      =  $emp_data->emp_id;
  $package     =  $emp_data->plan_type;
  $shift       =  $emp_data->shift;
  $price       =  $emp_data->price;
  $area_code   =  $emp_data->area_uniq;
  $get_day_pre =  $emp_data->day;
  
  //start at a time data for single day  or daywise
  if($package == '0'){
  $if_exists_order = "SELECT * FROM `job_avalability` WHERE job_id='$schedule_id' AND book_date='$start_date' AND status='1' ORDER BY id DESC LIMIT 1";
  $if_exists_order = $this->Model->getSqlData($if_exists_order);
  if(COUNT($if_exists_order) > 0){ 
    
    foreach($if_exists_order as $if__order){
      $book_dates = $if__order['book_date'];
      $book_date_next   = date('Y-m-d', strtotime($book_dates. ' + 7 days'));
      }
      }else{
      $book_date_next = $start_date;
      }
  $data2 = array(
          'timestamp'  => $timestamp ,
          'plan_type'  => $package ,
          'job_id'     => $schedule_id ,
          'order_id'   => $order_id ,
          'day'        => $day_name ,
          'user_id'    => $uid ,
          'emp_id'     => $emp_id ,
          'book_date'  => $book_date_next ,
          'status'     => 0, 
          'job_shift'  => $shift,
          'uniqid'     => uniqid()
          );
  $this->Model->insertData('job_avalability',$data2);
  
  //get check day exist or not in same days
  $getchek_related_job = "SELECT * FROM `job_scheduler` WHERE FIND_IN_SET('$day_name',day_name) AND emp_id ='$emp_id' AND shift='$shift'";
  $chkschedule         = $this->Model->getSqlData($getchek_related_job);
  foreach($chkschedule as $related_jobs ){
    $rel_empid    = $related_jobs['emp_id'] ;
    $rel_sch_id   = $related_jobs['scheduler_id'] ;
     //related jobs are inactive when user purchase same day booking.
    $rel_status =  array('status'=>0);
    $this->Model->updateData('job_scheduler',$rel_status,array('scheduler_id'=>$rel_sch_id));
    }    
   //update status of employee booked.
  $booking_status =  array('status'=>2);
  $this->Model->updateData('job_scheduler',$booking_status,array('scheduler_id'=>$schedule_id));
  //end at a time 
  }else if($package == '1'){ 
  //start subscription data
  $week0      = $start_date;
  $week_name0 = $day_name;
   //get day for twice 
  $day_data    = $this->Model->getData('subscription_day',array('sub_id' => $get_day_pre));
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
          'status'     => 0, //after payment success status update
          'job_shift'  => $shift,
          'uniqid'     => $uniqid
          );
   $this->Model->insertData('job_avalability',$datamulti);
   
   }
    
   //check my all job day are mismatch or not otherwise my related job is inactive when this job is pay
   
  $getchek_related_job = "SELECT * FROM `job_scheduler` WHERE FIND_IN_SET('$daysin_str',day_name) AND emp_id ='$emp_id' AND shift='$shift'";
  $chkschedule         = $this->Model->getSqlData($getchek_related_job);
  foreach($chkschedule as $related_jobs ){
    $rel_empid    = $related_jobs['emp_id'] ;
    $rel_sch_id   = $related_jobs['scheduler_id'] ;
     //related jobs are inactive when user purchase same day booking.
    $rel_status =  array('status'=>0);
    $this->Model->updateData('job_scheduler',$rel_status,array('scheduler_id'=>$rel_sch_id));
    
  }    
   //update status of employee booked.
  $booking_status =  array('status'=>2);
  $this->Model->updateData('job_scheduler',$booking_status,array('scheduler_id'=>$schedule_id));
  }else if($package == '2'){ 
  
  //start subscription data for twice day
  //get day for twice 
  $day_data = $this->Model->getData('subscription_day',array('sub_id' => $get_day_pre));
  $daysin_str  =  $day_data->day;
  $get_twice   = explode (",", $daysin_str); 
  
  $get_twice1  = $get_twice[0];
  $get_twice2  = $get_twice[1];
  $week1      = $start_date;
  $week_name1 = $day_name;
  $uniqid  = uniqid();
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
                  'status'     => 0, 
                  'job_shift'  => $shift,
                  'uniqid'     => $uniqid
                  );
    $this->Model->insertData('job_avalability',$data_ad_day1);
    } 
  //check my all job day are mismatch or not otherwise my related job is inactive when this job is pay
  $count_twice         = COUNT($get_twice); 
  for($z=0; $z<$count_twice; $z++){
  
  $get_twicei = $get_twice[$z];
  $getchek_related_job = "SELECT * FROM `job_scheduler` WHERE FIND_IN_SET('$get_twicei',day_name) AND emp_id ='$emp_id' AND shift='$shift'";
  $chkschedule         = $this->Model->getSqlData($getchek_related_job);
  foreach($chkschedule as $related_jobs ){
    $rel_empid    = $related_jobs['emp_id'] ;
    $rel_sch_id   = $related_jobs['scheduler_id'] ;
     //related jobs are inactive when user purchase same day booking.
    $rel_status =  array('status'=>0);
    $this->Model->updateData('job_scheduler',$rel_status,array('scheduler_id'=>$rel_sch_id));
    
  }    
  }//end lood for twice day check in related
  
   //update status of employee booked.
  $booking_status =  array('status'=>2);
  $this->Model->updateData('job_scheduler',$booking_status,array('scheduler_id'=>$schedule_id));
    
  //end twice
  
  }else if($package == '3'){ 
  
  //start subscription data for thrice day
  //get day for twice 
  $day_data = $this->Model->getData('subscription_day',array('sub_id' => $get_day_pre));
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
                  'status'     => 0, 
                  'job_shift'  => $shift,
                  'uniqid'     => $uniqid
                  );
    $this->Model->insertData('job_avalability',$data_thrice);
    }
    //check my all job day are mismatch or not otherwise my related job is inactive when this job is pay
  $count_twice         = COUNT($get_twice); 
  for($z=0; $z<$count_twice; $z++){
  
  $get_twicei = $get_twice[$z];
  $getchek_related_job = "SELECT * FROM `job_scheduler` WHERE FIND_IN_SET('$get_twicei',day_name) AND emp_id ='$emp_id' AND shift='$shift'";
  $chkschedule         = $this->Model->getSqlData($getchek_related_job);
  foreach($chkschedule as $related_jobs ){
    $rel_empid    = $related_jobs['emp_id'] ;
    $rel_sch_id   = $related_jobs['scheduler_id'] ;
     //related jobs are inactive when user purchase same day booking.
    $rel_status =  array('status'=>0);
    $this->Model->updateData('job_scheduler',$rel_status,array('scheduler_id'=>$rel_sch_id));
    
  }    
  }//end lood for twice day check in related
  
   //update status of employee booked.
  $booking_status =  array('status'=>2);
  $this->Model->updateData('job_scheduler',$booking_status,array('scheduler_id'=>$schedule_id));
  
  
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
          'main_address' => $main_address ,
          'status'     => 0 
          );
  
  
  $this->Model->insertData('transaction',$data);
  //remove card session
  $this->session->unset_userdata('checkout_token');
  $this->session->unset_userdata('search_id');
  //redirect('user/thankyou');
  redirect('user/paycharge/'.$order_id);
 }
 function paycharge()
 {  
    $this->check_login(); 
    $oid      = $this->uri->segment(3);
    $uid      = $this->session->userdata('user_id'); 
    $trans    = uniqid();
    
    //get user data
    $udata    = $this->Model->getData('users',array('user_id'=>$uid));
    $fname    = $udata->fullname;
    $email    = $udata->email;
    $mobile   = $udata->phone;
    //get amount and job data from transaction
    $trdata   = $this->Model->getData('transaction',array('order_id'=>$oid));
    $job_id   = $trdata->job_id;
   
    //check coupon is applied or not
    $coupon       = $this->session->userdata('coupon'); 
    $get_reward   = $this->Model->getData('reward_price',array('id' => 1));
    $add_discount = $get_reward->discount;
 
    //get amount from schdeuler
    $sch      = $this->Model->getData('job_scheduler',array('scheduler_id'=>$job_id));
    $pay      = $sch->price; //booking price
    if(!empty($coupon)){
    $pay = $pay - $add_discount;
    }else{
    $pay = $sch->price;
    
    }
    
    $redirect = 'https://sharukh.dbtechserver.online/housekeeper/user/redirect_charge';
    $post_url = 'https://sharukh.dbtechserver.online/housekeeper/home/not_found';
    
    //curl here
    $curl  = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.tap.company/v2/charges",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"amount\":$pay,\"currency\":\"KWD\",\"threeDSecure\":true,\"save_card\":false,\"description\":\"Housekeeper payment\",\"statement_descriptor\":\"payment\",\"metadata\":{\"udf1\":\"test 1\",\"udf2\":\"test 2\"},\"reference\":{\"transaction\":\"$trans\",\"order\":\"$oid\"},\"receipt\":{\"email\":false,\"sms\":true},\"customer\":{\"first_name\":\"$fname\",\"middle_name\":\"\",\"last_name\":\"\",\"email\":\"$email\",\"phone\":{\"country_code\":\"\",\"number\":\"$mobile\"}},\"merchant\":{\"id\":\"\"},\"source\":{\"id\":\"src_all\"},\"post\":{\"url\":\"$post_url\"},\"redirect\":{\"url\":\"$redirect\"}}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer sk_test_xxxxxxxxxxxxxxxxx",
    "content-type: application/json"
    
  ),
));
$response = curl_exec($curl);
$err      = curl_error($curl);
curl_close($curl);
if ($err) {
  echo "cURL Error #:" . $err;
} else {
    $person = json_decode($response,true);
    //response data in json to array
    
    $charge_id  = $person['id'];
    $method     = $person['method'];
    $status     = $person['status'];
   
    $url        = $person['transaction']['url'];
   
    header("Location: $url");
    exit();
}
 }
function redirect_charge()
{
$this->check_login(); 
$tap_id   = $_GET['tap_id'];
//$oid      = $this->uri->segment(3);
$curl   = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.tap.company/v2/charges/$tap_id",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer sk_test_xxxxxxxxxxxxxxxxx"
  ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
  echo "cURL Error #:" . $err;
} else {
 $data = json_decode($response,true);
 //response data in json to array
  
  $transaction = $data['reference']['transaction'];
  $order_id    = $data['reference']['order'];
  $charge_id   = $data['id'];
  $method      = $data['method'];
  $status      = $data['response']['message'];
  
  //get data from transaction
  $trdata   = $this->Model->getData('transaction',array('order_id'=>$order_id));
  $job_id   = $trdata->job_id;
  
     //check coupon is applied or not
    $coupon       = $this->session->userdata('coupon'); 
    $get_reward   = $this->Model->getData('reward_price',array('id' => 1));
    $add_discount = $get_reward->discount;
  //get amount from schdeuler
  $sch      = $this->Model->getData('job_scheduler',array('scheduler_id'=>$job_id));
  $pay      = $sch->price; //booking price
  
  if(!empty($coupon)){
    $pay = $pay - $add_discount;
    }else{
    $pay = $sch->price;
    
    }
  if($status =='Captured'){
      //if payment is done then update job status from transaction and job availability
      $trstatus = array('status' => 1 , 'charge_id'=>$charge_id , 'msg'=> $status, 'price'=>$pay);
      $status   = array('status' => 1 );
      $this->Model->updateData('transaction',$trstatus,array('order_id'=>$order_id,'job_id'=>$job_id));
      
      $this->Model->updateData('job_avalability',$status,array('order_id'=>$order_id,'job_id'=>$job_id));
      //coupon is expired
      $coup  =  array('status'=>0);
      $this->Model->updateData('rewards_codes',$coup,array('cupon'=>$coupon));
      $this->session->unset_userdata('coupon');
     //when payment is done then show Captured....
     redirect('user/thankyou');  
     exit();
  }else{
    
    $msg_status = explode(',',$status);
    $show_msg   = $msg_status[0];
    $trstatus = array('charge_id'=>$charge_id , 'msg'=> $status);
    $this->Model->updateData('transaction',$trstatus,array('order_id'=>$order_id,'job_id'=>$job_id));
    redirect('user/payments/'.$show_msg);  
    exit();
  }
  
}
}
function thankyou()
{ 
  $this->check_login(); 
  $this->load->view('web/booking-done');
}
function payments()
{  
  $this->check_login(); 
  $data['status_err'] = $this->uri->segment(3);
  $this->load->view('web/pay_status',$data);
}
function remove_address(){
//check if loged in
  $this->check_login();
  $id       = $this->uri->segment(3);
  $this->db->delete('user_addrs', array('id' => $id));
  redirect('user/profile');  
}
function del_order(){
  
  //check if loged in
  $this->check_login();
  $o_id       = $this->uri->segment(3);
 
  $chk_order  = $this->Model->CountWhereRecord('job_avalability',array('order_id'=>$o_id));
  if($chk_order > 0){
  
  //$this->db->delete('job_avalability', array('order_id' => $o_id));
  }
  $this->db->delete('transaction', array('order_id' => $o_id));
  
  redirect('user/transactions');  
}
function deny_day()
{
$job_id_primary   = $this->uri->segment(3);
$user_id          = $this->session->userdata('user_id'); 
$cdate            = date('Y-m-d');
$new_code         = "Housekeeper_".uniqid();
//get data from user table
$udata       = $this->Model->getData('users',array('user_id'=>$user_id));
$email_id    = $udata->email;
$fullname    = $udata->fullname;
//get data from job
$myjob       = $this->Model->getData('job_avalability',array('id' => $job_id_primary,'user_id'=>$user_id));
$book_date   = $myjob->book_date;
$sch_job_id  = $myjob->job_id;
$order_id    = $myjob->order_id;
$befor_24  = date('Y-m-d', strtotime("-1 day", strtotime($book_date)));
$chk_already_deny = $this->Model->CountWhereRecord('job_avalability',array('job_id'=>$sch_job_id,'order_id'=>$order_id,'user_id'=>$user_id,'status'=>2));
// if($cdate >= $befor_24){
if($cdate < $book_date){
// in this condtion user can do deny after 24hr
  if($chk_already_deny > 12){
    $this->session->set_flashdata('deny','In this plan you have already deny a day!');
    redirect('user/my_booking');
    
    }else{
    
  $data = array( 
        'status'    => 2
         );  
$this->Model->updateData('job_avalability', $data,array('id'=>$job_id_primary,'user_id'=>$user_id));
//add coupon in db
$add_data  = array(
                'date'  => $cdate,
                'time'  => date('H:i'),
                'cupon' => $new_code,
                'cid'   => uniqid()
                );
$this->Model->insertData('rewards_codes',$add_data);
//send mail to user when send reward
//mail function 
  require_once APPPATH.'third_party/sendgrid/sendgrid-php.php';
  $email = new \SendGrid\Mail\Mail();
  $email->setfrom("info@housekeeperskw.com", "Housekeeping");
  $email->setSubject("Deny a day rewards");
  $email->addTo($email_id , $fullname);
  
  $mailtemp['name']   = $fullname;
  $mailtemp['coupon'] = $new_code;
  
  $content = $this->load->view('mail/reward_mail',$mailtemp,true);
  $email->addContent("text/html",$content);

  $sercre_key = $this->config->item("Sandgrid_keys");

  $sendgrid = new \SendGrid(($sercre_key));

  
  $response = $sendgrid->send($email);
  //end mail function
// we can add reward for user.
$this->session->set_flashdata('sucdeny','Successfully deny a day! we will send you rewards on your mail!');
redirect('user/my_booking');
}
}else{
if($chk_already_deny > 0){
    $this->session->set_flashdata('deny','In this plan you have already deny a day!');
    redirect('user/my_booking');
    
    }else{
    
  $data = array( 
        'status'    => 2
         );  
$this->Model->updateData('job_avalability', $data,array('id'=>$job_id_primary,'user_id'=>$user_id));
// we can not add reward for user.bcz user deny after 24hr
$this->session->set_flashdata('sucdeny','Successfully deny a day! but we can not send you a reward because you deny a day after the booking date or 24 hr after the booking date!');
redirect('user/my_booking');
}
// in this condtion user can do deny after 24hr
// $this->session->set_flashdata('deny','Before 24 hour from booking date, you can not deny a day!');
// redirect('user/my_booking');
    }
}
//end of file
}