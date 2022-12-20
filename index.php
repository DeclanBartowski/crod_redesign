<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("show_title", "false");
$APPLICATION->SetPageProperty("title", "Школьные олимпиады калиниградской области");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Главная страница");

?><div class="container">
	<div class="row">
		<div class="col-12">
			<div class="row">
				<div class="col-lg-6 section-margin">
					 <?$sec_id_slider = Array(
                    // "SECTION_ID" => 663,
                );?> <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"slider",
	Array(
		"ACTIVE_DATE_FORMAT" => "",
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
		"COMPONENT_TEMPLATE" => "slider",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILE_404" => "",
		"FILTER_NAME" => "sec_id_slider",
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"IBLOCK_ID" => "12",
		"IBLOCK_TYPE" => "variety",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "9",
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
		"PROPERTY_CODE" => array(0=>"TARGET",1=>"URL",2=>"",),
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
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
				</div>
				<div class="col-lg-6">
					<div class="list_img_alies_ok list1_img_alies_ok">
						<div class="alies_ok">
							 <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/link_alies_ok/list1_img_alies1.php", Array(), Array("MODE" => "html", "SHOW_BORDER" => true));?>
						</div>
						<div class="alies_ok">
							 <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/link_alies_ok/list1_img_alies2.php", Array(), Array("MODE" => "html", "SHOW_BORDER" => true));?>
						</div>
					</div>
				</div>
			</div>
			<div class="mm_section">
				<div class="mm_section_body">
					<div class="mm-columns">
						<div class="mm_section-header">
							<h2 class="mm_section-heading">Предметы</h2>
						</div>
						<div class="pred_list">
							 <?$arEventsSIDA1 = Array(
                            // "SECTION_ID" => Array(9),
                        );?> <?$APPLICATION->IncludeComponent(
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
		"FILTER_NAME" => "arEventsSIDA1",
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
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
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
						</div>
					</div>
				</div>
			</div>
			<div class="mm_section">
				<div class="mm_section-body">
					<div class="mm_columns">
						<div class="mm_columns-item _left">
							 <?$APPLICATION->IncludeComponent(
	"consult-info:news.section.list",
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
		"NEWS_COUNT" => "6",
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
		"PROPERTY_CODE" => array(0=>"",1=>"",),
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
						</div>
						<div class="mm_columns-item _right">
							 <!--div class="mm_section-header">
								<h2 class="mm_section-heading"><?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/docs_section_heading.php", Array(), Array("MODE" => "html", "SHOW_BORDER" => true));?></h2>
							</div-->
							<div class="mm_section-body mm_section-body-index">
								<div class="mm_section-header">
									<h3 class="mm_section-body-index_title">Полезные ссылки</h3>
								</div>
								<div class="mm_baner_list mm_baner_list--info">
									 <?
                                    $arSelect12 = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");
                                    $arFilter12 = Array("IBLOCK_ID"=>26, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                                    $res12 = CIBlockElement::GetList(Array(), $arFilter12, false, Array("nPageSize"=>5), $arSelect12);
                                    while($ob12 = $res12->GetNextElement()){
                                        $arFields12 = $ob12->GetFields();
                                        $arProps12 = $ob12->GetProperties();
                                        $url = parse_url($arProps12['URL']['VALUE']);
                                        ?>
									<div class="mm_baner_list-item">
 <a href="<?=$arProps12['URL']['VALUE'];?>" class="mm_baner-item__inside" target="<span id=" title=" Код PHP: &lt;?=$arProps12['TARGET']['VALUE'];?&gt;"><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><br>
 </span><br>
										 <?=$arFields12['NAME'];?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><br>
										</span><br>
										<p class="name_link">
											 <?=$arFields12['NAME'];?>
										</p>
										<p class="title_link">
 <span class="value"><?=$url['host'];?></span><span class="i _player-blue"></span>
										</p>
 </a>
									</div>
									 <?}?>
								</div>
								<div class="mm_all-entries">
 <a href="/links/">Все ссылки</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?
/*
if (file_exists('news.xml')) {
    $xmlstr = simplexml_load_file('news.xml');
} else {
    exit('Не удалось открыть news.xml.');
}

//echo "<pre>";
//print_r($xmlstr->book);
//echo  "</pre>";

foreach ($xmlstr->book as $new) {
    $el = new CIBlockElement;

//    $PROP = array();
//    $PROP[12] = "Белый";  // свойству с кодом 12 присваиваем значение "Белый"
//    $PROP[3] = 38;        // свойству с кодом 3 присваиваем значение 38


    $params = Array(
        "max_len" => "200", // обрезает символьный код до 100 символов
        "change_case" => "L", // буквы преобразуются к нижнему регистру
        "replace_space" => "_", // меняем пробелы на нижнее подчеркивание
        "replace_other" => "_", // меняем левые символы на нижнее подчеркивание
        "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
        "use_google" => "false", // отключаем использование google
    );

    if((string)$new->status == 1) $status = "Y";
    else $status = "N";

    $arLoadProductArray = Array(
        "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
        "DATE_ACTIVE_FROM" => date('d.m.Y h:i:s', (string)$new->time),
        "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
        "IBLOCK_ID"      => 2,
        //"PROPERTY_VALUES"=> $PROP,
        "NAME"           => $new->title,
        "CODE"           => CUtil::translit($new->id."_".$new->title, "ru" , $params),
        "ACTIVE"         => $status,            // активен
        "PREVIEW_TEXT"   => $new->announcement,
        "DETAIL_TEXT"    => $new->page,
        //"DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/image.gif")
    );

    if($PRODUCT_ID = $el->Add($arLoadProductArray))
        echo "New ID: ".$PRODUCT_ID;
    else
        echo "Error: ".$el->LAST_ERROR;
}
*/
?>
<?
/*
if (file_exists('result2019.xml')) {
    $xmlstr = simplexml_load_file('result2019.xml');
} else {
    exit('Не удалось открыть result2019.xml.');
}

//echo "<pre>";
//print_r($xmlstr->book);
//echo  "</pre>";

foreach ($xmlstr->book as $new) {

        $el = new CIBlockElement;

        $PROP = array();

        $arSelect = Array("ID", "NAME");
        $arFilter = Array("IBLOCK_ID" => 19, "NAME" => $new->years);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 1), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $PROP[86] = $arFields['ID'];
        }

        $arSelect = Array("ID", "NAME");
        $arFilter = Array("IBLOCK_ID" => 17, "NAME" => $new->areas);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 1), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $PROP[87] = $arFields['ID'];
        }

        $arSelect = Array("ID", "NAME");
        $arFilter = Array("IBLOCK_ID" => 9, "NAME" => $new->subjects);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 1), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $PROP[88] = $arFields['ID'];
        }

        $PROP[89] = $new->classes;
        $PROP[90] = $new->name_teach;
        $PROP[91] = $new->marks;
        $PROP[92] = $new->rank;
        $PROP[93] = $new->school;

        if (in_array($new->competitions_id, array(1, 2))) $raz = [116, 120];
        else if (in_array($new->competitions_id, array(3, 4, 5))) $raz = [116, 119];
        else if (in_array($new->competitions_id, array(6, 8))) $raz = [116, 118, 117];
        else $raz = 116;

        $params = Array(
            "max_len" => "200", // обрезает символьный код до 100 символов
            "change_case" => "L", // буквы преобразуются к нижнему регистру
            "replace_space" => "_", // меняем пробелы на нижнее подчеркивание
            "replace_other" => "_", // меняем левые символы на нижнее подчеркивание
            "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
            "use_google" => "false", // отключаем использование google
        );

//        if((string)$new->status == 1) $status = "Y";
//        else $status = "N";

        $arLoadProductArray = Array(
            "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
            //"DATE_ACTIVE_FROM" => date('d.m.Y h:i:s', (string)$new->time),
            "IBLOCK_SECTION" => $raz,          // элемент лежит в корне раздела
            "IBLOCK_ID" => 24,
            "PROPERTY_VALUES" => $PROP,
            "NAME" => $new->name,
            "CODE" => CUtil::translit($new->name . $new->id, "ru", $params),
            "ACTIVE" => "Y",            // активен
            //"PREVIEW_TEXT"   => $new->announcement,
            //"DETAIL_TEXT"    => $new->page,
            //"DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/image.gif")
        );

        if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
            //echo "New ID: ".$PRODUCT_ID;
        } else
            echo "Error: " . $el->LAST_ERROR;
}*/
?>
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