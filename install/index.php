<?php
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

Class img2sitemap extends CModule
{
	var $MODULE_ID = "img2sitemap";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS = "Y";

	function __construct()
	{
		$arModuleVersion = array();

		include(__DIR__.'/version.php');

		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

		$this->MODULE_NAME = "Листинг картинок в виде Sitemap XML";
		$this->MODULE_DESCRIPTION = "Модуль создает Sitemap XML, и перечисляет в нем все картинки, находящиеся в заданной папке на сервере.";
	}



	function InstallDB($install_wizard = true)
	{
		RegisterModule("img2sitemap");
		return true;
	}

	function UnInstallDB($arParams = Array())
	{
		UnRegisterModule("img2sitemap");
		return true;
	}

	function InstallEvents()
	{
		return true;
	}

	function UnInstallEvents()
	{
		return true;
	}

	function InstallFiles()
	{
		return true;
	}

	function UnInstallFiles()
	{
		return true;
	}

	function DoInstall()
	{
		$this->InstallFiles();
		$this->InstallDB(false);
	}

	function DoUninstall()
	{
		$this->UnInstallDB(false);
		$this->UnInstallFiles(false);

	}
}
