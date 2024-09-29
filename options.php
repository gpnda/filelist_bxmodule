<?php
use Bitrix\Main\Localization\Loc;
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/options.php");
Loc::loadMessages(__FILE__);


$arAllOptions = array(
	array("path",       "Путь к папке в файловой системе",  "./img_for_test/",  array("text", 50)),
	array("uri",        "URI этой-же папки",                "/upload/img/",     array("text", 50)),
    array("protocol",   "Протокол: 'https://'",             "https://",         array("text", 10)),
);


// Дефолтные значения опций
$img2sitemap_default_option = array(
	"path" => "./img_for_test/",
	"uri" => "/upload/img/",
	"protocol" => "https://",
);
$arDefaultValues['default'] = $img2sitemap_default_option;



// Обрабатываем POST, если прилетел
if($_SERVER["REQUEST_METHOD"]=="POST" && ($_POST['Update'] || $_POST['Apply'] || $_POST['RestoreDefaults'])>0 && check_bitrix_sessid())
{
	if($_POST['RestoreDefaults'] <> '')
	{
		$arDefValues = $arDefaultValues['default'];
		foreach($arDefValues as $key=>$value)
		{
			COption::RemoveOption("img2sitemap", $key);
		}
	}
	else
	{
		foreach($arAllOptions as $arOption)
		{
			$name=$arOption[0];
			$val=$_REQUEST[$name];
			if($arOption[3][0]=="checkbox" && $val!="Y")
				$val="N";
			COption::SetOptionString("img2sitemap", $name, $val, $arOption[1]);
		}
	}
	if($_POST['Update'] <> '' && $_REQUEST["back_url_settings"] <> '')
		LocalRedirect($_REQUEST["back_url_settings"]);
	else
		LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($mid)."&lang=".urlencode(LANGUAGE_ID)."&back_url_settings=".urlencode($_REQUEST["back_url_settings"]));
}

?>

<h2>img2sitemap</h2>
<p>Модуль позволяет создавать sitemap.xml перечисляющий все файлы картинок, размещенные в конкретной папке на сервере.</p>



<form method="post" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&amp;lang=<?echo LANGUAGE_ID?>">
	
    <?
	foreach($arAllOptions as $arOption):
		$val = COption::GetOptionString("img2sitemap", $arOption[0], $arOption[2]);
		$type = $arOption[3];
		?>

        <p>
			<?echo $arOption[1]?>:

				<?if($type[0]=="checkbox"):?>
					<input type="checkbox" id="<?echo htmlspecialcharsbx($arOption[0])?>" name="<?echo htmlspecialcharsbx($arOption[0])?>" value="Y"<?if($val=="Y")echo" checked";?>>
				<?elseif($type[0]=="text"):?>
					<input type="text" size="<?echo $type[1]?>" maxlength="255" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($arOption[0])?>">
				<?elseif($type[0]=="textarea"):?>
					<textarea rows="<?echo $type[1]?>" cols="<?echo $type[2]?>" name="<?echo htmlspecialcharsbx($arOption[0])?>"><?echo htmlspecialcharsbx($val)?></textarea>
				<?elseif($type[0]=="selectbox"):?>
					<select name="<?echo htmlspecialcharsbx($arOption[0])?>">
						<?
						foreach ($type[1] as $key => $value)
						{
							?><option value="<?= $key ?>"<?= ($key == $val) ? " selected" : "" ?>><?= $value ?></option><?
						}
						?>
					</select>
				<?endif?>
        </p>

	<?endforeach?>

    <input type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>" class="adm-btn-save">
	<input type="submit" name="Apply" value="<?=GetMessage("MAIN_OPT_APPLY")?>" title="<?=GetMessage("MAIN_OPT_APPLY_TITLE")?>">
	<?if($_REQUEST["back_url_settings"] <> ''):?>
		<input type="button" name="Cancel" value="<?=GetMessage("MAIN_OPT_CANCEL")?>" title="<?=GetMessage("MAIN_OPT_CANCEL_TITLE")?>" onclick="window.location='<?echo htmlspecialcharsbx(CUtil::addslashes($_REQUEST["back_url_settings"]))?>'">
		<input type="hidden" name="back_url_settings" value="<?=htmlspecialcharsbx($_REQUEST["back_url_settings"])?>">
	<?endif?>
	<input type="submit" name="RestoreDefaults" title="<?echo GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" OnClick="return confirm('<?echo AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>')" value="<?echo GetMessage("MAIN_RESTORE_DEFAULTS")?>">
	<?=bitrix_sessid_post();?>