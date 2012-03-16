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
	   	$this->form_validation->set_rules('list_id', 'List', 'required');
	   	$this->form_validation->set_rules('name', 'Name', 'required');
	   	$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		// Passes Validation
	    if ($this->form_validation->run() == true)
	    {
	    	$posted		= array();
	    	$subscribed = array();
	    	$interests	= FALSE;
			$email		= $this->input->post('email');

	    	// Check User Then Add
	    	if (config_item('mailchimp_create_user') == 'TRUE')
	    	{
	        	$user = $this->social_auth->get_user('email', $this->input->post('email'));
	        	
	        	if (!$user)
	        	{
	        		$username			= url_username($this->input->post('name'), 'none', true);
			    	$password			= random_string('unique', 16);
			    	$additional_data 	= array(
			    		'name'			=> $this->input->post('name'),
			    		'image'			=> ''
			    	);
		
			    	$user = $this->social_auth->register($username, $password, $email, $additional_data, config_item('default_group'));    		
				}
			}
		
			// Loop Through Lists
		    foreach ($this->input->post('list_id') as $list_id)
	    	{	    		
				// List HAS Groups
				if ($this->input->post($list_id))
				{
					$merge_vars	= array(
						'FNAME' 	=> $this->input->post('name'),
						'NAME'	=> $this->input->post('name'),
						'GROUPINGS' => array()
					);
								
					// Loop Groups
					foreach ($this->input->post($list_id) as $group_id)
					{
						// Group HAS Interests
						if ($this->input->post($group_id))
						{	
							// Build Interests
							$interests = implode(',', $this->input->post($group_id));
							
							$merge_vars['GROUPINGS'][] = array('id' => $group_id, 'groups' => $interests);
						}
					}

					if ($interests)
					{
						$subscribed[$list_id] = $this->mailchimp_api->listSubscribe($list_id, $email, $merge_vars);
					}
					else
					{
						// Have Error Returned
						$subscribed[$list_id] = 'No Groups Selected, Do not submit';
					}
				}
				else
				{
					$merge_vars	= array(
						'FNAME' => $this->input->post('name'),
						'NAME'	=> $this->input->post('name')					
					);

					$subscribed[$list_id] = $this->mailchimp_api->listSubscribe($list_id, $email, $merge_vars);			
				}

				// Docs http://apidocs.mailchimp.com/api/1.3/listsubscribe.func.php
				$posted[$list_id] = array('email' => $email, 'merge_vars' => $merge_vars);    		
	    	}

	        $message = array('status' => 'success', 'message' => 'Success! Check your email to confirm sign up.', 'posted' => $posted, 'subscribed' => $subscribed);

	        //$message = array('status' => 'error', 'message' => $this->mailchimp_api->errorMessage);
		}
		else
		{
			$message = array('status' => 'error', 'message' => 'Oops '.validation_errors());		
		}

		$this->response($message, 200);			
	}

}