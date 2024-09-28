<?
use Bitrix\Iblock;
use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Entity;
use Bitrix\Main\Entity\ExpressionField;
use Bitrix\Main\Type;

require_once ($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");



require_once ($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/lum_seotags/lib/lum_tags.php");



$APPLICATION->SetTitle("Листинг картинок в виде Sitemap XML");




require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_after.php');
?>

<h2>Листинг картинок в виде Sitemap XML</h2>
111<br>
222<br>
333<br>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>