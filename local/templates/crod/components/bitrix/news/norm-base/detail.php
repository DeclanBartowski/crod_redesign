<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "N");

$res_step = CIBlockSection::GetByID($arResult['VARIABLES']['ELEMENT_CODE']);
if($ar_st = $res_step->GetNext()){
    $bread = $ar_st['NAME'];
}else{
    fun404();
}

$res = CIBlockSection::GetByID($arResult['VARIABLES']['SECTION_ID']);
if($ar_res = $res->GetNext()){
    $APPLICATION->AddChainItem(($ar_res['NAME']-1)."-".$ar_res['NAME'], $arParams['SEF_FOLDER'].$arResult['VARIABLES']['SECTION_ID']."/");
    $bread .= " за ".($ar_res['NAME']-1)."-".$ar_res['NAME']." год";
}else{
    fun404();
}

if($_REQUEST['reg']){
    $reg = CIBlockElement::GetByID($_REQUEST["reg"]);
    if($ar_res = $reg->GetNext())
        $bread .= " - ".$ar_res['NAME'];
    else fun404();
}
$inFirst = 0;
$APPLICATION->AddChainItem($bread);
$APPLICATION->SetTitle($bread);
?>

<div class="norm-baze__wrapper" id="wrp">
    <?
    if ($_REQUEST["AJAX"] == "Y") $APPLICATION->RestartBuffer();
    if($_REQUEST['NEWS_COUNT']) $num_page = $_REQUEST['NEWS_COUNT'];
    else $num_page = 20;
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DATE_ACTIVE_FROM","PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array(
            "IBLOCK_ID"=>$arParams['IBLOCK_ID'],
            "SECTION_ID" => $arResult['VARIABLES']['ELEMENT_CODE'],
            "PROPERTY_REG" => $_REQUEST['reg'],
            "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>$num_page), $arSelect);
    $NAV_STRING = $res->GetPageNavStringEx($navComponentObject, 'Заголовок', 'mm_pagination_new', 'Y');
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
        $file = CFile::GetFileArray($arProps['FILE']['VALUE']);
        $FILE_SIZE = CFile::FormatSize(
            $file['FILE_SIZE'],
            $precision = 1
        );
        $basename = pathinfo($file['FILE_NAME']);

        switch (mb_strtolower($basename['extension'])){
            case "doc" : $class_doc = "_doc"; break;
            case "DOC" : $class_doc = "_doc"; break;
            case "docx" : $class_doc = "_doc"; break;
            case "DOCX" : $class_doc = "_doc"; break;
            case "pdf" : $class_doc = "_pdf"; break;
            case "PDF" : $class_doc = "_pdf"; break;
            case "rar" : $class_doc = "_zip"; break;
            case "RAR" : $class_doc = "_zip"; break;
            case "zip" : $class_doc = "_zip"; break;
            case "ZIP" : $class_doc = "_zip"; break;
            case "xls" : $class_doc = "_xls"; break;
            case "XLS" : $class_doc = "_xls"; break;
            case "xlsx" : $class_doc = "_xls"; break;
            case "XLSX" : $class_doc = "_xls"; break;
            default :  $class_doc = "_doc";
        }

        $res_doc = CIBlockElement::GetByID($arProps['TYPE_DOC']['VALUE']);

        ?>

            <a href="<?=$file['SRC']?>" class="mm_doc-link <?=$class_doc;?>" title="(<?=mb_strtolower($basename['extension']);?>, <?=$FILE_SIZE?>)">
                <p class="mm_doc-info">
                    <span class="value"><?=!empty($arFields['PREVIEW_TEXT'])?$arFields['PREVIEW_TEXT']:$arFields['NAME'];?></span>

                    <?
                    if($ar_res_doc = $res_doc->GetNext())
                        echo " <span class='info-type'>{$ar_res_doc['NAME']}</span>";
                    ?>
                    <span class="mm_doc-type-size"><?=mb_strtolower($basename['extension']);?>, <?=$FILE_SIZE?></span>
                </p>
            </a>
    <?
        $inFirst++;
    }
    if($inFirst == 0){
        echo "<h3>В данном разделе ничего нет</h3>";
    }
    ?>
    <?=$NAV_STRING;?>
    <script>var page_num = "<?=$res->NavPageNomer?>";</script>

</div>


<script>
    var page = "<?=$APPLICATION->GetCurPage(false); ?>";
    var news_count = <?=$num_page?>;
    var news_count_option = <?=$num_page?>;
    var dir_section = page;
</script>

<script>
    function mm_createElement(t) {
        return;
    }

    $(document).ready(function() {

        $(document).on('change', '#_select', function (e) {
            var select_val = $(this).val();
            ajax_section(news_count,select_val);
        });

        $(document).on('click', '#mm_button_add', function (e) {
            news_count = news_count + news_count_option;
            ajax_section(news_count,page_num);
        });

        function ajax_section(news_count,page_num) {
            $.ajax({
                url: page,
                method: "post",
                data: {
                    AJAX: "Y",
                    NEWS_COUNT: news_count,
                    PAGEN_1: page_num,
                    reg: "<?if($_REQUEST['reg']) echo $_REQUEST['reg'];?>"
                    },
                    beforeSend: function () {
                        $('#wrp').fadeOut(200);
                    },
                    error: function () {
                        alert("Ошибка запроса");
                    },
                    success: function (result) {
                        $('#wrp').html(result).fadeIn(200);
                        $(".mm_select select").styler();
                        window.history.pushState(null, null, dir_section + "?PAGEN_1=" + page_num + "<?if($_REQUEST['reg']) echo "&reg=".$_REQUEST['reg'];?>");
                    }
                })
            }
        });
    </script>
    </div>
    <?if ($_REQUEST["AJAX"] == "Y") die;?>
