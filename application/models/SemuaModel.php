<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class SemuaModel extends CI_Model {
	public function tambahData($namaTable, $data)
	{
		return $this->db->insert($namaTable, $data);
	}
	public function getDataId($namaTable,$id_table,$id)
	{
		$this->db->select('*');
		$this->db->where($id_table, $id);
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
	public function editData($namaTable,$namaID,$id,$data)
	{
		$this->db->where($namaID, $id);
		return $this->db->update($namaTable, $data);
	}
                        
                            
                        
}
                        
/* End of file SemuaModel.php */
    
                        