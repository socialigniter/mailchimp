<?php
class Mailchimp extends Site_Controller
{
    function __construct()
    {
        parent::__construct();       

		$this->load->config('mailchimp');
		$this->load->library('mailchimp_api');
	}

	function index()
	{
		$this->data['page_title']	= 'MailChimp';
		$lists		= json_decode($this->mailchimp_api->lists());
		$groups		= json_decode($this->mailchimp_api->listInterestGroupings($lists->data[0]->id));

		$this->data['lists']	= $lists;
		$this->data['groups']	= $groups;

/*
		echo '<pre>';
		print_r($lists->data[0]);
		echo '<hr>';
		print_r($groups);
		die();
*/

		$this->render();
	}

	/* Widgets */
	function widgets_subscribe($widget_data) 
	{		
		
		$this->load->view('widgets/subscribe', $widget_data);
	}
	
}
