<?php
	/**
	* 
	*/
	class Hello extends CI_Controller
	{

		public function __construct()
		{
			parent :: __construct();
			echo "This is the inicialization<br>";
		}

		public function index()
		{
			echo "This is index";
		}
		
		public function one($p1 , $p2)
		{
			echo 'This is the one <br>';
			echo "These are the parameters: $p1 and $p2 <br>";
		}

		public function two() 
		{
			echo 'This is the two';
		}
	}
?>