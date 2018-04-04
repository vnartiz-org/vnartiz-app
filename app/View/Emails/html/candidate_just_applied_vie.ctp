
<h1 style="text-align:center;border-bottom:1px solid #eee;color:#0879bf;font-size:28px;font-weight:700;padding:20px 0;">Thông báo ứng tuyển</h1>

<div style="background: white; padding: 10px; border: 1px solid #eee; margin: 10px;">
	<h2>Thông tin ứng viên</h2>
	<table>
		<tr>
			<td>Tên</td><td>: <?=$firstname?></td>
		</tr>
		<tr>
			<td>Họ</td><td>: <?=$lastname?></td>
		</tr>
		<tr>
			<td>Điện thoại</td><td>: <?=$phone?></td>
		</tr>
		<tr>
			<td>Thư</td><td>: <?=$email?></td>
		</tr>
		<tr>
			<td>Địa chỉ</td><td>: <?=$candidate_address?></td>
		</tr>
	</table>
	<span class="button fr" style="display: inline-block; height: 35px; background: #96BC44; margin: 5px 0 5px 5px;">
		<a href="<?=$webroot?>employer/candidate/preview/<?=$candidate_id?>" style="padding: 0 10px; line-height: 35px; color: #fff; text-decoration: none; white-space: nowrap;">
			<?=__('Chi tiết ứng viên')?>
		</a>
	</span>
</div>

<div style="background: white; padding: 10px; border: 1px solid #eee; margin: 10px;">
	<h2>Thông tin việc làm</h2>
	<table>
		<tr>
			<td>Vị trí</td><td>: <?=$position?></td>
		</tr>
		<tr>
			<td>Chuyên nghành</td><td>: <?=$major?></td>
		</tr>
		<tr>
			<td>Lương</td><td>: <?=$salary?></td>
		</tr>
		<tr>
			<td>Quốc gia</td><td>: <?=$country?></td>
		</tr>
		<tr>
			<td>Địa điểm</td><td>: <?=$location?></td>
		</tr>
		<tr>
			<td>Ngày đăng tin</td><td>: <?=$created_date?></td>
		</tr>
		<tr>
			<td>Ngày bắt đầu</td><td>: <?=$start_date?></td>
		</tr>
		<tr>
			<td>Thời hạn</td><td>: <?=$duration?></td>
		</tr>
	</table>
	<span class="button fr" style="display: inline-block; height: 35px; background: #96BC44; margin: 5px 0 5px 5px;">
		<a href="<?=$webroot?>employee/top/preview/<?=$job_id?>" style="padding: 0 10px; line-height: 35px; color: #fff; text-decoration: none; white-space: nowrap;">
			<?=__('Chi tiết việc làm')?>
		</a>
	</span>
</div>