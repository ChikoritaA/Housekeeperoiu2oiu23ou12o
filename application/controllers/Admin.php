<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

public function __construct(){
parent::__construct();

date_default_timezone_set('Asia/Kolkata');
$this->load->database();
$this->load->model('Model');
$this->load->library(array('form_validation','session'));
$this->load->helper(array('form','url'));

}

public function index()
{
if($this->session->userdata('admin_email') !='')
 {
   redirect('admin/dashboard');
   
 }else{
     
   $this->load->view('admin/login');

   }
} 

function dashboard()
{
  $this->check_login();
  $this->load->view('admin/dashboard');
}

function shift()
{ 
  $this->check_login();
  //$data['shift_list'] = $this->Model->getAlData('shift');

  $shift  = "SELECT * FROM `shift` ORDER BY id DESC";
  $data['shift_list'] = $this->Model->getSqlData($shift);


  $this->load->view('admin/shift-create',$data);
}

function create_shift()
{ 
  //check if loged in
  $this->check_login();

  $this->form_validation->set_rules('from_time1', 'From Time', 'required');
  $this->form_validation->set_rules('to_time1', 'To Time', 'required');

if ($this->form_validation->run() != FALSE){

 $from_time = $this->input->post('from_time');
 $to_time   = $this->input->post('to_time');
 
 $if_exists = $this->Model->CountWhereRecord('shift',array('from_time'=>$from_time,'to_time'=>$to_time));

 if($if_exists > 0){

   
   $this->session->set_flashdata('shift_err','Shift is already established!');
   redirect('admin/shift');

 }else{

  if($from_time == $to_time){

     $this->session->set_flashdata('shift_err','From time and To time can not be same!');
     redirect('admin/shift');

  }else{

  

 $hours = round((strtotime($from_time) - strtotime($to_time))/3600, 1);
 
 $hours = abs($hours);

 $data = array( 
        'from_time'  => $from_time,
        'to_time'    => $to_time,
        'hours'      => $hours,
        'timestamp'  => date('Y-m-d H:i:s'),
        'shift_id'   => uniqid()
        );  

$this->Model->insertData('shift', $data);
$this->session->set_flashdata('shift_su','Added successfully!');
redirect('admin/shift');
   }
}
}
else{

//$data['shift_list'] = $this->Model->getAlData('shift');
  $shift  = "SELECT * FROM `shift` ORDER BY id DESC";
  $data['shift_list'] = $this->Model->getSqlData($shift);


$this->load->view('admin/shift-create',$data);

}
}

function del_shift(){
  
  //check if loged in
  $this->check_login();

  $shift_id   = $this->uri->segment(3);
 
  $chk_shift  = $this->Model->CountWhereRecord('pricing_plan',array('shift'=>$shift_id));
  

  if($chk_shift > 0){
   
   $this->session->set_flashdata('shift_er','You can not delete this shift, because it is already assigned in pricing plan section!');
   redirect('admin/shift');

  //$this->db->delete('pricing_plan', array('shift' => $shift_id));

  }else{

   $this->db->delete('shift', array('shift_id' => $shift_id));

   $this->session->set_flashdata('shift_succ','You have successfully deleted the shift!');

   redirect('admin/shift');

  }
    
}


function areacode()
{ 
  $this->check_login();
  //$data['areacode'] = $this->Model->getAlData('area_code_list');
  $area  = "SELECT * FROM `area_code_list` ORDER BY id DESC";
  $data['areacode'] = $this->Model->getSqlData($area);

  $this->load->view('admin/create-areacode',$data);
}

function add_areacode()
{
 //check if loged in
 $this->check_login();

 $this->form_validation->set_rules('area_name', 'Area Name', 'required');
 $this->form_validation->set_rules('area_code', 'Area Code', 'required');

if ($this->form_validation->run() != FALSE){

 $area_name  = $this->input->post('area_name');
 $area_code  = $this->input->post('area_code');
 
 $if_exists = $this->Model->CountWhereRecord('area_code_list',array('area_name'=>$area_name,'area_code'=>$area_code));

 if($if_exists > 0){
   
   $this->session->set_flashdata('area_err','Area code is already present!');
   redirect('admin/areacode');

 }else{

 
 $data = array( 
        'area_name'  => $area_name,
        'area_code'  => $area_code,
        'timestamp'  => date('Y-m-d H:i:s'),
        'area_uniqid'=> uniqid()
        );  

$this->Model->insertData('area_code_list', $data);
$this->session->set_flashdata('area_succ','Added successfully!');
redirect('admin/areacode');
}
}
else{

  // $data['areacode'] = $this->Model->getAlData('area_code_list');
  $area  = "SELECT * FROM `area_code_list` ORDER BY area_code DESC";
  $data['areacode'] = $this->Model->getSqlData($area);

  $this->load->view('admin/create-areacode',$data);

}  
}

function del_areacode()
{ 
  //check if loged in
  $this->check_login();
  $area_uniqid   = $this->uri->segment(3);

  // $get_area = $this->Model->getData('area_code_list',array('area_uniqid'=>$area_uniqid));

  // $area_name = $get_area->area_name;
  // $area_code = $get_area->area_code;

  $chk_area  = $this->Model->CountWhereRecord('job_scheduler',array('area_uniq'=>$area_uniqid));
 
  if($chk_area > 0){
  
  $this->session->set_flashdata('area_del','You can not delete this area,because this area have some jobs schedule!');
  redirect('admin/areacode'); 

  }else{

  $this->db->delete('area_code_list', array('area_uniqid' => $area_uniqid));
  $this->session->set_flashdata('area_suc','You have successfully deleted the area code!');

  redirect('admin/areacode');  
}

}

function day_combination()
{
$this->check_login();
$data['day_subs'] = $this->Model->getAlData('subscription_day');
$this->load->view('admin/day-combination',$data);
}

function single_day_combination()
{ 
 
 //check if loged in
 $this->check_login();

 $this->form_validation->set_rules('single_day', 'Day', 'required');

if ($this->form_validation->run() != FALSE){

 $single_day  = $this->input->post('single_day');
 
 $if_exists = $this->Model->CountWhereRecord('subscription_day',array('day'=>$single_day,'type'=>1));

 if($if_exists > 0){
   
   $this->session->set_flashdata('day_err','Already Exists');
   redirect('admin/day_combination');

 }else{

 
 $data = array( 
        'type'       => 1,
        'day'        => $single_day,
        'sub_id'     => uniqid()
        );  

$this->Model->insertData('subscription_day', $data);
$this->session->set_flashdata('day_succ','Added successfully!');
redirect('admin/single_day_combination');
}
}
else{

$data['day_subs'] = $this->Model->getAlData('subscription_day');
$this->load->view('admin/day-combination',$data);


}  
  
}

function twice_day_combination()
{
 //check if loged in
 $this->check_login();

 $this->form_validation->set_rules('twice_day1', 'Day one', 'required');
 $this->form_validation->set_rules('twice_day2', 'Day Two', 'required');

if ($this->form_validation->run() != FALSE){

 $twice_day1  = $this->input->post('twice_day1');
 $twice_day2  = $this->input->post('twice_day2');
 $days  = $twice_day1.",".$twice_day2 ;
 
 //for only validation
 $repeat_day = $twice_day2.",".$twice_day1 ;

 $if_exists2 = $this->Model->CountWhereRecord('subscription_day',array('day'=>$repeat_day,'type'=>2));

 $if_exists = $this->Model->CountWhereRecord('subscription_day',array('day'=>$days,'type'=>2));

 if($if_exists > 0){
   
   $this->session->set_flashdata('day_err','Already Exists!');
   redirect('admin/twice_day_combination');

 }else if($if_exists2 > 0){
  
   $this->session->set_flashdata('day_err','Already Exists!');
   redirect('admin/twice_day_combination');

 }else{

 if($twice_day1 == $twice_day2){
 
  $this->session->set_flashdata('day_err','You can not select same day twice a week');
  redirect('admin/twice_day_combination');

 }else{

 
 $data = array( 
        'type'       => 2,
        'day'        => $days,
        'sub_id'     => uniqid()
        );  

$this->Model->insertData('subscription_day', $data);
$this->session->set_flashdata('day_succ','Added successfully!');
redirect('admin/twice_day_combination');
}
}
}
else{

$data['day_subs'] = $this->Model->getAlData('subscription_day');
$this->load->view('admin/day-combination',$data);


}
}

function thirce_day_combination()
{ 
  //check if loged in
  $this->check_login();
  
  $this->form_validation->set_rules('thrice_day1', 'Day One', 'required');
  $this->form_validation->set_rules('thrice_day2', 'Day Two', 'required');
  $this->form_validation->set_rules('thrice_day3', 'Day Three', 'required');

if ($this->form_validation->run() != FALSE){

 $thrice_day1  = $this->input->post('thrice_day1');
 $thrice_day2  = $this->input->post('thrice_day2');
 $thrice_day3  = $this->input->post('thrice_day3');
 
 $days       = $thrice_day1.",".$thrice_day2.",".$thrice_day3 ;

 //for only day permutation combination validation
 $days1      = $thrice_day3.",".$thrice_day2.",".$thrice_day1 ;
 $days2      = $thrice_day3.",".$thrice_day1.",".$thrice_day2 ;
 $days3      = $thrice_day1.",".$thrice_day3.",".$thrice_day2 ;
 $days4      = $thrice_day2.",".$thrice_day1.",".$thrice_day3 ;
 $days5      = $thrice_day2.",".$thrice_day3.",".$thrice_day1 ;

 
 $if_exists = $this->Model->CountWhereRecord('subscription_day',array('day'=>$days,'type'=>3));

 $if_exists1 = $this->Model->CountWhereRecord('subscription_day',array('day'=>$days1,'type'=>3));
 
 $if_exists2 = $this->Model->CountWhereRecord('subscription_day',array('day'=>$days2,'type'=>3));
 
 $if_exists3 = $this->Model->CountWhereRecord('subscription_day',array('day'=>$days3,'type'=>3));

 $if_exists4 = $this->Model->CountWhereRecord('subscription_day',array('day'=>$days4,'type'=>3));

 $if_exists5 = $this->Model->CountWhereRecord('subscription_day',array('day'=>$days5,'type'=>3));


 if($if_exists > 0){
   
   $this->session->set_flashdata('day_err','Already Exists!');
   redirect('admin/thirce_day_combination');

 }else if($if_exists1 > 0){
   
   $this->session->set_flashdata('day_err','Already Exists!');
   redirect('admin/thirce_day_combination');

 }else if($if_exists2 > 0){
   
   $this->session->set_flashdata('day_err','Already Exists!');
   redirect('admin/thirce_day_combination');

 }else if($if_exists3 > 0){
   
   $this->session->set_flashdata('day_err','Already Exists!');
   redirect('admin/thirce_day_combination');

 }else if($if_exists4 > 0){
   
   $this->session->set_flashdata('day_err','Already Exists!');
   redirect('admin/thirce_day_combination');

 }else if($if_exists5 > 0){
   
   $this->session->set_flashdata('day_err','Already Exists!');
   redirect('admin/thirce_day_combination');

 }else {

 if($thrice_day1 == $thrice_day2 || $thrice_day2 == $thrice_day3 || $thrice_day1 == $thrice_day3){
 
  $this->session->set_flashdata('day_err','You can not select same day thrice a week!');
  redirect('admin/thirce_day_combination');

 }else{

 $data = array( 
        'type'       => 3,
        'day'        => $days,
        'sub_id'     => uniqid()
        );  

$this->Model->insertData('subscription_day', $data);
$this->session->set_flashdata('day_succ','Added successfully!');
redirect('admin/thirce_day_combination');
     }
}
}
else{

$data['day_subs'] = $this->Model->getAlData('subscription_day');
$this->load->view('admin/day-combination',$data);


}

}

function del_subsday()
{
  //check if loged in
  $this->check_login();

   $sub_id   = $this->uri->segment(3);
   //check_which fuction use
   $chk = $this->Model->getData('subscription_day',array('sub_id'=>$sub_id));
   $type_day = $chk->type;

   $chk_day  = $this->Model->CountWhereRecord('job_scheduler',array('day'=>$sub_id));
 
   if($chk_day > 0){
  
    
     if($type_day == '1'){

     $this->session->set_flashdata('day_del1','You can not delete this day, because this day is already assigned to the scheduler section!');

     redirect('admin/single_day_combination');

     }else if($type_day == '2'){

     $this->session->set_flashdata('day_del2','You can not delete this day, because this day is already assigned to the scheduler section!');

     redirect('admin/twice_day_combination');

     }else{

     $this->session->set_flashdata('day_del3','You can not delete this day, because this day is already assigned to the scheduler section!');

     redirect('admin/thirce_day_combination');

    }

  }else{



   $this->db->delete('subscription_day', array('sub_id' => $sub_id));
 
  if($type_day == '1'){
   $this->session->set_flashdata('subday1','You have successfully deleted the day!');

  redirect('admin/single_day_combination');

  }else if($type_day == '2'){
   $this->session->set_flashdata('subday2','You have successfully deleted the day!');

  redirect('admin/twice_day_combination');

  }else{
   $this->session->set_flashdata('subday3','You have successfully deleted the day!');

  redirect('admin/thirce_day_combination');

    }
  }
}

function pricing_plan()
{ 
  $this->check_login();
  $data['plan_list'] = $this->Model->getAlData('pricing_plan');
  $data['shift'] = $this->Model->getAlData('shift');
  $this->load->view('admin/pricing-plan',$data);
}

function crate_pricing_plan()
{
 //check if loged in
 $this->check_login();

 $this->form_validation->set_rules('plan', 'Week a Plan', 'required');
 $this->form_validation->set_rules('shift', 'Shift', 'required');
 $this->form_validation->set_rules('price', 'Price', 'required');

if ($this->form_validation->run() != FALSE){

 $plan   = $this->input->post('plan');
 $shift  = $this->input->post('shift');
 $price  = $this->input->post('price');
 
 $if_exists = $this->Model->CountWhereRecord('pricing_plan',array('plan'=>$plan,'shift'=>$shift));

 if($if_exists > 0){
   
 $this->session->set_flashdata('plan_err','Already Exists');
 redirect('admin/pricing_plan');

 }else{

 
 $data = array( 
        'plan'       => $plan,
        'shift'      => $shift,
        'price'      => $price,
        'timestamp'  => date('Y-m-d H:i:s'),
        'plan_id'    => uniqid()
        );  

$this->Model->insertData('pricing_plan', $data);
$this->session->set_flashdata('plan_succ','Added successfully!');
redirect('admin/pricing_plan');
}
}
else{
  
  $data['plan_list'] = $this->Model->getAlData('pricing_plan');
  $data['shift'] = $this->Model->getAlData('shift');
  $this->load->view('admin/pricing-plan',$data);

}  
}

function del_price_plan()
{ 
  //check if loged in
  $this->check_login();

  $plan_id   = $this->uri->segment(3);
  
  //check if plan is exist
  $chk_plan  = $this->Model->CountWhereRecord('job_scheduler',array('pricing_planid'=>$plan_id));

  if($chk_plan > 0){
   
  $this->session->set_flashdata('pricep_er','You can not delete this pricing plan, because it is already assigned to the employee scheduler section!');
  redirect('admin/pricing_plan');

  }else{

    $this->db->delete('pricing_plan', array('plan_id' => $plan_id));

    $this->session->set_flashdata('plnsuc','You have successfully deleted the plan!');

    redirect('admin/pricing_plan');

  }
  

  
}

function employee_onboard()
{
//check if loged in
$this->check_login();

$areacode     = "SELECT DISTINCT(area_code) FROM `area_code_list`";
$data['area'] = $this->Model->getSqlData($areacode);
$this->load->view('admin/onboard-employee',$data);
}

function add_employee()
{
//check if loged in
$this->check_login();

$this->form_validation->set_rules('fullname', 'Employee Name', 'required');
$this->form_validation->set_rules('job_type', 'Job Type', 'required');

if($this->input->post('job_type') =='driver'){

$this->form_validation->set_rules('area_code', 'Area', 'required');

}


$this->form_validation->set_rules('email', 'Email id', 'required|valid_email|is_unique[cleanner.email]');
$this->form_validation->set_rules('phone', 'Mobile Number ', 'required'); 

if ($this->form_validation->run() != FALSE){

$this->load->library('upload');

//start here upload images
$identity_card = $_FILES['identity_card']['name'];
$profile       = $_FILES['profile']['name'];


//start upload image
if(!empty($identity_card)){
  
  $id_img = array();
  $files  = $_FILES;
                                   
  $_FILES['identity_card']['name']     = $files['identity_card']['name'];
  $_FILES['identity_card']['type']     = $files['identity_card']['type'];
  $_FILES['identity_card']['tmp_name'] = $files['identity_card']['tmp_name'];
  $_FILES['identity_card']['error']    = $files['identity_card']['error'];
  $_FILES['identity_card']['size']     = $files['identity_card']['size'];    

  $this->upload->initialize($this->onboarding_emp());
  $this->upload->do_upload('identity_card');
  $id_img = $this->upload->data();
    
  $for_idcard = $id_img['file_name'];

  }else{

  $for_idcard = "dummy.png";
    
  }


if(!empty($profile)){
    
$u_profile = array();
$files     = $_FILES;

$_FILES['profile']['name']     = $files['profile']['name'];
$_FILES['profile']['type']     = $files['profile']['type'];
$_FILES['profile']['tmp_name'] = $files['profile']['tmp_name'];
$_FILES['profile']['error']    = $files['profile']['error'];
$_FILES['profile']['size']     = $files['profile']['size'];    

$this->upload->initialize($this->onboarding_emp());
$this->upload->do_upload('profile');
$u_profile = $this->upload->data();

$my_profile = $u_profile['file_name'];

}else{

$my_profile = "dummy.png";

}

//end upload image 

//here is input variables
$fullname  = $this->input->post('fullname');
$email_id  = $this->input->post('email');
$phone     = $this->input->post('phone');
$job_type  = $this->input->post('job_type');
$uniq_id   = uniqid();

if($job_type == 'driver'){
    
$area_code = $this->input->post('area_code');

}else{
    
$area_code = "";

}

$data = array( 
    'timestamp'      => date('Y-m-d H:i:s'),
    'emp_id'         => $uniq_id,
    'fullname'       => $fullname,
    'email'          => $email_id,
    'phone'          => $phone,
    'job_type'       => $job_type,
    'area_code'      => $area_code,
    'identity_card'  => $for_idcard,
    'profile'        => $my_profile
    );  

$this->Model->insertData('cleanner', $data);
//here is mail to employee for confirmation
  
//mail function 
require_once APPPATH.'third_party/sendgrid/sendgrid-php.php';

$email = new \SendGrid\Mail\Mail();
$email->setfrom("info@housekeeperskw.com", "Housekeeping Portal");
$email->setSubject("Employee account verification notification");
$email->addTo($email_id , $fullname);

$mailtemp['name'] = $fullname;
$mailtemp['link'] = base_url().'home/verify_employee/'.$uniq_id;

$content = $this->load->view('mail/employee_mail',$mailtemp,true);
$email->addContent(
    "text/html",$content);

$sercre_key = $this->config->item("Sandgrid_keys");

$sendgrid = new \SendGrid(($sercre_key));

$response = $sendgrid->send($email);
//end mail 
$this->session->set_flashdata('emp_succ','Added successfully!');
redirect('admin/employee_onboard');

}
else{
  
$areacode     = "SELECT DISTINCT area_code FROM `area_code_list`";
$data['area'] = $this->Model->getSqlData($areacode);
$this->load->view('admin/onboard-employee',$data);

}  

}



function employee_schedule()
{
//check if loged in
$this->check_login();

//for cleanner
$empdata = "SELECT * FROM `cleanner` WHERE status='1' AND job_type='cleaner'";
$data['emp_list'] = $this->Model->getSqlData($empdata);

//for driver

$driver = "SELECT * FROM `cleanner` WHERE status='1' AND job_type='driver'";
$data['driver_list'] = $this->Model->getSqlData($driver);


$data['shift']    = $this->Model->getAlData('shift');
//$data['area']   = $this->Model->getAlData('area_code_list');
//area code
$area  = "SELECT DISTINCT * FROM `area_code_list` GROUP BY area_code";
$data['area'] = $this->Model->getSqlData($area);

$data['schedule'] = $this->Model->getschedule_list_desc();

$this->load->view('admin/employee-scheduler',$data);

}

function refby()
{
  $this->load->view('admin/refby_admin');

}
function get_subcription_day()
{
//check if loged in
$this->check_login();

$plan_days = $this->input->post('plan_id',TRUE);
$data      = $this->Model->get_subscription_day($plan_days)->result();
echo json_encode($data);
}

function create_schedule()
{
//check if loged in
 $this->check_login();
 $this->form_validation->set_rules('employee', 'Employee', 'required');
 $this->form_validation->set_rules('plan', 'Package', 'required');
 $this->form_validation->set_rules('days', 'Day', 'required');
 $this->form_validation->set_rules('area_code', 'Area Code', 'required');
 $this->form_validation->set_rules('shift', 'Shift', 'required');
 $this->form_validation->set_rules('driver', 'Assign Driver', 'required');

 if($this->form_validation->run() != FALSE) { 

 $employee   = $this->input->post('employee');
 $plan       = $this->input->post('plan');
 $days       = $this->input->post('days');
 $area_code  = $this->input->post('area_code');
 $shift      = $this->input->post('shift');
 $driver     = $this->input->post('driver');
 
 //check already
 $if_exists  = $this->Model->CountWhereRecord('job_scheduler',array('emp_id'=>$employee,'plan_type'=>$plan,'day'=>$days,'shift'=>$shift));

 if($if_exists > 0){
   
 $this->session->set_flashdata('job_err','This job has been already assigned!');
 redirect('admin/employee_schedule');

 }else{

 $check_shift_in_price_master = $this->Model->CountWhereRecord('pricing_plan',array('plan'=>$plan,'shift '=>$shift));

if($check_shift_in_price_master > 0){

  
 
 //GET PLAN PRICE  
 $getplan  = $this->Model->getData('pricing_plan',array('plan'=>$plan,'shift '=>$shift));

 $pricing_plan    = $getplan->price;
 $pricing_plan_id = $getplan->plan_id;

 //GET DAY NAME

 $getdays  = $this->Model->getData('subscription_day',array('sub_id'=>$days));
 $day_name = $getdays->day;

 //get area name

 $getareanm      = $this->Model->getData('area_code_list',array('area_uniqid'=>$area_code));
 $getarea_name   = $getareanm->area_name;
 $getarea_uniqid = $getareanm->area_uniqid;
 $get_area_code  = $getareanm->area_code;

 $u_jobid = uniqid();
 
 $data = array( 
        'emp_id'         => $employee,
        'scheduler_id'   => $u_jobid,
        'plan_type '     => $plan,
        'day'            => $days,
        'day_name'       => $day_name,
        'area_code'      => $get_area_code,
        'area_uniq'      => $getarea_uniqid,
        'shift'          => $shift,
        'price'          => $pricing_plan,
        'pricing_planid' => $pricing_plan_id,
        'driver'         => $driver,
        'timestamp'      => date('Y-m-d H:i:s'),
        'status'         => 1
        );  

$this->Model->insertData('job_scheduler', $data);

$this->session->set_flashdata('job_suc','Employee schedule has been successfully added!');
redirect('admin/employee_schedule');


}else{
   $this->session->set_flashdata('job_err','Please choose pricing plan according to the shift and packages!');
   redirect('admin/employee_schedule');
 }
}

}else{
  
$empdata = "SELECT * FROM `cleanner` WHERE status='1' AND job_type='cleaner'";
$data['emp_list'] = $this->Model->getSqlData($empdata);
$data['shift']    = $this->Model->getAlData('shift');
//$data['area']     = $this->Model->getAlData('area_code_list');

$area  = "SELECT DISTINCT * FROM `area_code_list` GROUP BY area_code";
$data['area'] = $this->Model->getSqlData($area);


$data['schedule'] = $this->Model->getAlData('job_scheduler');

$this->load->view('admin/employee-scheduler',$data);

}  
}

function del_scheduler()
{
  //check if loged in 
  $this->check_login();
  

  $scheduler_id   = $this->uri->segment(3);

  $chk_trans  = $this->Model->CountWhereRecord('transaction',array('job_id'=>$scheduler_id));
  
  if($chk_trans > 0){
  
  $this->session->set_flashdata('del_sch','You can not delete employee scheduler,because it is related to user purchase order!');
  redirect('admin/employee_schedule');

  }else{

  $this->db->delete('job_scheduler', array('scheduler_id' => $scheduler_id));

  $this->session->set_flashdata('del_sch_suc','You have successfully deleted your employee scheduler!');

  redirect('admin/employee_schedule');

  }

  
}

function change_password()
{
$this->check_login();
$this->load->view('admin/change-password');
}

function upd_password()
{
//check if loged in
$this->check_login();

$this->form_validation->set_rules('password', 'New Password', 'required|min_length[5]|matches[cpassword]');
$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|min_length[5]');


if ($this->form_validation->run() != FALSE){

 $password   = $this->input->post('password');
 $cpassword  = $this->input->post('cpassword');
 
 $data = array( 
        'password' => $password,
        );  

$this->Model->updateData('access', $data,array('id'=>1));

$this->session->set_flashdata('pass_succ','Password update successfully!');
redirect('admin/change_password');

}else{
  
$this->load->view('admin/change-password');

}  
}

function manage_job()
{
//check if loged in
$this->check_login();

if(!empty($this->uri->segment(3))){
   
$uid = $this->uri->segment(3);

$upcomeing_job  = "SELECT * FROM `job_avalability` WHERE user_id='$uid' AND status='1' ORDER BY book_date ASC";

}else{

$upcomeing_job  = "SELECT * FROM `job_avalability` WHERE status='1' ORDER BY book_date ASC";

}

$data['all_job'] = $this->Model->getSqlData($upcomeing_job);

$empdata = "SELECT * FROM `cleanner` WHERE status='1' AND job_type='cleaner'";
$data['emp_list'] = $this->Model->getSqlData($empdata);

$this->load->view('admin/manage-job',$data);

}


function transaction(){

  //check if loged in
$this->check_login();

if(!empty($this->uri->segment(3))){
   
$uid = $this->uri->segment(3);

$transaction = "SELECT * FROM `transaction` WHERE user_id='$uid' AND status='1' ORDER BY id ASC";

}else{

$transaction = "SELECT * FROM `transaction` WHERE status='1' ORDER BY id DESC";


}
$data['get_trans'] = $this->Model->getSqlData($transaction);

$this->load->view('admin/transaction',$data);

}

function employee_manage()
{
//check if loged in
$this->check_login();
//$data['emp_list'] = $this->Model->getAlData('cleanner');

$cleanner = "SELECT * FROM `cleanner` ORDER BY id DESC";
$data['emp_list'] = $this->Model->getSqlData($cleanner);


$this->load->view('admin/mange-employee',$data);
}

function employee_details()
{
//check if loged in
$this->check_login();

$emp_id             = $this->uri->segment(3);
$chkemp             = $this->Model->CountWhereRecord('cleanner',array('emp_id'=>$emp_id));
$data['emp_detail'] = $this->Model->getData('cleanner',array('emp_id'=>$emp_id));

if(empty($emp_id)){

redirect('home/not_found');

}else if($chkemp =='0'){
  
redirect('home/not_found');

}else{

$this->load->view('admin/employee-detais',$data);

}

}

function edit_employee()
{
//check if loged in
$this->check_login();
$emp_id             = $this->uri->segment(3);

$chkemp             = $this->Model->CountWhereRecord('cleanner',array('emp_id'=>$emp_id));

if(empty($emp_id)){

redirect('home/not_found');

}else if($chkemp =='0'){
  
redirect('home/not_found');

}else{

$data['emp_detail'] = $this->Model->getData('cleanner',array('emp_id'=>$emp_id));
$areacode           = "SELECT DISTINCT(area_code) FROM `area_code_list`";
$data['area']       = $this->Model->getSqlData($areacode);
$this->load->view('admin/edit_employee',$data);

}


}

function employee_delete()
{
  //check if loged in
  $this->check_login();

  $emp_id   = $this->uri->segment(3);
 
  $chk_schedul  = $this->Model->CountWhereRecord('job_scheduler',array('emp_id'=>$emp_id));

  if($chk_schedul > 0){
  
  $this->session->set_flashdata('emp_errr','You can not delete this employee,because it has some jobs in employee scheduler!');
  redirect('admin/employee_manage');  

  //$this->db->delete('job_scheduler', array('emp_id' => $emp_id));

  }else{
   
  $this->db->delete('cleanner', array('emp_id' => $emp_id));
  $this->session->set_flashdata('emp_succ','You have successfully deleted your employee!');


  redirect('admin/employee_manage');  

  }
}


public function upd_employee()
{
//check if loged in
$this->check_login();

//here is input variables
$fullname  = $this->input->post('fullname');
$email_id  = $this->input->post('email');
$phone     = $this->input->post('phone');
$job_type  = $this->input->post('job_type');
$emp_id    = $this->input->post('emp_id');

if($job_type == 'driver'){
$area_code = $this->input->post('area_code');
}else{
$area_code = "";
}


$this->form_validation->set_rules('fullname', 'Employee Name', 'required');
$this->form_validation->set_rules('job_type', 'Job Type', 'required');
$this->form_validation->set_rules('email', 'Email id', 'required');
$this->form_validation->set_rules('phone', 'Mobile Number ', 'required'); 

if ($this->form_validation->run() != FALSE){

$this->load->library('upload');

//start here upload images
$identity_card = $_FILES['identity_card']['name'];
$profile       = $_FILES['profile']['name'];

//start upload image
if(!empty($identity_card)){
  
  $id_img = array();
  $files  = $_FILES;
                                   
  $_FILES['identity_card']['name']     = $files['identity_card']['name'];
  $_FILES['identity_card']['type']     = $files['identity_card']['type'];
  $_FILES['identity_card']['tmp_name'] = $files['identity_card']['tmp_name'];
  $_FILES['identity_card']['error']    = $files['identity_card']['error'];
  $_FILES['identity_card']['size']     = $files['identity_card']['size'];    

  $this->upload->initialize($this->onboarding_emp());
  $this->upload->do_upload('identity_card');
  $id_img = $this->upload->data();
    
  $for_idcard = $id_img['file_name'];
  
  $idata = array('identity_card'=> $for_idcard);

  $this->Model->updateData('cleanner', $idata,array('emp_id'=>$emp_id));

  }

if(!empty($profile)){
    
$u_profile = array();
$files     = $_FILES;

$_FILES['profile']['name']     = $files['profile']['name'];
$_FILES['profile']['type']     = $files['profile']['type'];
$_FILES['profile']['tmp_name'] = $files['profile']['tmp_name'];
$_FILES['profile']['error']    = $files['profile']['error'];
$_FILES['profile']['size']     = $files['profile']['size'];    

$this->upload->initialize($this->onboarding_emp());
$this->upload->do_upload('profile');
$u_profile = $this->upload->data();

$my_profile = $u_profile['file_name'];

$pdata = array('profile'=> $my_profile);

$this->Model->updateData('cleanner', $pdata,array('emp_id'=>$emp_id));

}

//end upload image 

$data = array( 
    'fullname'       => $fullname,
    'email'          => $email_id,
    'phone'          => $phone,
    'job_type'       => $job_type,
    'area_code'      => $area_code,
    );  

$this->Model->updateData('cleanner', $data,array('emp_id'=>$emp_id));
  
$this->session->set_flashdata('emp_succ','Update successfully!');
redirect('admin/edit_employee/'.$emp_id);


}
else{
  
$data['emp_detail'] = $this->Model->getData('cleanner',array('emp_id'=>$emp_id));
$areacode           = "SELECT DISTINCT(area_code) FROM `area_code_list`";
$data['area']       = $this->Model->getSqlData($areacode);

//$this->load->view('admin/edit_employee',$data);
redirect('admin/edit_employee/'.$emp_id);

}  

}


function user()
{
//check if loged in
$this->check_login();
$data['user_list'] = $this->Model->getAlData('users');
$this->load->view('admin/user-list',$data);
}

function user_edit()
{
 $this->check_login();
 $uid           = $this->uri->segment(3);
 $chkuser       = $this->Model->CountWhereRecord('users',array('user_id'=>$uid));
 

if(empty($uid)){

  redirect('home/not_found');

}else if($chkuser=='0'){

redirect('home/not_found');

}else{
  $data['user_list']   = $this->Model->getData('users',array('user_id'=>$uid));
  $this->load->view('admin/user-edit',$data);

}

}

function upd_user()
{
//check if loged in
$this->check_login();

$this->form_validation->set_rules('fullname', 'employee name', 'required');
$this->form_validation->set_rules('email', 'email id', 'required');
$this->form_validation->set_rules('phone', 'mobile number ', 'required'); 


$user_id     = $this->input->post('user_id');

if ($this->form_validation->run() != FALSE){

//here is input variables
$fullname    = $this->input->post('fullname');
$email_id    = $this->input->post('email');
$phone       = $this->input->post('phone');


 //array data for multi address
 $newaddrs  = $this->input->post('newaddrs');
 $area_arr  = $this->input->post('area_arr');
 $ad_type  = $this->input->post('ad_type');


$data = array( 
    'fullname'       => $fullname,
    'email'          => $email_id,
    'phone'          => $phone
    
     );  

$this->Model->updateData('users', $data,array('user_id'=>$user_id));

if (!empty($area_arr) && !empty($newaddrs) && !empty($ad_type)) {

  $chkextra  = $this->Model->CountWhereRecord('user_addrs',array('uid'=>$user_id));

  if($chkextra > 0){

   $this->db->delete('user_addrs', array('uid' => $user_id));


  } 


    foreach($newaddrs as $key=> $newaddrsess){

     $area_arr_drop = $area_arr[$key];
     $area_arr_typ  = $ad_type[$key];
     
     $chk_both                  = explode("," ,$area_arr_drop);
     
     $chk_uniqid_fromarea        = $chk_both[0];
     @$chk_name_fromarea         = $chk_both[1]; 
 
    $dns = array('address'=>$newaddrsess,'chk_uniqid_fromarea'=>$chk_uniqid_fromarea,'chk_name_fromarea'=>$chk_name_fromarea,'chk_type'=>$area_arr_typ,'uid'=>$user_id);

    if (!empty($newaddrsess)) {

    $this->Model->insertData('user_addrs', $dns);
    
    }
    
    }

      
  }
  
$this->session->set_flashdata('u_succ','Update successfully!');
redirect('admin/user_edit/'.$user_id);


}else{
  

 $data['user_list']   = $this->Model->getData('users',array('user_id'=>$user_id));
 $this->load->view('admin/user-edit',$data);
  //redirect('admin/user_edit/'.$user_id);

}  

  
}

function remove_address(){

//check if loged in
  
  $this->check_login();
  $id       = $this->uri->segment(3);
  $user_id       = $this->uri->segment(4);

  $this->db->delete('user_addrs', array('id' => $id));
  
  redirect('admin/user_edit/'.$user_id);  


}


function user_details()
{
 $this->check_login();
 $uid                 = $this->uri->segment(3);
 $chkuser             = $this->Model->CountWhereRecord('users',array('user_id'=>$uid));
 
 if($uid !='1'){
 $data['user_list']   = $this->Model->getData('users',array('user_id'=>$uid));
 }else{
 $data['user_list']   = $this->Model->getData('access',array('id'=>$uid));
 }

if(empty($uid)){

  redirect('home/not_found');

}
// else if($chkuser=='0'){
// redirect('home/not_found');
// }
else{
  
  $this->load->view('admin/user-detais',$data);

}

}

function block_user()
{
 $uid    = $this->uri->segment(3);
 $data   = array('status'=>2);

 $this->Model->updateData('users',$data,array('user_id'=>$uid));
 
 redirect('admin/user');

}

function unblock_user()
{
 $uid    = $this->uri->segment(3);
 $data   = array('status'=>1);

 $this->Model->updateData('users',$data,array('user_id'=>$uid));
 
 redirect('admin/user');
}

function del_user(){

 //check if loged in
  $this->check_login();

  $uid   = $this->uri->segment(3);

  $chk_order  = $this->Model->CountWhereRecord('transaction',array('user_id'=>$uid));
 
  if($chk_order > 0){
  
  $this->session->set_flashdata('del_u','You can not delete this user,because this user have some order!');
  redirect('admin/user'); 


  }else{

  $this->db->delete('users', array('user_id' => $uid));

  $this->session->set_flashdata('del_usucc','You have successfully deleted your user!');

  redirect('admin/user'); 
  }

     
}

function login()
{
//check method
if($this->input->method() === 'post')
{
$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
$this->form_validation->set_rules('password', 'Password', 'required|max_length[30]|min_length[6]');

if ($this->form_validation->run() != FALSE){

 $email    = $this->input->post('email');
 $password = $this->input->post('password');

 $chklogin = $this->Model->CountWhereRecord('access',array('email'=>$email,'password'=>$password));


if($chklogin > 0){

$emp_id     = $this->session->userdata('emp_id');
$user_id    = $this->session->userdata('user_id');
 
//if(empty($emp_id) && (empty($user_id))){


$admin = $this->Model->getData('access',array('email' => $email,'password'=>$password));

$sess_array = array(
'username'        => $admin->username,
'admin_email'     => $admin->email,
'password'        => $admin->password,
'admin_id'        => $admin->id
);

$this->session->set_userdata($sess_array);
$this->session->set_flashdata('login_succ','Login successfully!');

redirect('admin/dashboard');

// }else{

// $this->session->set_flashdata('login_err','You can not do more than one login in the same browser!');

// redirect('admin');

// }

}else{

$this->session->set_flashdata('login_err','Your email or password does not match!');

redirect('admin');

}

}else{

$this->load->view('admin/login');

} 

}else{

$this->load->view('admin/login');

} //end method

}

function logout()
{
//check if loged in
$this->check_login(); 

$this->session->unset_userdata('admin_email');
$this->session->unset_userdata('admin_id');
$this->session->unset_userdata('password');
$this->session->unset_userdata('username');
//$this->session->sess_destroy();
redirect('admin');
}

function check_login()
{
   if($this->session->userdata('admin_email') =='')
   {
   redirect('admin');
   }
}


private function onboarding_emp()
{   
    //upload an image options
    $config = array();
    $config['upload_path']   = 'uploads/idcard/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif';
    $config['max_size']      = '0';
    $config['overwrite']     = FALSE;

    return $config;
}

//assign job for new employee when old emp not available

public function assign_newemployee()
{
  //check if loged in
$this->check_login(); 

$emp_id = $this->uri->segment(3);
$job_id = $this->uri->segment(4);
$job_primary = $this->uri->segment(5);

//get job data available table
$getjobdata = $this->Model->getData('job_avalability',array('job_id'=>$job_id));
$job_shift  = $getjobdata->job_shift;
$job_day    = $getjobdata->day;


//check in scheduler user has already work on this shift.

$if_exists = $this->Model->CountWhereRecord('job_scheduler',array('emp_id'=>$emp_id,'shift'=>$job_shift));

if($if_exists > 0){
  
  $this->session->set_flashdata('err_assign','This user has been already assigned to the same shift!');

  redirect('admin/manage_job');

  
}else{

//update new employee here
$data = array( 
  'emp_id' => $emp_id,
  );  

$this->Model->updateData('job_avalability', $data,array('id'=>$job_primary));

$this->session->set_flashdata('succ_assign','Successfully Assign!');

redirect('admin/manage_job');

     }

}

//Cansel Subscription when user not pay offline
function cansel_subscription()
{
//check if loged in
$this->check_login(); 

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


$this->session->set_flashdata('plan_cansel','Successfully cancelled subscription plan!');

redirect('admin/transaction');

 }


 function continue_subscription()
 {

//check if loged in
$this->check_login(); 

$job_id = $this->uri->segment(3);

$timestamp   = date('Y-m-d');
$order_id    = uniqid();

//get scheduler data from schid
$emp_data    = $this->Model->getData('job_scheduler',array('scheduler_id' => $job_id));
$emp_id      =  $emp_data->emp_id;
$package     =  $emp_data->plan_type;
$shift       =  $emp_data->shift;
$price       =  $emp_data->price;
$area_code   =  $emp_data->area_uniq;
$get_day_pre =  $emp_data->day;


//expiry date of plan
              
$get_exp = "SELECT * FROM `job_avalability` WHERE job_id='$job_id' ORDER BY id DESC LIMIT 1";
$expget  = $this->Model->getSqlData($get_exp);

foreach($expget as $vals){       

$plan_type    = $vals['plan_type'];
$user_id      = $vals['user_id'];

$book_date    = $vals['book_date'];
$book_day     = $vals['day'];

//for once a week

if($plan_type =='1'){


 
  $week0      = date('Y-m-d', strtotime($book_date. ' + 7 days'));
  $week_name0 = date('l', strtotime($week0));
  
  $week1      = date('Y-m-d', strtotime($week0. ' + 7 days'));
  $week_name1 = date('l', strtotime($week1));
  
  $week2      = date('Y-m-d', strtotime($week1. ' + 7 days'));
  $week_name2 = date('l', strtotime($week2));

  $week3      = date('Y-m-d', strtotime($week2. ' + 7 days'));
  $week_name3 = date('l', strtotime($week3));
  
  $uniqid  = uniqid();
  


$week_date  = array($week0,$week1,$week2,$week3);
$week_days  = array($week_name0,$week_name1,$week_name2,$week_name3);


// now add multi row daata for monthly subscription
 for ($i=0; $i <4; $i++) {
  
   $datamulti = array(
          'timestamp'  => $timestamp ,
          'job_id'     => $job_id ,
          'plan_type'  => $package ,
          'order_id'   => $order_id ,
          'user_id'    => $user_id ,
          'emp_id'     => $emp_id ,
          'book_date'  => $week_date[$i] ,
          'day'        => $week_days[$i] ,
          'status'     => 1, 
          'job_shift'  => $shift,
          'uniqid'     => $uniqid

          );

   $this->Model->insertData('job_avalability',$datamulti);
   
   }

}
//end once a weeek

//start twice
else if($plan_type =='2'){


  
  //get day for twice 
  $day_data    = $this->Model->getData('subscription_day',array('sub_id' => $get_day_pre));
  $daysin_str  =  $day_data->day;
  $get_twice   = explode (",", $daysin_str); 
  
  $get_twice1  = $get_twice[0];
  $get_twice2  = $get_twice[1];

  $old_date      = $book_date;
  $old_day       = $book_day;

  $week1      = date('Y-m-d', strtotime($old_date. '+ 1 days'));
  $week_name1 = date('l', strtotime($week1));

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
                  'job_id'     => $job_id ,
                  'order_id'   => $order_id ,
                  'user_id'    => $user_id ,
                  'emp_id'     => $emp_id ,
                  'book_date'  => $for_onedate[$i] ,
                  'day'        => $for_oneday[$i] ,
                  'status'     => 1, 
                  'job_shift'  => $shift,
                  'uniqid'     => $uniqid

                  );

    $this->Model->insertData('job_avalability',$data_ad_day1);

    } 

}//end twice


//start thrice
else if($plan_type =='3'){


  //start subscription data for thrice day
  $old_date      = $book_date;
  $old_day       = $book_day;

  $week1      = date('Y-m-d', strtotime($old_date. '+ 1 days'));
  $week_name1 = date('l', strtotime($week1));

  //get day for thrice 
  $day_data    = $this->Model->getData('subscription_day',array('sub_id' => $get_day_pre));
  $daysin_str  =  $day_data->day;
  $get_twice   = explode (",", $daysin_str); 
  $get_twice1  = $get_twice[0];
  $get_twice2  = $get_twice[1];
  $get_twice3  = $get_twice[2];

  $uniqid      = uniqid();

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
                  'job_id'     => $job_id ,
                  'order_id'   => $order_id ,
                  'user_id'    => $user_id ,
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


}//foreach

$this->session->set_flashdata('plan_cansel','Successfully add subscription plan!');

redirect('admin/transaction');


}//close function


function booknow()
{
 $sch_id = $this->uri->segment(3);
 //direct book admin
 $schc  = $this->Model->CountWhereRecord('job_scheduler',array('scheduler_id'=>$sch_id));
 
 if($schc > 0){

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
 $myids = array('sch_id'=>$sch_id,'serach_id'=>$search_id);
 $data['mykeys'] = $myids;

 $usersdata        = "SELECT * FROM `users` WHERE status='1'";
 $data['u_list']   = $this->Model->getSqlData($usersdata);

 $this->load->view('admin/refby_admin',$data);

 //redirect('admin/service_detail/'.$sch_id.'/'.$search_id);
 }else{
  redirect('home/not_found');

 }
 
}



function bookfor()
{
  $sch_id    = $this->input->post('sch_id');
  $search_id = $this->input->post('search_id');
  $user      = $this->input->post('user');

  redirect('admin/service_detail/'.$sch_id.'/'.$search_id.'/'.$user);

}


function new_userbooking()
{
$this->form_validation->set_rules('fullname', 'Fullname', 'required');
$this->form_validation->set_rules('email', 'Email id', 'required|valid_email|is_unique[cleanner.email]');
$this->form_validation->set_rules('password', 'Password', 'required'); 
$this->form_validation->set_rules('phone', 'Mobile Number ', 'required'); 
$this->form_validation->set_rules('address', 'Address', 'required');

$sch_id    = $this->input->post('sch_id');
$search_id = $this->input->post('search_id');

$myids = array('sch_id'=>$sch_id,'serach_id'=>$search_id);

if ($this->form_validation->run() != FALSE){

 //here is input variables
 $fullname  = $this->input->post('fullname');
 $email_id  = $this->input->post('email');
 $password  = $this->input->post('password');
 $phone     = $this->input->post('phone');
 $address   = $this->input->post('address');
 $uniq_id   = uniqid();


 //get segments

 $add       = explode("," , $address);
 $add_uniq  = $add[0];
 $add_name  = $add[1];
 $ref_by    = "Admin";

 $if_exists = $this->Model->CountWhereRecord('users',array('email'=>$email_id));

if($if_exists > 0){
   
 $this->session->set_flashdata('newer','Email is already exists');
 redirect('admin/booknow/'.$sch_id);

 }else{
     
    $data = array( 
        'timestamp'  => date('Y-m-d H:i:s'),
        'user_id'    => $uniq_id,
        'fullname'   => $fullname,
        'email'      => $email_id,
        'password'   => md5($password),
        'phone'      => $phone,
        'address'    => $add_name,
        'addrs_id'   => $add_uniq,
        'status'     => 1,
        'ref_by'     => $ref_by
        );  

  $this->Model->insertData('users', $data);
  
  redirect('admin/service_detail/'.$sch_id.'/'.$search_id.'/'.$uniq_id);

   
}

}else{ 
  
  $data['mykeys']   = $myids;
  $usersdata        = "SELECT * FROM `users` WHERE status='1'";
  $data['u_list']   = $this->Model->getSqlData($usersdata);
  $this->load->view('admin/refby_admin',$data);
    
  }  

}



function service_detail(){
  
  $get_sch_id      = $this->uri->segment(3);
  $get_sch_next    = $this->uri->segment(4);
  $getuid          = $this->uri->segment(5);
  
  //for only valid url
  $chk_searchdata  = $this->Model->CountWhereRecord('search_history',array('search_id'=>$get_sch_next));
  $chk_idexist     = $this->Model->CountWhereRecord('job_scheduler',array('scheduler_id'=>$get_sch_id));
  $chk_usrs        = $this->Model->CountWhereRecord('users',array('user_id'=>$getuid));

  $data['get_sch'] = $this->Model->getData('job_scheduler',array('scheduler_id'=>$get_sch_id));
  
  
  //chk id valid or not
  if(empty($get_sch_id) || empty($get_sch_next) || empty($getuid)){

  redirect('home/not_found');

  }else if($chk_idexist =='0' || $chk_searchdata =='0' || $chk_usrs =='0'){
  
  redirect('home/not_found');

  }else{

  $this->load->view('web/admin_details',$data);

  }
}


function checkout()
{
  // data variables and id's
  $timestamp   = date('Y-m-d');
  $schedule_id = $this->input->post('scheduler_id');
  $start_date  = $this->input->post('start_date');
  $day_name    = date('l', strtotime($start_date));
  
  $uid         = $this->input->post('userid');
  $order_id    = uniqid();

  //get scheduler data from schid
  $emp_data    =  $this->Model->getData('job_scheduler',array('scheduler_id' => $schedule_id));
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
          'status'     => 1, 
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
                  'status'     => 1, 
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
                  'status'     => 1, 
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
          'status'     => 1 
          );
  
  
  $this->Model->insertData('transaction',$data);

  redirect('admin/employee_schedule');


}


function rewards()
{
  //check if loged in
  $this->check_login();
  $this->load->view('admin/rewards_offer');

}

function update_reward_price()
{

  //check if loged in
  $this->check_login();

  $this->form_validation->set_rules('discount', 'Price', 'required');

  if ($this->form_validation->run() != FALSE){

 
  $data = array( 
          'discount'   => $this->input->post('discount')
          );  

$this->Model->updateData('reward_price', $data , array('id'=>1));
$this->session->set_flashdata('psucc','Price updated successfully!');
redirect('admin/rewards');

}else{

$this->load->view('admin/rewards_offer');

}

}


function denyjob_day()
{

$job_id_primary   = $this->uri->segment(3);

$user_id          = $this->uri->segment(4);

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
$is_done     = $myjob->is_done;


$befor_24  = date('Y-m-d', strtotime("-1 day", strtotime($book_date)));

$chk_already_deny = $this->Model->CountWhereRecord('job_avalability',array('job_id'=>$sch_job_id,'order_id'=>$order_id,'user_id'=>$user_id,'status'=>2));

if($is_done =='1'){

$this->session->set_flashdata('err_assign','This job is already done, so we can not deny a day!');
redirect('admin/manage_job');

}else{ 



if($cdate < $book_date){
// in this condtion user can do deny after 24hr

if($chk_already_deny > 12){

  $this->session->set_flashdata('err_assign','In this plan you have already deny a day!');
  redirect('admin/manage_job');

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

$this->session->set_flashdata('succ_assign','Successfully deny a day! we will send you rewards on your mail!');

redirect('admin/manage_job');

}

}else{


if($chk_already_deny > 0){

    $this->session->set_flashdata('err_assign','In this plan you have already deny a day!');

    redirect('admin/manage_job');

    

    }else{

    

  $data = array( 

        'status'    => 2

         );  



$this->Model->updateData('job_avalability', $data,array('id'=>$job_id_primary,'user_id'=>$user_id));

// we can not add reward for user.bcz user deny after 24hr

$this->session->set_flashdata('succ_assign','Successfully deny a day! but we can not send you a reward because you deny a day after the booking date or 24 hr after the booking date!');

redirect('admin/manage_job');



}


    }

  }//for is done

}


}//end of file...
?>