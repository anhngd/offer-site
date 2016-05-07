<?php
class ModelDesignFlash extends Model {
	public function addFlash($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "flash SET name = '" . $this->db->escape($data['name']) . "', status = '" . (int)$data['status'] . "', flash_name = '" .$this->db->escape($data['file_name'])."'");

	}
	public function editFlash($flash_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "flash SET name = '" . $this->db->escape($data['name']) . "', status = '" . (int)$data['status'] . "',  flash_name = '" .$this->db->escape($data['file_name'])."' WHERE flash_id = '" . (int)$flash_id . "'");	
	}public function deleteFlashFile($flash_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "flash SET flash_name = '' WHERE flash_id = '" . (int)$flash_id . "'");	
	}
	
	public function deleteFlash($flash_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "flash WHERE flash_id = '" .(int)$flash_id . "'");
		
	}
	
	public function getFlash($flash_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "flash WHERE flash_id = '" . (int)$flash_id . "'");
		
		return $query->row;
	}
		
	public function getFlashs($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "flash";
		
		$sort_data = array(
			'name',
			'status'
		);	
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY name";	
		}
		
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}					

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}		
		
		$query = $this->db->query($sql);

		return $query->rows;
	}
		
	public function getTotalFlash() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "flash");
		
		return $query->row['total'];
	}	
}
?>