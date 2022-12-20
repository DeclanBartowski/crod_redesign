<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Нормативная база");
global $USER;
if (!$USER->IsAuthorized())LocalRedirect("authorize.php");
$errors = array(
    1 	=> 'Название не введено',
    2 	=> 'Предмет не указан',
    3 	=> 'Описание не заполнено',
    4   => 'Ошибка при сохранении. Обратитесь к администратору'
);
?>
<style>
    .errors{border:1px solid #FF1F1F; color:#FF1F1F; margin:20px 0; padding: 10px;}
    .success{border:1px solid #3ebc41; color: #3ebc41; margin:20px 0; padding: 10px;}
</style>
<?if(!empty($_REQUEST['ERRORS']) && !empty($_SESSION['ERROR_ALERT'])):?>
    <?$current_errors = unserialize(urldecode($_REQUEST['ERRORS']));
    if(!empty($_REQUEST['ERROR_CODE'])){
        $errors[] = urldecode($_REQUEST['ERROR_CODE']);
        $current_errors[] = count($errors);
    }
    ?>
    <div class="errors">
        <?foreach($current_errors as $key => $error):?>
            <?=$errors[$error] . ($key == count($current_errors)-1 ? '' : '<br>');?>
        <?endforeach;?>
    </div>
    <?if(!empty($_SESSION['ERROR_ALERT']))unset($_SESSION['ERROR_ALERT']);?>
<?endif;?>
<?if(!empty($_REQUEST['SUCCESS']) && !empty($_SESSION['SUCCESS_ALERT'])):?>
    <?if ($_REQUEST['SUCCESS'] == 'DEL'):?>
        <div class="success">Успешно удалено</div>
    <?else:?>
        <div class="success">Данные успешно сохранены</div>
    <?endif;?>
    <? if(!empty($_SESSION['SUCCESS_ALERT']))unset($_SESSION['SUCCESS_ALERT']);?>
<?endif;?>
<a href="index.php">К основному меню личного кабинета</a>
<?
$APPLICATION->IncludeComponent(
	"bitrix:news",
	"municipal_norm_base",
	Array(
        "CUSTOM_FILTER" => array("PROPERTY_REG"=>CURRENT_USER_REGION_ID),
        "SHOW_FILTER" => 'N',
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
        "DETAIL_FIELD_CODE" => array(0=>"",1=>"",),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
        "DETAIL_PROPERTY_CODE" => array(0=>"",1=>"YEAR",2=>"CLASS",3=>"SUB",4=>"REG",5=>"TYPE_DOC",6=>"FILE",),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
        "FILTER_NAME" => 'arrFilter',
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "27",
		"IBLOCK_TYPE" => "documents",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "LIST_FIELD_CODE" => array(0=>"",1=>"",),
        "LIST_PROPERTY_CODE" => array(0=>"",1=>"YEAR",2=>"CLASS",3=>"SUB",4=>"REG",5=>"TYPE_DOC",6=>"",),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_MODE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "Y",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"VARIABLE_ALIASES" => Array("ELEMENT_ID"=>"ELEMENT_ID","SECTION_ID"=>"SECTION_ID")
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>