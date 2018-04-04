<h1><?=__('Preview Account')?></h1>

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
				<div class="item">
					<label><?=__('Username')?></label> <?=$member['Account']['username']?>
				</div>
				<div class="item">
					<label><?=__('Password')?></label> ********
				</div>
				<div class="item">
					<label><?=__('Email')?></label> <?=$member['Account']['email']?>
				</div>
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
				<div class="item">
					<label><?=__('First name')?></label> <?=$member['Contact']['firstname']?>
				</div>	
				<div class="item">
					<label><?=__('Last name')?></label> <?=$member['Contact']['lastname']?>
				</div>
				<div class="item">
					<label><?=__('Gender')?></label> <?=$genders[$member['Contact']['gender']]?>
				</div>
				<div class="item">
					<label><?=__('Birthday')?></label> <?=$member['Contact']['birthday']?>
				</div>	
				<div class="item">
					<label><?=__('Identify No.')?></label> <?=$member['Contact']['identify']?>
				</div>
				<div class="item">
					<label><?=__('Tax code')?></label> <?=$member['Contact']['taxcode']?>
				</div>
				<div class="item">
					<label><?=__('Phone')?></label> <?=$member['Contact']['phone']?>
				</div>
				<div class="item">
					<label><?=__('Email')?></label> <?=$member['Contact']['email']?>
				</div>
				<div class="item">
					<label><?=__('Address')?></label> <?=$member['Contact']['address']?>
				</div>
				<div class="item">
					<label><?=__('Country')?></label> <?=$countries[$member['Contact']['country_id']]?>
				</div>
				<div class="item">
					<label><?=__('Location')?></label> <?=$locations[$member['Contact']['location_id']]?>
				</div>
			</td>
		</tr>
		<tr>
			<td class="w-25pr b-left va-top ta-center">
				<div class="avatar-box">
					<img class="avatar-img" src="<?=$file?>" />
				</div>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td>
				<span class="button ">
					<?=$this->Html->link($linkLogin['edit_account'])?>
				</span>
			</td>
		</tr>
	</tfoot>
</table>