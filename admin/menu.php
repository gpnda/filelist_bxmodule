<?php

use Bitrix\Main\ModuleManager;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if ($APPLICATION->GetGroupRight('img2sitemap') == 'D')
{
	return false;
}
else
{
	$menu = array(
		array(
			'parent_menu' => 'global_menu_marketing',
			'section' => 'img2sitemap',
			'sort' => 100,
			'text' => "Листинг картинок в Sitemap XML",
			'title' => "img2sitemap",
			'icon' => '',
			'page_icon' => '',
			'items_id' => 'menu_img2sitemap',
			'url' => 'img2sitemap.php',
		),
	);


	return $menu;
}
