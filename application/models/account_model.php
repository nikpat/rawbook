<?php

class Account_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_users(){
        $query = "  SELECT usr.* , grp.name type,a.interest FROM user usr 
                    LEFT JOIN
                    `group` grp
                    ON
                    usr.group_id=grp.id
                    LEFT JOIN
                        (   SELECT ui.user_id,GROUP_CONCAT(cat.title) as interest 
                            FROM category cat 
                            LEFT JOIN user_interest ui 
                            ON ui.category_id = cat.id 
                            GROUP BY ui.user_id
                        ) as a
                    ON 
                    a.user_id = usr.id " ;

        $userinfo = $this->db->query($query)->result_array() ; 
        return $userinfo;
    }


    // find users with interest
    function get_interest_users(){
        $query = "  SELECT usr.* , grp.name type,a.interest FROM user usr 
                    LEFT JOIN
                    `group` grp
                    ON
                    usr.group_id=grp.id
                    LEFT JOIN
                        (   SELECT ui.user_id,GROUP_CONCAT(cat.title) as interest 
                            FROM category cat 
                            LEFT JOIN user_interest ui 
                            ON ui.category_id = cat.id 
                            GROUP BY ui.user_id
                        ) as a
                    ON 
                    a.user_id = usr.id " ;

        $userinfo = $this->db->query($query)->result_array() ; 
        return $userinfo;
    }
    
    function get_user($id){
    	return $this->db->get_where('user',array('id'=>$id))->row_array();    	
    }

    function is_following($this_id,$that_id){
    	if(count($this->db->get_where('user_connection',array('user_id'=>$this_id,'following_id'=>$that_id))->result_array()) > 0){
    		return TRUE ;
    	}
    	else{
    		return FALSE ;
    	}
    }

    function follow($this_id,$that_id){
    	if(count($this->db->get_where('user_connection',array('user_id'=>$this_id,'following_id'=>$that_id))->result_array()) < 1){
    		$data = array(
				   'user_id' => $this_id ,
				   'following_id' => $that_id
				);
    		if($this->db->insert('user_connection', $data)){
	    		echo TRUE;
	    	}
    	}
    	else{
    		return FALSE;
    	}
    }

    function unfollow($this_id,$that_id){
    	if(count($this->db->get_where('user_connection',array('user_id'=>$this_id,'following_id'=>$that_id))->result_array()) > 0){
    		$this->db->where('user_id', $this_id);
    		$this->db->where('following_id', $that_id);
			$this->db->delete('user_connection'); 
			return TRUE;
    	}
    	else{
    		return FALSE;
    	}
    }

    //takes id to give comma seperated ids
    function user_interest($user_id){
        $query = "  SELECT GROUP_CONCAT(cat.title) interest  FROM category cat LEFT JOIN user_interest ui ON ui.category_id = cat.id WHERE ui.user_id=".$user_id." GROUP BY ui.user_id";
        $interestarr = $this->db->query($query)->row_array() ;
        if(count($interestarr) > 0){
            return $interestarr['interest']  ;     
        }
        else{
            return "";    
        }
    }

    function user_follower($user_id){
    	$userArr = array();
        $query = "  SELECT usr.* , grp.name type,a.interest FROM user usr 
                    LEFT JOIN
                    user_connection uc 
                    ON
                    usr.id=uc.user_id
                    LEFT JOIN
                    `group` grp
                    ON
                    usr.group_id=grp.id
                    LEFT JOIN
                        (   SELECT ui.user_id,GROUP_CONCAT(cat.title) as interest 
                            FROM category cat 
                            LEFT JOIN user_interest ui 
                            ON ui.category_id = cat.id 
                            GROUP BY ui.user_id
                        ) as a
                    ON 
                    a.user_id = uc.user_id
                    WHERE   uc.following_id=".$user_id;

        $userinfo = $this->db->query($query)->result_array() ; 
        
        
        return $userinfo;
    }

    function user_following($user_id){
    	$query = " SELECT usr.* , grp.name type,a.interest  FROM user usr 
                    LEFT JOIN
                    user_connection uc 
                    ON
                    usr.id=uc.following_id
                    LEFT JOIN
                    `group` grp
                    ON
                    usr.group_id=grp.id
                    LEFT JOIN
                        (   SELECT ui.user_id,GROUP_CONCAT(cat.title) as interest 
                            FROM category cat 
                            LEFT JOIN user_interest ui 
                            ON ui.category_id = cat.id 
                            GROUP BY ui.user_id
                        ) as a
                    ON 
                    a.user_id = uc.following_id
                    WHERE   uc.user_id=".$user_id;

        $userinfo = $this->db->query($query)->result_array();
        
    	return $userinfo;
    }

    function follower_ids($user_id){
        $query = "SELECT GROUP_CONCAT(user_id) as followers_ids FROM user_connection WHERE following_id =".$user_id." GROUP BY following_id";
        $qryarr = $this->db->query($query)->result_array();
        if(count($qryarr) > 0){
            $followers_ids =  $qryarr[0]['followers_ids'];    
        }
        else {
            $followers_ids =  0 ;   
        }
        return $followers_ids;
    }

    function following_ids($user_id){
        $query = "SELECT GROUP_CONCAT(following_id) as following_ids FROM user_connection WHERE user_id =".$user_id." GROUP BY user_id";
        $qryarr = $this->db->query($query)->result_array();
        if(count($qryarr) > 0){
            $following_ids =  $qryarr[0]['following_ids'];    
        }
        else {
            $following_ids =  0 ;   
        }
        return $following_ids;
    }
    
    function user_categories($user_id){
        $query = " SELECT cat.* FROM `category` cat 
                    LEFT JOIN
                    `user_interest` usr_int
                    ON
                    usr_int.category_id=cat.id
                    WHERE   usr_int.user_id= ".$user_id;
        return $this->db->query($query)->result_array();
    }

    function follow_category($user_id,$category_id){
        if(count($this->db->get_where('user_interest',array('user_id'=>$user_id,'category_id'=>$category_id))->result_array()) < 1){
            $data = array(
                   'user_id' => $user_id ,
                   'category_id' => $category_id
                );
            if($this->db->insert('user_interest', $data)){
                echo TRUE;
            }
        }
        else{
            return FALSE;
        }
    }

    function unfollow_category($user_id,$category_id){
        if(count($this->db->get_where('user_interest',array('user_id'=>$user_id,'category_id'=>$category_id))->result_array()) > 0){
            $this->db->where('user_id', $user_id);
            $this->db->where('category_id', $category_id);
            $this->db->delete('user_interest'); 
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    function categories($user_id){
        $query = "  SELECT * 
                    FROM  `category` where category.id not in ( SELECT cat.id FROM `category` cat 
                    LEFT JOIN
                    `user_interest` usr_int
                    ON
                    usr_int.category_id=cat.id
                    WHERE   usr_int.user_id= ".$user_id.")
                    LIMIT 0 , 30 ";
        return $this->db->query($query)->result_array();
    }

    function edit_profile($user_id,$data,$image){
        
        $opts = array(
          'http'=>array(
            'method'=>"GET",
            'header'=>"Accept-language: en\r\n" .
                      "Cookie: foo=bar\r\n"
          )
        );

        $context = stream_context_create($opts);

        // Open the file using the HTTP headers set above

        //$homepage = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='+$data['country']+','+$data['city']+',mumbai&sensor=false', false, $context);
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$data['country'].','.$data['city'].'&sensor=false';
        
        //$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=india,bombay&sensor=false';
        $homepage = file_get_contents($url, false, $context);
        $jsonDcoded = json_decode($homepage);
        $lat = $jsonDcoded->results['0']->geometry->location->lat;
        $lng = $jsonDcoded->results['0']->geometry->location->lng;
        
    

        $filename = $this->do_upload($image);

        
        $user = $this->db->query('SELECT * FROM user WHERE id ='.$user_id)->row_array();
        $oldpass = $user['img_url'];

        $data = array(
                'firstname' => $data['firstname'],
                'middlename' => $data['middlename'],
                'lastname' => $data['lastname'],
                'dob' => $data['dob'],
                'gender' => $data['gender'],
                'country' => $data['country'],
                'city' => $data['city'],
                'lat' => $lat,
                'lng' => $lng
            );

        if($filename){
            $data['img_url'] = $filename;

        }

        $this->db->where('id', $user_id);
        $this->db->update('user', $data); 

        
    }

    function do_upload($FILE)
    {
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $FILE["file"]["name"]);
        $extension = end($temp);
        $filename = uniqid().'.'.$extension ;


        if ((($FILE["file"]["type"] == "image/gif")
        || ($FILE["file"]["type"] == "image/jpeg")
        || ($FILE["file"]["type"] == "image/jpg")
        || ($FILE["file"]["type"] == "image/pjpeg")
        || ($FILE["file"]["type"] == "image/x-png")
        || ($FILE["file"]["type"] == "image/png"))
        && ($FILE["file"]["size"] < 2000000)
        && in_array($extension, $allowedExts))
          {
          if ($FILE["file"]["error"] > 0)
            {
                //return "Return Code: " . $_FILES["file"]["error"] . "<br>";
                return FALSE;
            }
          else
            {

            if (file_exists("./pics/".$filename ))
              {
              return  $FILE["file"]["name"] . " already exists. ";
              }
            else
              {
              move_uploaded_file($FILE["file"]["tmp_name"],
              "./pics/" . $filename);
              return $filename;
              }
            }
          }
        else
          {
            return FALSE;
          }


    }


    function change_password($user_id,$data){

        $user = $this->db->query('SELECT password FROM user WHERE id ='.$user_id)->row_array();
        $oldpass = $user['password'];
        if(md5($data['old_pass']) == $oldpass ){
           $data = array(
                'password' => md5($data['new_pass']),
            );
            $this->db->where('id', $user_id);
            $this->db->update('user', $data); 
            return TRUE ; 
        }
        else{
            return FALSE ;
        }
        
    }
}

