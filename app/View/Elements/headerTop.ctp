<div class="row" id="navigation">
	<div class="col-xs-2">
		<a href="<?=$this->webroot?>" class="logo-mini p-5-0 wp-nowrap" style="height: 45px; width: 272px;" title="Artist World organization">
			<img class="pl-5" style="height: 42px" alt="Artist World organization" src="<?=$this->webroot?>files/img/logo-awo.png">
		</a>
	</div>
	<div class="col-xs-10">
		<div class="navigation">
			<div class="nav-box">
				<a class="nav-bt btn-navigation" href="javascript:void(0)"></a>
				<div class="nav-ct">
					<ul class="menu nav nav-pills fr">
						<li><a href="http://realestate.vnartiz.com" target="_blank"><?=__('Real estate')?></a></li>
						<li><a href="http://recruit.vnartiz.com" target="_blank"><?=__('Job seeker')?></a></li>
						<li><a href="http://recruit.vnartiz.com/employer/" target="_blank"><?=__('Employer')?></a></li>
						<li><a href="http://color.vnartiz.com" target="_blank"><?=__('Multimedia')?></a></li>
						<li <?php if ($this->params['controller'] == 'account'):?>class="selected"<?php endif;?> >
							<a href="javascript:void(0)" target="_blank">
								<?php if (!isset($member)):?>
									<?=__('Account')?>
								<?php else:?>
									<?=__('Hello')?> <?=$member['Contact']['firstname']?>
								<?php endif;?>
							</a>
							<ul>
								<li class="p-10">
									<?php if (!isset($member)):?>
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
										</div>
										<?=$this->Form->end()?>
									<?php else:?>
										<div>
											<div class="display-table">
												<ul>
													<li>
														<?=$this->Html->link($linkLogin['preview_account'])?>
													</li>
													<li>
														<?=$this->Html->link($linkLogin['edit_account'])?>
													</li>
												</ul>
											</div>
											<?=$this->Form->create()?>
												<?=$this->Form->button($logoutButton['logout'])?>
											<?=$this->Form->end()?>
										</div>
									<?php endif;?>
								</li>
																							
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>