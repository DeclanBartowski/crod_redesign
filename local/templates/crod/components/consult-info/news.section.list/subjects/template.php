<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$page_num = $arResult['NAV_RESULT']->NavPageNome;
?>
<!--header class="mm_section-header">
    <div class="mm_tabs _767" id="_anchor">
        <ul class="mm_tabs-list" id="_tabs">
            <? foreach ($arResult["SECTIONS"] as $key => $sTabs) : ?>
                                                                        <li class="mm_tabs-list__item<?= $sTabs["CURRENT"] == "Y" ? " _active" : "" ?>">
                                                                            <a data-id="<?= $sTabs["ID"] ?>" data-code="<?= $sTabs["CODE"] ?>" href="javascript:void(0);" class="mm_tabs-list__link<?= $sTabs["CURRENT"] == "Y" ? " _active" : "" ?>"><?= $sTabs["NAME"] ?></a>
                                                                        </li>
            <? endforeach; ?>
        </ul>
        <div class="mm_tabs-select">
            <select id="_tabs-select">
                <? foreach ($arResult["SECTIONS"] as $key => $sTabs) : ?>
                                                                            <option value="<?= $sTabs["CODE"] ?>" <?= $sTabs["CURRENT"] == "Y" ? "selected" : "" ?>><?= $sTabs["NAME"] ?></option>
                <? endforeach; ?>
            </select>
        </div>
    </div>
</header-->
<div class="mm_section-body" id="wrp">
    <? if ($_REQUEST["AJAX"] == "Y") $APPLICATION->RestartBuffer(); ?>
    <div class="mm_subject_list">
        <? $arrNewTest = ["color-orange", "color-red", "color-green", "color-blue", "color-violet"]; /* временный массив */
        $indexFive = 0; /* счетчик */
        ?>
        <? foreach ($arResult["ITEMS"] as $key => $arItem) :
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $img_svg = CFile::GetPath($arItem['PROPERTIES']['SVG']['VALUE']);
            $arrNumber = $indexFive % 5; /* для массива цветов */
            $indexFive++; /* счетчик */
            ?>
            <div class="mm_subject_list-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="mm_news_list-item__link <?= $arrNewTest[$arrNumber] ?>">

                    <? if ($img_svg) { ?>
                        <span class="mm_subject_list-item__image <?= $arrNewTest[$arrNumber] ?> ">
                            <img src="<?= $img_svg ?>" alt="<?= $arItem["NAME"] ?>" title="<?= $arItem["NAME"] ?>">
                        </span>
                    <? } else if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])) { ?>
                        <span class="mm_subject_list-item__image">
                            <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>">
                        </span>
                    <? } ?>
                    <span class="mm_news_list-item__details">
                        <? if (!empty($arParams["EVENT_SECTION_CODE"]) && $arParams["EVENT_SECTION_CODE"] == $arResult["SECTION"]["PATH"][0]["CODE"]) : ?>
                            <span class="mm_news_list-item__label"><?= FormatDate("d F", MakeTimeStamp($arItem["ACTIVE_FROM"])); ?></span>
                            <span class="mm_value"><?= $arItem["NAME"] ?></span>
                        <? else : ?>
                            <span class="mm_value"><?= $arItem["NAME"] ?></span>
                            <span class="mm_news_list-item__date"><?= $arItem["DISPLAY_ACTIVE_FROM"]; ?></span>
                        <? endif; ?>
                    </span>
                </a>
            </div>
        <? endforeach; ?>
    </div>
    <? if ($arParams["PAGER_SHOW_ALL"] == "Y") : ?>
        <div class="mm_all-entries">
            <div class="mm_all-entries">
                <a href="<?= $arResult["SECTION"]["PATH"][0]["LIST_PAGE_URL"] ?>?sect=<?= $arResult["SECTION"]["PATH"][0]["CODE"] ?>">Все новости</a>
            </div>
        </div>
    <? endif; ?>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]) : ?>
        <?= $arResult["NAV_STRING"] ?>
    <? endif; ?>
    <script>
        var section_code = <?= CUtil::PhpToJSObject($arResult["SECTION"]["PATH"][0]["CODE"]) ?>;
        var page_num = "<?= $arResult['NAV_RESULT']->NavPageNomer ?>";
    </script>

</div>
