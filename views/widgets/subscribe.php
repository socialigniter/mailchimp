<form id="mailchimp_subscribe_widget" name="mailchimp_subscribe_widget">
	<fieldset>
		<?php if ($widget_title) echo '<legend>'.$widget_title.'</legend>'; ?>		
		<label>Select List</label>
		<p>
		<select name="list_id" id="list_id">
			<?php foreach($lists->data as $list): ?>
			<option value="<?= $list->id ?>"><?= $list->name ?></option>
			<?php endforeach; ?>
		</select></p>
		
		<label>Name</label>
		<p><input type="text" name="name" id="subscribe_name" placeholder="John Smythe"></p>
		
		<label for="email" id="address-label">Email Address</label>
		<p><input type="text" name="email" id="subscribe_email" placeholder="johnsmythe@gmail.com"></p>
		
		<h4>Select Only What You Are Interested In</h4>

		<input type="submit" name="submit" value="Join" class="btn" alt="Join">
		
	</fieldset>
</form>      
<script type="text/javascript">
$(document).ready(function()
{
	$('#mailchimp_subscribe_widget').submit(function(e)
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