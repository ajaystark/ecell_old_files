<li class="description-list">
								<?php
if (isset($event->details_dump->events->Location[$venuekey])) {?>
								<span class="icon">
									<i class="fa fa-flag-checkered expfa-black" aria-hidden="true"></i>
								</span>
								<span class="content">
									<?php echo $event->details_dump->events->Location[$venuekey]->venueName; ?>, <?php echo $event->details_dump->events->Location[$venuekey]->address; ?><br>
									<?php echo $event->details_dump->events->Location[$venuekey]->city; ?>, <?php echo $event->details_dump->events->Location[$venuekey]->state; ?>, <?php echo $event->details_dump->events->Location[$venuekey]->country; ?><br>
									<?php echo $event->details_dump->events->Location[$venuekey]->zipcode; ?>
								</span><br>
								<span class="map">
								<?php if (!empty($event->details_dump->events->Location[$venuekey]->latitude) && !empty($event->details_dump->events->Location[$venuekey]->longitude)) {?>
									<a target="_blank" href="https://www.google.com/maps/?q=<?php echo $event->details_dump->events->Location[$venuekey]->latitude; ?>,<?php echo $event->details_dump->events->Location[$venuekey]->longitude; ?>">View map →</a>
								<?php }?>
								</span>
								<?php
}
?>
							</li>