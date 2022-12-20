<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация муниципалитета");
global $USER;
if($USER->IsAuthorized())LocalRedirect("index.php");
$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"simple_auth_form",
Array()
);?>