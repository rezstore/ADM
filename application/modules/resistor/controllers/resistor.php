<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resistor extends CI_Controller {
	function __construct()
	 {
		parent::__construct();
		$this->load->helper('resistor');
	 }
	 
	function index(){
	 /* diketahui 
		g1=merah;
		g2=coklat;
		g3=kuning;
		g4=emas;
	 */
	 echo 2^(2);
	 echo '|';
		$p1=P1COKLAT_4;
		$p2=P2MERAH_4;
		echo $p3=P3ORANGE_4;
		$p4=P4EMAS_4;
		$p12=$p1.$p2;
		echo '|'.$p123=$p12*$p3;
		$p1234=$p123.$p4;
		echo '|'.$p1234;
	}
	
	
}
//end of file
