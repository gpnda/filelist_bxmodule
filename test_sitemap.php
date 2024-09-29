<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("Img2Sitemap");
	
use Gpnda\Img2Sitemap\Img2Sitemap;

\Gpnda\Img2Sitemap\Img2Sitemap::print_sitemap();



require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); //если ругается на него php, то комментим и дальше пользуемся