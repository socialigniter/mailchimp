<h2 class="content_title"><img src="<?= $modules_assets ?>mailchimp_32.png"> MailChimp</h2>
<ul class="content_navigation">
	<?= navigation_list_btn('home/mailchimp', 'Recent') ?>
	<?= navigation_list_btn('home/mailchimp/custom', 'Custom') ?>
	<?php if ($logged_user_level_id <= 2) echo navigation_list_btn('home/module_template/manage', 'Manage', $this->uri->segment(4)) ?>
</ul>