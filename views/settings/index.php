<form name="settings_update" id="settings_update" method="post" action="<?= base_url() ?>api/settings/modify" enctype="multipart/form-data">

<div class="content_wrap_inner">

	<div class="content_inner_top_right">
		<h3>App</h3>
		<p><?= form_dropdown('enabled', config_item('enable_disable'), $settings['mailchimp']['enabled']) ?></p>
		<p><a href="<?= base_url() ?>api/<?= $this_module ?>/uninstall" id="app_uninstall" class="button_delete">Uninstall</a></p>
	</div>

	<h3>Application Key</h3>

	<p>While logged into MailChimp get your <a href="http://us2.admin.mailchimp.com/account/api/" target="_blank">application key</a></p>
				
	<p><input type="text" name="api_key" value="<?= $settings['mailchimp']['api_key'] ?>"> API Key</p> 

	<input type="hidden" name="module" value="<?= $this_module ?>">

	<p><input type="submit" name="save" value="Save" /></p>

</div>
</form>

<?= $shared_ajax ?>