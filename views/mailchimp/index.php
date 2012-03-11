<h3>Mailing Lists</h3>

<form id="mailchimp_subscribe" name="mailchimp_subscribe">
	<fieldset>
		<legend>Join Our Mailing List</legend>

		<span id="response"></span>

		<select name="list_id" id="list_id">
			<?php foreach($lists['data'] as $list): ?>
			<option value="<?= $list['id'] ?>"><?= $list['name'] ?></option>
			<?php endforeach; ?>
		</select>
		
		<label>Name</label>
		<input type="text" name="name" id="subscribe_name" />
		
		<label for="email" id="address-label">Email Address</label>
		
		<input type="text" name="email" id="subscribe_email" />
		<input type="submit" name="submit" value="Join" class="btn" alt="Join" />
		
		<div id="no-spam">We'll never spam or give this address away</div>
	</fieldset>
</form>      
<script type="text/javascript">
$(document).ready(function()
{
	$('#mailchimp_subscribe').submit(function(e)
	{
		e.preventDefault();

		// Update user interface
		$('#response').html('Adding you to our mailing list…');
		
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