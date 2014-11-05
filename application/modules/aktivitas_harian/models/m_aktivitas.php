<?php 
define('T_ACT','user_activities');
define('TYPE','activities');

class m_aktivitas extends CI_model {

	function view_activity($user=''){
		$user=$this->escape($user);
		$type=$this->escape(TYPE);
		$sql ="SELECT * from ".T_ACT." WHERE user = $user AND type = $type ORDER BY date_time ASC";
		$qwr=$this->db->query($sql);
		return $qwr;
	}
	function insert_db($user,$date,$text){
		$user=$this->escape($user);
		$date=$this->escape($date.' '.date('g:i:s'));
		$text=$this->escape($text);
		$type=$this->escape(TYPE);

		$sql="INSERT INTO ".T_ACT." (`user`, `date_time`,`type`, `message`) VALUES ($user,$date,$type,$text)";
		$qwr=$this->db->query($sql);
		return $qwr;
	}
	
	function escape($str){
		return $this->db->escape($str);

	}

	function update_db($id,$user,$date,$activity){
		$id=$this->escape($id);
		$user=$this->escape($user);
		$date=$this->escape($date.' '.date('g:i:s'));
		$activity=$this->escape($activity);
		$type=$this->escape(TYPE);

		echo $sql="UPDATE ".T_ACT." SET  user=$user ,  `date_time` = $date, `message` = $activity
			WHERE `ID` = $id AND type=$type LIMIT 1";
		$qwr=$this->db->query($sql);
		return $qwr;
	}

	function select_activity($id){
		$id=$this->escape($id);
		$type=$this->escape(TYPE);
		$sql="SELECT * FROM  ".T_ACT." WHERE ID=$id AND type=$type LIMIT 1";
		$qwr=$this->db->query($sql);
		return $qwr;
	}



}
?>
