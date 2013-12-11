<?php

class Message_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    

    function sendMessage($data){
        
        $userId = $this->session->userdata('userId');
        $userSend = $this->db->get_where('user',array('username' => $data['username']))->row_array();
        
        if(isset($userSend['id'])){
            $msg = array(
               'subject'   => $data['subject'] ,
               'article'   => $data['article'] ,
               'message'   => $data['message'],
               'from_user' => $userId,
               'to_user'   => $userSend['id']
            );
            $this->db->insert('message', $msg);
            return TRUE ;    
        }
        else{
            return FALSE ;
        }
        
    }


    function getMsg($mid){
        $userId = $this->session->userdata('userId');
        $query = "  SELECT 
                        msg.*,from_usr.username as from_user,
                        to_usr.username as to_user 
                    FROM 
                        message as msg , 
                        user as from_usr ,
                        user as to_usr 
                    WHERE 
                        msg.from_user = from_usr.id 
                    AND msg.id =".$mid."
                    AND to_usr.id=".$userId;

        $messages = $this->db->query($query)->row_array();
    
        return $messages;
    }

    function getInbox($data = null){
        $userId = $this->session->userdata('userId');
        $query = "  SELECT 
                        msg.*,usr.username 
                    FROM 
                        message as msg ,
                        user as usr 
                    WHERE msg.from_user = usr.id
                    AND msg.is_deleted = 0
                    AND msg.is_spam = 0
                    AND msg.to_user =".$userId ;

        $messages = $this->db->query($query)->result_array();
        return $messages;
    }

    function deleteMessage($mids){  
        //$query = "UPDATE FROM  `message` WHERE id IN ( $mids )";
        $query = "UPDATE message SET  is_deleted =  1 WHERE  id IN (".$mids.") ";
        $this->db->query($query);
        return TRUE ;
    }

    function getSent($data = null){
        $userId = $this->session->userdata('userId');
        $query = "  SELECT 
                        msg.*,usr.username 
                    FROM 
                        message as msg ,
                        user as usr 
                    WHERE msg.to_user = usr.id
                    AND msg.is_deleted = 0
                    AND msg.is_spam = 0
                    AND msg.from_user =".$userId ;

        $messages = $this->db->query($query)->result_array();
        return $messages;
    }

    function getSpam($data = null){
        $userId = $this->session->userdata('userId');
        $query = "  SELECT 
                        msg.*,usr.username 
                    FROM 
                        message as msg ,
                        user as usr 
                    WHERE msg.from_user = usr.id
                    AND msg.is_deleted = 0
                    AND msg.is_spam = 1
                    AND msg.to_user =".$userId ;

        $messages = $this->db->query($query)->result_array();
        return $messages;
    }

    function getThrash($data = null){
        $userId = $this->session->userdata('userId');
        $query = "  SELECT 
                        msg.*,usr.username 
                    FROM 
                        message as msg ,
                        user as usr 
                    WHERE msg.from_user = usr.id
                    AND msg.is_deleted = 1
                    AND msg.is_spam = 0
                    AND msg.to_user =".$userId ;

        $messages = $this->db->query($query)->result_array();
        return $messages;
    }

    function spamMessage($mids){
        $query = "UPDATE message SET  is_spam =  1 WHERE  id IN (".$mids.") ";
        $this->db->query($query);
        return TRUE ;
    }

    function deleteMsgsForever($mids){  
        $query = "DELETE FROM message WHERE  id IN (".$mids.") ";
        $this->db->query($query);
        return TRUE ;
    }
}