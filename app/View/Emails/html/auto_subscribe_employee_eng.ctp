<?php if (is_array($jobs) && $jobs):?>
	<section class="jobs" style="width: 100%;">
		<h2 style="width: 100%; text-align: center; color: #fff; background: #0879bf; margin-bottom: 20px; line-height: 50px;">Latest Jobs</h2>
		<table style="width: 100%">
			<tbody>
				<?php foreach ($jobs as $recruiter):?>
					<tr>
						<td style="padding: 10px; border-bottom: 1px solid #eee;">
							<div class="fl w-40pr" style="float: left; width: 35%; display: inline-block;">
								<h3><?=$recruiter['Recruiter']['position']?></h3>
								<div class="text-grey"><?=__('Posted on')?> <?=$recruiter['Recruiter']['create_datetime']?></div>
								<div>
									<label style="display: inline-block; width: 100px;"><?=__('Major')?></label><?=__($majors[$recruiter['Recruiter']['major_id']])?><br/>
									<label style="display: inline-block; width: 100px;"><?=__('Quantity')?></label><?=$recruiter['Recruiter']['quantity']?><br/>
									<label style="display: inline-block; width: 100px;"><?=__('Salary')?></label><span class="salary" style="color: #f93355; font-weight: 700;" ><?=__($salaries[$recruiter['Recruiter']['salary_id']])?></span><br/>
									<?=$countries[$recruiter['Recruiter']['country_id']]?> <?=$locations[$recruiter['Recruiter']['location_id']]?><br/>
									<?=$recruiter['Recruiter']['address']?>
								</div>
							</div>
							<div class="fl w-40pr pr-10" style="float: left; width: 40%; padding-right: 10px; display: inline-block;">
								<div class="mini-square-box fl w-30pr pr-10" style="float: left; padding-right: 10px; display: inline-block; width: 60px; min-height: 60px; overflow: hidden;">
									<img src="<?=$webroot?>employer/files/img/logo/<?=$recruiter['Company']['Logo']['square']?>" style="width: 100%" />
								</div>
								<div class="display-table w-70pr fl" style="display: inline-block; width: 70%; float: left;">
									<h3><?=$recruiter['Company']['name']?></h3>
									<div class="text-grey"><?=__('Joined on')?> <?=$recruiter['Company']['create_datetime']?></div>
									<div class="fb"><?=__($majors[$recruiter['Company']['major_id']])?></div>
									<div class="fb"><?=$rates[$recruiter['Company']['rate_id']]?></div>
									<?=$countries[$recruiter['Company']['country_id']]?> <?=$locations[$recruiter['Company']['location_id']]?><br/>
									<?=$recruiter['Company']['address']?>
								</div>
							</div>
							<div class="w-20pr fr pr-10" style="width: 20%; float: right; padding-right: 10px; display: inline-block;">
								<div class="text-red"><?=__('Expire on')?> <?=$recruiter['Recruiter']['expire_date']?></div>
								<span class="button" style="display: inline-block; height: 35px; background: #96BC44; margin: 5px 0 5px 5px;">
									<a target="_blank" href="<?=$webroot?>top/preview/<?=$recruiter['Recruiter']['id']?>" style="padding: 0 10px; line-height: 35px; color: #fff; text-decoration: none; white-space: nowrap;"><?=__('View detail')?></a>
								</span>
							</div>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<div class="item w-full" style="width: 100%; text-align: center; margin: 20px 0;">
			<span class="button fr" style="display: inline-block; height: 35px; background: #96BC44; margin: 5px 0 5px 5px;">
				<a href="<?=$webroot?>" style="padding: 0 10px; line-height: 35px; color: #fff; text-decoration: none; white-space: nowrap;">
					<?=__('View all')?>
				</a>
			</span>
		</div>
	</section>
<?php endif;?>
<?php if (!empty($vi_consultants)):?>
<div class="block white p0">
	<div class="p-20">
		<h2 style="width: 100%; text-align: center; color: #fff; background: #0879bf; margin-bottom: 20px; line-height: 50px;"><?=__('Consultant')?></h2>
		<div style="display: table; border-bottom: 1px solid #eee; width: 100%;">
			<?php foreach ($vi_consultants as $vi_consultant):?>
				<div class="item b-bottom" style="width: 33.3%; float: left; display: inline-block;">
					<div style="min-height: 310px; padding: 10px; ">
						<a class="p0 b0" alt="<?=$vi_consultant['Consultant']['title']?>" href="<?=$webroot?>employee/consultant/preview/<?=$vi_consultant['Consultant']['comp_title']?>">
							<div class="img-consultant-box b0">
								<img src="<?=$webroot?>employee/files/img/consultant/<?=$vi_consultant['Consultant']['file']?>" style="width: 100%" />
							</div>
						</a>
						<h3><?=$vi_consultant['Consultant']['title']?></h3>
						<p style="height: 100px;">
							<?=$vi_consultant['Consultant']['summary']?>
						</p>
					</div>
					<span class="button fr" style="display: inline-block; height: 35px; background: #96BC44; margin: 5px 0 5px 5px;">
						<a alt="<?=$vi_consultant['Consultant']['title']?>" href="<?=$webroot?>employee/consultant/preview/<?=$vi_consultant['Consultant']['comp_title']?>" style="padding: 0 10px; line-height: 35px; color: #fff; text-decoration: none; white-space: nowrap;">
							<?=__('View detail')?>
						</a>
					</span>
				</div>
			<?php endforeach;?>
		</div>
		<div class="item w-full" style="width: 100%; text-align: center; margin: 20px 0;">
			<span class="button fr" style="display: inline-block; height: 35px; background: #96BC44; margin: 5px 0 5px 5px;">
				<a href="<?=$webroot?>employee/consultant/" style="padding: 0 10px; line-height: 35px; color: #fff; text-decoration: none; white-space: nowrap;">
					<?=__('View all')?>
				</a>
			</span>
		</div>
	</div>
</div>
<?php endif;?>