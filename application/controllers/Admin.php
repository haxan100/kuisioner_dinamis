<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('AdminModel');
	}	
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
		$this->load->view('Admin/Pertanyaan');
		$this->load->view('Templates/Footer');
	}
	public function getPertanyaan()
	{

		$bu = base_url();
		$dt = $this->AdminModel->dt_Pertanyaan($_POST);
		$datatable['draw']   = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// var_dump($dt['data']->result());die();
		$no = $start + 1;
		foreach ($dt['data']->result() as $row) {
			$fields = array($no++);
			$fields[] = $row->pertanyaan . '<br>';
			$fields[] = 'Jawanan<br>';
			$fields[] = '
        <button class="btn btn-warning my-1  btn-block btnUbah text-white" 
          data-id_pertanyaan="' . $row->id_pertanyaan . '"
          data-pertanyaan="' . $row->pertanyaan . '"
        ><i class="far fa-edit"></i> Ubah</button>
        
        <button class="btn btn-danger my-1  btn-block btnHapus text-white" 
          data-id_pertanyaan="' . $row->id_pertanyaan . '"
          data-pertanyaan="' . $row->pertanyaan . '"
				><i class="fas fa-trash"></i> Hapus</button>        ';
			$datatable['data'][] = $fields;
		}
		echo json_encode($datatable);
		exit();
	}
        
}
        
    /* End of file  Admin.php.php */
        
                            