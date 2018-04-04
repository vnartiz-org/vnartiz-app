<div class="awo-block-cyan">
	<div class="awo-block-titles-cyan">
		<div class="awo-label-cyan"><h1>Search result</h1></div>
	</div>
	<div class="awo-block-content-cyan">
		<?php if (!empty($properties)):?>
			<?php foreach ($properties as $key => $property):?>
				<div class="cyan-items <?php if ($key%2 == 0):?>cyan-items-even<?php endif;?>">
					<div class="display-table w-75pr fl">
						<div class="display-table w-full">
							<div class="mini-properties-box fl w-30pr h-full">
								<?php if (empty($property['Account']['Company']['comp_name'])):?>
									<a target="_blank" href="<?=$this->webroot?>properties/preview/<?=$property['Properties']['comp_title']?>">
								<?php else:?>
									<a target="_blank" href="<?=$this->webroot?>sites/properties/<?=$property['Account']['Company']['comp_name']?>/<?=$property['Properties']['comp_title']?>">
								<?php endif;?>
									<img src="<?=$this->webroot?>files/img/properties/<?=$property['Properties_image']['file']?>" />
								</a>
							</div>
							<div class="">
								<div style="color:#026484;">
									<?php if (empty($property['Account']['Company']['comp_name'])):?>
										<a target="_blank" href="<?=$this->webroot?>properties/preview/<?=$property['Properties']['comp_title']?>">
									<?php else:?>
										<a target="_blank" href="<?=$this->webroot?>sites/properties/<?=$property['Account']['Company']['comp_name']?>/<?=$property['Properties']['comp_title']?>">
									<?php endif;?>
										<h2><?=$property['Properties']['title']?></h2>
									</a>
								</div>
								<div><?=__('Posted by')?> <?=$property['Account']['Contact']['firstname']?> <?=__('on')?> <?=$property['Properties']['create_datetime']?></div>
								<p style="color:#666; line-height:14px; padding-right:10px;"><?=$property['Properties']['summary']?></p>
							</div>
						</div>
						<div class="w-full">
							<div class="category tab"> 
								<?=$property['Properties_type']['title']?>
							</div>
							<div class="category tab"> 
								<?=$purposes[$property['Properties']['purpose_id']]?>
							</div>
							<div class="category tab"> 
								<?=$property['Properties']['area']?> <?=$squares[$property['Properties']['square_id']]?>
							</div>
							<div class="category tab"> 
								<?=$property['Country']['name']?>
							</div>
							<div class="category tab"> 
								<?=$property['Location']['name']?>
							</div>
							<div class="category tab red pl-0">
								<span class="tag-price">
									<?=$property['Properties']['price']?><?=$property['Currency']['mark']?> /<?=$price_types[$property['Properties']['price_type_id']]?>
								</span>
							</div>
						</div>
					</div>
					<div class="w-25pr fr">
						<div class="display-table w-full">
							<div class="item">
								<h3>Bought: <?=count($property['Buyer'])?></h3>
							</div>
							<div class="item">
								<div class="category pl-0">
									Viewed: 1
								</div>
								<div class="category pl-0">
									Liked: 1
								</div>
							</div>
						</div>
						<div class="item">
							<span class="button green">
								<?php if (empty($property['Account']['Company']['comp_name'])):?>
									<a target="_blank" href="<?=$this->webroot?>properties/preview/<?=$property['Properties']['comp_title']?>">
								<?php else:?>
									<a target="_blank" href="<?=$this->webroot?>sites/properties/<?=$property['Account']['Company']['comp_name']?>/<?=$property['Properties']['comp_title']?>">
								<?php endif;?>
									<i class="icon_show"></i><?=__('View detail')?>
								</a>
							</span>
							<?php if (!empty($property['Account']['Company']['id'])):?>
								<span class="button green">
									<a target="_blank" href="<?=$this->webroot?>sites/<?=$property['Account']['Company']['comp_name']?>"><i class="icon_show"></i><?=__('View company')?></a>
								</span>
							<?php endif;?>
							<span class="button green">
								
								<?php if (empty($property['Account']['Company']['comp_name'])):?>
									<a target="_blank" href="<?=$this->webroot?>account/preview/<?=$property['Account']['username']?>">
								<?php else:?>
									<a target="_blank" href="<?=$this->webroot?>sites/members/<?=$property['Account']['Company']['comp_name']?>/<?=$property['Account']['username']?>">
								<?php endif;?>
									<i class="icon_show"></i><?=__('View seller')?>
								</a>
							</span>
						</div>
					</div>
				</div>
			<?php endforeach;?>
		<?php else:?>
			<div class="cyan-items">
				<div class="note-box">
					<i class="icon_note icon_black"></i><?=$note?>
				</div>
			</div>
		<?php endif;?>
		<div class="footer-item">Total properties<span class="count"><?=count($properties)?></span></div>
	</div>
</div>