<form method="POST" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
	<?php wp_nonce_field( plugin_basename( __FILE__ ), 'appointment_form',true,true); ?>
	
	<div class="mb-3">
		<label for="email" class="form-label">Your e-mail address:</label>
		<input required="true" type="email" class="form-control border-2 rounded" name="to_email" placeholder="name@example.com" />
	</div>
	<div class="mb-3">
		<label for="text" class="form-label">Your name</label>
		<input required="true" type="text" class="form-control border-2 rounded" name="sender_name" placeholder="name@example.com" />
	</div>
	<div class="mb-3">
		<label for="dev">Select a time slot:</label>
		<select name="time_slot" id="browser" class="p-2 border border-2 rounded">
				<option value="Adebola, Monday - 10:00am GMT">Adebola, Monday - 10:00am GMT</option>
				<option value="Omkar, Tuesday - 9:00am GMT">Omkar, Tuesday - 9:00am GMT</option>
				<option value="David, Wednesday - 10:00am EST">David, Wednesday - 10:00am EST</option>
				<option value="Itunu, Thursday - 4:00pm EST">Itunu, Thursday - 4:00pm EST</option>
		</select>
	</div>
	<div>
		<input class="btn btn-primary" type="submit" name="send_mailgun_email" value="Schedule Appointment" />
	</div>
	<input type="hidden" name="action" value="appointment_form" />
</form>