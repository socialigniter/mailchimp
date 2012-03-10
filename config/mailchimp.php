<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:		Social Igniter : Module Template : Config
* Author: 	Brennan Novak
* 		  	contact@social-igniter.com
* 
* Created by Brennan Novak
*
* Project:	http://social-igniter.com
* Source: 	http://github.com/socialigniter/module-template
* 
* Description: this file Social Igniter
*
|--------------------------------------------------------------------------
| MailChimp API credentials
|
| These details are used to authenticate your MailChimp API.
|--------------------------------------------------------------------------
*/
   
//API Key - see http://admin.mailchimp.com/account/api
$config['mailchimp_apikey'] 		= 'YOUR MAILCHIMP APIKEY';
    
// A List Id to run examples against. use lists() to view all
// Also, login to MC account, go to List, then List Tools, and look for the List ID entry
$config['mailchimp_listId'] 		= 'YOUR MAILCHIMP LIST ID - see lists() method';
    
// A Campaign Id to run examples against. use campaigns() to view all
$config['mailchimp_campaignId'] 	= 'YOUR MAILCHIMP CAMPAIGN ID - see campaigns() method';

//some email addresses used in the examples:
$config['mailchimp_my_email'] 		= 'INVALID@example.org';
$config['mailchimp_boss_man_email'] = 'INVALID@example.com';

//just used in xml-rpc examples
$config['mailchimp_apiUrl'] 		= 'http://api.mailchimp.com/1.2/';
