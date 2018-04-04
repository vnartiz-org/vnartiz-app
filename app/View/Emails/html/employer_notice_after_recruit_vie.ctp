<h1 style="text-align:center;border-bottom:1px solid #eee;color:#0879bf;font-size:28px;font-weight:700;padding:20px 0;">Nhà tuyển dụng vừa đăng tin</h1>
<!--
<div style="background: white; padding: 10px; border: 1px solid #eee; margin: 10px;">
	<h2>Thông tin người đăng</h2>
	<table>
		<tr>
			<td>Tên</td><td>: <?=$firstname?></td>
		</tr>
		<tr>
			<td>Họ</td><td>: <?=$lastname?></td>
		</tr>
	</table>
</div>
-->
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
			<td>Số lượng</td><td>: <?=$quantity?></td>
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
<!--
<div style="background: white; padding: 10px; border: 1px solid #eee; margin: 10px;">
	<h2>Thông tin quyên góp</h2>
	<table>
		<tr>
			<td>Loại thẻ</td><td>: <?=$card_type?></td>
		</tr>
		<tr>
			<td>Số thẻ</td><td>: <?=$card_number?></td>
		</tr>
		<tr>
			<td>Số tiền:</td><td>: <?=$amount?></td>
		</tr>
		<tr>
			<td>Năm hết hạn:</td><td>: <?=$expire_year?></td>
		</tr>
		<tr>
			<td>Tháng hết hạn</td><td>: <?=$expire_month?></td>
		</tr>
	</table>
</div>
-->