<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class SemuaModel extends CI_Model {
	public function tambahData($namaTable, $data)
	{
		return $this->db->insert($namaTable, $data);
	}
	public function getDataId($namaTable,$id)
	{
		$this->db->select('*');
		$this->db->where('id_pertanyaan', $id);
		$query = $this->db->get($namaTable);
		return $query;
		# code...
	}
	public function HapusData($namaTable,$namaID,$id)
	{
		$this->db->where($namaID, $id);
		$this->db->delete($namaTable);
		$query = $this->db->get($namaTable);
		return $query->result();


		# code...
	}
                        
                            
                        
}
                        
/* End of file SemuaModel.php */
    
                        