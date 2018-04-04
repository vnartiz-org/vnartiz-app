<h1><?=__('Edit Account')?></h1>
<p>
	<?=__('Manage your Account information and Contact information.')?><br/>
</p>
<?=$this->Form->create($form)?>

<table class="edit">
	<thead>
		<tr>
			<th>
				<h3><?=__('Account')?></h3>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<?=$this->Form->inputs($account)?>
			</td>
		</tr>
	</tbody>
	<thead>
		<tr>
			<th>
				<h3><?=__('Contact')?></h3>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<?=$this->Form->inputs($contact)?>
			</td>
		</tr>
		<tr>
			<td class="b-left va-top ta-center">
				<div class="avatar-box">
					<img class="avatar-img" src="<?=$file?>" />
				</div>
				<label>300x400px <?=__('or')?> 400x600px</label>
				<?=$this->Form->inputs($avatar)?>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td>
				<?=$this->Form->button($button['edit'])?>
				<span class="button">
					<?=$this->Html->link($linkEdit['cancel'])?>
				</span>
			</td>
		</tr>
	</tfoot>
</table>
<?=$this->Form->end()?>