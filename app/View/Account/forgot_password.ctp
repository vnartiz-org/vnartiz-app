<div class="login-form">
	<h1><?=__('Forgot password')?></h1>
	<?php if (isset($forgotMessage)):?>
		<div class="success-box">
			<?=$forgotMessage?>
		</div>
	<?php elseif(isset($forgotNote)):?>
		<div class="note-box">
			<?=$forgotNote?>
		</div>
	<?php elseif(isset($forgotError)):?>
		<div class="error-box">
			<?=$forgotError?>
		</div>
	<?php endif;?>
	<?=$this->Form->create()?>
		<table>
			<tbody>
				<tr>
					<td>
						<p>
							<?=__('If you forgot your password please fill out your username and email to reset it now')?>
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<?=$this->Form->inputs($forgot_password)?>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td>
						<?=$this->Form->button($button['submit'])?>
					</td>
				</tr>
			</tfoot>
		</table>
	<?=$this->Form->end()?>
</div>