<?php $current_url = $group->db_group->complete_link . '?page=checkout';?>
<div   id="explara-group-renew">
<div class="overlay">
	
</div>
	<div class="reniew-content">
		<h3>
		<i class="fa fa-times-circle" aria-hidden="true"></i>
		</h3>
		<h2>
		We are Sorry. You are not a memeber of the group <br>'<?php echo $group->name; ?>'
		</h2>
		<p>
			Please join the group  <a href="<?php echo $current_url; ?>" class="">
				Join
			</a>
			or   <a href="<?php echo $current_url; ?>" class="">
				Renew
			</a>  your membership
		</p>
	</div>
</div>