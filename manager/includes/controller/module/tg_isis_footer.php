<?php
class ControllerModuletgisisfooter extends Controller {
	private $error = array(); 
	private $_name = 'mymodule';
	public function index() {   
		$this->load->language('module/tg_isis_footer');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('tg_isis_footer', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_description'] = $this->language->get('text_description');
		$this->data['text_info_title'] = $this->language->get('text_info_title');
		$this->data['text_social_title'] = $this->language->get('text_social_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		
		$this->data['entry_code'] = $this->language->get('entry_code');
		$this->data['entry_limit'] = $this->language->get('entry_limit');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_url'] = $this->language->get('entry_url');
		$this->data['entry_storetitle'] = $this->language->get('entry_storetitle');
		$this->data['entry_informationurl'] = $this->language->get('entry_informationurl');
		$this->data['entry_informationtitle'] = $this->language->get('entry_informationtitle');
		$this->data['entry_categoryurl'] = $this->language->get('entry_categoryurl');
		$this->data['entry_categorytitle'] = $this->language->get('entry_categorytitle');
		$this->data['entry_supporttitle'] = $this->language->get('entry_supporttitle');
		$this->data['entry_image']          = $this->language->get('entry_image');
		$this->data['entry_url']            = $this->language->get('entry_url');
		$this->data['token'] = $this->session->data['token'];
		
		$this->data['button_save']          = $this->language->get('button_save');
		$this->data['button_cancel']        = $this->language->get('button_cancel');
        $this->data['button_addslide']      = $this->language->get('button_addslide');
        $this->data['button_remove']        = $this->language->get('button_remove');
        
		$this->data['tab_gen']              =  $this->language->get('tab_gen');
		$this->data['tab_info'] =  $this->language->get('tab_info');
		$this->data['tab_twitter'] =  $this->language->get('tab_twitter');
		$this->data['tab_facebook'] =  $this->language->get('tab_facebook');
		$this->data['tab_contact'] =  $this->language->get('tab_contact');
		$this->data['tab_payment'] =  $this->language->get('tab_payment');
		$this->data['tab_default'] =  $this->language->get('tab_default');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['text_image_manager'] =  $this->language->get('text_image_manager');
		$this->data['image_instruction'] =  $this->language->get('image_instruction');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
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
			'href'      => $this->url->link('module/tg_isis_footer', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/tg_isis_footer', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		
		
		
		$this->load->model('localisation/language');
		
		$languages = $this->model_localisation_language->getLanguages();
		
		foreach ($languages as $language) {
			if (isset($this->request->post[$this->_name . '_code' . $language['language_id']])) {
				$this->data[$this->_name . '_code' . $language['language_id']] = $this->request->post[$this->_name . '_code' . $language['language_id']];
			} else {
				$this->data[$this->_name . '_code' . $language['language_id']] = $this->config->get($this->_name . '_code' . $language['language_id']);
			}
		}
		
		foreach ($languages as $language) {
			if (isset($this->request->post[$this->_name . '_title' . $language['language_id']])) {
				$this->data[$this->_name . '_title' . $language['language_id']] = $this->request->post[$this->_name . '_title' . $language['language_id']];
			} else {
				$this->data[$this->_name . '_title' . $language['language_id']] = $this->config->get($this->_name . '_title' . $language['language_id']);
			}
		}
		
		foreach ($languages as $language) {
			if (isset($this->request->post[$this->_name . '_title2' . $language['language_id']])) {
				$this->data[$this->_name . '_title2' . $language['language_id']] = $this->request->post[$this->_name . '_title2' . $language['language_id']];
			} else {
				$this->data[$this->_name . '_title2' . $language['language_id']] = $this->config->get($this->_name . '_title2' . $language['language_id']);
			}
		}
		
		foreach ($languages as $language) {
			if (isset($this->request->post[$this->_name . '_title2b' . $language['language_id']])) {
				$this->data[$this->_name . '_title2b' . $language['language_id']] = $this->request->post[$this->_name . '_title2b' . $language['language_id']];
			} else {
				$this->data[$this->_name . '_title2b' . $language['language_id']] = $this->config->get($this->_name . '_title2b' . $language['language_id']);
			}
		}
		
		foreach ($languages as $language) {
			if (isset($this->request->post[$this->_name . '_title3' . $language['language_id']])) {
				$this->data[$this->_name . '_title3' . $language['language_id']] = $this->request->post[$this->_name . '_title3' . $language['language_id']];
			} else {
				$this->data[$this->_name . '_title3' . $language['language_id']] = $this->config->get($this->_name . '_title3' . $language['language_id']);
			}
		}
		
		foreach ($languages as $language) {
			if (isset($this->request->post[$this->_name . '_title4' . $language['language_id']])) {
				$this->data[$this->_name . '_title4' . $language['language_id']] = $this->request->post[$this->_name . '_title4' . $language['language_id']];
			} else {
				$this->data[$this->_name . '_title4' . $language['language_id']] = $this->config->get($this->_name . '_title4' . $language['language_id']);
			}
		}

		$this->data['languages'] = $languages;	
		
		if (isset($this->request->post[$this->_name . '_code'])) {
			$this->data[$this->_name . 'mymodule_code'] = $this->request->post[$this->_name . '_code'];
		} else {
			$this->data[$this->_name . '_code'] = $this->config->get($this->_name . '_code');
		}	
		
		
		
		
		if (isset($this->request->post['tg_isis_footer_status'])) {
			$this->data['tg_isis_footer_status'] = $this->request->post['tg_isis_footer_status'];
		} else {
			$this->data['tg_isis_footer_status'] = $this->config->get('tg_isis_footer_status');
		}
		
		if (isset($this->request->post['tg_isis_footer_phone_show'])) {
			$this->data['tg_isis_footer_phone_show'] = $this->request->post['tg_isis_footer_phone_show'];
		} else {
			$this->data['tg_isis_footer_phone_show'] = $this->config->get('tg_isis_footer_phone_show');
		}
		
		if (isset($this->request->post['tg_isis_footer_mobile_show'])) {
			$this->data['tg_isis_footer_mobile_show'] = $this->request->post['tg_isis_footer_mobile_show'];
		} else {
			$this->data['tg_isis_footer_mobile_show'] = $this->config->get('tg_isis_footer_mobile_show');
		}
		
		if (isset($this->request->post['tg_isis_footer_email_show'])) {
			$this->data['tg_isis_footer_email_show'] = $this->request->post['tg_isis_footer_email_show'];
		} else {
			$this->data['tg_isis_footer_email_show'] = $this->config->get('tg_isis_footer_email_show');
		}
		
		if (isset($this->request->post['tg_isis_footer_email_show'])) {
			$this->data['tg_isis_footer_email_show'] = $this->request->post['tg_isis_footer_email_show'];
		} else {
			$this->data['tg_isis_footer_email_show'] = $this->config->get('tg_isis_footer_email_show');
		}
		
		if (isset($this->request->post['tg_isis_footer_skype_show'])) {
			$this->data['tg_isis_footer_skype_show'] = $this->request->post['tg_isis_footer_skype_show'];
		} else {
			$this->data['tg_isis_footer_skype_show'] = $this->config->get('tg_isis_footer_skype_show');
		}
		
		if (isset($this->request->post['tg_isis_footer_address_show'])) {
			$this->data['tg_isis_footer_address_show'] = $this->request->post['tg_isis_footer_address_show'];
		} else {
			$this->data['tg_isis_footer_address_show'] = $this->config->get('tg_isis_footer_address_show');
		}
		
		if (isset($this->request->post['tg_isis_footer_facebook_show'])) {
			$this->data['tg_isis_footer_facebook_show'] = $this->request->post['tg_isis_footer_facebook_show'];
		} else {
			$this->data['tg_isis_footer_facebook_show'] = $this->config->get('tg_isis_footer_facebook_show');
		}
		
		if (isset($this->request->post['tg_isis_footer_twitter_show'])) {
			$this->data['tg_isis_footer_twitter_show'] = $this->request->post['tg_isis_footer_twitter_show'];
		} else {
			$this->data['tg_isis_footer_twitter_show'] = $this->config->get('tg_isis_footer_twitter_show');
		}
		
		if (isset($this->request->post['tg_isis_footer_flickr_show'])) {
			$this->data['tg_isis_footer_flickr_show'] = $this->request->post['tg_isis_footer_flickr_show'];
		} else {
			$this->data['tg_isis_footer_flickr_show'] = $this->config->get('tg_isis_footer_flickr_show');
		}
		
		if (isset($this->request->post['tg_isis_footer_myspace_show'])) {
			$this->data['tg_isis_footer_myspace_show'] = $this->request->post['tg_isis_footer_myspace_show'];
		} else {
			$this->data['tg_isis_footer_myspace_show'] = $this->config->get('tg_isis_footer_myspace_show');
		}
		
		if (isset($this->request->post['tg_isis_footer_youtube_show'])) {
			$this->data['tg_isis_footer_youtube_show'] = $this->request->post['tg_isis_footer_youtube_show'];
		} else {
			$this->data['tg_isis_footer_youtube_show'] = $this->config->get('tg_isis_footer_youtube_show');
		}
		
		if (isset($this->request->post['tg_isis_footer_flickr'])) {
			$this->data['tg_isis_footer_flickr'] = $this->request->post['tg_isis_footer_flickr'];
		} else {
			$this->data['tg_isis_footer_flickr'] = $this->config->get('tg_isis_footer_flickr');
		}
		
		if (isset($this->request->post['tg_isis_footer_myspace'])) {
			$this->data['tg_isis_footer_myspace'] = $this->request->post['tg_isis_footer_myspace'];
		} else {
			$this->data['tg_isis_footer_myspace'] = $this->config->get('tg_isis_footer_myspace');
		}
		
		if (isset($this->request->post['tg_isis_footer_youtube'])) {
			$this->data['tg_isis_footer_youtube'] = $this->request->post['tg_isis_footer_youtube'];
		} else {
			$this->data['tg_isis_footer_youtube'] = $this->config->get('tg_isis_footer_youtube');
		}
		
		if (isset($this->request->post['tg_isis_footer_facebook'])) {
			$this->data['tg_isis_footer_facebook'] = $this->request->post['tg_isis_footer_facebook'];
		} else {
			$this->data['tg_isis_footer_facebook'] = $this->config->get('tg_isis_footer_facebook');
		}
		
		if (isset($this->request->post['tg_isis_footer_twitter'])) {
			$this->data['tg_isis_footer_twitter'] = $this->request->post['tg_isis_footer_twitter'];
		} else {
			$this->data['tg_isis_footer_twitter'] = $this->config->get('tg_isis_footer_twitter');
		}
		
		if (isset($this->request->post['tg_isis_footer_sort_order'])) {
			$this->data['tg_isis_footer_sort_order'] = $this->request->post['tg_isis_footer_sort_order'];
		} else {
			$this->data['tg_isis_footer_sort_order'] = $this->config->get('tg_isis_footer_sort_order');
		}	
		
		if (isset($this->request->post['tg_isis_footer_facebook_id'])) {
			$this->data['tg_isis_footer_facebook_id'] = $this->request->post['tg_isis_footer_facebook_id'];
		} else {
			$this->data['tg_isis_footer_facebook_id'] = $this->config->get('tg_isis_footer_facebook_id');
		}	
		
		if (isset($this->request->post['tg_isis_footer_footer_info_enabled'])) {
			$this->data['tg_isis_footer_footer_info_enabled'] = $this->request->post['tg_isis_footer_footer_info_enabled'];
		} else {
			$this->data['tg_isis_footer_footer_info_enabled'] = $this->config->get('tg_isis_footer_footer_info_enabled');
		}	
		
		if (isset($this->request->post['tg_isis_footer_footer_enabled_footer_columns_cnt'])) {
			$this->data['tg_isis_footer_footer_enabled_footer_columns_cnt'] = $this->request->post['tg_isis_footer_footer_enabled_footer_columns_cnt'];
		} else {
			$this->data['tg_isis_footer_footer_enabled_footer_columns_cnt'] = $this->config->get('tg_isis_footer_footer_enabled_footer_columns_cnt');
		}
	
		if (isset($this->request->post['tg_isis_footer_footer_contacts_enabled'])) {
			$this->data['tg_isis_footer_footer_contacts_enabled'] = $this->request->post['tg_isis_footer_footer_contacts_enabled'];
		} else {
			$this->data['tg_isis_footer_footer_contacts_enabled'] = $this->config->get('tg_isis_footer_footer_contacts_enabled');
		}	
		
		if (isset($this->request->post['tg_isis_footer_footer_twitter_enabled'])) {
			$this->data['tg_isis_footer_footer_twitter_enabled'] = $this->request->post['tg_isis_footer_footer_twitter_enabled'];
		} else {
			$this->data['tg_isis_footer_footer_twitter_enabled'] = $this->config->get('tg_isis_footer_footer_twitter_enabled');
		}
		
		if (isset($this->request->post['tg_isis_footer_footer_facebookfp_enabled'])) {
			$this->data['tg_isis_footer_footer_facebookfp_enabled'] = $this->request->post['tg_isis_footer_footer_facebookfp_enabled'];
		} else {
			$this->data['tg_isis_footer_footer_facebookfp_enabled'] = $this->config->get('tg_isis_footer_footer_facebookfp_enabled');
		}
		
		if (isset($this->request->post['tg_isis_footer_footer_facebook_enabled'])) {
			$this->data['tg_isis_footer_footer_facebook_enabled'] = $this->request->post['tg_isis_footer_footer_facebook_enabled'];
		} else {
			$this->data['tg_isis_footer_footer_facebook_enabled'] = $this->config->get('tg_isis_footer_footer_facebook_enabled');
		}
		
		if (isset($this->request->post['tg_isis_footer_twitter_username'])) {
			$this->data['tg_isis_footer_twitter_username'] = $this->request->post['tg_isis_footer_twitter_username'];
		} else {
			$this->data['tg_isis_footer_twitter_username'] = $this->config->get('tg_isis_footer_twitter_username');
		}
		
		if (isset($this->request->post['tg_isis_footer_facebook_id'])) {
			$this->data['tg_isis_footer_facebook_id'] = $this->request->post['tg_isis_footer_facebook_id'];
		} else {
			$this->data['tg_isis_footer_facebook_id'] = $this->config->get('tg_isis_footer_facebook_id');
		}
		
		if (isset($this->request->post['tg_isis_footer_tweets'])) {
			$this->data['tg_isis_footer_tweets'] = $this->request->post['tg_isis_footer_tweets'];
		} else {
			$this->data['tg_isis_footer_tweets'] = $this->config->get('tg_isis_footer_tweets');
		}
		
		if (isset($this->request->post['tg_isis_footer_phone'])) {
			$this->data['tg_isis_footer_phone'] = $this->request->post['tg_isis_footer_phone'];
		} else {
			$this->data['tg_isis_footer_phone'] = $this->config->get('tg_isis_footer_phone');
		}
		
		if (isset($this->request->post['tg_isis_footer_mobile'])) {
			$this->data['tg_isis_footer_mobile'] = $this->request->post['tg_isis_footer_mobile'];
		} else {
			$this->data['tg_isis_footer_mobile'] = $this->config->get('tg_isis_footer_mobile');
		}
		
		if (isset($this->request->post['tg_isis_footer_email'])) {
			$this->data['tg_isis_footer_email'] = $this->request->post['tg_isis_footer_email'];
		} else {
			$this->data['tg_isis_footer_email'] = $this->config->get('tg_isis_footer_email');
		}
               
        if (isset($this->request->post['tg_isis_footer_skype'])) {
			$this->data['tg_isis_footer_skype'] = $this->request->post['tg_isis_footer_skype'];
		} else {
			$this->data['tg_isis_footer_skype'] = $this->config->get('tg_isis_footer_skype');
		}
		
		if (isset($this->request->post['tg_isis_footer_address'])) {
			$this->data['tg_isis_footer_address'] = $this->request->post['tg_isis_footer_address'];
		} else {
			$this->data['tg_isis_footer_address'] = $this->config->get('tg_isis_footer_address');
		}
		
		if (isset($this->request->post['tg_isis_footer_default'])) {
			$this->data['tg_isis_footer_default'] = $this->request->post['tg_isis_footer_default'];
		} else {
			$this->data['tg_isis_footer_default'] = $this->config->get('tg_isis_footer_default');
		}
		
		if (isset($this->request->post['tg_isis_footer_default_show'])) {
			$this->data['tg_isis_footer_default_show'] = $this->request->post['tg_isis_footer_default_show'];
		} else {
			$this->data['tg_isis_footer_default_show'] = $this->config->get('tg_isis_footer_default_show');
		}
          
            
		
		

		$this->template = 'module/tg_isis_footer.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/tg_isis_footer')) {
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