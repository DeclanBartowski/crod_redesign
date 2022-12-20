<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Школьные олимпиады калиниградской области");
$APPLICATION->SetTitle("Главная страница");

?>
<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "slider-main",
    Array(
        "ACTIVE_DATE_FORMAT" => "j F",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "N",
        "COMPONENT_TEMPLATE" => "docs-list",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(0=>"",1=>"",),
        "FILE_404" => "",
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "IBLOCK_ID" => "12",
        "IBLOCK_TYPE" => "variety",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "999",
        "PAGER_BASE_LINK" => "",
        "PAGER_BASE_LINK_ENABLE" => "Y",
        "PAGER_DESC_NUMBERING" => "Y",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_PARAMS_NAME" => "arrPager",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_TITLE" => "",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(0=>"URL",1=>"URL", 2 => 'DATE', 3 => 'SVG'),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "NAME",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "DESC",
        "STRICT_SECTION_CHECK" => "N"
    )
);?>

<div class="documents-box">
    <div class="title-inner-wrap">
        <h1 class="h1-title title-large">Документы</h1>
    </div>
    <div class="items-wrap">
        <!--item wrap-->
        <div class="item-wrap">
            <div class="item-tile-doc">
                <a href="" class="tile-link-wrap">
                                <span class="tile-photo">
                                    <img src="./img/icons/file-pdf.svg" alt="">
                                </span>
                    <span class="tile-title-wrap">
                                    <span class="tile-title">Нормативные базы за&nbsp;2022-2023</span>
                                    <span class="tile-info">7,45 mb.pdf</span>
                                </span>
                </a>
                <div class="tile-info-wrap">
                    <a href="" class="btn-action-icon">
                        <span class="button-title">Скачать</span>
                        <span class="button-ico">
                                        <img src="./img/icons/download.svg" alt="">
                                    </span>
                    </a>
                </div>
            </div>
        </div>
        <!--/item wrap-->
        <!--item wrap-->
        <div class="item-wrap">
            <div class="item-tile-doc">
                <a href="" class="tile-link-wrap">
                                <span class="tile-photo">
                                    <img src="./img/icons/file-pdf.svg" alt="">
                                </span>
                    <span class="tile-title-wrap">
                                    <span class="tile-title">Нормативные базы за&nbsp;2022-2023</span>
                                    <span class="tile-info">7,45 mb.pdf</span>
                                </span>
                </a>
                <div class="tile-info-wrap">
                    <a href="" class="btn-action-icon">
                        <span class="button-title">Скачать</span>
                        <span class="button-ico">
                                        <img src="./img/icons/download.svg" alt="">
                                    </span>
                    </a>
                </div>
            </div>
        </div>
        <!--/item wrap-->
        <!--item wrap-->
        <div class="item-wrap">
            <div class="item-tile-doc">
                <a href="" class="tile-link-wrap">
                                <span class="tile-photo">
                                    <img src="./img/icons/file-pdf.svg" alt="">
                                </span>
                    <span class="tile-title-wrap">
                                    <span class="tile-title">Нормативные базы за&nbsp;2022-2023</span>
                                    <span class="tile-info">7,45 mb.pdf</span>
                                </span>
                </a>
                <div class="tile-info-wrap">
                    <a href="" class="btn-action-icon">
                        <span class="button-title">Скачать</span>
                        <span class="button-ico">
                                        <img src="./img/icons/download.svg" alt="">
                                    </span>
                    </a>
                </div>
            </div>
        </div>
        <!--/item wrap-->
    </div>
</div>

<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "docs-list",
    Array(
        "ACTIVE_DATE_FORMAT" => "j F",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "BLOCK_TITLE" => "Конкурсы",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "N",
        "COMPONENT_TEMPLATE" => "docs-list",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(0=>"",1=>"",),
        "FILE_404" => "",
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "IBLOCK_ID" => "9",
        "IBLOCK_TYPE" => "subjects",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "999",
        "PAGER_BASE_LINK" => "",
        "PAGER_BASE_LINK_ENABLE" => "Y",
        "PAGER_DESC_NUMBERING" => "Y",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_PARAMS_NAME" => "arrPager",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_TITLE" => "",
        "PARENT_SECTION" => "sobytiya",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(0=>"SVG",1=>"",),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "NAME",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "DESC",
        "STRICT_SECTION_CHECK" => "N"
    )
);?>

<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "news-main-page",
    Array(
        "ACTIVE_DATE_FORMAT" => "f j, Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "N",
        "COMPONENT_TEMPLATE" => "news-main-page",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(0=>"",1=>"",),
        "FILE_404" => "",
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "IBLOCK_ID" => "2",
        "IBLOCK_TYPE" => "news",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "4",
        "PAGER_BASE_LINK" => "",
        "PAGER_BASE_LINK_ENABLE" => "Y",
        "PAGER_DESC_NUMBERING" => "Y",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_PARAMS_NAME" => "arrPager",
        "PAGER_SHOW_ALL" => "Y",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_TITLE" => "",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(0=>"URL",1=>"TARGET",),
        "SET_BROWSER_TITLE" => "Y",
        "SET_LAST_MODIFIED" => "Y",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "DESC"
    )
);?>

<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "links-main-page",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array("",""),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "26",
        "IBLOCK_TYPE" => "variety",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "N",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "5",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Новости",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array("TARGET","URL",""),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "SORT",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N"
    )
);?>

<?$APPLICATION->IncludeComponent(
    "bitrix:news.detail",
    "main_link",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_ELEMENT_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "BROWSER_TITLE" => "-",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "ELEMENT_CODE" => "",
        "ELEMENT_ID" => "256057",
        "FIELD_CODE" => array("PREVIEW_TEXT",""),
        "IBLOCK_ID" => "32",
        "IBLOCK_TYPE" => "variety",
        "IBLOCK_URL" => "",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "MESSAGE_404" => "",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Страница",
        "PROPERTY_CODE" => array("",""),
        "SET_BROWSER_TITLE" => "N",
        "SET_CANONICAL_URL" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "STRICT_SECTION_CHECK" => "N",
        "USE_PERMISSIONS" => "N",
        "USE_SHARE" => "N"
    )
);?>

<? $APPLICATION->IncludeComponent(
    "sp:main.feedback",
    "",
    array(
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "EMAIL_TO" => "",
        "EVENT_MESSAGE_ID" => array(
            0 => "33",
        ),
        "INFOBLOCKADD" => "Y",
        "INFOBLOCKID" => 31,
        "LINK" => "",
        "OK_TEXT" => "Спасибо, ваше сообщение принято.",
        "REQUIRED_FIELDS" => array(
            0 => "NONE",
        ),
        "USE_CAPTCHA" => "N",
        "COMPONENT_TEMPLATE" => "form_footer"
    ),
    false
); ?>

<?
//$yerer = 2007;
//libxml_use_internal_errors(true);
//if (file_exists("zad{$yerer}.xml")) {
//    $xmlstr = simplexml_load_file("zad{$yerer}.xml");
//} else {
//    exit("Не удалось открыть zad{$yerer}.xml");
//}
//
//
//if (false === $xmlstr) {
//    echo "<pre>";
//    $errors = libxml_get_errors();
//    echo 'Errors are '.var_export($errors, true);
//    echo "</pre>";
//    throw new \Exception('invalid XML');
//}
//
//
//foreach ($xmlstr->book as $new) {
//
//        $el = new CIBlockElement;
//
//        $PROP = array();
//
//        if((string)$new->years) {
//            $arSelect = Array("ID", "NAME");
//            $arFilter = Array("IBLOCK_ID" => 19, "=NAME" => $new->years);
//            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount" => 1), $arSelect);
//            while ($ob = $res->GetNextElement()) {
//                $arFields = $ob->GetFields();
//                if ($arFields['ID']) $PROP[112] = $arFields['ID'];
//            }
//        }
//
//        if((string)$new->areas) {
//            $arSelect = Array("ID", "NAME");
//            $arFilter = Array("IBLOCK_ID" => 17, "=NAME" => $new->areas);
//            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount" => 1), $arSelect);
//            while ($ob = $res->GetNextElement()) {
//                $arFields = $ob->GetFields();
//                if($arFields['ID']) $PROP[113] = $arFields['ID'];
//            }
//        }
//
//        if((string)$new->documents_type) {
//            $arSelect = Array("ID", "NAME");
//            $arFilter = Array("IBLOCK_ID" => 22, "=NAME" => $new->documents_type);
//            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount" => 1), $arSelect);
//            while ($ob = $res->GetNextElement()) {
//                $arFields = $ob->GetFields();
//                if($arFields['ID']) $PROP[117] = $arFields['ID'];
//            }
//        }
//
//    if((string)$new->subjects) {
//        $arSelect = Array("ID", "NAME");
//        $arFilter = Array("IBLOCK_ID" => 9, "=NAME" => $new->subjects);
//        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount" => 1), $arSelect);
//        while ($ob = $res->GetNextElement()) {
//            $arFields = $ob->GetFields();
//            if($arFields['ID']) $PROP[114] = $arFields['ID'];
//        }
//    }
//
//        $params = Array(
//            "max_len" => "200", // обрезает символьный код до 100 символов
//            "change_case" => "L", // буквы преобразуются к нижнему регистру
//            "replace_space" => "_", // меняем пробелы на нижнее подчеркивание
//            "replace_other" => "_", // меняем левые символы на нижнее подчеркивание
//            "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
//            "use_google" => "false", // отключаем использование google
//        );
//
//        $code = CUtil::translit($new->name . $new->id, "ru", $params);
//
//        $PROP[115] = $new->classes;
//
//        $PROP[116] = CFile::MakeFileArray($new->documents_linkx);
//        $PROP[116]['name'] = $code.".".(string)$new->documents_extension;
//
//
////        if (in_array($new->competitions_id, array(1))) $raz = [121, 124];
////        else if (in_array($new->competitions_id, array(3))) $raz = [121, 123];
////        else if (in_array($new->competitions_id, array(6))) $raz = [121, 122];
////        else $raz = 121;
//
//
//
////        if((string)$new->status == 1) $status = "Y";
////        else $status = "N";
//
//        $arLoadProductArray = Array(
//            "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
//            //"DATE_ACTIVE_FROM" => date('d.m.Y h:i:s', (string)$new->time),
//            "IBLOCK_SECTION" => 187,          // элемент лежит в корне раздела
//            "IBLOCK_ID" => 28,
//            "PROPERTY_VALUES" => $PROP,
//            "NAME" => $new->name,
//            "CODE" => $code,
//            "ACTIVE" => "Y",            // активен
//            //"PREVIEW_TEXT"   => $new->announcement,
//            //"DETAIL_TEXT"    => $new->page,
//            //"DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/image.gif")
//        );
//
//        if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
//           // echo "New ID: ".$PRODUCT_ID;
//        } else
//            echo "Error: " . $el->LAST_ERROR;
//}
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
