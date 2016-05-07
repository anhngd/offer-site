<?php
class ControllerCommonFooter extends Controller {   
	protected function index() {
		if (!$this->user->isLogged() || !isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
			$this->data['logged'] = '';
			
			$this->data['footer'] = $this->url->link('common/footer', '', 'SSL');
		} else {
			$this->data['logged'] = sprintf($this->language->get('text_logged'), $this->user->getUserName());
	
			$this->data['footer'] = $this->url->link('common/footer', '', 'SSL');
		}
		$this->load->language('common/footer');
		
		$this->data['text_footer'] = sprintf($this->language->get('text_footer'), VERSION);
		
		if (file_exists(DIR_SYSTEM . 'config/svn/svn.ver')) {
			$this->data['text_footer'] .= '.r' . trim(file_get_contents(DIR_SYSTEM . 'config/svn/svn.ver'));
		}

		
		$this->template = 'common/footer.tpl';

	
    	$this->render();
  	}
}
?>