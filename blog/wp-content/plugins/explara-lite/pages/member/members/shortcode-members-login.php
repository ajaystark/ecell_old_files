<section class="explara-light-member-section">
	<!-- <div class="container"> -->
	<h1 class="explara-light-member-section-heading">
	Members
	</h1>
	<div class="explara-light-member-login-buttons">
		<ul>
			<li>
				<a href="<?php echo $data['group']['joinUrl'] ?>" class="explara-light-cm-btn-red" target="_blank">
					JOIN NOW 
				</a>
			</li>
			<li>
				<a href="<?php echo $data['group']['loginUrl'] ?>" class="explara-light-cm-btn-brown" target="_blank">
					MEMBER LOGIN
				</a>
			</li>
		</ul>
	</div>
	<?php 
	$i=0;
	foreach ($data['group']['membsers'] as $member) {
	
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
	<!-- </div> -->
</section>