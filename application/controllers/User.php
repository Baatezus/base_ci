<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');
    }

    public function index()
    {
        if(is_null($this->user) || $this->user->admin !== '1') {
            redirect('home');
        }
        
        $data['users'] = $this->user_model->getAllUsers();
        
        $this->load->view('components/header');
        $this->load->view('admin/user_list', $data);
        $this->load->view('components/endpage');
    }

    public function signup()
    {
        $data['signup'] = FALSE;
        $this->form_validation->set_rules('email', 'Email', 'required|callback_email_check|callback_emailexists_check');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_password_check');
        $this->form_validation->set_rules('passconf', 'Passconf', 'required|callback_passconf_check');
        
        if ($this->form_validation->run() !== FALSE)
        {
            $user['email'] = $this->input->post('email');
            $user['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $user['token'] = md5(uniqid());
            
            $user_id = $this->user_model->add($user);
            $url = base_url() .
                    "index.php/user/confirm_registration/".
                    "$user_id/" . $user['token'];
            $this->welcomeMail($user['email'], $url);
            
            $data['signup'] = TRUE; 
            $data['email'] = $user['email'];
        }
     
        $this->load->view('components/header');
        $this->load->view('user/signup', $data);
        $this->load->view('components/endpage');
    }
    
    public function confirm_registration($user_id = NULL, $token = NULL) {
        if(is_null($user_id) || is_null($token)){
            redirect('home');
        }
        
        if($this->user_model->user_exists($user_id, $token)) {
            $this->user_model->validateUser($user_id, $token);
            redirect('user/registration_done');
        } else {
            $data["message"] = "Something went wrong...";
        }
        
        $this->load->view('components/header');
        $this->load->view('user/confirm_registration', $data);
        $this->load->view('components/endpage');
    }
    
    public function registration_done() {
        $this->load->view('components/header');
        $this->load->view('user/registration_done');
        $this->load->view('components/endpage');        
    }

    public function signin()
    {
        $data['message'] = FALSE;
        
        $this->form_validation->set_rules('email', 'Email', 'required|callback_email_check');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_password_check');
        
        if ($this->form_validation->run() !== FALSE)
        {
            $user = $this->user_model->getUser($this->input->post());
            
            if(!$user){
                $data['message'] = "Wrong email or password";
            }else if($user->is_valid === '1') {
                $this->session->set_userdata('user', $user);
                $this->session->set_flashdata('message', 'You have signed in, welcome back !');
                redirect("home");    
            } else {
                $url = base_url() .
                        "index.php/user/confirm_registration/".
                        $user->id. "/" . $user->token;                
                $data['message'] = "Your registration is not complete,"
                        . " please visit the link we sent you "
                        . "to confirm your registration";
                
                $this->welcomeMail($user->email, $url);                
            }
        }
        
        $this->load->view('components/header');
        $this->load->view('user/signin', $data);
        $this->load->view('components/endpage');
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('home');
    }
    
    public function forgot() {
        $data['message'] = '';
        $data['request_sent'] = FALSE;

        $this->form_validation->set_rules('email', 'E-mail', 'required|callback_email_check');

        if ($this->form_validation->run() !== FALSE) {                

            $user = $this->user_model->getUserByEmail($this->input->post('email'));

            if($user) {
                $tokenData['expire_at'] = time() + 1800;
                $tokenData['token'] =  md5(uniqid());
                $tokenData['user_id'] = $user->id;
                $this->user_model->addToken($tokenData);

                $url='http://www.yannlaru.com/index.php/user/new_password/' .
                        $tokenData['user_id'] . '/' .
                        $tokenData['token'];

                $this->recoverPwdMail($user->email, $url);
                $data['request_sent'] = TRUE;
                $data['email'] = $this->input->post('email');
                $data['url'] = $url;

            } else {
                $data['message'] = "Cet email ne correspond à aucun compte";
            }  
        } 

        $this->load->view('components/header', $data);
        $this->load->view('user/forgot_form');
        $this->load->view('components/endpage');
    }    
    
    public function new_password($user_id = NULL, $token = NULL) {
        $data['token'] = $token; 
        $data['user_id'] = $user_id;

        $postData = $this->input->post();

        if(isset($postData['token']) && isset($postData['user_id'])) {
            $token = $postData['token'];
            $user_id = $postData['user_id'];
        }

        $isTokenValid = $this->user_model->isTokenValid($user_id, $token);
        
        if(!$isTokenValid){
            redirect('user/invalid_token');
        }
        
        $this->form_validation->set_rules('password', 'Password', 'required|callback_password_check');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'callback_passconf_check');

        if ($this->form_validation->run() !== FALSE) {                     
            $this->user_model->updatePwd($user_id, password_hash($this->input->post('password'), PASSWORD_DEFAULT));

            redirect('user/password_updated');
        } 

        $this->load->view('components/header', $data);
        $this->load->view('user/new_pwd_form');
        $this->load->view('components/endpage');
    }
    
    public function password_updated() {
        $this->load->view('components/header');
        $this->load->view('user/password_updated');
        $this->load->view('components/endpage');        
    }
    
    public function my_page($token = NULL) {
        if(is_null($this->user) || $token !== $this->user->token) {
            redirect('home');
        }
        
        $this->load->view('components/header');
        $this->load->view('user/my_page');
        $this->load->view('components/endpage');       
    }
        
    public function email_check($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $this->form_validation->set_message("email_check", "Email format is not correct");
            return FALSE;
        }       

        return TRUE;
    }
    
    public function emailexists_check($email)
    {        
        if ($this->user_model->emailExists($email))
        {
            $this->form_validation->set_message("emailexists_check", "Email is already use");
            return FALSE; 
        }

        return TRUE;
    }   
    
    public function password_check($password)
    {
        if (strlen($password) <= 7)
        {
            $this->form_validation->set_message("password_check", "Password is too short");
            return FALSE;
        }

        return TRUE;
    }    
    
    public function passconf_check($passconf)
    {
        if ($passconf !== $this->input->post('password'))
        {
            $this->form_validation->set_message("passconf_check", "Confirmation does not match with password");
            return FALSE;
        }

        return TRUE;
    } 
    
    public function welcomeMail() {
        // send a welcome email with activation link
    }
    
    public function recoverPwdMail($email, $url) {
        // Send revovery passowrd email
    }
}
