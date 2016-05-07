<?php
class ControllerModuleCustomBackground extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/custom_background');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addScript('view/javascript/color_picker/jquery.miniColors.js');
		$this->document->addStyle('view/javascript/color_picker/jquery.miniColors.css');
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('custom_background', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		
 		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');	
		
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_background_image'] = $this->language->get('entry_background_image');		
		$this->data['entry_background_color'] = $this->language->get('entry_background_color');		
		$this->data['entry_background_repeat'] = $this->language->get('entry_background_repeat');
		$this->data['entry_background_attachment'] = $this->language->get('entry_background_attachment');
		$this->data['entry_background_position'] = $this->language->get('entry_background_position');
		
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
 		if (isset($this->error['code'])) {
			$this->data['error_code'] = $this->error['code'];
		} else {
			$this->data['error_code'] = '';
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/custom_background', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/custom_background', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['custom_background_status'])) {
			$this->data['custom_background_status'] = $this->request->post['custom_background_status'];
		} else {
			$this->data['custom_background_status'] = $this->config->get('custom_background_status');
		}	
		
		if (isset($this->request->post['custom_background_img_status'])) {
			$this->data['custom_background_img_status'] = $this->request->post['custom_background_img_status'];
		} else {
			$this->data['custom_background_img_status'] = $this->config->get('custom_background_img_status');
		}	
		
		/*custom_background_position*/ 
		if (isset($this->request->post['custom_background_position'])) {
			$this->data['custom_background_position'] = $this->request->post['custom_background_position'];
		} else {
			$this->data['custom_background_position'] = $this->config->get('custom_background_position');
		}	
		
		/*config_custom_background_color*/ 
		$this->load->model('tool/image');

		if (isset($this->request->post['config_custom_background_color'])) {
			$this->data['config_custom_background_color'] = $this->request->post['config_custom_background_color'];
		} else {
			$this->data['config_custom_background_color'] = $this->config->get('config_custom_background_color');			
		}	
		/*config_custom_background_img*/ 
		$this->load->model('tool/image');

		if (isset($this->request->post['config_custom_background_img'])) {
			$this->data['config_custom_background_img'] = $this->request->post['config_custom_background_img'];
		} else {
			$this->data['config_custom_background_img'] = $this->config->get('config_custom_background_img');			
		}	
		
		if ($this->config->get('config_custom_background_img')=='') {
			$this->data['custom_background_img'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);	
		} else {
			$this->data['custom_background_img'] = $this->model_tool_image->resize($this->config->get('config_custom_background_img'), 100, 100);	
		}
		/*custom_background_attachment*/ 
		if (isset($this->request->post['custom_background_attachment'])) {
			$this->data['custom_background_attachment'] = $this->request->post['custom_background_attachment'];
		} else {
			$this->data['custom_background_attachment'] = $this->config->get('custom_background_attachment');			
		}
		/*custom_background_repeat*/ 
		if (isset($this->request->post['custom_background_repeat'])) {
			$this->data['custom_background_repeat'] = $this->request->post['custom_background_repeat'];
		} else {
			$this->data['custom_background_repeat'] = $this->config->get('custom_background_repeat');			
		}
			
		
		
		
		
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		$this->data['modules'] = array();
		
		if (isset($this->request->post['custom_background_module'])) {
			$this->data['modules'] = $this->request->post['custom_background_module'];
		} elseif ($this->config->get('custom_background_module')) { 
			$this->data['modules'] = $this->config->get('custom_background_module');
		}			
				
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->data['token'] = $this->session->data['token'];
		$this->template = 'module/custom_background.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/custom_background')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>