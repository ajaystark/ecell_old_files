<section id="explara-light" class="explara-light-member-section">
	<h1 class="explara-light-member-section-heading">
	Members
	</h1>

<?php
			$i=0;
			foreach ($data['members'] as $member) {
			?>
	
	<div class="explara-light-member-card explara-light-events-list-view">
		<img src="<?php echo $member['profileImage'] ?>" alt="<?php echo $member['name']; ?>">
		<div class="explara-light-member-card-content">
			<h4>
			<?php echo $member['name']; ?>
			</h4>
			<p>
				<?php echo $member['attendeeInfo']['Designation']; ?>, <?php echo $member['attendeeInfo']['Company Name']; ?>
			</p>
		</div>
	</div>

<?php
	$i++;
	if(!empty($data['atts']['count']) && $data['atts']['count']==$i){
	break;
	}
	} ?>

</section>