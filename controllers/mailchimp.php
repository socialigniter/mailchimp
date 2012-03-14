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
		$groups		= array();

		if (count($lists->data))
		{
			foreach ($lists->data as $list)
			{
				$groups[$list->id] = json_decode($this->mailchimp_api->listInterestGroupings($list->id));
			}
		}

		$this->data['lists']	= $lists;
		$this->data['groups']	= $groups;

		$this->render();
	}

	/* Widgets */
	function widgets_subscribe($widget_data) 
	{		
		
		$this->load->view('widgets/subscribe', $widget_data);
	}
	
}
