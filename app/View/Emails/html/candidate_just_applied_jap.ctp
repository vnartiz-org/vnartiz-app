
<h1 style="text-align:center;border-bottom:1px solid #eee;color:#0879bf;font-size:28px;font-weight:700;padding:20px 0;">通知は、ジョブを適用しました</h1>

<div style="background: white; padding: 10px; border: 1px solid #eee; margin: 10px;">
	<h2>候補情報</h2>
	<table>
		<tr>
			<td>名前</td><td>: <?=$firstname?></td>
		</tr>
		<tr>
			<td>彼ら</td><td>: <?=$lastname?></td>
		</tr>
		<tr>
			<td>電話</td><td>: <?=$phone?></td>
		</tr>
		<tr>
			<td>メール</td><td>: <?=$email?></td>
		</tr>
		<tr>
			<td>住所</td><td>: <?=$candidate_address?></td>
		</tr>
	</table>
	<span class="button fr" style="display: inline-block; height: 35px; background: #96BC44; margin: 5px 0 5px 5px;">
		<a href="<?=$webroot?>employer/candidate/preview/<?=$candidate_id?>" style="padding: 0 10px; line-height: 35px; color: #fff; text-decoration: none; white-space: nowrap;">
			<?=__('候補詳細')?>
		</a>
	</span>
</div>

<div style="background: white; padding: 10px; border: 1px solid #eee; margin: 10px;">
	<h2>就職情報</h2>
	<table>
		<tr>
			<td>ポジション</td><td>: <?=$position?></td>
		</tr>
		<tr>
			<td>メジャー</td><td>: <?=$major?></td>
		</tr>
		<tr>
			<td>給料</td><td>: <?=$salary?></td>
		</tr>
		<tr>
			<td>国</td><td>: <?=$country?></td>
		</tr>
		<tr>
			<td>ロケーション</td><td>: <?=$location?></td>
		</tr>
		<tr>
			<td>作成日付</td><td>: <?=$created_date?></td>
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
			<?=__('仕事の詳細')?>
		</a>
	</span>
</div>