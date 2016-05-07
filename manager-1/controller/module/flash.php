<?php  
class ControllerModuleFlash extends Controller {
	protected function index($setting) {
		static $module = 0;
		$this->load->model('design/flash');
	
		$this->data['banners'] = array();
		
		$results = $this->model_design_flash->getFlash($setting['flash_id']);
		  
		foreach ($results as $result) {
			if (file_exists(DIR_IMAGE . $result['flash_name'])) {
				$this->data['flashs'][] = array(
					'flash_name' => $result['flash_name'],
					'width' =>$setting['width'],
					'height' =>$setting['height']
					
				);
			}
		}
		$this->data['module'] = $module++;
				
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/flash.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/flash.tpl';
		} else {
			$this->template = 'default/template/module/flash.tpl';
		}
		
		$this->render();
	}
}
?>