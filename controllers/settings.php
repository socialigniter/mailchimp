<?php
class Settings extends Dashboard_Controller 
{
    function __construct() 
    {
        parent::__construct();

		if ($this->data['logged_user_level_id'] > 1) redirect('home');	
        
        $this->load->config('mailchimp');
        
		$this->data['page_title']	= 'Settings';
    }
 
 	function index()
	{ 	
		$this->data['sub_title'] 	= 'MailChimp';
		$this->data['shared_ajax'] .= $this->load->view(config_item('dashboard_theme').'/partials/settings_modules_ajax.php', $this->data, true);
		$this->render();
	}	

}