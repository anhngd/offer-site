<?php
class ControllerModulecr2htmlmodulepro extends Controller {

	private $_name = 'cr2htmlmodulepro';
	private $_version = '1.5b';


     protected function index($setting) {
		//$this->language->load('module/' . $this->_name);

      	//$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['heading_title'] = "CR2 HTML Module Pro";

		$this->load->model('localisation/language');

		$languages = $this->model_localisation_language->getLanguages();

		$this->data['customcss'] = $this->config->get( $this->_name . '_customcss');

		for ($i=1; $i<=10; $i++) {
     		$this->data['code'.$i] = html_entity_decode($this->config->get($this->_name . '_code' . $i.'_'.$this->config->get('config_language_id')));
     		$this->data['title'.$i] = $this->config->get($this->_name . '_title' . $i.'_'.$this->config->get('config_language_id'));
     		$this->data['header'.$i] = $this->config->get( $this->_name . '_header'.$i);
     		$this->data['borderless'.$i] = $this->config->get( $this->_name . '_borderless'.$i);

     		if( !$this->data['title'.$i] ) { $this->data['title'.$i] = $this->data['heading_title']; }
     		if( !$this->data['header'.$i] ) { $this->data['title'.$i] = ''; }
		};//for $i

          $position = $setting["area_id"];
          $this->data['classname'] = $setting['classname'];
          $this->data['boxstyle'] = $setting['boxstyle'];
          $this->data['code'] = ''; $this->data['title'] = ''; $this->data['borderless'] = 1;

          $this->data['csscode'] = "<style type=\"text/css\">\n";
          switch($this->data['boxstyle']){
               case "darkbox": $this->data['csscode'] .= ".cr2darkbox .box-heading { background: #333; border: 1px solid #000; color: #fff; font-size: 14px; } .cr2darkbox .box-content { background: #666; border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; color: #fff; padding-bottom: 5px; }"; break;
               case "bluebox": $this->data['csscode'] .= ".cr2bluebox .box-heading { background: #0e5381; border: 1px solid #0e5381; color: #fff; font-size: 14px; } .cr2bluebox .box-content { background: #1476b3;   border-bottom: 1px solid #0e5381; border-left: 1px solid #0e5381; border-right: 1px solid #0e5381; color: #fff; padding-bottom: 5px;  } .cr2bluebox a { color: #002851; } "; break;
               case "redbox": $this->data['csscode'] .= ".cr2redbox .box-heading { background: #AA0000; border: 1px solid #CE0000; color: #fff; font-size: 14px; } .cr2redbox .box-content { background: #FF8A8A;   border-bottom: 1px solid #CE0000; border-left: 1px solid #CE0000; border-right: 1px solid #CE0000; color: #fff; padding-bottom: 5px;  } .cr2redbox a { color: #710000; } " ; break;
               case "greenbox": $this->data['csscode'] .= ".cr2greenbox .box-heading { background: #004000; border: 1px solid #004000; color: #fff; font-size: 14px; } .cr2greenbox .box-content { background: #008000; border-bottom: 1px solid #004000; border-left: 1px solid #004000; border-right: 1px solid #004000; color: #fff; padding-bottom: 5px;  } .cr2greenbox a { color: #500; }"; break;
               case "yellowbox": $this->data['csscode'] .= ".cr2yellowbox .box-heading { background: #FFFF04; border: 1px solid #CECE00; color: #000; font-size: 14px; } .cr2yellowbox .box-content { background: #FFFFC4; border-bottom: 1px solid #CECE00; border-left: 1px solid #CECE00; border-right: 1px solid #CECE00; color: #000; padding-bottom: 5px;  } .cr2yellowbox a { color: #500; }"; break;
               case "nobox":
               default:
                    /* nothing to output */ ;
          } // switch
          if (strlen($this->data['customcss'])>0) {$this->data['csscode'] .= "\n". $this->data['customcss']. ""; };
          $this->data['csscode'] .= "\n</style>\n";

          for ($i=1;$i<=10;$i++) {
               if ($position=="area".$i) {
                    $this->data['code'] = $this->data['code'.$i];
                    $this->data['title'] = $this->data['title'.$i];
                    $this->data['borderless'] = $this->data['borderless'.$i];
               };//if
          };//for $i

		$this->id = $this->_name;


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/'.$this->_name.'.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/'.$this->_name.'.tpl';
		} else {
			$this->template = 'default/template/module/'.$this->_name.'.tpl';
		}

		$this->render();
	}
}
?>
