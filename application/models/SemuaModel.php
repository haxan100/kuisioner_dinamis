<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class SemuaModel extends CI_Model {
	public function tambahData($namatable, $data)
	{
		return $this->db->insert($namatable, $data);
	}
                        
                            
                        
}
                        
/* End of file SemuaModel.php */
    
                        