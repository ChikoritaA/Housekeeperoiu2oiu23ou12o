<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

function __construct(){

parent::__construct();

date_default_timezone_set('Asia/Kolkata');
$this->load->database();
$this->load->model('Model');
$this->load->library(array('form_validation','session'));
$this->load->helper(array('form','url'));


}



function index()
{
$uid              = $this->session->userdata('user_id'); 
$data['shift']    = $this->Model->getAlData('shift');
$data['area']     = $this->Model->getAlData('area_code_list');

//get data for card list
$get_filters = "SELECT * FROM `job_scheduler` WHERE plan_type !='0' AND status='1'";

$data['schedule'] = $this->Model->getSqlData($get_filters);

$this->load->view('web/index',$data);

}

function dummy_home(){
  
  $this->load->view('web/dummy_home');
 
}


function service_list()
{
  

$get_filter = "SELECT * FROM `job_scheduler` WHERE plan_type !='0' AND status='1' ORDER BY id DESC";

$data['schedule'] = $this->Model->getSqlData($get_filter);
  
$data['shift']  = $this->Model->getAlData('shift');
$data['area']   = $this->Model->getAlData('area_code_list');
$data['start_date'] = '';
$this->load->view('web/services-list',$data);


}


function search_job()
{
//form validation
//$this->form_validation->set_rules('package','Package','required');
//$this->form_validation->set_rules('shift_li','Shift','required'); 
//$this->form_validation->set_rules('area_code','Area ','required'); 
//$this->form_validation->set_rules('start_date','Select Date', 'required');

if($this->input->post()){
// chk form submit    
$page = $this->input->post('page');


//if ($this->form_validation->run() != FALSE){
 
 $uid       = $this->session->userdata('user_id'); 

 //here is input variables
 $package    = $this->input->post('package');
 $shift_li   = $this->input->post('shift_li');
 $area_code  = $this->input->post('area_code');
 $start_date = $this->input->post('start_date');
 //y-m-d
 if(!empty($area_code)){

 $area_imp      = explode("," ,$area_code); 
 
 $area_code_ar  = $area_imp[0];
 $area__uniq_ar = $area_imp[1];
 
 }
 
 if(empty($start_date)){
 
   $sdate =  date('Y-m-d');
   //here start date is curent date  
   }else{
 
   $sdate = $start_date ;
   //here start date from input  
   }
    
  //DAY NAME USING DATE
  $day_name    = date('l', strtotime($sdate));
  
  //when package empty
if($package == '0'){ 
//when package empty

if(empty($area__uniq_ar)){

$get_filter = "SELECT * FROM `job_scheduler` WHERE FIND_IN_SET('$day_name',day_name) AND plan_type ='0' AND shift LIKE '$shift_li%'";


}else{

$get_filter = "SELECT * FROM `job_scheduler` WHERE FIND_IN_SET('$day_name',day_name) AND plan_type ='0' AND shift LIKE '$shift_li%' AND area_code LIKE '$area__uniq_ar%'";


}



}else if($package =='1' || $package =='2' || $package =='3'){


if(empty($area__uniq_ar)){

$get_filter = "SELECT * FROM `job_scheduler` WHERE plan_type LIKE '$package%' AND shift LIKE '$shift_li%' AND status='1'";

}else{

$get_filter = "SELECT * FROM `job_scheduler` WHERE plan_type LIKE '$package%' AND shift LIKE '$shift_li%' AND area_code LIKE '$area__uniq_ar%' AND status='1'";


  }


}else{

if(empty($area__uniq_ar)){

 
  $get_filter = "SELECT * FROM `job_scheduler` WHERE shift LIKE '$shift_li%' AND plan_type !='0' AND status='1'";

}else{

  $get_filter = "SELECT * FROM `job_scheduler` WHERE shift LIKE '$shift_li%' AND area_code LIKE '$area__uniq_ar%' AND plan_type !='0' AND status='1'";
  

}
}


if($package =='0'){

$related = "SELECT * FROM `job_scheduler` WHERE plan_type ='0' AND status='1'";

}else{

$related = "SELECT * FROM `job_scheduler` WHERE plan_type !='0' AND status='1'";

}

$search_id = uniqid();

if(!empty($area_code_ar)){

$data_add  = array(
             'package'    => $package,    
             'shift'      => $shift_li,  
             'area'       => $area_code_ar,
             'start_date' => $sdate,    
             'search_id'  => $search_id  
              );

}else{

$data_add  = array(
             'package'    => $package,    
             'shift'      => $shift_li,  
             //'area'       => $area_code_ar,
             'start_date' => $sdate,    
             'search_id'  => $search_id  
              );

}  


$this->Model->insertData('search_history',$data_add);

$data['schedule']       = $this->Model->getSqlData($get_filter);
$data['related_data']   = $this->Model->getSqlData($related);
$data['shift']          = $this->Model->getAlData('shift');

$data['area']           = $this->Model->getAlData('area_code_list');

if(!empty($uid) ){ 
    
    $area  = "SELECT * FROM `user_addrs` WHERE uid='$uid' ORDER BY id DESC"; 
    $data['area']  = $this->Model->getSqlData($area);
    
}else{ 
    $area  = "SELECT * FROM `area_code_list` ORDER BY id DESC";

    $data['area']  = $this->Model->getSqlData($area);
}





$data['start_date']     = $sdate; 
$data['search_id']      = $search_id; 
$data['data_pack']      = $package;

$this->load->view('web/services-list',$data);
}
else{
     redirect('home');

}
//}else{

//if($page =='home'){
//for home page view

// $data['shift']  = $this->Model->getAlData('shift');
// $data['area']   = $this->Model->getAlData('area_code_list');
// //$data['schedule'] = $this->Model->getAlData('job_scheduler');
// $get_filter = "SELECT * FROM `job_scheduler` WHERE plan_type !='0' AND status='1' ORDER BY id DESC";
// $data['schedule'] = $this->Model->getSqlData($get_filter);


// $this->load->view('web/index',$data);

//}else{

//for filter page view
// $data['start_date'] = ''; 

// // $get_filter = "SELECT * FROM `job_scheduler` WHERE plan_type !='0' AND status='1' ORDER BY id DESC";
// // $data['schedule'] = $this->Model->getSqlData($get_filter);
// $data['schedule'] = '';
// $data['shift']  = $this->Model->getAlData('shift');
// $data['area']   = $this->Model->getAlData('area_code_list');
// $this->load->view('web/services-list',$data);

//}     

    
    //}  

}

function verify_employee()
{

 $this->load->view('web/employee-verify');

}

function not_found()
{
 $this->load->view('web/404');

}

function expire()
{
 $this->load->view('web/expire_link');

}

function user_guide()
{
 $this->load->view('web/userguide');

}

function privacy_policy()
{
 $this->load->view('web/privacypolicy');

}

function support_center()
{
 $this->load->view('web/supportcenter');

}

function about_page()
{
 $this->load->view('web/about');

}

function emp_acc_active()
{
  $emp_id     = $this->input->post('emp_id');
  $password   = $this->input->post('password');
  $cpassword  = $this->input->post('cpassword');
 
  $if_exists = $this->Model->CountWhereRecord('cleanner',array('emp_id'=>$emp_id,'status'=>1));

 if($if_exists > 0){
   
 redirect('home/expire');

 }else if(empty($emp_id)){
 
 redirect('home/not_found');

 }else if($password != $cpassword){
 
 $this->session->set_flashdata('pas_err','New password and confirm phpassword does not match!');
 redirect('home/verify_employee/'.$emp_id);

 }
 else{

     $data = array( 
        'password' => md5($password),
        'status'   => 1,
        );  

$this->Model->updateData('cleanner', $data,array('emp_id'=>$emp_id));

$this->session->set_flashdata('pas_suc','Successfully register, login here!');

redirect('employee');

 }

}

function user_login()
{
    
if($this->session->userdata('user_id') !='')
 {
   redirect('user');
   
 }else{
     
  $this->load->view('web/login');

   }
  

}

function user_signup()

{
  $this->load->view('web/signup');
}



function service_details()
{

  $get_sch_id         = $this->uri->segment(3);
  $get_sch_next       = $this->uri->segment(4);
  
  //for only valid 
  $chk_searchdata     = $this->Model->CountWhereRecord('search_history',array('search_id'=>$get_sch_next));
  $chk_idexist        = $this->Model->CountWhereRecord('job_scheduler',array('scheduler_id'=>$get_sch_id));

  $data['get_sch']    = $this->Model->getData('job_scheduler',array('scheduler_id'=>$get_sch_id));
  $data['searchdata'] = $this->Model->getData('search_history',array('search_id'=>$get_sch_next));
  
  
  //chk id valid or not
  if(empty($get_sch_id) || empty($get_sch_next)){

  redirect('home/not_found');

  }else if($chk_idexist =='0' || $chk_searchdata =='0'){
  
  redirect('home/not_found');

  }else{

  //$data['search_id'] = $search_id;
  $this->load->view('web/details',$data);

  }
 

}

function remove_discount()
{

  $coupon      = $this->input->post('coupon');
  $totalprice  = $this->input->post('totalprice');

  $toldprice   = $this->input->post('toldprice');

  $cp          = $this->session->userdata('coupon'); 
       
  $get_reward   = $this->Model->getData('reward_price',array('id' => 1));
  $add_discount = $get_reward->discount;
  //$remaingprice = $totalprice + $add_discount ." KD";

  $remaingprice = $toldprice ." KD";
  
  //coupon update active

  $data = array( 
        'status'   => 1
        );  

  $this->Model->updateData('rewards_codes', $data,array('cupon'=>$cp));
    
  $this->session->unset_userdata('coupon');

      $response = array(

            "status"   => "success",
            "rm_price" => $remaingprice,
            "response" => "Coupon code successfully removed!"

             );

  echo json_encode($response);

}

function add_discount()
{
  $coupon     = $this->input->post('coupon');
  $totalprice = $this->input->post('totalprice');
  
  if(empty($coupon)){

    $response = array(

        "status"   => "error",
        "response" => "Coupon code is empty!"

         );
      
  }else{


    $if_exists = $this->Model->CountWhereRecord('rewards_codes',array('cupon'=>$coupon));

    if($if_exists > 0){



    $if_valid = $this->Model->CountWhereRecord('rewards_codes',array('cupon'=>$coupon,'status'=>1));


    if($if_valid > 0){

      $get_reward   = $this->Model->getData('reward_price',array('id' => 1));
      
      $add_discount = $get_reward->discount;
      
      $remaingprice = $totalprice - $add_discount ." KD";


      $store_coupon   = array(
              'coupon'         => $coupon
              );

      $this->session->set_userdata($store_coupon);
      
      //coupon expire
      $status  =  array('status'=>0);
      $this->Model->updateData('rewards_codes',$status,array('cupon'=>$coupon));
      //$this->session->unset_userdata('coupon');

      $response = array(

            "status"   => "success",
            "rm_price" => $remaingprice,
            "response" => "Coupon code successfully applied!"

             );

    }else{


      $response = array(

        "status"   => "error",
        "response" => "Coupon code is expired!"

         );

    }


        
    }else{
      

      $response = array(

        "status"   => "error",
        "response" => "Coupon code is invalid!"

         );


    }
  }

  echo json_encode($response);

}

function forgot_password()

{
  $this->load->view('web/forgot-password');

}




function keywords()
{
  $vname = $this->input->post('vname');

  $getall_vend = "SELECT * FROM `vendor_skill` WHERE fullname LIKE '$vname%'  OR map_address LIKE '$vname%' OR price LIKE '$vname%' OR about LIKE '$vname%' AND status='1' AND allow ='Yes'";

  $data['get_vend']       = $this->Model->getSqlData($getall_vend);
  $data['getall_cat']     = $this->Model->getAllData('categories');
  $data['country_list']   = $this->Model->getAllData('country');
  $data['getall_skill']   = $this->Model->getAllData('skills');     
      
  $this->load->view('home/all-category',$data);
}

function homesearch()
{
  $country = $this->input->post('country');
  $cat     = $this->input->post('cat');

  $getall_vend = "SELECT * FROM `vendor_skill` WHERE country='$country' AND category='$cat' AND status='1' AND allow='Yes'";

  $data['get_vend']       = $this->Model->getSqlData($getall_vend);
  $data['getall_cat']     = $this->Model->getAllData('categories');
  $data['country_list']   = $this->Model->getAllData('country');
  $data['getall_skill']   = $this->Model->getAllData('skills');     
      
  $this->load->view('home/all-category',$data);
}

function filterbycat(){

  $cat = $this->uri->segment(3);

  $getall_vend = "SELECT * FROM `vendor_skill` WHERE category='$cat' AND status='1' AND allow='Yes'";

  $data['get_vend']       = $this->Model->getSqlData($getall_vend);
  $data['getall_cat']     = $this->Model->getAllData('categories');
  $data['country_list']   = $this->Model->getAllData('country');
  $data['getall_skill']   = $this->Model->getAllData('skills');     
      
  $this->load->view('home/all-category',$data);

}




function faq()

{

$this->load->view('web/faq');

}

function terms()

{

$this->load->view('web/terms-conditions');

}

function contact()

{

$this->load->view('web/contact');

}


function contact_us()
{

$this->form_validation->set_rules('name', 'Name', 'required');
$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
$this->form_validation->set_rules('phone', 'Phone', 'required');
$this->form_validation->set_rules('subject', 'Name', 'required');
$this->form_validation->set_rules('msg', 'Email', 'required');

if ($this->form_validation->run() != FALSE){

 $name       = $this->input->post('name');
 $inq_email  = $this->input->post('email');
 $phone      = $this->input->post('phone');
 $subject    = $this->input->post('subject');
 $msg        = $this->input->post('msg');

 //mail function 
 require_once APPPATH.'third_party/sendgrid/sendgrid-php.php';

 $email = new \SendGrid\Mail\Mail();
 $email->setfrom("info@housekeeperskw.com", "Housekeeping");
 $email->setSubject("Contact Inquiry");
 $email->addTo("info@housekeeperskw.com" , "Admin");
  
 $info= array(
        'name'      => $name,
        'inq_email' => $inq_email,
        'phone'     => $phone,
        'subject'   => $subject,
        'msg'       => $msg

 );

 $mailtemp['myinfo'] = $info;
 $content = $this->load->view('mail/contact_inquiry',$mailtemp,true);
 $email->addContent("text/html",$content);

 $sercre_key = $this->config->item("Sandgrid_keys");

 $sendgrid = new \SendGrid(($sercre_key));

 
 $response = $sendgrid->send($email);
 //end mail 

$this->session->set_flashdata('inq_suc','Thank you for getting in touch! We appreciate you contacting us!');

redirect('home/contact');

}else{

$this->load->view('web/contact');

}
}


function cansel_book()
{

$job_id = $this->uri->segment(3);

//get job data available table
$getjobdata = $this->Model->getdata('job_avalability',array('job_id'=>$job_id));
$job_shift  = $getjobdata->job_shift;
$job_day    = $getjobdata->day;


//work done all subscription
$data = array( 
  'is_done' => 1
  );  

$this->Model->updateData('job_avalability', $data,array('job_id'=>$job_id));

//transaction cansel data for not subription
$data2 = array( 
  'is_done' => 2
  );  

$this->Model->updateData('transaction', $data2,array('job_id'=>$job_id));

//employee scheduling free now for next booking 

$data3 = array( 
  'status' => 1
  );  

$this->Model->updateData('job_scheduler', $data3,array('scheduler_id'=>$job_id));


// $this->session->set_flashdata('plan_cansel','Successfully cancelled subscription plan!');

redirect('home/cancelled_sub');

}

function cancelled_sub()
{

$this->load->view('web/cansel_sub');

}

function direct_book()
{
 $sch_id = $this->uri->segment(3);

 $chkid  = $this->Model->CountWhereRecord('job_scheduler',array('scheduler_id'=>$sch_id));

 
 if(empty($sch_id)){
 
 redirect('home/not_found');

 }else if($chkid == '0'){
 
  redirect('home/not_found');
 
}else{


  //get schedule data

 $jobdata = $this->Model->getData('job_scheduler',array('scheduler_id'=>$sch_id));
 $package = $jobdata->plan_type;
 $shift   = $jobdata->shift;
 $area    = $jobdata->area_uniq;
 $sdate   = date('Y-m-d');

 $search_id = uniqid();
 
 $data = array(
        
         "package"     => $package,
         "shift"       => $shift,
         "area"        => $area,
         "start_date"  => $sdate,
         "search_id"   => $search_id

          );
 $this->Model->insertData('search_history',$data);

 redirect('home/service_details/'.$sch_id.'/'.$search_id);



}
 
}


//end of file
}