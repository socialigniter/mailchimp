<form id="mailchimp_subscribe" name="mailchimp_subscribe">
	<fieldset>
		<legend>Join Our Mailing Lists</legend>
		
		<label>Name</label>
		<p><input type="text" name="name" id="subscribe_name" placeholder="John Smythe"></p>
		
		<label for="email" id="address-label">Email Address</label>
		<p><input type="text" name="email" id="subscribe_email" placeholder="johnsmythe@gmail.com"></p>


		<h4>Select What You Are Interested In</h4>
		<?php foreach($lists->data as $list): ?>

		<p><input type="checkbox" value="<?= $list->id ?>" name="list_id[]"> <?= $list->name ?></p>

			<?php if ($groups): ?>
			<?php foreach ($groups as $group_key => $group): if ($group): ?>
			<div id="list_groups_<?= $group_key ?>">
				<?php foreach($group->groups as $child_group): ?>
					<p><input type="checkbox" value="<?= $child_group->bit ?>" name="group-<?= $group->id ?>-[<?= $child_group->bit ?>]" id="group-check-<?= $child_group->bit ?>"> <?= $child_group->name ?></p>
				<?php endforeach; ?>
			</div>
			<?php endif; endforeach; endif; ?>	
		
		<?php endforeach; ?>

		<input type="submit" name="submit" value="Join" class="btn" alt="Join">
		
	</fieldset>
</form>      
<script type="text/javascript">
$(document).ready(function()
{
	$('#mailchimp_subscribe').submit(function(e)
	{
		e.preventDefault();
		
		// Data
		var subscribe_data = $('#mailchimp_subscribe').serializeArray();
	
		$.ajax(
		{
			url			: base_url + 'api/mailchimp/subscribe',
			type		: 'POST',
			dataType	: 'json',
			data		: subscribe_data,
		  	success		: function(result)
		  	{							  	
				$('html, body').animate({scrollTop:0});
				$('#content_message').notify({scroll:true,status:result.status,message:result.message});									
		  	}		
		});			

	});
});
</script>