<?php $edit_current_url = "//" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '&page=substitute&action=edit&';?>
<div class="explara_orders update-attendee">
	<div class="explara_orders_list">
		<div class="row">
			<div class="col-sm-12">
				<h3>
				Update Attendee
				</h3>
				<p>
					Order Number: <?php echo $order->orderNo; ?>
				</p>
				<p>
					Ticket Number: <?php echo $_GET['ticket']; ?>
				</p>
				<div class="explara_attendeee_form_update">
					<form method="post" id="explara_attendee_update" class="exp-form">
						<div class="form-group">
							<label>
								First Name*
							</label>
							<input type="text" name="newFirstName" class="" required>
						</div>
						<div class="form-group">
							<label>
								Last Name*
							</label>
							<input type="text" name="newLastName" required>
						</div>
						<div class="form-group">
							<label>
								Email*
							</label>
							<input type="email" name="newEmailId" required>
						</div>
						<div class="form-group">
							<label>
								Phone Number*
							</label>
							<input type="number" name="newPhoneNo" required>
						</div>
						<input type="hidden" name="action" value="explara_attendee_update">
						<input type="hidden" name="orderNo" value="<?php echo $order->orderNo; ?>">
						<input type="hidden" name="ticketNumber" value="<?php echo $_GET['ticket']; ?>">
						<div class="text-center">
							<button class="btn btn-explara-lgreen" type="submit">
							Save
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>