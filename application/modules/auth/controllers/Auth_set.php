<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Auth_set extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('users/Users_model');
    $this->load->library('form_validation');
    $this->load->helper('string');
    $this->load->library('recaptcha');
  }

  function index() {
    redirect('manage/auth/login');
  }

  function login() {
    if ($this->session->userdata('logged')) {
      redirect('manage');
    }
    if ($this->input->post('location')) {
      $location = $this->input->post('location');
    } else {
      $location = NULL;
    }

    $data = array(
      'recaptcha_html' => $this->recaptcha->render()
    );

    $this->form_validation->set_rules('email', 'Email', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    $this->form_validation->set_rules('g-recaptcha-response', '<strong>Captcha</strong>', 'callback_getResponseCaptcha');
    if ($_POST AND $this->form_validation->run() == TRUE) {
      $email = $this->input->post('email', TRUE);
      $password = $this->input->post('password', TRUE);
      $user = $this->Users_model->get(array('email' => $email, 'password' => sha1($password)));

      if (count($user) > 0) {
        if ($user[0]['user_status']== 'active') {
          $this->session->set_userdata('logged', TRUE);
          $this->session->set_userdata('uid', $user[0]['user_id']);
          $this->session->set_userdata('uemail', $user[0]['user_email']);
          $this->session->set_userdata('ufullname', $user[0]['user_full_name']);
          $this->session->set_userdata('user_image', $user[0]['user_image']);
          if ($location != '') {
            header("Location:" . htmlspecialchars($location));
          } else {
            redirect('manage');
          }
        } else {
          $this->session->set_flashdata('success', 'Maaf, Akun anda belum dikonfirmasi');
          redirect('manage/auth/login');
        }
      } else {

        $this->session->set_flashdata('success', 'Maaf, username dan password tidak cocok!');
        redirect('manage/auth/login');
      }
    } else {
      $this->load->view('manage/login', $data);
    }
  }

  function register() {

    $this->load->config('email');
    $this->load->library('email');
    $this->load->helper('string');
    $this->form_validation->set_rules('user_full_name', 'Nama Lengkap', 'trim|required');
    $this->form_validation->set_rules('user_gender', 'Jenis Kelamin', 'trim|required');
    $this->form_validation->set_rules('user_phone', 'No Handphone', 'trim|required');
    $this->form_validation->set_rules('user_email', 'Email', 'trim|required|is_unique[users.user_email]');
    $this->form_validation->set_rules('user_password', 'Password', 'trim|required');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
    if ($_POST AND $this->form_validation->run() == TRUE) {
      $email = $this->input->post('user_email', TRUE);
      $users = $this->Users_model->get(array('user_email' => $email));
      if (count($users) > 0) {
        redirect('base');
      } else {
        $token = random_string('alnum',5);
        $status = $this->Users_model->add(
          array(
            'user_email' => $this->input->post('user_email'),
            'user_password' => sha1($this->input->post('user_password')),
            'user_full_name' => $this->input->post('user_full_name'),
            'user_gender' => $this->input->post('user_gender'),
            'user_phone' => $this->input->post('user_phone'),
            'user_status' => 'pending',
            'user_input_date' => date('Y-m-d H:i:s'),
            'user_last_update' => date('Y-m-d H:i:s'),
            'user_token' => $token
          )
        );
// send email
        if($this->config->item('email'))
        {
          $params = array();
          $params['token'] = $token;
          $this->email->from($this->config->item('from'), $this->config->item('from_name'));
          $this->email->to($this->input->post('user_email')); 
          $this->email->subject('Konfirmasi registrasi');
          $this->email->message($this->load->view('email/registration', array('params' => $params), true));
          $this->email->send();
        }
        $this->session->set_flashdata('success', 'Akun anda berhasil dibuat, silahkan cek email anda untuk konfirmasi');
        redirect('manage/auth/login');
      }
    } else {
      $this->load->view('manage/register');
    }
  }

  function confirmation() {
    $this->load->config('email');
    $this->load->library('email');
    $data = array(
      'recaptcha_html' => $this->recaptcha->render()
    );
    $this->form_validation->set_rules('email', 'Email', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    $this->form_validation->set_rules('g-recaptcha-response', '<strong>Captcha</strong>', 'callback_getResponseCaptcha');
    if ($_POST AND $this->form_validation->run() == TRUE) {
      $email = $this->input->post('email', TRUE);
      $password = $this->input->post('password', TRUE);
      $token = $this->input->post('token', TRUE);
      $user = $this->Users_model->get(array('user_email' => $email, 'password' => sha1($password), 'token' => $token));

      if (count($user) > 0) {
        if ($user[0]['user_status']!= 'active' OR $user[0]['user_status']== 'not_active') {
          $status = $this->Users_model->add(array(
            'user_status' => 'active',
            'user_id' => $user[0]['user_id']
          ));
            // Send Email Confirmation
          if($this->config->item('email'))
          {
            $params = array();
            $this->email->from($this->config->item('from'), $this->config->item('from_name'));
            $this->email->to($user[0]['user_email']); 
            $this->email->subject('Konfirmasi registrasi');
            $this->email->message($this->load->view('email/confirmation', array('params' => $params), true));
            $this->email->send();
          } 
          $this->session->set_flashdata('success', 'Akun anda berhasil dikonfirmasi, silahkan login');
          redirect('manage/auth/login');
        } else {
          $this->session->set_flashdata('success', 'Maaf, Konfirmasi Gagal');
          redirect('manage/auth/login');
        }
      } else {
        $this->session->set_flashdata('success', 'Maaf, Akun anda sudah aktif, silahkan login');
        redirect('manage/auth/login');
      }
    } else {
      $this->load->view('manage/confirmation',$data);
    }
  }

  public function getResponseCaptcha($str)
  {
    $this->load->library('recaptcha');
    $response = $this->recaptcha->verifyResponse($str);
    if ($response['success'])
    {
      return true;
    } else {
      $this->form_validation->set_message('getResponseCaptcha', '%s is required.' );
      return false;
    }
  }

  function forgot() {
    $this->load->config('email');
    $this->load->library('email');
    $this->load->helper('string');
    $data = array(
      'recaptcha_html' => $this->recaptcha->render()
    );

    $this->form_validation->set_rules('email', 'Email', 'trim|required');
    $this->form_validation->set_rules('g-recaptcha-response', '<strong>Captcha</strong>', 'callback_getResponseCaptcha');
    if ($_POST AND $this->form_validation->run() == TRUE) {
      $email = $this->input->post('email', TRUE);
      $user = $this->Users_model->get(array('user_email' => $email));
      if($this->config->item('email'))
      {
        $params = array();
        $params['user'] = $user[0];
        $params['url'] = site_url('manage/auth/rpw?e='.$user[0]['user_email'].'&c='.$user[0]['user_password']);
        $this->email->from($this->config->item('from'), $this->config->item('from_name'));
        $this->email->to($email); 
        $this->email->subject('Konfirmasi Lupa Password');
        $this->email->message($this->load->view('email/forgot', array('params' => $params), true));
        $this->email->send();
      }
      redirect('manage/auth/login');

    } else {
      $this->load->view('manage/forgot', $data);
    }
  }

  function rpw() {

    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    $this->form_validation->set_rules('passconf', 'Konfirmasi password', 'trim|required|xss_clean|matches[password]');
    if ($_POST) {
      if($this->form_validation->run() == TRUE){

        $email = $this->input->post('email', TRUE);
        $code = $this->input->post('code', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->Users_model->get(array('user_email' => $email, 'password' => $code));

        if (count($user) > 0) {
          $this->Users_model->add(array('user_id' => $user[0]['user_id'], 'user_password' => sha1($password)));
          redirect('manage/auth/login');
        }else{
          redirect(site_url());
        }
      }else{
        $this->session->set_flashdata('failed', 'Maaf, username dan password tidak cocok!');
        redirect(site_url('manage/auth/rpw?e='.$email.'&c='.$code));
      }
    } else {
      $q = $this->input->get(NULL, TRUE);
      $user = $this->Users_model->get(array('user_email' => $q['e'], 'password' => $q['c']));
      if (count($user) > 0) {
        $data['email'] = $q['e'];
        $data['code'] = $q['c'];
        $this->load->view('manage/rpw', $data);
      }else{
        redirect('manage');
      }

    }
  }

// Logout Processing
  function logout() {
    $this->session->unset_userdata('logged');
    $this->session->unset_userdata('uid');
    $this->session->unset_userdata('uemail');
    $this->session->unset_userdata('ufullname');
    $this->session->unset_userdata('user_image');

    $q = $this->input->get(NULL, TRUE);
    if ($q['location'] != NULL) {
      $location = $q['location'];
    } else {
      $location = NULL;
    }
    header("Location:" . $location);
  }

}
