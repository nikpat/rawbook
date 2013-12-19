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
        $buy_items_str = $data['buy_items'];
        $sell_items_str = $data['sell_items'];
        $trade_items_str = $data['trade_items'];
        $buy_items = array();
        $sell_items = array();
        $trade_items = array();

        if(strlen($buy_items_str)>1){
            $buy_items = explode(',',$buy_items_str);
        }
        if(strlen($sell_items_str)>1){
            $sell_items = explode(',',$sell_items_str);
        }
        if(strlen($trade_items_str)>1){
            $trade_items = explode(',',$trade_items_str);
        }
        

        echo count($buy_items);
        echo count($sell_items);
        echo count($trade_items);
        exit;
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