<?php
class apis_model extends CI_Model{
 function index(){
  return null;
 }
 
 function escape($string){
  return $this->db->escape($string);
 }
 
 function insert_data_user($username,$password,$status){
  $username=$this->escape($username);
  $password=$this->escape($password);
  $status=$this->escape($status);
  $sql="INSERT INTO user_accounts (`username`,`password`,`activated_status`) VALUES ($username,$password,$status)";
  $this->db->query($sql);
 }
 
 function get_login_user($username){
  $username=$this->escape($username);
  $sql="SELECT * FROM user_accounts WHERE username=$username and status=1 LIMIT 1";
  $q=$this->db->query($sql);
  return $q;
 }

}
?>
