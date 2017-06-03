<?php

/**
 * Represent a user
 */

class User_model extends CI_Model {

    public $email;
    public $password;
    public $token;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function emailExists($email){
        $this->db->where('email', $email);
        return $this->db->count_all_results('users') > 0;
    }
    
    public function add($user) {     
        $this->db->insert('users', $user);
        return $this->db->insert_id();
    }
    
    public function user_exists($user_id, $token){
        $this->db->where('id', $user_id);
        $this->db->where('token', $token);
        $this->db->from('users');
        return $this->db->count_all_results() > 0;
    }
    
    public function validateUser($user_id, $token){        
        $this->db->set('is_valid', 1);
        $this->db->where('id', $user_id);
        $this->db->where('token', $token);
        $this->db->update('users');
    }
    
    public function getUser($data) {
        $this->db->where('email', $data['email']);
        $q = $this->db->get('users');
        
        $result = $q->result();
        if(count($result) < 1) {
            return FALSE;
        } else { 
            $user = $result[0];
            
            if(password_verify($data['password'], $user->password)) {
                return $user;
            } else {
                return FALSE;
            } 
        }
    }
    
    public function addToken($data) {
        $this->db->insert('tokens', $data);
    }
    
    public function isTokenValid($user_id, $token) {
        $query = $this->db->get_where('tokens', ['user_id' => $user_id, 'token' => $token]);
        
        @$r = $query->result()[0];
        
        if(!$r || $r->expire_at <= time()) {
            return FALSE;
        } else { 
            return TRUE;   
        }
    }
    
    public function getUserByEmail($email) {
        $this->db->where('email', $email);
        $q = $this->db->get('users');
        
        $result = $q->result();
        if(count($result) < 1) {
            return FALSE;
        } else { 
            return $result[0];
        }        
    }    
    
    public function updatePwd($id, $pwd) {
        $this->db->set('password', $pwd);
        $this->db->where('id', $id);
        $this->db->update('users');    
    }
    
    public function getAllUsers() {
        return $this->db->get('users')->result();
    }
}