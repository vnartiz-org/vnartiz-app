<div id="awo-container" style="font-size: 12px; font-family: Arial, Helvetica, sans-serif">
	<div id="awo-top-header" style="background: #111; height: 30px; padding: 5px;">
   		<div class="awo-content">
        	<div class="awo-mini-nav fl">
				<div class="awo-logo-square-mini-box">
					<a href="<?=$my_root?>"><img src="<?=$my_root?>files/img/layout/realestate-logo-square.png" style="width:30px;"></a>
				</div>
			</div>
    	</div>
	</div>
	<div id="awo-header" style="background:#b80717">
		<div class="awo-content" style="padding:5px;">
			<div class="awo-logo-rectangle-box fl">
				<a href="<?=$my_root?>">
					<img id="awo-image-logo" src="<?=$my_root?>files/img/layout/realestate-logo.png" alt="WRE">
				</a>
			</div>		
		</div>
   	</div>	
	<div id="awo-main-content" style="width: 100%; background: whiteSmoke; display; table;">
		<div class="content" style="display: table; width: 100%; max-width: 800px; margin: 0 auto;">
			<div class="content-insider" style="width: 100%;  min-height: 200px;">
				<?=$this->fetch('content')?>
			</div>
			<div style="background: #ffb;color: #000; width: 96%; padding: 10px 2%; margin: 10px 0px; font-weight: 700;">
				<?=__('This email has auto sent by systems. Please do not rely it.')?>
			</div>
		</div>
	</div>
	<div id="awo-footer" style="background:#111; color: #666; text-align: center">
		<div class="awo-content">
			<div id="authorise">
				<div>
					<img border="0" style="padding:5px;" src="<?=$my_root?>files/img/layout/biz-realestate-logo.png" alt="WRE">
				</div>
				<div class="biz-logo-title" style="color: #999; font-size: 30px; line-height: 30px; margin: 5px 0;"><?=__('Real Estate Solution')?></div>
				<div><?=__('Mobile')?>: (+84) 964 301 364. <?=__('Email')?>: anh_dung9244@yahoo.com</div>
				<div><?=__('Address')?>: 60 Vo Thi Sau, Lien Huong, Tuy Phong, Binh Thuan, Vietnam.</div>
				<div style="color: #999">
					<a href="<?=$my_root?>help/privacy_policy" style="color: #999"><?=__('Privacy policy')?></a> ! <a href="<?=$my_root?>help/term_of_used" style="color: #999"><?=__('Term of used')?></a> ! <a href="<?=$my_root?>help/" style="color: #999"><?=__('Help')?></a> ! <a href="<?=$my_root?>help/tool_center" style="color: #999"><?=__('Live support')?></a>
				</div>
				<div>
					<img class="technology" style="width: 100%; max-width: 450px" src="<?=$my_root?>files/img/layout/programming.jpg" alt="Programming">
				</div>
			</div> 
		</div>
	</div>
</div>