<!DOCTYPE html>
<html <?php if ($current_language == 'ara'):?>class ="ta-right" dir="rtl"<?php endif;?>>
<head>
	<meta charset=utf-8" />
	<meta name="keywords" content="bất động sản, real esate, tuyển dụng, việc làm, jobs, working, recruit, recruitmemt, photo, photography, ảnh, nhiếp ảnh">
	<meta name="viewport" content="height=device-height,width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
	<link href="<?=$this->webroot?>files/img/favicon.png" rel="shortcut icon">
	<?=$this->Html->css('boothstrap')?>
	<?=$this->Html->css('jquery.ui')?>
	<?=$this->Html->css('navigation')?>
	<?=$this->Html->css('style')?>
	<?=$this->Html->css('component')?>
	<?=$this->Html->css('popup')?>
	<?=$this->Html->css('icon')?>
	<?=$this->Html->css('final')?>
	<?=$this->Html->script('jquery.min')?>
	<?=$this->Html->script('angular.min')?>
	<?=$this->Html->script('jquery.ui')?>
	<?=$this->Html->script('payment')?>
	<?=$this->Html->script('myquery')?>
	<title>Artist World organization</title>
	<script>
		webroot = '<?=$this->webroot?>';
		layout = 'default';
	</script>
</head>
<body ng-app="awoApp" >
<div class="container">
	<div class="header-top">
		<div class="insider">
			<?=$this->element('headerTop')?>
		</div>
	</div>
	<div class="header">
		<div class="insider">
			<?=$this->element('header')?>
		</div>
	</div>
	<?php if ($this->action == 'about_us'):?>
	<div class="banner">
		<div class="insider">
			<?=$this->element('banner')?>
		</div>
	</div>
	<?php endif;?>
	<div class="content <?php if($this->params['action'] == 'login' || $this->params['action'] == 'forgot_password'):?>login-wrapper<?php endif;?>">
		<div class="insider">
			<?=$this->fetch('content')?>
		</div>
	</div>
	<div class="footer">
		<div class="insider p-10-0">
			<?=$this->element('footer')?>
		</div>
	</div>
</div>
<?=$this->Html->script('dataController')?>
</body>
</html>