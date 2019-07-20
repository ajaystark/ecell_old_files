<section class="explara-light-members-page-banner">
	<div class="overlay"></div>
	<div class="explara-light-members-page-heading">
		<h1>
		Members
		</h1>
		<p>
			&nbsp;
		</p>
	</div>
</section>
<section id="explara-light" class="explara-light-members-page-members">
	<div class="explara-light-members-page-members-holder">
		<div class="explara-light-members-page-member-heading">
			<h1>
			Members
			</h1>
		</div>
		<div class="explara-light-members-page-members-listing">
			<div class="exl-row">
				<?php
				$i=0;
				foreach ($data['members'] as $member) {
				?>
				
				<div class="exl-col">
					
					<div class="explara-light-members-page-member-card">
						<img src="<?php echo $member['profileImage'] ?>" alt="<?php echo $member['name']; ?>">
						<div class="explara-light-members-page-member-content">
							<h4><?php echo $member['name']; ?></h4>
							<p><?php echo $member['attendeeInfo']['Designation']; ?>, <?php echo $member['attendeeInfo']['Company Name']; ?></p>
						</div>
					</div>
					
				</div>
				
				<?php
				$i++;
				if(!empty($data['atts']['count']) && $data['atts']['count']==$i){
				break;
				}
				} ?>
			</div>
		</div>
	</div>
</section>
