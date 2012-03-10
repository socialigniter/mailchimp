<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends Oauth_Controller
{
    function __construct()
    {
        parent::__construct();
        
    	$this->form_validation->set_error_delimiters('', '');        
        
		$this->load->config('mailchimp/mailchimp');
		$this->load->library('mailchimp/MCAPI');        
	}

    /* Install App */
	function install_get()
	{
		// Load
		$this->load->library('installer');
		$this->load->config('install');        

		// Settings & Create Folders
		$settings = $this->installer->install_settings('mailchimp', config_item('mailchimp_settings'));
	
		if ($settings == TRUE)
		{
            $message = array('status' => 'success', 'message' => 'Yay, the MailChimp App was installed');
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'Dang MailChimp App could not be uninstalled');
        }		
		
		$this->response($message, 200);
	} 
	
	function subscribe_post()
	{
		// Validation Rules
	   	$this->form_validation->set_rules('name', 'Name', 'required');
	   	$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		// Passes Validation
	    if ($this->form_validation->run() == true)
	    {		
			// grab an API Key from http://admin.mailchimp.com/account/api/
			// grab your List's Unique Id by going to http://admin.mailchimp.com/lists/
			// Click the "settings" link for the list - the Unique Id is at the bottom of that page.	
			$api		= new MCAPI('12f5672d275c3569e7e4a5fb47721a13-us2'); 
			$list_id	= 'a0b1b967d2';
			$email		= $this->input->post('email');
			$merge_vars	= array(
				'NAME'	=> $this->input->post('name'),
				'FNAME' => 'Test', 
				'LNAME'	=>'Account'
			);
		
			if ($api->listSubscribe($list_id, $email, $merge_vars) === true)
			{
	            $message = array('status' => 'success', 'message' => 'Success! Check your email to confirm sign up.');
				
			}
			else
			{			
	            $message = array('status' => 'error', 'message' => $api->errorMessage);			
			}
		}
		else
		{
			$message = array('status' => 'error', 'message' => 'Oops '.validation_errors());		
		}

		$this->response($message, 200);			
	}

}