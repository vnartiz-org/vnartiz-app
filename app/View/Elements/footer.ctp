<div class="display-table w-full border-bottom">
	<ul class="lang nav nav-pills fl w-50pr">
		<li>
			<?=$this->Form->create()?>
				<a class="<?php if ($current_language == 'eng'):?>selected<?php endif;?> language" href="javascript:void(0)" name="language" value="eng">English</a>
				<?=$this->Form->input($language['eng'])?>
			<?=$this->Form->end()?>
		</li>
    	<li>
			<?=$this->Form->create()?>
				<a class="<?php if ($current_language == 'vie'):?>selected<?php endif;?> language" href="javascript:void(0)">Tiếng Việt</a>
				<?=$this->Form->input($language['vie'])?>
			<?=$this->Form->end()?>
		</li>
		<li>
			<?=$this->Form->create()?>
				<a class="<?php if ($current_language == 'fra'):?>selected<?php endif;?> language" href="javascript:void(0)">Français</a>
				<?=$this->Form->input($language['fra'])?>
			<?=$this->Form->end()?>
		</li>
    	<li>
			<?=$this->Form->create()?>
				<a class="<?php if ($current_language == 'zho'):?>selected<?php endif;?> language" href="javascript:void(0)">中文</a>
				<?=$this->Form->input($language['zho'])?>
			<?=$this->Form->end()?>
		</li>
    	<li>
			<?=$this->Form->create()?>
				<a class="<?php if ($current_language == 'jap'):?>selected<?php endif;?> language" href="javascript:void(0)">日本語</a>
				<?=$this->Form->input($language['jap'])?>
			<?=$this->Form->end()?>
		</li>
    	<li>
			<?=$this->Form->create()?>
				<a class="<?php if ($current_language == 'kor'):?>selected<?php endif;?> language" href="javascript:void(0)">한국의</a>
				<?=$this->Form->input($language['kor'])?>
			<?=$this->Form->end()?>
		</li>
    	<li>
			<?=$this->Form->create()?>
				<a class="<?php if ($current_language == 'rus'):?>selected<?php endif;?> language" href="javascript:void(0)">русский</a>
				<?=$this->Form->input($language['rus'])?>
			<?=$this->Form->end()?>
		</li>
    	<li>
			<?=$this->Form->create()?>
				<a class="<?php if ($current_language == 'ara'):?>selected<?php endif;?> language" href="javascript:void(0)">العربية</a>
				<?=$this->Form->input($language['ara'])?>
			<?=$this->Form->end()?>
		</li>
    	<li>
			<?=$this->Form->create()?>
				<a class="<?php if ($current_language == 'hin'):?>selected<?php endif;?> language" href="javascript:void(0)">हिंदी</a>
				<?=$this->Form->input($language['hin'])?>
			<?=$this->Form->end()?>
		</li>
	</ul>
	<ul class="social fr">
		<li>
			<a title="Facebook" href="https://www.facebook.com/pages/Artist-World-Organization/185462384846801" target="_blank"><i class="icon_social_facebook"></i></a>
		</li>
		<li>
			<a title="Twitter" href="https://twitter.com/anh_dung9244" target="_blank"><i class="icon_social_twiter"></i></a>
		</li>
		<li>
			<a title="Linked In" href="http://www.linkedin.com/company/artist-world-organization" target="_blank"><i class="icon_social_linkin"></i></a>
		</li>
		<li>
			<a title="Flickr" href="https://www.flickr.com/photos/artistworld/" target="_blank"><i class="icon_social_flickr"></i></a>
		</li>
	</ul>
</div>
<div>
	<ul class="page nav nav-pills">
		<li><a href="<?=$this->webroot?>page/our_services"><?=__('Our services')?></a></li>
		<li><a href="<?=$this->webroot?>page/about_us"><?=__('About us')?></a></li>
	</ul>
</div>
<div class="copyright">
	<?=__('Copyright &copy by Artist World organization. All right reserved.')?>
</div>