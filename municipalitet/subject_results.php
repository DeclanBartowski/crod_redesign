<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Результаты олимпиад");
global $USER;
if (!$USER->IsAuthorized())LocalRedirect("authorize.php");
$errors = array(
	1 	=> 'ФИО не введено',
	2 	=> 'Год не указан',
	3 	=> 'Предмет не указан',
	4 	=> 'Класс не указан',
	5 	=> 'ФИО преподавателя не указано',
	6 	=> 'Баллы не указаны',
	7 	=> 'Занятое место не указано',
	8 	=> 'Школа не указана',
	9 	=> 'Статус участника не указан',
	10 	=> 'Ошибка при сохранении. Обратитесь к администратору',
    11  => 'Неправильный формат файла. Загрузите файл с расширением .xls или .xlsx',
    12  => 'Файл не выбран, выберите файл формата .xlsx',
    13  => 'Все результаты из списка уже добавлены. Обновите список'
);
?>
<style>	
	.errors{border:1px solid #FF1F1F; color:#FF1F1F; margin:20px 0; padding: 10px;}
    .success{border:1px solid #3ebc41; color: #3ebc41; margin:20px 0; padding: 10px;}
</style>
<?if(!empty($_REQUEST['ERRORS']) && $_SESSION['ERROR_ALERT']):?>
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
        <div class="success">
            Данные успешно сохранены
            <?if(!empty($_REQUEST['ITEMS_ADDED'])):?>
                . Добавлено результатов: <?=$_REQUEST['ITEMS_ADDED'];?>
            <?endif;?>
        </div>
    <?endif;?>
<?endif;?>
<?if(!empty($_SESSION['SUCCESS_ALERT']))unset($_SESSION['SUCCESS_ALERT']);?>
<a href="index.php">К основному меню личного кабинета</a>
<?
$arrFilter = array("PROPERTY_REG"=>CURRENT_USER_REGION_ID);
$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"subjects_results", 
	array(
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
		"COMPONENT_TEMPLATE" => "subjects_results",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "CLASS",
			1 => "CITIZENSHIP",
			2 => "BIRTH_DATE",
			3 => "FIRST_NAME",
			4 => "TEACHER_FIRST_NAME",
			5 => "PLACE",
			6 => "MUNICIPALITET",
			7 => "MIDDLE_NAME",
			8 => "TEACHER_MIDDLE_NAME",
			9 => "SCHOOL_FULL_NAME",
			10 => "SUBJECT",
			11 => "RESULT_VALUE",
			12 => "SCHOOL_SHORT_NAME",
			13 => "PARTICIPANT_STATUS",
			14 => "LAST_NAME",
			15 => "TEACHER_LAST_NAME",
			16 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"EVENT_SECTION_CODE" => "sobytiya",
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "24",
		"IBLOCK_TYPE" => "documents",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "XML_ID",
			3 => "NAME",
			4 => "TAGS",
			5 => "SORT",
			6 => "PREVIEW_TEXT",
			7 => "PREVIEW_PICTURE",
			8 => "DETAIL_TEXT",
			9 => "DETAIL_PICTURE",
			10 => "DATE_ACTIVE_FROM",
			11 => "ACTIVE_FROM",
			12 => "DATE_ACTIVE_TO",
			13 => "ACTIVE_TO",
			14 => "SHOW_COUNTER",
			15 => "SHOW_COUNTER_START",
			16 => "IBLOCK_TYPE_ID",
			17 => "IBLOCK_ID",
			18 => "IBLOCK_CODE",
			19 => "IBLOCK_NAME",
			20 => "IBLOCK_EXTERNAL_ID",
			21 => "DATE_CREATE",
			22 => "CREATED_BY",
			23 => "CREATED_USER_NAME",
			24 => "TIMESTAMP_X",
			25 => "MODIFIED_BY",
			26 => "USER_NAME",
			27 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "MARKS",
			1 => "YEAR",
			2 => "BIRTHDATE",
			3 => "RANK",
			4 => "CLASS",
			5 => "SUB",
			6 => "REG",
			7 => "STATUS",
			8 => "FIO_TEACH",
			9 => "SCHOOL",
			10 => "",
		),
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
		"SEF_FOLDER" => "/municipalitet/",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "ID",
			2 => "CODE",
			3 => "XML_ID",
			4 => "NAME",
			5 => "TAGS",
			6 => "SORT",
			7 => "PREVIEW_TEXT",
			8 => "PREVIEW_PICTURE",
			9 => "DETAIL_TEXT",
			10 => "DETAIL_PICTURE",
			11 => "DATE_ACTIVE_FROM",
			12 => "ACTIVE_FROM",
			13 => "DATE_ACTIVE_TO",
			14 => "ACTIVE_TO",
			15 => "SHOW_COUNTER",
			16 => "SHOW_COUNTER_START",
			17 => "IBLOCK_TYPE_ID",
			18 => "IBLOCK_ID",
			19 => "IBLOCK_CODE",
			20 => "IBLOCK_NAME",
			21 => "IBLOCK_EXTERNAL_ID",
			22 => "DATE_CREATE",
			23 => "CREATED_BY",
			24 => "CREATED_USER_NAME",
			25 => "TIMESTAMP_X",
			26 => "MODIFIED_BY",
			27 => "USER_NAME",
			28 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "MARKS",
			2 => "YEAR",
			3 => "BIRTHDATE",
			4 => "RANK",
			5 => "CLASS",
			6 => "SUB",
			7 => "REG",
			8 => "STATUS",
			9 => "FIO_TEACH",
			10 => "SCHOOL",
			11 => "",
		),
		"VARIABLE_ALIASES" => array(
			"SECTION_ID" => "SECTION_ID",
			"ELEMENT_ID" => "ELEMENT_ID",
		)
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>