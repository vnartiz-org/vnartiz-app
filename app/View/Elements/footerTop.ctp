<div class="awo-mini-nav m-0-auto">
	<a href="#this"><img id="languge-image" src="<?=$this->webroot?>files/img/layout/language-icon.png" width="25" height="25" alt="language" /></a>
	<ul>
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
				<a class="<?php if ($current_language == 'jap'):?>selected<?php endif;?> language" href="javascript:void(0)">日本語</a>
				<?=$this->Form->input($language['jap'])?>
			<?=$this->Form->end()?>
		</li>
	</ul>
</div>
