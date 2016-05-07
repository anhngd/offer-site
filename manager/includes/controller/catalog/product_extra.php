<?php
include_once(dirname(__FILE__).'/product.php');
class ControllerCatalogProductExtra extends ControllerCatalogProduct {
	private $error = array(); 
     
  	public function index() {
		$this->load->model('catalog/product_extra');
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_store"){
			$this->model_catalog_product_extra->changeProductToStore((int)$this->request->get['product_id'], (int)$this->request->get['store_id']);
			echo "done";
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_manufacturer"){
			$this->model_catalog_product_extra->changeManufacturer((int)$this->request->get['product_id'], (int)$this->request->get['manufacturer_id']);
			echo "done";
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_status"){
			$this->model_catalog_product_extra->changeProductStatus((int)$this->request->get['product_id']);
			echo "done";
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_quantity"){
			echo $this->model_catalog_product_extra->changeProductQuantity((int)$this->request->get['product_id'], (int)$this->request->get['quantity']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_price"){
			echo $this->model_catalog_product_extra->changeProductPrice((int)$this->request->get['product_id'], (float)$this->request->get['price']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_sort_order"){
			echo $this->model_catalog_product_extra->changeProductSortOrder((int)$this->request->get['product_id'], (float)$this->request->get['sort_order']);
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "special_prices"){
			//$this->model_catalog_product_extra->changeSpecialPrices((int)$this->request->get['product_id'], (float)$this->request->post);
			
			return $this->SpecialPrices((int)$this->request->get['product_id']);
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "add_category"){
			$this->model_catalog_product_extra->addProductCategory((int)$this->request->get['product_id'], $this->request->get['category_id']);
			echo "done";
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "remove_category"){
			$this->model_catalog_product_extra->removeProductCategory((int)$this->request->get['product_id'], (int)$this->request->get['category_id']);
			echo "done";
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_model"){
			echo $this->model_catalog_product_extra->changeModel((int)$this->request->get['product_id'], $this->request->get['model']);
			die();
		}
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_name"){
			echo $this->model_catalog_product_extra->changeName((int)$this->request->get['product_id'], $this->request->get['name'], $this->request->get['language']);
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_image"){
			$this->model_catalog_product_extra->changeImage((int)$this->request->get['product_id'], $this->request->get['image']);
			echo "done";
			die();
		}
		
		if(isset($this->request->get['type']) && $this->request->get['type'] == "change_language"){
			if(isset($this->request->get['language'])){
				$_SESSION['product_language'] = (int)$this->request->get['language'];
			} else {
				$_SESSION['product_language'] = (int)$this->config->get('config_language_id');
			}
			header('Location: '.str_replace("&amp;", "&", $_SERVER['HTTP_REFERER']));
			die();
		}
		
		$this->load->language('catalog/product');
		$this->load->language('catalog/product_extra');
    	
		$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->getList();
  	}
	
	public function update() {
		$this->load->language('catalog/product');
		$this->load->model('catalog/product');
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_product->editProduct($this->request->get['product_id'], $this->request->post);
			echo "OK";
		} else {
			echo "ERROR";
		}
	}
	
	public function ajaxify(){
		if(isset($this->request->get['product_id']) && (int)$this->request->get['product_id'] > 0){
			$this->load->language('catalog/product_extra');
			$this->load->model('catalog/product_extra');
			$list_manufacturers = $this->model_catalog_product_extra->getManufacturers();
			$this->data['manufacturers'] = $list_manufacturers;
			$this->load->model('tool/image');
			$results = $this->model_catalog_product_extra->getProducts($data = array('product_id'=>(int)$this->request->get['product_id']), (isset($_SESSION['product_language'])?$_SESSION['product_language']:$this->config->get('config_language_id')));
			$url = '';
			$this->data['link'] = 'index.php?route=catalog/product_extra&token=' . $this->session->data['token'];
			$default_customer_group = $this->config->get('config_customer_group_id');
			$this->load->model('catalog/category');
			$list_categories = array();
			$categories = $this->model_catalog_category->getCategories(0);
			foreach($categories as $category){
				$list_categories[$category['category_id']] = $category['name'];
			}
			$this->data['categories'] = $list_categories;
			
			$this->data['text_default'] = $this->language->get('default_store_text');
			$this->load->model('setting/store');
			$this->data['stores'] = $this->model_setting_store->getStores();
			foreach ($results as $result) {
				$action = array();
				
				$action[] = array(
					'text' => $this->language->get('text_edit'),
					'href' => 'index.php?route=catalog/product/update&token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url
				);
				
				if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
					$image = $this->model_tool_image->resize($result['image'], 40, 40);
				} else {
					$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
				}
				
				$this->data['products'][] = array(
					'product_id' => $result['product_id'],
					'name'       => $result['name'],
					'model'      => $result['model'],
					'image'      => $image,
					'quantity'   => $result['quantity'],
					'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
					'status_int' => $result['status'],
					'selected'   => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
					'action'     => 'index.php?route=catalog/product/update&token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url,
					'stores'     => $this->model_catalog_product_extra->getProductStores($result['product_id']),
					'categories' => $this->model_catalog_product_extra->getProductCategories($result['product_id']),
					'hasSpecial' => $this->model_catalog_product_extra->hasSpecial($result['product_id']),
					'hasDiscount' => $this->model_catalog_product_extra->hasDiscount($result['product_id']),
					'price'      => $result['price'],
					'frontend_price'      => $this->model_catalog_product_extra->getFinalPrice($result['product_id'], $result['price'], $default_customer_group),
					'sort_order'      => $result['sort_order'],
					'manufacturer_id'      => $result['manufacturer_id'],
				);
			}
			$this->template = 'catalog/product_list_extra_row.tpl';
			$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
		} else {
			echo "ERROR";
		}
	}
	
	private function validateForm() { 
		if (!$this->user->hasPermission('modify', 'catalog/product')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
	
		foreach ($this->request->post['product_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}
			
		if ((utf8_strlen($this->request->post['model']) < 1) || (utf8_strlen($this->request->post['model']) > 64)) {
			$this->error['model'] = $this->language->get('error_model');
		}
			
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
						
		if (!$this->error) {
				return true;
		} else {
			return false;
		}
  	}
	
	private function specialPrices($product_id){
		$this->load->model('catalog/product');
		$this->load->model('catalog/product_extra');
		$this->load->language('catalog/product');
		$this->load->language('catalog/product_extra');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_quantity'] = $this->language->get('entry_quantity');
		$this->data['entry_priority'] = $this->language->get('entry_priority');
		$this->data['entry_price'] = $this->language->get('entry_price');
		$this->data['entry_date_start'] = $this->language->get('entry_date_start');
		$this->data['entry_date_end'] = $this->language->get('entry_date_end');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['button_add_discount'] = $this->language->get('button_add_discount');
		$this->data['button_add_special'] = $this->language->get('button_add_special');
		$this->data['special_prices_dialog'] = $this->language->get('special_prices_dialog');
		$this->data['discounts_title'] = $this->language->get('discounts_title');
		$this->data['special_title'] = $this->language->get('special_title');
		
		$this->data['ad_button'] = $this->language->get('ad_button');
		
		if(isset($this->request->get['t'])){
			$this->data['t'] = $this->request->get['t'];
		} else {
			$this->data['t'] = 'discount';
		}
		$this->load->model('sale/customer_group');
		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_catalog_product_extra->changeSpecialPrices((int)$product_id, $this->request->post);
		}
		if (isset($this->request->post['product_discount'])) {
			$this->data['product_discounts'] = $this->request->post['product_discount'];
		} elseif ((int)$product_id > 0) {
			$this->data['product_discounts'] = $this->model_catalog_product->getProductDiscounts((int)$product_id);
		} else {
			$this->data['product_discounts'] = array();
		}

		if (isset($this->request->post['product_special'])) {
			$this->data['product_specials'] = $this->request->post['product_special'];
		} elseif ((int)$product_id > 0) {
			$this->data['product_specials'] = $this->model_catalog_product->getProductSpecials((int)$product_id);
		} else {
			$this->data['product_specials'] = array();
		}
		
		$this->data['product_id'] = $product_id;
		$this->template = 'catalog/product_special_prices.tpl';
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
		
	}
	
	protected function validateSpecialForm(){
		if (!$this->user->hasPermission('modify', 'catalog/product_extra')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
	}
	
  	private function getList() {			
		$this->data['selected_language'] = isset($_SESSION['product_language'])?(int)$_SESSION['product_language']:(int)$this->config->get('config_language_id');
		$this->data['languages'] = $this->model_catalog_product_extra->getLanguages();
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = NULL;
		}

		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = NULL;
		}

		if (isset($this->request->get['filter_quantity'])) {
			$filter_quantity = $this->request->get['filter_quantity'];
		} else {
			$filter_quantity = NULL;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = NULL;
		}
		
		if (isset($this->request->get['filter_category'])) {
			$filter_category = $this->request->get['filter_category'];
		} else {
			$filter_category = NULL;
		}
		
		if (isset($this->request->get['filter_manufacturer'])) {
			$filter_manufacturer = $this->request->get['filter_manufacturer'];
		} else {
			$filter_manufacturer = NULL;
		}
		
		if (isset($this->request->get['filter_store'])) {
			$filter_store = $this->request->get['filter_store'];
		} else {
			$filter_store = NULL;
		}
		
		if (isset($this->request->get['filter_price'])) {
			$filter_price = $this->request->get['filter_price'];
		} else {
			$filter_price = NULL;
		}
		if (isset($this->request->get['filter_sort_order'])) {
			$filter_sort_order = $this->request->get['filter_sort_order'];
		} else {
			$filter_sort_order = NULL;
		}
		
		$url = '';
						
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . $this->request->get['filter_model'];
		}
		
		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}
		
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}
		if (isset($this->request->get['filter_sort_order'])) {
			$url .= '&filter_sort_order=' . $this->request->get['filter_sort_order'];
		}
		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}
		
		if (isset($this->request->get['filter_manufacturer'])) {
			$url .= '&filter_manufacturer=' . $this->request->get['filter_manufacturer'];
		}
		
		if (isset($this->request->get['filter_store'])) {
			$url .= '&filter_store=' . $this->request->get['filter_store'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
						
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

  		$this->document->breadcrumbs = array();

   		$this->document->breadcrumbs[] = array(
			'href'      => 'index.php?route=common/home&token=' . $this->session->data['token'],
			'text'      => $this->language->get('text_home'),
			'separator' => FALSE
   		);

   		$this->document->breadcrumbs[] = array(
			'href'      => 'index.php?route=catalog/product&token=' . $this->session->data['token'] . $url,
			'text'      => $this->language->get('heading_title'),
			'separator' => ' :: '
   		);
		
		$this->data['insert'] = 'index.php?route=catalog/product/insert&token=' . $this->session->data['token'] . $url;
		$this->data['copy'] = 'index.php?route=catalog/product/copy&token=' . $this->session->data['token'] . $url;	
		$this->data['delete'] = 'index.php?route=catalog/product/delete&token=' . $this->session->data['token'] . $url;
    	
		$this->data['products'] = array();

		$data = array(
			'filter_name'	  	=> $filter_name, 
			'filter_model'	  	=> $filter_model,
			'filter_quantity' 	=> $filter_quantity,
			'filter_status'   	=> $filter_status,
			'filter_category' 	=> $filter_category,
			'filter_manufacturer' 	=> $filter_manufacturer,
			'filter_store'    	=> $filter_store,
			'filter_price'    	=> $filter_price,
			'filter_sort_order'    	=> $filter_sort_order,
			'sort'            	=> $sort,
			'order'           	=> $order,
			'start'           	=> ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           	=> $this->config->get('config_admin_limit')
		);
		
		$this->load->model('tool/image');
		
		$product_total = $this->model_catalog_product_extra->getTotalProducts($data);
			
		$results = $this->model_catalog_product_extra->getProducts($data, (isset($_SESSION['product_language'])?$_SESSION['product_language']:$this->config->get('config_language_id')));
		//Get categories
		$this->load->model('catalog/category');
		$list_categories = array();
		$categories = $this->model_catalog_category->getCategories(0);
		foreach($categories as $category){
			$list_categories[$category['category_id']] = $category['name'];
		}
		$this->data['categories'] = $list_categories;
		
		$list_manufacturers = $this->model_catalog_product_extra->getManufacturers();
		$this->data['manufacturers'] = $list_manufacturers;
		
		//Get stores
		$this->data['text_default'] = $this->language->get('text_default');
		$this->load->model('setting/store');
		$this->data['stores'] = $this->model_setting_store->getStores();
		$this->data['url'] = HTTP_SERVER;
		$this->data['admin_root_url'] = HTTP_SERVER;
		
		$this->data['edit_link'] = $this->language->get('text_edit');
		$this->data['link'] = 'index.php?route=catalog/product_extra&token=' . $this->session->data['token'];
		
		$default_customer_group = $this->config->get('config_customer_group_id');
		
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 40, 40);
		
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => 'index.php?route=catalog/product/update&token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url
			);
			
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			
			
			$this->data['products'][] = array(
				'product_id' => $result['product_id'],
				'name'       => $result['name'],
				'model'      => $result['model'],
				'image'      => $image,
				'quantity'   => $result['quantity'],
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'status_int' => $result['status'],
				'selected'   => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
				'action'     => 'index.php?route=catalog/product/update&token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url,
				'stores'     => $this->model_catalog_product_extra->getProductStores($result['product_id']),
				'categories' => $this->model_catalog_product_extra->getProductCategories($result['product_id']),
				'hasSpecial' => $this->model_catalog_product_extra->hasSpecial($result['product_id']),
				'hasDiscount' => $this->model_catalog_product_extra->hasDiscount($result['product_id']),
				'price'      => $result['price'],
				'frontend_price'      => $this->model_catalog_product_extra->getFinalPrice($result['product_id'], $result['price'], $default_customer_group),
				'sort_order'      => $result['sort_order'],
				'manufacturer_id'      => $result['manufacturer_id'],
			);
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['extra_warning'] = $this->language->get('extra_warning');
		$this->data['special_link'] = $this->language->get('special_link');

		$this->data['column_image'] = $this->language->get('column_image');
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_model'] = $this->language->get('column_model');
		$this->data['column_quantity'] = $this->language->get('column_quantity');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_action'] = $this->language->get('column_action');
		$this->data['column_store'] = $this->language->get('column_store');
		$this->data['column_category'] = $this->language->get('column_category');
		$this->data['column_price'] = $this->language->get('column_price');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_manufacturer'] = $this->language->get('column_manufacturer');
		
		$this->data['button_copy'] = $this->language->get('button_copy');
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
		$this->data['button_filter'] = $this->language->get('button_filter');
		$this->data['s_button'] = $this->language->get('s_button');
		$this->data['c_button'] = $this->language->get('c_button');
		$this->data['saved'] =  $this->language->get('saved');
		$this->data['discount_link'] =  $this->language->get('discount_link');
		$this->data['frontend_price'] =  $this->language->get('frontend_price');
		
		$this->data['image_column_switch'] = $this->language->get('image_column_switch');
		$this->data['product_column_switch'] = $this->language->get('product_column_switch');
		$this->data['model_column_switch'] = $this->language->get('model_column_switch');
		$this->data['category_column_switch'] = $this->language->get('category_column_switch');
		$this->data['manufacturer_column_switch'] = $this->language->get('manufacturer_column_switch');
		$this->data['stores_column_switch'] = $this->language->get('stores_column_switch');
		$this->data['price_column_switch'] = $this->language->get('price_column_switch');
		$this->data['qty_column_switch'] = $this->language->get('qty_column_switch');
		$this->data['status_column_switch'] = $this->language->get('status_column_switch');
		$this->data['order_column_switch'] = $this->language->get('order_column_switch');
		$this->data['frontend_price_column_switch'] = $this->language->get('frontend_price_column_switch');
		$this->data['discounts_column_switch'] = $this->language->get('discounts_column_switch');
		$this->data['specials_column_switch'] = $this->language->get('specials_column_switch');
		$this->data['edit_column_switch'] = $this->language->get('edit_column_switch');
		$this->data['column_switch'] = $this->language->get('column_switch');
		$this->data['text_product_manager'] = $this->language->get('text_product_manager');
		$this->data['edit_column_popup_switch'] = $this->language->get('edit_column_popup_switch');
		
 
 		$this->data['token'] = $this->session->data['token'];
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . $this->request->get['filter_model'];
		}
		
		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}
		
		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}
		
		if (isset($this->request->get['filter_manufacturer'])) {
			$url .= '&filter_manufacturer=' . $this->request->get['filter_manufacturer'];
		}
		
		if (isset($this->request->get['filter_store'])) {
			$url .= '&filter_store=' . $this->request->get['filter_store'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}
		if (isset($this->request->get['filter_sort_order'])) {
			$url .= '&filter_sort_order=' . $this->request->get['filter_sort_order'];
		}						
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$this->data['sort_name'] = 'index.php?route=catalog/product_extra&token=' . $this->session->data['token'] . '&sort=pd.name' . $url;
		$this->data['sort_model'] = 'index.php?route=catalog/product_extra&token=' . $this->session->data['token'] . '&sort=p.model' . $url;
		$this->data['sort_quantity'] = 'index.php?route=catalog/product_extra&token=' . $this->session->data['token'] . '&sort=p.quantity' . $url;
		$this->data['sort_status'] = 'index.php?route=catalog/product_extra&token=' . $this->session->data['token'] . '&sort=p.status' . $url;
		$this->data['sort_order'] = 'index.php?route=catalog/product_extra&token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url;
		$this->data['sort_price'] = 'index.php?route=catalog/product_extra&token=' . $this->session->data['token'] . '&sort=p.price' . $url;
		$this->data['sort_sort_order'] = 'index.php?route=catalog/product_extra&token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url;
		$this->data['sort_manufacturer'] = 'index.php?route=catalog/product_extra&token=' . $this->session->data['token'] . '&sort=m.name' . $url;
		
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . $this->request->get['filter_model'];
		}
		
		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}
		
		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}
		
		if (isset($this->request->get['filter_sort_order'])) {
			$url .= '&filter_sort_order=' . $this->request->get['filter_sort_order'];
		}
		
		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}
		
		if (isset($this->request->get['filter_manufacturer'])) {
			$url .= '&filter_manufacturer=' . $this->request->get['filter_manufacturer'];
		}
		
		if (isset($this->request->get['filter_store'])) {
			$url .= '&filter_store=' . $this->request->get['filter_store'];
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
				
		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = 'index.php?route=catalog/product_extra&token=' . $this->session->data['token'] . $url . '&page={page}';
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_name'] = $filter_name;
		$this->data['filter_model'] = $filter_model;
		$this->data['filter_quantity'] = $filter_quantity;
		$this->data['filter_status'] = $filter_status;
		$this->data['filter_category'] = $filter_category;
		$this->data['filter_manufacturer'] = $filter_manufacturer;
		$this->data['filter_store'] = $filter_store;
		$this->data['filter_price'] = $filter_price;
		$this->data['filter_sort_order'] = $filter_sort_order;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'catalog/product_list_extra.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
  	}
}
?>