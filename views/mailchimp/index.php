<form id="mailchimp_subscribe" name="mailchimp_subscribe">
	<fieldset>
		<legend>Join Our Mailing Lists</legend>
		
		<label>Name</label>
		<p><input type="text" name="name" id="subscribe_name" placeholder="John Smythe"></p>
		
		<label for="email" id="address-label">Email Address</label>
		<p><input type="text" name="email" id="subscribe_email" placeholder="johnsmythe@gmail.com"></p>

		<h4>Select Your Areas Of Interest</h4>
		<?php 
		// Lists are for "separate" accounts
		// Need to only show what is declared
		foreach($lists->data as $list):
			// Get Groups		
			$groups = json_decode($this->mailchimp_api->listInterestGroupings($list->id));
			// If Groups Do This
			if ($groups):
		?>
			<input type="hidden" name="list_id[]" value="<?= $list->id ?>">
			<p><strong><?= $list->name ?> - <?= $list->id ?></strong><br>
			<?php
				// Loop Groups
				foreach ($groups as $group):
 					// Does Group Have Interests				
					if ($group->groups):
			?>
					<input type="hidden" name="<?= $list->id ?>[]" value="<?= $group->id ?>">	
					<?php foreach ($group->groups as $interest): ?>
					<input type="checkbox" value="<?= $interest->name ?>" name="<?= $group->id ?>[]" class="subscribe_checkboxes"> <?= $interest->name ?><br>
					<?php endforeach; ?>
			<?php
					endif; // End $group_parent->groups 
				endforeach; // End $groups
			?>
			</p>
			<?php else: // Has No Groups ?>
				<p><strong><?= $list->name ?> - <?= $list->id ?></strong><br>
				<input type="checkbox" value="<?= $list->id ?>" name="list_id[]" class="subscribe_checkboxes"> General</p>
			<?php endif; ?>
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
		  		$('#subscribe_name').val('');
		  		$('#subscribe_email').val(''); 
		  		$('.subscribe_checkboxes').attr('checked', false);

				$('html, body').animate({scrollTop:0});
				$('#content_message').notify({scroll:true,status:result.status,message:result.message});								
		  	}		
		});			

	});
});
</script>