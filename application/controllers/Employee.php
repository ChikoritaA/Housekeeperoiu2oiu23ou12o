<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Employee extends CI_Controller {
	
public function __construct() 
{
    
    parent::__construct(); 
    
    date_default_timezone_set('Asia/Kolkata');
    $this->load->database();
    $this->load->model('Model');
    $this->load->library(array('form_validation','session'));
    $this->load->helper(array('form','url'));


}
	
public function index()
{  
    
if($this->session->userdata('emp_id') !='')
 {
   redirect('employee/dashboard');
   
 }else{
     
$this->load->view('employee/cleaner-login');

   }
	 
     
}

function dashboard()
{
 $this->check_login();
 $emp_id = $this->session->userdata('emp_id'); 

 $data['upcoming_job'] = $this->Model->CountWhereRecord('job_avalability',array('emp_id'=>$emp_id,'status'=>1,'is_done'=>0));
 $data['complte_job']  = $this->Model->CountWhereRecord('job_avalability',array('emp_id'=>$emp_id,'status'=>1,'is_done'=>1));

 $this->load->view('employee/cleaner-dashboard',$data);

}

function driver_booking()
{

$this->check_login();

$emp_id         = $this->session->userdata('emp_id'); 

$upcomeing_job  = "SELECT * FROM `job_avalability` WHERE  status='1' AND is_done='0' ORDER BY book_date ASC";

$data['upcoming_jobs'] = $this->Model->getSqlData($upcomeing_job);

$this->load->view('employee/driverjobs',$data);


}

function upcoming_job()
{  
$this->check_login();

$emp_id = $this->session->userdata('emp_id'); 

$upcomeing_job  = "SELECT * FROM `job_avalability` WHERE emp_id='$emp_id' AND status='1' AND is_done='0' ORDER BY book_date ASC";
$data['upcoming_jobs'] = $this->Model->getSqlData($upcomeing_job);

$this->load->view('employee/cleaner-upcoming-jobs',$data);
     
}

function complte_job()
{  

$this->check_login();

$emp_id = $this->session->userdata('emp_id'); 

$upcomeing_job  = "SELECT * FROM `job_avalability` WHERE emp_id='$emp_id' AND status='1' AND is_done='1' ORDER BY id DESC";
$data['complted_job'] = $this->Model->getSqlData($upcomeing_job);

$this->load->view('employee/cleaner-complete-jobs',$data);
     
}


function view_client_profile()
{
    $user_id          = $this->uri->segment(3);
    $availability_id  = $this->uri->segment(4);
    
    $chkuid           = $this->Model->CountWhereRecord('users',array('user_id'=> $user_id));
    $chkadata         = $this->Model->CountWhereRecord('job_avalability',array('uniqid'=> $availability_id));
    
    $data['udetails'] = $this->Model->getData('users',array('user_id'=>$user_id));
    
    $note = "SELECT * FROM `note_data` WHERE availability_id='$availability_id' ORDER BY id DESC LIMIT 1";
    $data['notes'] = $this->Model->getSqlData($note);

    if(empty($user_id)){
    
    redirect('home/not_found');
     
    }else if(empty($availability_id)){
    
    redirect('home/not_found');
    
    }
    //else if($chkuid =='0' || $user_id ='1'){
    
       // redirect('home/not_found');
        
    //}
    else if($chkadata =='0'){
    
        redirect('home/not_found');
        
    }else{
   
    $this->load->view('employee/view-client-pofile',$data);
    
    }
    

}

function add_note()
{  


//here is input variables 
$emp_id           = $this->session->userdata('emp_id');
$emp_name         = $this->session->userdata('emp_name');

$user_id          = $this->input->post('user_id');
$availability_id  = $this->input->post('availability_id');
$note             = $this->input->post('note');


    $data = array( 
        'timestamp'  => date('Y-m-d H:i:s'),
        'emp_id'     => $emp_id,
        'note_by'    => $emp_name,
        'note'       => $note,
        'user_id'    => $user_id,
        'availability_id' => $availability_id,
        'note_id'    => uniqid()
        );  

  
  $this->Model->insertData('note_data',$data);
  //$this->Model->updateData('users', $data,array('user_id'=>$user_id));

  $this->session->set_flashdata('note','Successfully Added!');

  redirect('employee/view_client_profile/'.$user_id.'/'.$availability_id);
   

}




function myprofile()
{  
$this->check_login();
$this->load->view('employee/cleaner-self-profile');
     
}

function client_pofile()
{
$this->check_login();
$this->load->view('employee/view-client-pofile');
}

function login_employee()
{
    
//check method
if($this->input->method() === 'post')
{
    
$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
$this->form_validation->set_rules('password', 'Password', 'required');

if ($this->form_validation->run() != FALSE){

 $email    = $this->input->post('email');
 $password = md5($this->input->post('password'));

 $chklogin = $this->Model->CountWhereRecord('cleanner',array('email'=>$email,'password'=>$password));


if($chklogin > 0){

//check account is verify or not from email
$chk_acc_verify = $this->Model->CountWhereRecord('cleanner',array('email'=>$email,'password'=>$password,'status'=>1));

$admin_id     = $this->session->userdata('admin_id');
$user_id    = $this->session->userdata('user_id');
 
// if(empty($admin_id) && (empty($user_id))){

if($chk_acc_verify > 0){


$emp = $this->Model->getData('cleanner',array('email' => $email,'password'=>$password));

$sess_array = array(
'emp_name'         => $emp->fullname,
'emp_email'        => $emp->email,
'emp_job_type'     => $emp->job_type,
'emp_id'           => $emp->emp_id
);

$this->session->set_userdata($sess_array);
//$this->session->set_flashdata('login_succ','Login successfully!');

redirect('employee/dashboard');

}else{

$this->session->set_flashdata('login_err','Your account is inactive,please verify by mail!');

redirect('employee');

}

// }else{
// $this->session->set_flashdata('login_err','You can not do more than one login in the same browser
// !');
// redirect('employee');
// }

}

else{

$this->session->set_flashdata('login_err','Your Email or Password does not match!');

redirect('employee');

}

}else{

$this->load->view('employee/cleaner-login');


} 


}else{

$this->load->view('employee/cleaner-login');

} //end method


}

function check_login()
{
   if($this->session->userdata('emp_email') =='')
   {
   redirect('employee');
   }
}

function logout()
{ 
   
$this->session->unset_userdata('emp_name');
$this->session->unset_userdata('emp_email');
$this->session->unset_userdata('emp_job_type');
$this->session->unset_userdata('emp_id');
//$this->session->sess_destroy();
redirect('employee');
}

function forgot_password()
{
 
 $this->load->view('employee/cleaner-forgot-password');

}

function change_password()
{

$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

if ($this->form_validation->run() != FALSE){

 $email    = $this->input->post('email');

 $chklogin = $this->Model->CountWhereRecord('cleanner',array('email'=>$email));


if($chklogin > 0){

 $cleanner_data = $this->Model->getData('cleanner',array('email' => $email));

 $emp_name  =  $cleanner_data->fullname;
 $emp_email =  $cleanner_data->email;
 $emp_id    =  $cleanner_data->emp_id;

 //send token for otp
 $token = array('email_token'=>1);
 $this->Model->updateData('cleanner',$token,array('emp_id'=>$emp_id));

  //mail function 
  require_once APPPATH.'third_party/sendgrid/sendgrid-php.php';

  $email = new \SendGrid\Mail\Mail();
  $email->setfrom("info@housekeeperskw.com", "Housekeeping");
  $email->setSubject("Forgot Password");
  $email->addTo($emp_email , $emp_name);
  
  $mailtemp['name'] = $emp_name;
  $mailtemp['forgot'] = base_url().'employee/upd_password/'.$emp_id;
  
  $content = $this->load->view('mail/employee_forgot',$mailtemp,true);
  $email->addContent(
      "text/html",$content);
  
  $sercre_key = $this->config->item("Sandgrid_keys");

  $sendgrid = new \SendGrid(($sercre_key));


  $response = $sendgrid->send($email);
  //end mail 

$this->session->set_flashdata('ch_suc','Your request is successfully sent on mail!');

redirect('employee/forgot_password');

}else{

$this->session->set_flashdata('ch_err','Your Email is does not exist!');

redirect('employee/forgot_password');

}

}else{

 $this->load->view('employee/cleaner-forgot-password');


} 

}

function upd_password()
{
 $emp_id          = $this->uri->segment(3);
 $chkemp_isexist  = $this->Model->CountWhereRecord('cleanner',array('emp_id'=>$emp_id,'email_token'=>1));
 
  if(empty($emp_id)){
 
   redirect('home/not_found');
 
  }else if($chkemp_isexist =='0'){
   
   redirect('home/expire');

  }else{

  $this->load->view('employee/change_pswd'); 

  }
   
}

function emp_changed_pass()
{
  $emp_id     = $this->input->post('emp_id');
  $password   = $this->input->post('password');
  $cpassword  = $this->input->post('cpassword');
 

 if(empty($emp_id)){
 
 redirect('home/not_found');

 }else if($password != $cpassword){
 
 $this->session->set_flashdata('ch_err','Password and confirm password does not match!');
 redirect('employee/upd_password/'.$emp_id);

 }
 else{

     $data = array( 
        'password'    => md5($password),
        'email_token' => 0
        );  

$this->Model->updateData('cleanner', $data,array('emp_id'=>$emp_id));

$this->session->set_flashdata('pas_suc','Password successfully changed login here!');

redirect('employee');

 }
 
}

function job_done()
{
   
$job_id_primary   = $this->uri->segment(3);
$emp_id           = $this->session->userdata('emp_id');
$cdate            = date('Y-m-d');
//get data from job
$myjob     = $this->Model->getData('job_avalability',array('id' => $job_id_primary,'emp_id'=>$emp_id));
$book_date = $myjob->book_date;

if($cdate == $book_date || $cdate > $book_date){
    $data = array( 
        'is_done'    => 1
        );  

$this->Model->updateData('job_avalability', $data,array('id'=>$job_id_primary,'emp_id'=>$emp_id));

$this->session->set_flashdata('job_done','Congrats! You have successfully completed your job!');

redirect('employee/upcoming_job');

}else{

$this->session->set_flashdata('not_done','You can not done your Job before date!');
redirect('employee/upcoming_job');

}
 
}





//end of file
}