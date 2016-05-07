<?php
class ModelCatalogProductExtra extends Model {
	
	/**
	 * @param $language - used to fetch product related translations
	 */
	public function getProducts($data = array(), $language = null) {
		if($language == null){
			$selected_language = (int)$this->config->get('config_language_id');
		} else {
			$selected_language = (int)$language;
		}
		if ($data) {
			//Used because need a link to another table
			if (isset($data['filter_store']) && !is_null($data['filter_store'])) {
				$sql = "SELECT DISTINCT pd.*, p.* FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store pts ON (p.product_id = pts.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category ptc ON (p.product_id=ptc.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE pd.language_id = '" . $selected_language . "'";
			} else {
				$sql = "SELECT DISTINCT ptc.*, pd.*, p.* FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category ptc ON (p.product_id=ptc.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE pd.language_id = '" . $selected_language . "'";
			}
			if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
				$sql .= " AND LCASE(pd.name) LIKE '%" . $this->db->escape(strtolower($data['filter_name'])) . "%'";
			}

			if (isset($data['filter_model']) && !is_null($data['filter_model'])) {
				$sql .= " AND LCASE(p.model) LIKE '%" . $this->db->escape(strtolower($data['filter_model'])) . "%'";
			}
			if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
				if(count(explode("&gt;", urldecode($data['filter_price']))) > 1){
					$between = explode("&gt;", urldecode($data['filter_price']));
					if(trim($between[1]) == ""){ //case 10>
						$sql .= " AND p.price >= " . (float)$this->db->escape($between[0]);
					} else { //case 5>10
						$sql .= " AND p.price between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
					}
				} elseif(count(explode("&lt;", urldecode($data['filter_price']))) > 1){
					$between = explode("&lt;", urldecode($data['filter_price']));
					if(trim($between[0]) == ""){ //case <10
						$sql .= " AND p.price <= " . (float)$this->db->escape($between[1]);
					} else { //case 5<10
						$sql .= " AND p.price between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
					}
				} else {
					$sql .= " AND p.price = '" . $this->db->escape($data['filter_price']) . "'";
				}
			}
			if (isset($data['filter_sort_order']) && !is_null($data['filter_sort_order'])) {
				if(count(explode("&gt;", urldecode($data['filter_sort_order']))) > 1){
					$between = explode("&gt;", urldecode($data['filter_sort_order']));
					if(trim($between[1]) == ""){ //case 10>
						$sql .= " AND p.sort_order >= " . (float)$this->db->escape($between[0]);
					} else { //case 5>10
						$sql .= " AND p.sort_order between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
					}
				} elseif(count(explode("&lt;", urldecode($data['filter_sort_order']))) > 1){
					$between = explode("&lt;", urldecode($data['filter_sort_order']));
					if(trim($between[0]) == ""){ //case <10
						$sql .= " AND p.sort_order <= " . (float)$this->db->escape($between[1]);
					} else { //case 5<10
						$sql .= " AND p.sort_order between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
					}
				} else {
					$sql .= " AND p.sort_order = '" . $this->db->escape($data['filter_sort_order']) . "'";
				}
			}
			if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
				if(count(explode("&gt;", urldecode($data['filter_quantity']))) > 1){
					$between = explode("&gt;", urldecode($data['filter_quantity']));
					if(trim($between[1]) == ""){ //case 10>
						$sql .= " AND p.quantity >= " . (int)$this->db->escape($between[0]);
					} else { //case 5>10
						$sql .= " AND p.quantity between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
					}
				} elseif(count(explode("&lt;", urldecode($data['filter_quantity']))) > 1){
					$between = explode("&lt;", urldecode($data['filter_quantity']));
					if(trim($between[0]) == ""){ //case <10
						$sql .= " AND p.quantity <= " . (int)$this->db->escape($between[1]);
					} else { //case 5<10
						$sql .= " AND p.quantity between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
					}
				} else {
					$sql .= " AND p.quantity = '" . $this->db->escape($data['filter_quantity']) . "'";
				}
			}
			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
			}
			
			if (isset($data['filter_store']) && !is_null($data['filter_store'])) {
				$sql .= " AND pts.store_id = '" . (int)$data['filter_store'] . "'";
			}
			
			if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
				$sql .= " AND ptc.category_id = '" . (int)$data['filter_category'] . "'";
			}
			
			if (isset($data['filter_manufacturer']) && !is_null($data['filter_manufacturer'])) {
				$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer'] . "'";
			}
			if (isset($data['product_id']) && !is_null($data['product_id'])) {
				$sql .= " AND p.product_id = '" . (int)$data['product_id'] . "'";
			}

			$sort_data = array(
				'pd.name',
				'p.model',
				'p.quantity',
				'p.status',
				'p.sort_order',
				'p.price',
				'm.name'
			);
			
			$sql .= " GROUP BY p.product_id";
			
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY pd.name";	
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
		} else {
			$product_data = $this->cache->get('product.' . $selected_language);
		
			if (!$product_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . $selected_language . "' ORDER BY pd.name ASC");
	
				$product_data = $query->rows;
			
				$this->cache->set('product.' . $selected_language, $product_data);
			}	
	
			return $product_data;
		}
	}
	
	
	public function getProductStores($product_id) {
		$product_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_store_data[] = $result['store_id'];
		}
		
		return $product_store_data;
	}
	
	public function getProductCategories($product_id) {
		$product_category_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_category_data[] = $result['category_id'];
		}
		
		return $product_category_data;
	}
	
	public function getTotalProducts($data = array(), $language = null) {
		if($language == null){
			$selected_language = (int)$this->config->get('config_language_id');
		} else {
			$selected_language = (int)$language;
		}
		//Used because need a link to another table
		if (isset($data['filter_store']) && !is_null($data['filter_store']) || isset($data['filter_category']) && !is_null($data['filter_category'])) {
			$table = "";
			$where = "";
			if(isset($data['filter_store']) && !is_null($data['filter_store'])){
				$table .= ", " . DB_PREFIX . "product_to_store pts";
				$where .= " AND p.product_id=pts.product_id";
			}
			if(isset($data['filter_category']) && !is_null($data['filter_category'])){
				$table .= ", " . DB_PREFIX . "product_to_category ptc";
				$where .= " AND p.product_id=ptc.product_id";
			}
			$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)".$table." WHERE pd.language_id = '" . $selected_language . "'".$where;
		} else {
			$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . $selected_language . "'";
		}
		
		if (isset($data['filter_name']) && !is_null($data['filter_name'])) {
			$sql .= " AND LCASE(pd.name) LIKE '%" . $this->db->escape(strtolower($data['filter_name'])) . "%'";
		}

		if (isset($data['filter_model']) && !is_null($data['filter_model'])) {
			$sql .= " AND LCASE(p.model) LIKE '%" . $this->db->escape(strtolower($data['filter_model'])) . "%'";
		}
		
		if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
			if(count(explode("&gt;", urldecode($data['filter_price']))) > 1){
				$between = explode("&gt;", urldecode($data['filter_price']));
				if(trim($between[1]) == ""){ //case 10>
					$sql .= " AND p.price >= " . (float)$this->db->escape($between[0]);
				} else { //case 5>10
					$sql .= " AND p.price between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
				}
			} elseif(count(explode("&lt;", urldecode($data['filter_price']))) > 1){
				$between = explode("&lt;", urldecode($data['filter_price']));
				if(trim($between[0]) == ""){ //case <10
					$sql .= " AND p.price <= " . (float)$this->db->escape($between[1]);
				} else { //case 5<10
					$sql .= " AND p.price between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
				}
			} else {
				$sql .= " AND p.price = '" . $this->db->escape($data['filter_price']) . "'";
			}
		}
		if (isset($data['filter_sort_order']) && !is_null($data['filter_sort_order'])) {
				if(count(explode("&gt;", urldecode($data['filter_sort_order']))) > 1){
					$between = explode("&gt;", urldecode($data['filter_sort_order']));
					if(trim($between[1]) == ""){ //case 10>
						$sql .= " AND p.sort_order >= " . (float)$this->db->escape($between[0]);
					} else { //case 5>10
						$sql .= " AND p.sort_order between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
					}
				} elseif(count(explode("&lt;", urldecode($data['filter_sort_order']))) > 1){
					$between = explode("&lt;", urldecode($data['filter_sort_order']));
					if(trim($between[0]) == ""){ //case <10
						$sql .= " AND p.sort_order <= " . (float)$this->db->escape($between[1]);
					} else { //case 5<10
						$sql .= " AND p.sort_order between " . (float)$this->db->escape($between[0]) . " AND " . (float)$this->db->escape($between[1]) . "";
					}
				} else {
					$sql .= " AND p.sort_order = '" . $this->db->escape($data['filter_sort_order']) . "'";
				}
			}
		if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
			if(count(explode("&gt;", urldecode($data['filter_quantity']))) > 1){
				$between = explode("&gt;", urldecode($data['filter_quantity']));
				if(trim($between[1]) == ""){ //case 10>
					$sql .= " AND p.quantity >= " . (int)$this->db->escape($between[0]);
				} else { //case 5>10
					$sql .= " AND p.quantity between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
				}
			} elseif(count(explode("&lt;", urldecode($data['filter_quantity']))) > 1){
				$between = explode("&lt;", urldecode($data['filter_quantity']));
				if(trim($between[0]) == ""){ //case <10
					$sql .= " AND p.quantity <= " . (int)$this->db->escape($between[1]);
				} else { //case 5<10
					$sql .= " AND p.quantity between " . (int)$this->db->escape($between[0]) . " AND " . (int)$this->db->escape($between[1]) . "";
				}
			} else {
				$sql .= " AND p.quantity = '" . $this->db->escape($data['filter_quantity']) . "'";
			}
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}
		
		if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
			$sql .= " AND ptc.category_id = '" . (int)$data['filter_category'] . "'";
		}
		
		if (isset($data['filter_manufacturer']) && !is_null($data['filter_manufacturer'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer'] . "'";
		}
		
		if (isset($data['filter_store']) && !is_null($data['filter_store'])) {
			$sql .= " AND pts.store_id = '" . (int)$data['filter_store'] . "'";
		}
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}
	
	public function changeProductToStore($product_id, $store_id){
		$query = $this->db->query("SELECT count(*) AS exist FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "' AND store_id = '" . $store_id . "'");
		if($query->row['exist'] == 0){
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store (product_id, store_id) VALUES ('" . (int)$product_id . "', '" . (int)$store_id . "')");
		} else {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "' AND store_id = '" . (int)$store_id . "'");
		}
		$this->cache->delete('product');
	}
	
	public function changeProductStatus($product_id){
		if($product_id > 0){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET status=ABS(status-1) WHERE product_id = '" . (int)$product_id . "'");
		}
		$this->cache->delete('product');
	}
	
	public function changeProductQuantity($product_id, $quantity){
		$query = $this->db->query("SELECT quantity FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['quantity'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET quantity = '" . (int)$quantity ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT quantity FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['quantity'];
		} else {
			return "Error";
		}
	}
	
	public function changeProductPrice($product_id, $price){
		$query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['price'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET price = '" . (float) $price ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			
			$query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
			return $query->row['price'];
		} else {
			return "Error";
		}
	}
	
	public function changeSpecialPrices($product_id, $data){
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");
 
		if (isset($data['product_discount'])) {
			foreach ($data['product_discount'] as $value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_discount SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$value['customer_group_id'] . "', quantity = '" . (int)$value['quantity'] . "', priority = '" . (int)$value['priority'] . "', price = '" . (float)$value['price'] . "', date_start = '" . $this->db->escape($value['date_start']) . "', date_end = '" . $this->db->escape($value['date_end']) . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");
		
		if (isset($data['product_special'])) {
			foreach ($data['product_special'] as $value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$value['customer_group_id'] . "', priority = '" . (int)$value['priority'] . "', price = '" . (float)$value['price'] . "', date_start = '" . $this->db->escape($value['date_start']) . "', date_end = '" . $this->db->escape($value['date_end']) . "'");
			}
		}
		$this->cache->delete('product');
	}
	
	public function removeProductCategory($product_id, $category_id){
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$category_id . "'");
		$this->cache->delete('product');
	}
	
	public function addProductCategory($product_id, $category_id){
		$categories = explode(',', $category_id);
		foreach($categories as $category){
			$query = $this->db->query("SELECT COUNT(*) AS cnt FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$category. "'");
			if(isset($query->row['cnt']) && $query->row['cnt'] == 0){
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category (product_id, category_id) VALUES ('".(int)$product_id."', '".(int)$category."')");
			}
		}
		$this->cache->delete('product');
	}
	
	public function changeProductSortOrder($product_id, $sort_order){
		$query = $this->db->query("SELECT sort_order FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		if(isset($query->row['sort_order'])){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET sort_order = '" . (int) $sort_order ."' WHERE product_id = '" . (int)$product_id . "'");
			$this->cache->delete('product');
			return (int)$sort_order;
		} else {
			return "Error";
		}
	}
	
	public function hasSpecial($product_id){
		$query = $this->db->query("SELECT COUNT(*) cnt FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");
		if((int)$query->row['cnt'] > 0){
			return true;
		}
		return false;
	}
	
	public function hasDiscount($product_id){
		$query = $this->db->query("SELECT COUNT(*) cnt FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");
		if((int)$query->row['cnt'] > 0){
			return true;
		}
		return false;
	}
	
	public function getManufacturers(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer ORDER BY sort_order, name");
		$manufacturers = array();
		foreach ($query->rows as $result) {
			$manufacturers[$result['manufacturer_id']] = $result['name'];
		}
		return $manufacturers;
	}
	
	public function changeManufacturer($product_id, $manufacturer_id){
		if($product_id > 0){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET manufacturer_id=".(int)$manufacturer_id." WHERE product_id = '" . (int)$product_id . "'");
		}
		$this->cache->delete('product');
	}
	
	public function getFinalPrice($product_id, $regular_price, $default_customer_group){
		$price = '';
		$special = $this->db->query("
			SELECT
				price
			FROM
				" . DB_PREFIX . "product_special ps
			WHERE
				ps.product_id = ".(int)$product_id." AND
				ps.customer_group_id = '" . (int)$default_customer_group . "' AND
				(
					(ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND
					(ps.date_end = '0000-00-00' OR ps.date_end > NOW())
				)
			ORDER BY
				ps.priority ASC,
				ps.price ASC
			LIMIT 1");
		$discount = $this->db->query("
			SELECT
				price
			FROM
				" . DB_PREFIX . "product_discount pd2
			WHERE pd2.product_id = ".(int)$product_id." AND
			pd2.customer_group_id = '" . (int)$default_customer_group . "' AND
			pd2.quantity = '1' AND
			(
				(pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND
				(pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())
			)
			ORDER BY
				pd2.priority ASC,
				pd2.price ASC
			LIMIT 1");
		if(isset($discount->row['price'])){
			$price = $discount->row['price'];
		}
		if(isset($special->row['price'])){
			$price = $special->row['price'];
		}
		return $price;
	}
	
	public function changeModel($product_id, $model){
		if($product_id > 0){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET model='".$model."' WHERE product_id = '" . (int)$product_id . "'");
			$query = $this->db->query("SELECT model FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		}
		$this->cache->delete('product');
		return $query->row['model'];
	}
	public function changeImage($product_id, $image){
		if($product_id > 0){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product SET image='".$image."' WHERE product_id = '" . (int)$product_id . "'");
			$query = $this->db->query("SELECT image FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");
		}
		$this->cache->delete('product');
		return $query->row['image'];
	}
	public function changeName($product_id, $name, $language = null){
		if($language == null || $language==0){
			$selected_language = (int)$this->config->get('config_language_id');
		} else {
			$selected_language = (int)$language;
		}
		if($product_id > 0){
			$query = $this->db->query("UPDATE " . DB_PREFIX . "product_description SET name='".$name."' WHERE product_id = '" . (int)$product_id . "' AND language_id='".$selected_language."'");
			$query = $this->db->query("SELECT name FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "' AND language_id='".$selected_language."'");
		}
		$this->cache->delete('product');
		return $query->row['name'];
	}
	
	public function getLanguages(){
		return $this->db->query("SELECT language_id, CONCAT(name, IF(status=1, '', ' *')) AS name FROM " . DB_PREFIX . "language");
	}
}
?>