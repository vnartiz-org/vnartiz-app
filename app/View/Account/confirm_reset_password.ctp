<h1><?=__('Confirm Reset Password')?></h1>
<?php if (isset($forgotMessage)):?>
	<div class="success-box">
		<?=$forgotMessage?>
	</div>
<?php elseif(isset($forgotError)):?>
	<div class="error-box">
		<?=$forgotError?>
	</div>
<?php endif;?>