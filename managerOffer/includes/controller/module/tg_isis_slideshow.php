<?php
class ControllerModuletgisisslideshow extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/tg_isis_slideshow');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('tg_isis_slideshow', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['text_pleaseselect'] = $this->language->get('text_pleaseselect');
		$this->data['text_pause']          = $this->language->get('text_pause');
		
		$this->data['entry_banner'] = $this->language->get('entry_banner');
		$this->data['entry_dimension'] = $this->language->get('entry_dimension'); 
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_delay'] = $this->language->get('entry_delay');
		$this->data['entry_speed'] = $this->language->get('entry_speed');
		$this->data['entry_pause']          = $this->language->get('entry_pause');
		$this->data['entry_effect'] = $this->language->get('entry_effect');
		$this->data['entry_slices'] = $this->language->get('entry_slices');
		$this->data['entry_boxcolumns'] = $this->language->get('entry_boxcolumns');
		$this->data['entry_boxrows'] = $this->language->get('entry_boxrows');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
		if (isset($this->request->post['tg_isis_slideshow_slideshow_effect'])) {
			$this->data['tg_isis_slideshow_slideshow_effect'] = $this->request->post['tg_isis_slideshow_slideshow_effect'];
		} else {
			$this->data['tg_isis_slideshow_slideshow_effect'] = $this->config->get('tg_isis_slideshow_slideshow_effect');
		}	
		
		if(! $this->data['tg_isis_slideshow_slideshow_effect']){
		 	 $this->data['tg_isis_slideshow_slideshow_effect'] = "random";
		}
		
		if (isset($this->request->post['tg_isis_slideshow_slideshow_delay'])) {
			$this->data['tg_isis_slideshow_slideshow_delay'] = $this->request->post['tg_isis_slideshow_slideshow_delay'];
		} else {
			$this->data['tg_isis_slideshow_slideshow_delay'] = $this->config->get('tg_isis_slideshow_slideshow_delay');
		}	
		
		if(! $this->data['tg_isis_slideshow_slideshow_delay']){
		 	 $this->data['tg_isis_slideshow_slideshow_delay'] = 8000;
		}
		
		if (isset($this->request->post['tg_isis_slideshow_slideshow_speed'])) {
			$this->data['tg_isis_slideshow_slideshow_speed'] = $this->request->post['tg_isis_slideshow_slideshow_speed'];
		} else {
			$this->data['tg_isis_slideshow_slideshow_speed'] = $this->config->get('tg_isis_slideshow_slideshow_speed');
		}	
		
		if(! $this->data['tg_isis_slideshow_slideshow_speed']){
		 	 $this->data['tg_isis_slideshow_slideshow_speed'] = 600;
		}
		
		if (isset($this->request->post['tg_isis_slideshow_slideshow_pause'])) {
			$this->data['tg_isis_slideshow_slideshow_pause'] = $this->request->post['tg_isis_slideshow_slideshow_pause'];
		} else {
			$this->data['tg_isis_slideshow_slideshow_pause'] = $this->config->get('tg_isis_slideshow_slideshow_pause');
		}	
		
		if(! $this->data['tg_isis_slideshow_slideshow_pause']){
		 	 $this->data['tg_isis_slideshow_slideshow_pause'] = "true";
		}
		
		
		if (isset($this->request->post['tg_isis_slideshow_slideshow_slices'])) {
			$this->data['tg_isis_slideshow_slideshow_slices'] = $this->request->post['tg_isis_slideshow_slideshow_slices'];
		} else {
			$this->data['tg_isis_slideshow_slideshow_slices'] = $this->config->get('tg_isis_slideshow_slideshow_slices');
		}	
		
		if(! $this->data['tg_isis_slideshow_slideshow_slices']){
		 	 $this->data['tg_isis_slideshow_slideshow_slices'] = 14;
		}
		
		if (isset($this->request->post['tg_isis_slideshow_slideshow_boxcolumns'])) {
			$this->data['tg_isis_slideshow_slideshow_boxcolumns'] = $this->request->post['tg_isis_slideshow_slideshow_boxcolumns'];
		} else {
			$this->data['tg_isis_slideshow_slideshow_boxcolumns'] = $this->config->get('tg_isis_slideshow_slideshow_boxcolumns');
		}	
		
		if(! $this->data['tg_isis_slideshow_slideshow_boxcolumns']){
		 	 $this->data['tg_isis_slideshow_slideshow_boxcolumns'] = 8;
		}
		
		if (isset($this->request->post['tg_isis_slideshow_slideshow_boxrows'])) {
			$this->data['tg_isis_slideshow_slideshow_boxrows'] = $this->request->post['tg_isis_slideshow_slideshow_boxrows'];
		} else {
			$this->data['tg_isis_slideshow_slideshow_boxrows'] = $this->config->get('tg_isis_slideshow_slideshow_boxrows');
		}	
		
		if(! $this->data['tg_isis_slideshow_slideshow_boxrows']){
		 	 $this->data['tg_isis_slideshow_slideshow_boxrows'] = 4;
		}
		
				
		if (isset($this->request->post['tg_isis_slideshow_module'])) {
			$this->data['modules'] = $this->request->post['tg_isis_slideshow_module'];
		} elseif ($this->config->get('tg_isis_slideshow_module')) { 
			$this->data['modules'] = $this->config->get('tg_isis_slideshow_module');
		}	
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->error['dimension'])) {
			$this->data['error_dimension'] = $this->error['dimension'];
		} else {
			$this->data['error_dimension'] = array();
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
			'href'      => $this->url->link('module/tg_isis_slideshow', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/tg_isis_slideshow', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['modules'] = array();
		
		if (isset($this->request->post['tg_isis_slideshow_module'])) {
			$this->data['modules'] = $this->request->post['tg_isis_slideshow_module'];
		} elseif ($this->config->get('tg_isis_slideshow_module')) { 
			$this->data['modules'] = $this->config->get('tg_isis_slideshow_module');
		}	
						
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->load->model('design/banner');
		
		$this->data['banners'] = $this->model_design_banner->getBanners();
		
		$this->template = 'module/tg_isis_slideshow.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/tg_isis_slideshow')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (isset($this->request->post['tg_isis_slideshow_module'])) {
			foreach ($this->request->post['tg_isis_slideshow_module'] as $key => $value) {
				if (!$value['width'] || !$value['height']) {
					$this->error['dimension'][$key] = $this->language->get('error_dimension');
				}				
			}
		}	
						
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>