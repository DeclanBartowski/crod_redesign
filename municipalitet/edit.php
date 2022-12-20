<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редактирование элемента");
global $USER;
if (!$USER->IsAuthorized())LocalRedirect("authorize.php");
$elementId = !empty($_REQUEST['ELEMENT_ID'])?$_REQUEST['ELEMENT_ID']:false;
$elementIblockId = !empty($_REQUEST['IBLOCK_ID'])?$_REQUEST['IBLOCK_ID']:false;
$elementIblockType = !empty($_REQUEST['IBLOCK_TYPE'])?$_REQUEST['IBLOCK_TYPE']:false;
//if(!$elementId)LocalRedirect(SITE_SERVER_NAME . '/404.php');

//get element data

CModule::IncludeModule("iblock");
$rsElem = CIBlockElement::GetByID($elementId);
if($arRes = $rsElem->GetNext()){
    $element = $arRes;
}else{
    $element = false;
}

//get element properties list
$props = array();
$res = CIBlock::GetProperties($elementIblockId, Array(), Array('TYPE'=>$elementIblockType));
while($propRes = $res->GetNext()){
    $props[] = $propRes['ID'];
}

//getting params for element add form

$arParams['IBLOCK_ID'] = $element['IBLOCK_ID'];
$arParams['PROPERTY_CODES'] = $props;
$arParams['IBLOCK_TYPE'] = $element['IBLOCK_TYPE_ID'];
$arParams['PROPERTY_CODES'][] = 'NAME';

?>

<pre>
    <?//print_r($element);?>
    <?//print_r($arParams);?>
</pre>

<?$APPLICATION->IncludeComponent(
	"bitrix:infoportal.element.add.form", 
	"subject_result_edit_form", 
	array(
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_NAME" => "",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"DEFAULT_INPUT_SIZE" => "30",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"ELEMENT_ASSOC" => "PROPERTY_ID",
		"ELEMENT_ASSOC_PROPERTY" => "",
		"GROUPS" => array(
			0 => "1",
			1 => "8",
		),
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
		"LEVEL_LAST" => "Y",
		"LIST_URL" => "",
		"MAX_FILE_SIZE" => "0",
		"MAX_LEVELS" => "100000",
		"MAX_USER_ENTRIES" => "100000",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"PROPERTY_CODES" => $arParams['PROPERTY_CODES'],
		"PROPERTY_CODES_REQUIRED" => array(),
		"RESIZE_IMAGES" => "N",
		"SEF_MODE" => "N",
		"STATUS" => "ANY",
		"STATUS_NEW" => "N",
		"USER_MESSAGE_ADD" => "Элемент успешно добавлен",
		"USER_MESSAGE_EDIT" => "Изменения успешно сохранены",
		"USE_CAPTCHA" => "N",
		"COMPONENT_TEMPLATE" => ".default",
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>