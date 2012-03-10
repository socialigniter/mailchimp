<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : MailChimp : Widgets
* Author: 		Brennan Novak
* 		  		contact@social-igniter.com
*         		@brennannovak
*          
* Project:		http://social-igniter.com/
* Source: 		http://github.com/socialigniter/mailchimp
*
* Description: 	Widgets for MailChimp of Social Igniter
*/

$config['mailchimp_widgets'][] = array(
	'regions'	=> array('sidebar','content','leftbar'),
	'widget'	=> array(
		'module'	=> 'mailchimp',
		'name'		=> 'Subscribe',
		'method'	=> 'run',
		'path'		=> 'widgets_subscribe',
		'multiple'	=> 'FALSE',
		'order'		=> '1',
		'title'		=> 'Join Our Mailing List',
		'content'	=> ''
	)
);