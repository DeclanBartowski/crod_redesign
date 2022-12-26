<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Документы");
if (!$USER->IsAuthorized()) {
    LocalRedirect('/login/');
}
?>
<? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "personal",
    array(
        "ALLOW_MULTI_SELECT" => "N",
        "CHILD_MENU_TYPE" => "left",
        "DELAY" => "N",
        "MAX_LEVEL" => "1",
        "MENU_CACHE_GET_VARS" => array(""),
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "ROOT_MENU_TYPE" => "lk",
        "USE_EXT" => "N"
    )
); ?>

<?
$APPLICATION->IncludeComponent(
    "sp:personal.documents",
    "",
    array(

    ),
    false
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
