<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('AdminModel');
		$this->load->model('SemuaModel');
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


		
        <button class="btn btn-warning my-1  btn-block btnDetail text-white" 
          data-id_pertanyaan="' . $row->id_pertanyaan . '"
		><i class="far fa-edit"></i> Detail </button>
		
        
        <button class="btn btn-danger my-1  btn-block btnHapus text-white" 
          data-id_pertanyaan="' . $row->id_pertanyaan . '"
          data-pertanyaan="' . $row->pertanyaan . '"
				><i class="fas fa-trash"></i> Hapus</button>        ';
			$datatable['data'][] = $fields;
		}
		echo json_encode($datatable);
		exit();
	}
	public function tambahPertanyaan()
	{
		// var_dump($_POST);die;
		$ask = $this->input->post('ask', TRUE);

		$message = 'Gagal menambah data !<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		if (empty($ask)) {
			$status = false;
			$errorInputs[] = array('#ask', 'Silahkan Isi Pertanyaan');
		}
		$in = array(
			'pertanyaan' => $ask,
		);
		$this->SemuaModel->tambahData('pertanyaan',$in);

		$message = "Berhasil Menambah Data #1";

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function hapusPertanyaan()
	{
		$id = $this->input->post('id', TRUE);
		$data = $this->SemuaModel->getDataId('pertanyaan','id_pertanyaan',$id)->result();
		$status = false;
		$message = 'Gagal menghapus Data!';
		if (count($data) == 0) {
			$message .= '<br>Tidak terdapat Data yang dimaksud.';
		} else {
			$this->SemuaModel->HapusData('pertanyaan','id_pertanyaan',$id);
			$status = true;
			$message = 'Berhasil menghapus Data: <b>' . $data[0]->pertanyaan . '</b>';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
	}
	public function ubahPertanyaan()
	{
		// var_dump($_POST);die;
		$id = $this->input->post('id', TRUE);
		$ask = $this->input->post('ask', TRUE);

		$message = 'Gagal mengedit data !<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(
			'pertanyaan' => $ask,
		);
		if (empty($ask)) {
			$status = false;
			$errorInputs[] = array('#ask', 'Silahkan Isi Pertanyaan');
		}
		if ($status) {
			$this->SemuaModel->editData('pertanyaan','id_pertanyaan', $id,$in);
			$message = "Berhasil Mengedit Data ";
			$status = true;
		} else {
			$message = "Gagal Mengubah Data #1";
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function Jawaban($id= "")
	{
			if($id=="") {
				die("tidak Dikasih ID");
			}else {
				$ids = $this->SemuaModel->getDataId('pertanyaan', 'id_pertanyaan', $id)->row();
				// var_dump($ids);die;
				if($ids==null){
					die("tidak ada");
				}else{

				
		
			$obj['id'] = $id;
			$obj['pertanyaan']= $this->SemuaModel->getDataId('pertanyaan','id_pertanyaan',$id)->row()->pertanyaan;
			// var_dump($obj['pertanyaan']);die;
			$this->load->view('Templates/Header');
			$this->load->view('Templates/Sidebar');
			$this->load->view('Templates/TopNavigasi');
			$this->load->view('Admin/Jawaban',$obj);
			$this->load->view('Templates/Footer');
			};
		}
	}
	public function getJawaban()
	{

		$id = $this->input->post('id');
		$bu = base_url();
		$dt = $this->AdminModel->dt_Jawaban($_POST);
		$datatable['draw']   = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// var_dump($dt['data']->result());die();
		$no = $start + 1;
		foreach ($dt['data']->result() as $row) {
			$fields = array($no++);
			$fields[] = $row->jawaban . '<br>';
			$fields[] = '
        <button class="btn btn-warning my-1  btn-block btnUbah text-white" 
		  data-id_jawaban="' . $row->id_jawaban . '"
		  data-id_pertanyaan="' . $row->id_pertanyaan . '"
          data-jawaban="' . $row->jawaban . '"
		><i class="far fa-edit"></i> Ubah</button>

        <button class="btn btn-danger my-1  btn-block btnHapus text-white" 
          data-id_jawaban="' . $row->id_jawaban . '"
          data-jawaban="' . $row->jawaban . '"
				><i class="fas fa-trash"></i> Hapus</button>        ';
			$datatable['data'][] = $fields;
		}
		echo json_encode($datatable);
		exit();
	}
	public function tambahJawaban()
	{
		// var_dump($_POST);die;
		$id_pertanyaan = $this->input->post('id_pertanyaan', TRUE);
		$ask = $this->input->post('ask', TRUE);

		$message = 'Gagal menambah data !<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		if (empty($ask)) {
			$status = false;
			$errorInputs[] = array('#ask', 'Silahkan Isi Pertanyaan');
		}
		if (empty($id_pertanyaan)) {
			$status = false;
			$errorInputs[] = array('#id_pertanyaan', 'Silahkan Isi Pertanyaan');
		}
		$in = array(
			'jawaban' => $ask,
			'id_pertanyaan' => $id_pertanyaan,
		);
		$this->SemuaModel->tambahData('jawaban', $in);

		$message = "Berhasil Menambah Data #1";

		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function ubahJawaban()
	{
		// var_dump($_POST);die;
		$id = $this->input->post('id', TRUE);
		$ask = $this->input->post('ask', TRUE);
		$id_pertanyaan = $this->input->post('id_pertanyaan', TRUE);

		$message = 'Gagal mengedit data !<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(
			'jawaban' => $ask,
			'id_pertanyaan' => $id_pertanyaan,
		);
		if (empty($ask)) {
			$status = false;
			$errorInputs[] = array('#ask', 'Silahkan Isi Pertanyaan');
		}
		if ($status) {
			$this->SemuaModel->editData('jawaban', 'id_jawaban', $id, $in);
			$message = "Berhasil Mengedit Data ";
			$status = true;
		} else {
			$message = "Gagal Mengubah Data #1";
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function hapusJawaban()
	{
		$id = $this->input->post('id', TRUE);
		$data = $this->SemuaModel->getDataId('jawaban', 'id_jawaban', $id)->result();
		$status = false;
		$message = 'Gagal menghapus Data!';
		if (count($data) == 0) {
			$message .= '<br>Tidak terdapat Data yang dimaksud.';
		} else {
			$this->SemuaModel->HapusData('jawaban', 'id_jawaban', $id);
			$status = true;
			$message = 'Berhasil menghapus Data: <b>' . $data[0]->jawaban . '</b>';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
	}
        
}
        
    /* End of file  Admin.php.php */
        
                            