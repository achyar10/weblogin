<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array()) {

        if (isset($params['id'])) {
            $this->db->where('users.user_id', $params['id']);
        }
        if (isset($params['user_id'])) {
            $this->db->where('users.user_id', $params['user_id']);
        }
        if (isset($params['user_email'])) {
            $this->db->where('user_email', $params['user_email']);
        }
        if (isset($params['password'])) {
            $this->db->where('user_password', $params['password']);
        }
        if (isset($params['status'])) {
            $this->db->where('user_status', $params['status']);
        }

        if (isset($params['token'])) {
            $this->db->where('user_token', $params['token']);
        }
        if (isset($params['date'])) {
            $this->db->where('user_input_date', $params['date']);
        }

        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'desc');
        } else {
            $this->db->order_by('user_last_update', 'desc');
        }

        $this->db->select('users.user_id, user_password, user_full_name, user_gender, user_phone, user_pob, user_dob, user_address, user_status, user_token,
            user_email, user_image, user_input_date, user_last_update');

        $res = $this->db->get('users');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }


    function add($data = array()) {

        if (isset($data['user_id'])) {
            $this->db->set('user_id', $data['user_id']);
        }

        if (isset($data['user_password'])) {
            $this->db->set('user_password', $data['user_password']);
        }

        if (isset($data['user_full_name'])) {
            $this->db->set('user_full_name', $data['user_full_name']);
        }

        if (isset($data['user_email'])) {
            $this->db->set('user_email', $data['user_email']);
        }

        if (isset($data['user_image'])) {
            $this->db->set('user_image', $data['user_image']);
        }

        if (isset($data['user_gender'])) {
            $this->db->set('user_gender', $data['user_gender']);
        }

        if (isset($data['user_pob'])) {
            $this->db->set('user_pob', $data['user_pob']);
        }

        if (isset($data['user_dob'])) {
            $this->db->set('user_dob', $data['user_dob']);
        }

        if (isset($data['user_phone'])) {
            $this->db->set('user_phone', $data['user_phone']);
        }

        if (isset($data['user_address'])) {
            $this->db->set('user_address', $data['user_address']);
        }

        if (isset($data['user_status'])) {
            $this->db->set('user_status', $data['user_status']);
        }

        if (isset($data['user_token'])) {
            $this->db->set('user_token', $data['user_token']);
        }

        if (isset($data['user_input_date'])) {
            $this->db->set('user_input_date', $data['user_input_date']);
        }

        if (isset($data['user_last_update'])) {
            $this->db->set('user_last_update', $data['user_last_update']);
        }

        if (isset($data['user_id'])) {
            $this->db->where('user_id', $data['user_id']);
            $this->db->update('users');
            $id = $data['user_id'];
        } else {
            $this->db->insert('users');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }


    function delete($id) {
        $this->db->where('user_id', $id);
        $this->db->delete('users');
    }


    function change_password($id, $params) {
        $this->db->where('user_id', $id);
        $this->db->update('users', $params);
    }

}
