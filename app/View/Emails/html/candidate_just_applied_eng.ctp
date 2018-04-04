
<h1 style="text-align:center;border-bottom:1px solid #eee;color:#0879bf;font-size:28px;font-weight:700;padding:20px 0;">Notice applied a job</h1>

<div style="background: white; padding: 10px; border: 1px solid #eee; margin: 10px;">
	<h2>Candidate information</h2>
	<table>
		<tr>
			<td>First name</td><td>: <?=$firstname?></td>
		</tr>
		<tr>
			<td>Last name</td><td>: <?=$lastname?></td>
		</tr>
		<tr>
			<td>Phone</td><td>: <?=$phone?></td>
		</tr>
		<tr>
			<td>Email</td><td>: <?=$email?></td>
		</tr>
		<tr>
			<td>Address</td><td>: <?=$candidate_address?></td>
		</tr>
	</table>
	<span class="button fr" style="display: inline-block; height: 35px; background: #96BC44; margin: 5px 0 5px 5px;">
		<a href="<?=$webroot?>employer/candidate/preview/<?=$candidate_id?>" style="padding: 0 10px; line-height: 35px; color: #fff; text-decoration: none; white-space: nowrap;">
			<?=__('Candidate detail')?>
		</a>
	</span>
</div>

<div style="background: white; padding: 10px; border: 1px solid #eee; margin: 10px;">
	<h2>Job information</h2>
	<table>
		<tr>
			<td>Position</td><td>: <?=$position?></td>
		</tr>
		<tr>
			<td>Major</td><td>: <?=$major?></td>
		</tr>
		<tr>
			<td>Salary</td><td>: <?=$salary?></td>
		</tr>
		<tr>
			<td>Country</td><td>: <?=$country?></td>
		</tr>
		<tr>
			<td>Location</td><td>: <?=$location?></td>
		</tr>
		<tr>
			<td>Created date</td><td>: <?=$created_date?></td>
		</tr>
		<tr>
			<td>Start date</td><td>: <?=$start_date?></td>
		</tr>
		<tr>
			<td>Duration</td><td>: <?=$duration?></td>
		</tr>
	</table>
	<span class="button fr" style="display: inline-block; height: 35px; background: #96BC44; margin: 5px 0 5px 5px;">
		<a href="<?=$webroot?>employee/top/preview/<?=$job_id?>" style="padding: 0 10px; line-height: 35px; color: #fff; text-decoration: none; white-space: nowrap;">
			<?=__('Job detail')?>
		</a>
	</span>
</div>