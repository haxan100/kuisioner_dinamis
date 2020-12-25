<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Admin extends CI_Controller {

public function index()
{
        $this->load->view('Templates/Header');
		$this->load->view('Templates/Sidebar');
		$this->load->view('Templates/TopNavigasi');

		$this->load->view('Admin/Home');
		$this->load->view('Templates/Footer');
				
}
	public function Pertanyaan()
	{
		$this->load->view('Templates/Header');
		$this->load->view('Templates/Sidebar');
		$this->load->view('Templates/TopNavigasi');
		// $this->load->view('Admin/Pertanyaan');
		$this->load->view('Templates/Templates');
		$this->load->view('Templates/Footer');
	}
        
}
        
    /* End of file  Admin.php.php */
        
                            