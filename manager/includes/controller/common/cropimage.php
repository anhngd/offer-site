<?php
class ControllerCommonCropImage extends Controller {
	private $error = array();
	public function index() {
		$this->load->language('common/filemanager');
				
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$this->data['base'] = HTTPS_SERVER;
		} else {
			$this->data['base'] = HTTP_SERVER;
		}
		$this->data['token'] = $this->session->data['token'];
		
		$this->data['filename_error'] = $this->language->get('error_filename');
		$this->data['select_size_error'] = $this->language->get('error_select_size');
		
		if (isset($this->request->get['name']) && $this->request->get['name']){
			$file = rtrim(DIR_IMAGE . 'data/' . str_replace('../', '', $this->request->get['name']), '/');
			if (!file_exists($file)) {
				$this->data['error'] = $this->language->get('error_missing');
			}
			
			$this->data['imagename'] = $this->request->get['name'];
			$this->data['image'] = HTTP_IMAGE . 'data/' . $this->request->get['name'];
			$fullname = $this->request->get['name'];
			if (strrpos($fullname, '/') > 0){
				$fullname =  utf8_substr($fullname, strrpos($fullname, '/') + 1);
			}
			$basename = utf8_substr($fullname, 0, strrpos($fullname, '.'));
			$ext = utf8_substr($fullname, strrpos($fullname, '.') + 1);
			$this->data['save_as_name'] = $basename . '_' . rand(100,1000) . '.' . $ext;
			
			$info = getimagesize($file);
			$this->data['width'] = $info[0];
			$this->data['height'] = $info[1];
			if ($info[0] > 1000 || $info[1] > 900){
				$this->data['rate'] = 0.2;
			}else{
				$this->data['rate'] = 0.3;
			}
			if ($info[1] > 340){
				$this->data['fixheight'] = 340;
				$this->data['fixwidth'] = round($info[0] * 340 / $info[1]); 
				if ($this->data['fixwidth'] > 480){
					$this->data['fixheight'] = round($info[1] * 480 /$info[0]);
					$this->data['fixwidth'] = 480;
				}
			}elseif($info[0] > 480){
				$this->data['fixheight'] = round($info[1] * 480 /$info[0]);
				$this->data['fixwidth'] = 480;
			}else{
				$this->data['fixwidth'] = $info[0];
				$this->data['fixheight'] = $info[1];
			}
			
		}else{
			$this->data['error'] = $this->language->get('error_missing');
		}
		
		$this->template = 'common/cropimage.tpl';
		$this->response->setOutput($this->render());
	}
	
	public function cropimage(){
		$this->load->language('common/filemanager');
		$json = array();
		$message = '';
		
		$w = (isset($this->request->post['width']) && $this->request->post['width']) ? (int)$this->request->post['width'] : 0;
		$h = (isset($this->request->post['height']) && $this->request->post['height']) ? (int)$this->request->post['height'] : 0;
		$x1 = (isset($this->request->post['x1']) && $this->request->post['x1']) ? (int)$this->request->post['x1'] : 0;
		$y1 = (isset($this->request->post['y1']) && $this->request->post['y1']) ? (int)$this->request->post['y1'] : 0;
		$x2 = (isset($this->request->post['x2']) && $this->request->post['x2']) ? (int)$this->request->post['x2'] : 0;
		$y2 = (isset($this->request->post['y2']) && $this->request->post['y2']) ? (int)$this->request->post['y2'] : 0;
		$name = (isset($this->request->post['name']) && $this->request->post['name']) ? $this->request->post['name'] : '';
		$image = (isset($this->request->post['image']) && $this->request->post['image']) ? $this->request->post['image'] : '';
		
		if ($w == 0 || $h == 0 || $x2 == 0 || $y2 == 0){
			$json['error'] = $this->language->get('error_select_size');
		}
		if (!isset($json['error'])){
			if ($name != ''){
				if (utf8_strlen(utf8_decode($name)) < 3 ||utf8_strlen(utf8_decode($name)) > 255){
					$json['error'] = $this->language->get('error_filename');
				}else{
					$allowed = array(
						'.jpg',
						'.jpeg',
						'.gif',
						'.png'
					);
					;
					if (!in_array(utf8_substr($name, strrpos($name, '.')), $allowed)){
						$json['error'] = $this->language->get('error_file_type');
					}else{
						$message = $this->crop($x1, $y1, $x2, $y2, $image, $name);
					}
				}
			}else{
				$json['error'] = $this->language->get('error_missing');
			}
			
			if ($message != ''){
				$json['error'] = $message;
			}
		}
		
		$this->response->setOutput(json_encode($json));	
	}
	
	private function crop($x1, $y1, $x2, $y2, $old, $new){
		$file = rtrim(DIR_IMAGE . 'data/' . str_replace('../', '', $old), '/');
		if (!file_exists($file)) {
			return $this->language->get('error_missing');
		}
		$info = pathinfo($old);
		$extension = $info['extension'];
		$dirname = $info['dirname'];
		$basename = $info['basename'];
		
		$newfile = rtrim(DIR_IMAGE . 'data/' . $dirname . '/' . str_replace('../', '', $new), '/');
		if (file_exists($newfile)){
			return $this->language->get('error_exists');
		}
		$image = new Image($file);
		$image->crop($x1, $y1, $x2, $y2);
		$image->save($newfile);
	}
	
}
?>