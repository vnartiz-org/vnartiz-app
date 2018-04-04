<h1><?=__('Create an enterprise account')?></h1>
<div class="col-sm-8 ta-center">
	<div class="block">
		<div class="display-block">
			<h3><?=__('One account for all application')?></h3>
			<div><?=__('Sign in to used full our feature and component.')?></div>
		</div>
		<div>
			<ul class="all-app-list">
				<li>
					<a href="http://realestate.vnartistworld.com" target="_blank" title="WRE World Real Estate"><img src="<?=$this->webroot?>files/img/icon-wre-color.png" /></a>
				</li>
				<li>
					<a href="http://recruit.vnartistworld.com" target="_blank" title="ViRecruitment"><img src="<?=$this->webroot?>files/img/icon-vir-color.png" /></a>
				</li>
				<li>
					<a href="http://iphoto.vnartistworld.com" target="_blank" title="iPhoto"><img src="<?=$this->webroot?>files/img/icon-iphoto-color.png" /></a>
				</li>
			</ul>
		</div>
	</div>
	<br/><br/><br/>
	<div class="block">
		<div class="display-block">
			<h3><?=__('One application for all devices')?></h3>
			<div><?=__('We commit you that we have the best way allow you use our application')?></div>
		</div>
		<div class="display-block">
			<img src="<?=$this->webroot?>files/img/misc/responsive.png" style="width: auto;" title="Responsive" />
		</div>
	</div>
	<br/><br/><br/>
	<div class="block">
		<div class="display-block">
			<h3><?=__('All features security in all our application')?></h3>
			<div><?=__('We commit your account always place in highest level of security status')?></div>
		</div>
		<div class="display-block">
			<img src="<?=$this->webroot?>files/img/misc/icon-security-all.png" style="width: auto;" title="Security" />
		</div>
	</div>
</div>
<div class="col-sm-4">
	<?php if (isset($signinMessage)):?>
		<div class="success-box">
			<?=$signinMessage?>
		</div>
	<?php elseif(isset($signinError)):?>
		<div class="error-box">
			<?=$signinError?>
		</div>
	<?php endif;?>
	<?=$this->Form->create($form)?>
	<table class="edit">
		<tbody>
			<tr>
				<td>
					<?=$this->Form->inputs($account)?>
				</td>
			</tr>
		</tbody>
		<tbody>
			<tr>
				<td>
					<?=$this->Form->inputs($contact)?>
				</td>
			</tr>
			<tr>
				<td class="w-25pr b-left va-top ta-center">
					<div class="avatar-box">
						<img class="avatar-img" src="<?=$this->webroot?>files/img/default/avatar_default.jpg" />
					</div>
					<label>300x400px <?=__('or')?> 400x600px</label>
					<?=$this->Form->inputs($avatar)?>
				</td>
			</tr>
		</tbody>
		<tbody>
			<tr>
				<td>
					<?=$this->Form->inputs($company)?>
				</td>
			</tr>
			<tr>
				<td class="b-left va-top ta-center">
					<div class="square-box">
						<img class="square-img" src="<?=$this->webroot?>files/img/default/logo_square.jpg" />
					</div>
					<label>150x150px</label>
					<?=$this->Form->input($logo['square'])?>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td>
					<?=$this->Form->button($button['signin'])?>
				</td>
			</tr>
		</tfoot>
	</table>
	<?=$this->Form->end()?>
</div>