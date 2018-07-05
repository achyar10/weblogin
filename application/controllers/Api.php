<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $res = array('message' => 'Nothing here');

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($res));
    }

    public function get_ket() {
        $this->load->model('Sket_model');
        $res = $this->Sket_model->get_ket();

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($res));
    }

    public function get_bank() {
        $this->load->model('Spb_model');
        $res = $this->Spb_model->get_bank();

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($res));
    }

}
