<h1 style="text-align:center;border-bottom:1px solid #eee;color:#0879bf;font-size:28px;font-weight:700;padding:20px 0;">雇用主はちょうど掲示します</h1>

<div style="background: white; padding: 10px; border: 1px solid #eee; margin: 10px;">
	<h2>情報のポスター</h2>
	<table>
		<tr>
			<td>名前</td><td>: <?=$firstname?></td>
		</tr>
		<tr>
			<td>彼ら</td><td>: <?=$lastname?></td>
		</tr>
	</table>
</div>

<div style="background: white; padding: 10px; border: 1px solid #eee; margin: 10px;">
	<h2>就職情報</h2>
	<table>
		<tr>
			<td>場所</td><td>: <?=$position?></td>
		</tr>
		<tr>
			<td>専門化</td><td>: <?=$major?></td>
		</tr>
		<tr>
			<td>数量</td><td>: <?=$quantity?></td>
		</tr>
		<tr>
			<td>ルオン</td><td>: <?=$salary?></td>
		</tr>
		<tr>
			<td>国</td><td>: <?=$country?></td>
		</tr>
		<tr>
			<td>場所</td><td>: <?=$location?></td>
		</tr>
		<tr>
			<td>掲載日</td><td>: <?=$created_date?></td>
		</tr>
		<tr>
			<td>開始日</td><td>: <?=$start_date?></td>
		</tr>
		<tr>
			<td>デュレーション</td><td>: <?=$duration?></td>
		</tr>
	</table>
	<span class="button fr" style="display: inline-block; height: 35px; background: #96BC44; margin: 5px 0 5px 5px;">
		<a href="<?=$webroot?>employee/top/preview/<?=$job_id?>" style="padding: 0 10px; line-height: 35px; color: #fff; text-decoration: none; white-space: nowrap;">
			<?=__('ジョブの詳細')?>
		</a>
	</span>
</div>

<div style="background: white; padding: 10px; border: 1px solid #eee; margin: 10px;">
	<h2>情報を寄付</h2>
	<table>
		<tr>
			<td>カードタイプ</td><td>: <?=$card_type?></td>
		</tr>
		<tr>
			<td>カード番号</td><td>: <?=$card_number?></td>
		</tr>
		<tr>
			<td>量</td><td>: <?=$amount?></td>
		</tr>
		<tr>
			<td>有効期限年</td><td>: <?=$expire_year?></td>
		</tr>
		<tr>
			<td>有効期限の月</td><td>: <?=$expire_month?></td>
		</tr>
	</table>
</div>