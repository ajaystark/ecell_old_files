<section id="explara-light" class="explara-light-member-section">
	<!-- <div class="container"> -->
	<div class="explara-light-login-page-head-content">
		<h1 class="">
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
	</div>
	<div class="explara-light-members-page-members-listing">
		<div class="exl-row">
			<?php
$i = 0;
foreach ($data['group']['membsers'] as $member) {

	?>
			<div class="exl-col">
				<div class="explara-light-members-page-member-card">
					<img src="<?php echo $member['profileImage'] ?>" alt="">
					<div class="explara-light-members-page-member-content">
						<h4>
						<?php echo $member['name']; ?>
						</h4>
						<p>
							<?php echo $member['attendeeInfo']['Designation']; ?>, <?php echo $member['attendeeInfo']['Company Name']; ?>
						</p>
					</div>
				</div>
			</div>
			<?php
$i++;
	if (!empty($data['atts']['count']) && $data['atts']['count'] == $i) {
		break;
	}
}?>
		</div>
	</div>
	<!-- </div> -->
</section>