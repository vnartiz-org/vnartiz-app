<div class="login-form">
	<h1><?=__('Login')?></h1>
	<?=$this->Form->create('login')?>
		<?php if (isset($loginError)):?>
			<div class="error-box">
				<?=$loginError?>
			</div>
		<?php endif;?>
		<div class="display-table w-full">
			<table>
				<tbody>
					<tr>
						<td>
							<?=$this->Form->inputs($loginForm)?>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td>
							<?=$this->Form->button($loginButton['login'])?>
						</td>
					</tr>
					<tr>
						<td>
							<ul>
								<li class="">
									<?=$this->Html->link($linkLogin['create_a_personal_account'])?>
								</li>
								<li class="">
									<?=$this->Html->link($linkLogin['create_an_enterprise_account'])?>
								</li>
								<li class="">
									<?=$this->Html->link($linkLogin['forgot_password'])?>
								</li>
							</ul>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	<?=$this->Form->end()?>
</div>