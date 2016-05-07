<?php  
class ControllerModuleSideBanner extends Controller {
	protected function index($setting) {
		static $module = 0;
		
		$this->load->model('design/banner');
		$this->load->model('tool/image');
		
		$this->document->addScript('catalog/view/javascript/jquery/jquery.cycle.js');
		$this->document->addScript('catalog/view/theme/default/template/module/side_banner/script.js');
		$this->data['width'] = $setting['width'];	
		$this->data['height'] = $setting['height'];	
		
		$this->data['left_banners'] = array();		
		$left_banners = $this->model_design_banner->getBanner($setting['banner_left_id']);		  
		foreach ($left_banners as $result) {
			if (file_exists(DIR_IMAGE . $result['image'])) {
				$this->data['left_banners'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}
		}
		$this->data['right_banners'] = array();		
		$right_banners = $this->model_design_banner->getBanner($setting['banner_right_id']);		  
		foreach ($right_banners as $result) {
			if (file_exists(DIR_IMAGE . $result['image'])) {
				$this->data['right_banners'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}
		}
		
		$this->data['module'] = $module++;
				
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/side_banner/side_banner.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/side_banner/side_banner.tpl';
		} else {
			$this->template = 'default/template/module/side_banner/side_banner.tpl';
		}
		
		$this->render();
	}
}
?>