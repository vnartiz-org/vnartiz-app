<div class="login-form">
	<h1><?=__('Login')?></h1>
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
						<?=$this->Form->create('login')?>
						<?php if (isset($loginError)):?>
							<div class="error-box">
								<?=$loginError?>
							</div>
						<?php endif;?>
						<div class="display-table">
							<div>
								<?=$this->Form->inputs($loginForm)?>
							</div>
							<div>
								<?=$this->Form->button($loginButton['login'])?>
							</div>
							
						</div>
						<div class="display-table">
							<ul>
								<li class="p-10-0">
									<?=$this->Html->link($linkLogin['create_an_account'])?>
								</li>
								<li class="p-10-0">
									<?=$this->Html->link($linkLogin['forgot_password'])?>
								</li>
							</ul>
						</div>
						<?=$this->Form->end()?>
					</td>
				</tr>
			</tbody>
		</table>
	<?=$this->Form->end()?>
</div>