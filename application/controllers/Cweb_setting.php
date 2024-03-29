<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cweb_setting extends CI_Controller {
	public $menu;
	function __construct() {
      parent::__construct();
		$this->load->library('auth');
		$this->load->library('lweb_setting');
		$this->load->library('session');
		$this->load->model('Web_settings');
		$this->auth->check_admin_auth();
		$this->template->current_menu = 'web_setting';

//		if ($this->session->userdata('user_type') == '2') {
//            $this->session->set_userdata(array('error_message'=>display('you_are_not_access_this_part')));
//            redirect('Admin_dashboard');
//        }
    }
	public function index()
	{
		$content = $this->lweb_setting->setting_add_form();
		$this->template->full_admin_html_view($content);
	}
	// Update setting
	public function update_setting()
	{
		$this->load->model('Web_settings');

		   if ($_FILES['logo']['name']) {
            //Chapter chapter add start

        $config['upload_path']    = './my-assets/image/logo/';
        $config['allowed_types']  = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG'; 
        $config['encrypt_name']   = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('logo')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Cweb_setting'));
            } else {
            $data = $this->upload->data();  
            $logo = $config['upload_path'].$data['file_name']; 
            $config['image_library']  = 'gd2';
            $config['source_image']   = $logo;
            $config['create_thumb']   = false;
            $config['maintain_ratio'] = TRUE;
            $config['width']          = 200;
            $config['height']         = 200;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $logo = base_url() . $logo;

            }
        }

		if ($_FILES['favicon']['name']) {
			//Chapter chapter add start
			$config['upload_path']          = './my-assets/image/logo/';
	        $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
	        $config['max_size']             = "*";
	        $config['max_width']            = "*";
	        $config['max_height']           = "*";
	        $config['encrypt_name'] 		= TRUE;

	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('favicon'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_userdata(array('error_message'=> $this->upload->display_errors()));
	            redirect(base_url('Cweb_setting'));
	        }
	        else
	        {
	        	$image =$this->upload->data();
	        	$favicon = base_url()."my-assets/image/logo/".$image['file_name'];
	        }
		}

		if ($_FILES['invoice_logo']['name']) {
			//Chapter chapter add start
			$config['upload_path']          = './my-assets/image/logo/';
	        $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
	        $config['max_size']             = "*";
	        $config['max_width']            = "*";
	        $config['max_height']           = "*";
	        $config['encrypt_name'] 		= TRUE;

	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('invoice_logo'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_userdata(array('error_message'=> $this->upload->display_errors()));
	            redirect(base_url('Cweb_setting'));
	        }
	        else
	        {
	        	$image =$this->upload->data();
	        	$invoice_logo = base_url()."my-assets/image/logo/".$image['file_name'];
	        }
		}

		$old_logo = $this->input->post('old_logo');
		$old_invoice_logo = $this->input->post('old_invoice_logo');
		$old_favicon = $this->input->post('old_favicon');
	
		$data=array(
			'logo' 			=> (!empty($logo)?$logo:$old_logo),
			'invoice_logo' 	=> (!empty($invoice_logo)?$invoice_logo:$old_invoice_logo),
			'favicon' 		=> (!empty($favicon)?$favicon:$old_favicon),
			'currency' 		=> $this->input->post('currency'),
			'currency_position' => $this->input->post('currency_position'),
			'footer_text'	=> $this->input->post('footer_text'),
			'language' 		=> $this->input->post('language'),
			'rtr' 			=> $this->input->post('rtr'),
			'timezone'      => $this->input->post('timezone'),
			'captcha' 		=> $this->input->post('captcha'),
			'site_key' 		=> $this->input->post('site_key'),
			'secret_key' 	=> $this->input->post('secret_key'),
			'discount_type' => $this->input->post('discount_type'),
			);

		$this->Web_settings->update_setting($data);

		$this->session->set_userdata(array('message'=>display('successfully_updated')));
		redirect(base_url('Cweb_setting'));
		exit;
	}
}