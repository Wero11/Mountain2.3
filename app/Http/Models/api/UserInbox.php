<?php namespace App\Http\Models\api;

use Illuminate\Database\Eloquent\Model;
use DB;
class UserInbox extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_inbox';
	public $timestamps = false;

	protected $fillable = [ 
			'user_id',
			'sender_id',
			'message',
			'is_read',
			'is_reportabuse',
			'created_by',
			'updated_by',
			'created_dttm',
			'updated_dttm',
			'is_active'
	];

	

	public static function getConversation($sender_id,$user_id){

		$SQL="	SELECT u.id as user_id,u.user_name,u.user_type,u.first_name,u.family_name,
				m.message,ui.image_path as ProfileImage,m.created_dttm,m.id as message_id,m.is_read
				FROM user_inbox m
				LEFT JOIN user u ON (m.user_id = u.id )
				LEFT JOIN user_image ui ON (m.user_id = ui.user_id  AND ui.is_active = 1)
				WHERE (m.sender_id=".$sender_id." AND m.user_id = ".$user_id.") OR 
				 (m.sender_id=".$user_id." AND m.user_id = ".$sender_id.") AND m.is_active = 1 
				 ORDER BY m.created_dttm DESC";
	    $data = DB::select ( $SQL );  
		          
	    return $data;   
	}
	
	
	public static function updateConversation($sender_id,$user_id){

		$SQL="	UPDATE user_inbox m SET m.is_read = 1
				WHERE (m.sender_id=".$user_id." AND m.user_id = ".$sender_id.") 
				AND m.is_active = 1 AND m.is_read = 0  
				ORDER BY m.created_dttm DESC";
	    $data = DB::select ( $SQL );  		          
	    return $data;   
	}
	
	
	public static function receiveMessage($sender_id,$user_id){

		$SQL="	SELECT u.id as user_id,u.user_name,u.user_type,u.first_name,u.family_name,
				m.message,ui.image_path as ProfileImage,m.created_dttm,m.id as message_id,m.is_read
				FROM user_inbox m
				LEFT JOIN user u ON (m.user_id = u.id )
				LEFT JOIN user_image ui ON (m.user_id = ui.user_id  AND ui.is_active = 1)
				WHERE (m.sender_id=".$user_id." AND m.user_id = ".$sender_id.")  
				 AND m.is_active = 1 
				 AND m.is_read = 0 
				 ORDER BY m.created_dttm DESC";
		
	    $data = DB::select ( $SQL );            
	    return $data;   
	}


	public static function getMessageHistory($user_id){

		$SQL="  SELECT u.id as user_id,u.user_name,u.user_type,u.first_name,u.family_name,
				m.message,ui.image_path as ProfileImage,m.created_dttm,m.id as message_id,m.is_read,m.sender_id			
				FROM (SELECT id,message, created_dttm, is_read, is_active,sender_id,
				     if(sender_id = $user_id, user_id, sender_id) as cid 
					FROM `user_inbox` WHERE (user_id = $user_id OR sender_id = $user_id )  Order by id desc)  m
				LEFT JOIN user u ON (m.cid = u.id )
				LEFT JOIN user_image ui ON m.cid = ui.user_id  AND ui.is_active = 1
				WHERE m.is_active = 1
				GROUP BY user_id ORDER BY m.created_dttm DESC";
		
	    $data = DB::select ( $SQL );            
	    return $data;   
	}

	public static function deleteConversation($user_id,$sender_id){

		$SQL = "UPDATE user_inbox  m SET m.is_active = 0 WHERE() (m.user_id = ".$user_id." AND m.sender_id = ".$sender_id." ) OR
		(m.user_id = ".$sender_id." AND m.sender_id = ".$user_id." ))";
		
		$data = DB::select ( $SQL );      
		if($data)
	    	return TRUE; 
	    else
	    	return FALSE;
	}


	public static function getUnreadCount($user_id,$sender_id){

		$SQL = "SELECT count(*) as unread FROM `user_inbox` WHERE user_id = $user_id AND sender_id = $sender_id AND is_read = 0 AND is_active = 1";
		
		$data = DB::select ( $SQL );      
		if($data)
	    	return $data[0]->unread; 
	    else
	    	return 0;
	}
public static function getAllUnreadCount($user_id){

		$SQL = "SELECT count(*) as unread FROM `user_inbox` WHERE user_id = $user_id AND is_read = 0 AND is_active = 1";
		
		$data = DB::select ( $SQL );      
		if($data)
	    	return $data[0]->unread; 
	    else
	    	return 0;
	}

}
