<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
if (!$USER->IsAuthorized()) {
    LocalRedirect('/login/');
} else {
    LocalRedirect('/personal/results/');
}
?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
