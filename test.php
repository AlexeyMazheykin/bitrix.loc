<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>Text here....<?$APPLICATION->IncludeComponent(
	"mazheykin:buld.component",
	"",
	Array(
		"DATA_FINISH" => "",
		"LINE_TEXT_SPEED" => "30",
		"ONLY_HOME" => "Y",
		"TEXT_FINISH" => "",
		"TEXT_NOT_FINISH" => "",
		"USE_BOOTSTRAP" => "Y",
		"USE_BOOTSTRAP_v3" => "Y",
		"USE_BOOTSTRAP_v4" => "Y",
		"USE_JQUERY" => "Y",
		"USE_LINE_RUN" => "Y"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>