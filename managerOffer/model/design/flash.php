<?php
class ModelDesignFlash extends Model {	
	public function getFlash($flash_id) {
		$query = $this->db->query("SELECT flash_name FROM " . DB_PREFIX . "flash WHERE flash_id = '" . (int)$flash_id . "'");
		
		return $query->rows;
	}
}
?>