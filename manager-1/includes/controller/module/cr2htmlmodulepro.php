<?php
class ControllerModulecr2htmlmodulepro extends Controller {
	private $error = array();
	private $_name = 'cr2htmlmodulepro';
	private $_version = '1.5b';

	public function index() {
		$this->load->language('module/' . $this->_name);

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		$this->data['cr2htmlmodulepro_version'] = $this->_version;

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting($this->_name, $this->request->post);

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

		$this->data['entry_product'] = $this->language->get('entry_product');
		$this->data['entry_area_id'] = $this->language->get('entry_area_id');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_borderless'] = $this->language->get('entry_borderless');
		$this->data['entry_borderlesswarn'] = $this->language->get('entry_borderlesswarn');
		$this->data['entry_classname'] = $this->language->get('entry_classname');
		$this->data['entry_classnameinfo'] = $this->language->get('entry_classnameinfo');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['entry_yes'] = $this->language->get( 'entry_yes' );
		$this->data['entry_no']	= $this->language->get( 'entry_no' );

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

          $this->data['entry_area'] = $this->language->get('entry_area');
          $this->data['entry_style'] = $this->language->get('entry_style');
          $this->data['entry_boxstyle'] = $this->language->get('entry_boxstyle');
          $this->data['entry_code'] = $this->language->get('entry_code');
          $this->data['entry_customcss'] = $this->language->get('entry_customcss');
		$this->data['entry_header'] = $this->language->get( 'entry_header' );
		$this->data['entry_title'] = $this->language->get( 'entry_title' );

          $this->data['entry_nobox'] = $this->language->get('entry_nobox');
          $this->data['entry_darkbox'] = $this->language->get('entry_darkbox');
          $this->data['entry_bluebox'] = $this->language->get('entry_bluebox');
          $this->data['entry_greenbox'] = $this->language->get('entry_greenbox');
          $this->data['entry_redbox'] = $this->language->get('entry_redbox');
          $this->data['entry_yellowbox'] = $this->language->get('entry_yellowbox');
		$this->data['noticelayout'] = $this->language->get('noticelayout');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		$this->load->model('localisation/language');

		$languages = $this->model_localisation_language->getLanguages();

		foreach ($languages as $language) {
			if (isset($this->error['code' . $language['language_id']])) {
				$this->data['error_code' . $language['language_id']] = $this->error['code' . $language['language_id']];
			} else {
				$this->data['error_code' . $language['language_id']] = '';
			}
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
			'href'      => $this->url->link('module/'.$this->_name, 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$this->data['action'] = $this->url->link('module/'.$this->_name, 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['token'] = $this->session->data['token'];
		$this->load->model('localisation/language');

		foreach ($languages as $language) {

          	for ($i=1;$i<=10;$i++) {

     			if (isset($this->request->post[$this->_name . '_code'.$i.'_' . $language['language_id']])) {
     				$this->data[$this->_name . '_code'.$i.'_' . $language['language_id']] = $this->request->post[$this->_name . '_code'.$i.'_' . $language['language_id']];
     			} else {
     				$this->data[$this->_name . '_code'.$i.'_' . $language['language_id']] = $this->config->get($this->_name . '_code'.$i.'_' . $language['language_id']);
     			}

     			if (isset($this->request->post[$this->_name . '_title'.$i.'_' . $language['language_id']])) {
     				$this->data[$this->_name . '_title'.$i.'_' . $language['language_id']] = $this->request->post[$this->_name . '_title'.$i.'_' . $language['language_id']];
     			} else {
     				$this->data[$this->_name . '_title'.$i.'_' . $language['language_id']] = $this->config->get($this->_name . '_title'.$i.'_' . $language['language_id']);
     			}

     		};//for
     	};//foreach

		$this->data['languages'] = $languages;

          for ($i=1;$i<=10;$i++) {

     		if( isset( $this->request->post[$this->_name . '_header'.$i] ) ) {
     			$this->data[$this->_name . '_header'.$i] = $this->request->post[$this->_name . '_header'.$i];
     		}else{
     			$this->data[$this->_name . '_header'.$i] = $this->config->get( $this->_name . '_header'.$i );
     		}

     		if( isset( $this->request->post[$this->_name . '_borderless'.$i] ) ) {
     			$this->data[$this->_name . '_borderless'.$i] = $this->request->post[$this->_name . '_borderless'.$i];
     		}else{
     			$this->data[$this->_name . '_borderless'.$i] = $this->config->get( $this->_name . '_borderless'.$i );
     		}
		};//for

     	if( isset( $this->request->post[$this->_name . '_customcss'] ) ) {
     		$this->data[$this->_name . '_customcss'] = $this->request->post[$this->_name . '_customcss'];
     	}else{
     		$this->data[$this->_name . '_customcss'] = $this->config->get( $this->_name . '_customcss' );
     	}

/*		if (isset($this->request->post['cr2htmlmodulepro_module'])) {
			$modules = explode(',', $this->request->post['cr2htmlmodulepro_module']);
		} elseif ($this->config->get('cr2htmlmodulepro_module') != '') {
			$modules = explode(',', $this->config->get('cr2htmlmodulepro_module'));
		} else {
			$modules = array();
		}*/

		$this->load->model('design/layout');

		$this->data['layouts'] = $this->model_design_layout->getLayouts();

/*		foreach ($modules as $module) {
			if (isset($this->request->post['cr2htmlmodulepro_' . $module . '_area_id'])) {
				$this->data['cr2htmlmodulepro_' . $module . '_area_id'] = $this->request->post['cr2htmlmodulepro_' . $module . '_area_id'];
			} else {
				$this->data['cr2htmlmodulepro_' . $module . '_area_id'] = $this->config->get('cr2htmlmodulepro_' . $module . '_area_id');
			}

			if (isset($this->request->post['cr2htmlmodulepro_' . $module . '_classname'])) {
				$this->data['cr2htmlmodulepro_' . $module . '_classname'] = $this->request->post['cr2htmlmodulepro_' . $module . '_classname'];
			} else {
				$this->data['cr2htmlmodulepro_' . $module . '_classname'] = $this->config->get('cr2htmlmodulepro_' . $module . '_classname');
			}

			if (isset($this->request->post['cr2htmlmodulepro_' . $module . '_layout_id'])) {
				$this->data['cr2htmlmodulepro_' . $module . '_layout_id'] = $this->request->post['cr2htmlmodulepro_' . $module . '_layout_id'];
			} else {
				$this->data['cr2htmlmodulepro_' . $module . '_layout_id'] = $this->config->get('cr2htmlmodulepro_' . $module . '_layout_id');
			}

			if (isset($this->request->post['cr2htmlmodulepro_' . $module . '_position'])) {
				$this->data['cr2htmlmodulepro_' . $module . '_position'] = $this->request->post['cr2htmlmodulepro_' . $module . '_position'];
			} else {
				$this->data['cr2htmlmodulepro_' . $module . '_position'] = $this->config->get('cr2htmlmodulepro_' . $module . '_position');
			}

			if (isset($this->request->post['cr2htmlmodulepro_' . $module . '_status'])) {
				$this->data['cr2htmlmodulepro_' . $module . '_status'] = $this->request->post['cr2htmlmodulepro_' . $module . '_status'];
			} else {
				$this->data['cr2htmlmodulepro_' . $module . '_status'] = $this->config->get('cr2htmlmodulepro_' . $module . '_status');
			}

			if (isset($this->request->post['cr2htmlmodulepro_' . $module . '_sort_order'])) {
				$this->data['cr2htmlmodulepro_' . $module . '_sort_order'] = $this->request->post['cr2htmlmodulepro_' . $module . '_sort_order'];
			} else {
				$this->data['cr2htmlmodulepro_' . $module . '_sort_order'] = $this->config->get('cr2htmlmodulepro_' . $module . '_sort_order');
			}
		}

		$this->data['modules'] = $modules;*/

		$this->data['modules'] = array();

		if (isset($this->request->post['cr2htmlmodulepro_module'])) {
			$this->data['modules'] = $this->request->post['cr2htmlmodulepro_module'];
		} elseif ($this->config->get('cr2htmlmodulepro_module')) {
			$this->data['modules'] = $this->config->get('cr2htmlmodulepro_module');
		}



		$this->template = 'module/' . $this->_name . '.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}

	private function validate() {

		if (!$this->user->hasPermission('modify', 'module/' . $this->_name)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

/*		if ($this->request->post[$this->_name.'_module'] !== '') {
			$modules = explode(',', $this->request->post[$this->_name.'_module']);
		} else {
			$modules = array();
		}*/

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>
