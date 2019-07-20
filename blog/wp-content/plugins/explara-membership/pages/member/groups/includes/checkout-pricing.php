<div class="form-rt">
	<div class="price-chart">
		<div class="text-center">
			<p class="text-center">
				<i class="fa fa-shopping-bag cart" aria-hidden="true"></i>
			</p>
		</div>
		<ul class="list-unstyled">
			<li class="item-price clearfix">
				<span>
					Sub Total
				</span>
				<span class="pull-right">
					<span>
						<?php echo $currency; ?>
					</span>
					<span id="explara_member_subtotal_value">
						<?php echo $sub_total; ?>
					</span>
				</span>
			</li>
			<li class="item-price clearfix" id="explara_discounts" style="display: none">
			</li>
			<li class="item-price clearfix" id="explara_member_taxs" style="display: none">
			</li>
			<li class="item-price clearfix explara_member_discount_price" style="display: none">
				<span>
					Discount
				</span>
				<span  class="pull-right">
					<span>
						<?php echo $currency; ?>
					</span>
					<span id="explara_member_discount_value">
					</span>
				</span>
			</li>
			<li class="item-price clearfix explara_member_procession_fee" style="display: none">
				<span>
					Processing Fee
				</span>
				<span  class="pull-right">
					<span>
						<?php echo $currency; ?>
					</span>
					<span id="explara_memver_procession_fee_value">
						<?php echo $pricessing_fee; ?>
					</span>
				</span>
			</li>
			<li>
				<hr>
			</li>
			<li class="final-amount">
				<span>
					Total
				</span>
				<span class="pull-right">
					<span>
						<?php echo $currency; ?>
					</span>
					<span id="explara_member_total_amount">
						<?php echo $total; ?>
					</span>
				</span>
			</li>
		</ul>
	</div>
</div>