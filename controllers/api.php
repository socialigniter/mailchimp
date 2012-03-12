<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends Oauth_Controller
{
    function __construct()
    {
        parent::__construct();
        
    	$this->form_validation->set_error_delimiters('', '');        
        
		$this->load->config('mailchimp/mailchimp');
		$this->load->library('mailchimp/mailchimp_api');        
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
			$list_id	= $this->input->post('list_id');
			$email		= $this->input->post('email');
			$merge_vars	= array(
				'FNAME' => $this->input->post('name')
			);
		
			if ($this->mailchimp_api->listSubscribe($list_id, $email, $merge_vars) === true)
			{
	            $message = array('status' => 'success', 'message' => 'Success! Check your email to confirm sign up.');
				
			}
			else
			{			
	            $message = array('status' => 'error', 'message' => $this->mailchimp_api->errorMessage);			
			}
		}
		else
		{
			$message = array('status' => 'error', 'message' => 'Oops '.validation_errors());		
		}

		$this->response($message, 200);			
	}

}