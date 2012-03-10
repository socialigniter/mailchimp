<?php
class Mailchimp extends Site_Controller
{
    function __construct()
    {
        parent::__construct();       

		$this->load->config('mailchimp');
	}
	
	function index()
	{
		$this->data['page_title'] = 'MailChimp';
		$this->render();	
	}

	/* Widgets */
	function widgets_subscribe($widget_data) 
	{		
		$widget_data['posts'] = '';
		
		$this->load->view('widgets/subscribe', $widget_data);
	}
	
}
