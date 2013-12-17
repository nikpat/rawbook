<?php

class Core_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    

    function registerUser($data){
        print_r($data);
        $checkUsername = count($this->db->get_where('user',array('username' => $data['username']))->result_array());
        $checkEmail = count($this->db->get_where('user',array('email' => $data['email']))->result_array());

        $data = array(
           'email'      => $data['email'] ,
           'username'   => $data['username'] ,
           'password'   => md5($data['password']),
           'firstname'  => $data['firstname'] ,
           'lastname'  => $data['lastname'] ,
        );
        $this->db->insert('user', $data);
        $res = array(
           'status'     => 'success' ,
           'username'   => $data['username'] ,
           'email'      => $data['email'] ,
        );
        
        return $this->db->insert_id(); ;
    }

    function login($data){

        $by_username = $this->db->get_where('user',array('username' => $data['usernameEmail'],'password' => md5($data['password'])))->row_array();
        $by_email = $this->db->get_where('user',array('email' => $data['usernameEmail'],'password' => md5($data['password'])))->row_array();

        
        $byUsername = count($by_username);
        $byEmail = count($by_email);

        if($byUsername == 0 && $byEmail == 0 ){
            return false ;
        }
        else if($byUsername > 0 ){
            return $by_username ;
        }
        else if($byEmail > 0 ){
            return $by_email ;
        }
    }

    function get_countries(){
        return $this->db->get('country')->result_array();
    }

    function get_cities($code){
        return $this->db->get_where('city',array("CountryCode"=>$code))->result_array();
    }

    function get_categories(){
        $query = "SELECT * FROM category ORDER BY 'parent_id'";
        return $this->db->query($query)->result_array();
    }

}