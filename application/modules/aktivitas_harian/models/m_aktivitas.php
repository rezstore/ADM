<?php 
class m_aktivitas extends CI_model {
function tampil()
	{
			$sql ="SELECT * from user_activity WHERE  1";
			$qwr=$this->db->query($sql);
			return $qwr;
	}
function insert_db($user,$date,$text)
	{
			$user=$this->escape($user);
			$date=$this->escape($date);
			$text=$this->escape($text);

			$sql="INSERT INTO user_activity (`username`, `date_post`, `actifity_list`) VALUES ($user,$date,$text)";
			$qwr=$this->db->query($sql);
			return $qwr;
	}
function escape($str)
	{
			return $this->db->escape($str);

	}


function update_db($id,$user,$date,$actifis)
	{
			$id=$this->escape($id);
			$user=$this->escape($user);
			$date=$this->escape($date);
			$actifis=$this->escape($actifis);

		echo	$sql="UPDATE `user_activity` SET  username=$user ,  `date_post` = $date, `actifity_list` = $actifis
						WHERE `user_activity`.`activity_ID` = $id";
			$qwr=$this->db->query($sql);
			return $qwr;
	}
function select_db($id)
	{
			$id=$this->escape($id);
			$sql="SELECT * FROM  user_activity WHERE activity_ID=$id limit 1";
			$qwr=$this->db->query($sql);
			return $qwr;
	}



}
?>