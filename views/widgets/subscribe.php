<div class="widget_<?= $widget_region ?> widget_mailchimp_subscribe" id="widget_<?= $widget_id ?>">

	<form action="" method="post" id="mailchimp_subscribe" name="mailchimp_subscribe">
	<fieldset>
	
		<legend><span><?= $widget_title ?></span></legend>
		<div class="indicate-required">* indicates required</div>
		<div class="mc-field-group">
			<label>Email Address <strong class="note-required">*</strong></label>
			<input type="text" value="" name="EMAIL" class="required email" id="mce-EMAIL">
		</div>

		<div class="mc-field-group">
			<label>Name </label>
			<input type="text" value="" name="MMERGE3" class="" id="mce-MMERGE3">
		</div>

		<div class="mc-field-group">
			<label class="input-group-label"><strong>Recommended </strong>Only choose <strong>ONE group</strong> to avoid double email newsletters...</label>
		    <ul>
		    	<li><input type="checkbox" value="1" name="group[1]" id="mce-group-1-0"><label>Portland Youth Programs</label></li>
				<li><input type="checkbox" value="2" name="group[2]" id="mce-group-1-1"><label>Portland Adult Programs</label></li>
			</ul>
		</div>
		<div id="mce-responses">
			<div class="response" id="mce-error-response"></div>
		</div>
		<div><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn"></div>

		<strong>Privacy Policy</strong> We absolutely hate spam. We will <strong>never, never, ever</strong> sell or giveaway your email. You can unsubscribe at anytime you feel like it.

	</fieldset>	
	</form>
</div>

<script type="text/javascript">
$(document).ready( function($)
{
	
}
</script>