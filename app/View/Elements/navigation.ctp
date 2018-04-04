<?php if (!empty($member) && !empty($isManagement)):?>
<ul class="fl">
	<li>
		<a class="management-nor<?php if (isset($isManagement) && $isManagement !== false):?> management-nav<?php endif;?>"  href="<?=$this->webroot?>management/"><?=__('Management')?></a>
	</li>
</ul>
<?php endif;?>
<div class="nav-box nav-customize">
	<a class="nav-bt" href="javascript:void(0))"></a>
	<div class="nav-ct">
		<ul>
			<li><a <?php if ($this->params['controller'] == 'properties'):?>class="selected"<?php endif;?> href="<?=$this->webroot?>properties/"><?=__('Properties')?></a></li>
			<li><a <?php if ($this->params['controller'] == 'companies'):?>class="providers-nav"<?php endif;?> href="<?=$this->webroot?>companies/"><?=__('Providers')?></a></li>
			<li><a <?php if ($this->params['controller'] == 'reports'):?>class="reports-nav"<?php endif;?>  href="<?=$this->webroot?>reports/"><?=__('Reports')?></a></li>
			<li><a <?php if ($this->params['controller'] == 'help'):?>class="FAQs-nav"<?php endif;?> href="<?=$this->webroot?>help/"><?=__('Help')?></a></li>
		</ul>
	</div>
</div>