<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->AddHeadScript("/local/components/vision/vision.special/templates/.default/style/js/js.cookie.js");
$APPLICATION->AddHeadScript("/local/components/vision/vision.special/templates/.default/style/js/js.cookie.min.js");


if( $_SESSION["special_version"] == "Y")
{
$APPLICATION->SetAdditionalCSS("/local/components/vision/vision.special/templates/.default/style/css/style.css", true);
$APPLICATION->SetAdditionalCSS("/local/components/vision/vision.special/templates/.default/style/css/bvi-font.css", true);
$APPLICATION->SetAdditionalCSS("/local/components/vision/vision.special/templates/.default/style/css/bvi.css", true);
$APPLICATION->SetAdditionalCSS("/local/components/vision/vision.special/templates/.default/style/css/bvi.min.css", true);
$APPLICATION->SetAdditionalCSS("/local/components/vision/vision.special/templates/.default/style/css/bvi-font.min.css", true);
$APPLICATION->SetAdditionalCSS("/local/components/vision/vision.special/templates/.default/style/css/style.css", true);
$APPLICATION->AddHeadScript("/local/components/vision/vision.special/templates/.default/style/js/bvi.js");
$APPLICATION->AddHeadScript("/local/components/vision/vision.special/templates/.default/style/js/responsivevoice.min.js");
$APPLICATION->AddHeadScript("/local/components/vision/vision.special/templates/.default/style/js/responsivevoice.js");
$APPLICATION->AddHeadScript("/local/components/vision/vision.special/templates/.default/style/js/bvi-init.js");
$APPLICATION->AddHeadScript("/local/components/vision/vision.special/templates/.default/style/js/bvi.min.js");
?>

    <?php
}

?>

<style>
    .bvi-body:first-child{
        display: none!important;
    }
</style>
