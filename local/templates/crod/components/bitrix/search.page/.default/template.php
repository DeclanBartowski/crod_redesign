<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Grid\Declension;

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
if (count($arResult["SEARCH"]) > 0) {

    $APPLICATION->SetTitle(GetMessage('TITLE_RESULT', ['#QUERY#' => $arResult["REQUEST"]["QUERY"]]));
}

$tabs = [
    'news' => GetMessage('SEARCH_TITLE_NEWS'),
    'subjects' => GetMessage('SEARCH_TITLE_ITEMS'),
    'documents' => GetMessage('SEARCH_TITLE_BASE'),
];


?>
<div class="search-box">
    <div class="box-inner-wrap">

        <form class="frm-main-search">
            <input type="text" class="form-input" placeholder="Поиск" name="q"
                   value="<?= $arResult["REQUEST"]["QUERY"] ?>">
            <button type="reset" class="btn-action-ico ico-clear btn button-second"></button>
        </form>

        <? if (count($arResult["SEARCH"]) < 1 && !empty($arResult["REQUEST"]["QUERY"])): ?>
            <div class="info-inner-wrap">
                <div class="h2-title"><?= GetMessage('SEARCH_RESULT_ZERO') ?></div>
                <div class="h3-title"><?= GetMessage('SEARCH_RESULT_ZERO_TEXT') ?>
                </div>
                <div class="action-wrap">
                    <a href="/" class="btn button-border-att">
                        <span class="button-title"><?= GetMessage('SEARCH_GO_TO_HOME') ?></span>
                        <span class="button-ico ico-large">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/arrow-button-att.svg" alt="">
                                </span>
                    </a>
                </div>
            </div>
        <? endif; ?>

        <? if (count($arResult["SEARCH"]) > 0): ?>
            <div class="info-inner-wrap">
                <div class="h2-title">
                    <?
                    $resultString = new Declension(GetMessage('RESULTS_COUNT_1'), GetMessage('RESULTS_COUNT_2'),
                        GetMessage('RESULTS_COUNT_10'));
                    echo GetMessage('TEXT_RESULT', [
                        '#COUNT#' => count($arResult["SEARCH"]),
                        '#TEXT#' => $resultString->get(count($arResult["SEARCH"])),
                    ])
                    ?>
                </div>
            </div>
        <? endif; ?>
    </div>

</div>

<? if (count($arResult["SEARCH"]) > 0): ?>


    <div class="tabs-box js-tabs-nav">
        <ul class="menu">
            <?
            $active = false;
            foreach ($tabs as $keyTab => $tab):?>
                <?
                if (empty($arResult['ITEMS'][$keyTab])) {
                    continue;
                }
                ?>
                <li><a href="" <? if (!$active): ?>class="active"<?endif;
                    ?> data-tab="<?= $keyTab ?>"><?= $tab ?></a></li>
                <?
                $active = true;
            endforeach; ?>
        </ul>
    </div>
    <?
    foreach ($tabs as $keyTab => $tab):?>
        <?
        if (empty($arResult['ITEMS'][$keyTab])) {
            continue;
        }
        ?>
        <div class="news-box section-inner tab-box js-tab-block" data-tab="<?= $keyTab ?>">
            <div class="items-wrap">

                <? foreach ($arResult['ITEMS'][$keyTab] as $item): ?>

                    <?
                    switch ($keyTab) {
                        case 'news':
                            ?>
                            <div class="item-wrap">
                                <a href="<?= $item['URL_WO_PARAMS'] ?>" class="item-tile-new">
                            <span class="tile-head-wrap">
                                <span class="tile-ico color-blue">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/calendar.svg" alt="">
                                </span>
                                <span class="tile-date"><?= $item['FORMAT_DATE'] ?></span>
                            </span>
                                    <span class="tile-title-wrap">
                                <span class="tile-title h3-title"><?= $item['TITLE'] ?></span>
                            </span>
                                    <span class="tile-action-wrap">
                                <span class="btn-action-icon">
                                    <span class="button-title"><?= GetMessage('SEARCH_TITLE_MORE') ?></span>
                                    <span class="button-ico ico-large">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/arrow-button.svg" alt="">
                                    </span>
                                </span>
                            </span>
                                </a>
                            </div>
                            <?
                            break;
                        case 'subjects':

                            ?>
                            <div class="item-wrap">
                                <a href="<?= $item['URL_WO_PARAMS'] ?>" class="item-tile-object tile-border">
                                    <? if (!empty($item['SVG'])): ?>
                                        <span class="tile-photo-wrap"><span class="tile-photo photo-contain"><img
                                                        src="<?= $item['SVG'] ?>"
                                                        alt="<?= $item['TITLE'] ?>"></span></span>
                                    <? endif; ?>
                                    <span class="tile-title h3-title"><?= $item['TITLE'] ?></span>
                                </a>
                            </div>
                            <?
                            break;
                        case 'documents':
                            ?>
                            <div class="item-wrap">
                                <div class="item-tile-doc">
                                    <a download="" href="<?= $item['FILE']['SRC'] ?>" class="tile-link-wrap">
                                <span class="tile-photo">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/file-pdf.svg" alt="">
                                </span>
                                        <span class="tile-title-wrap">
                                    <span class="tile-title title-small"><?= $item['TITLE'] ?></span>
                                    <span class="tile-info"><?= $item['FILE']['FORMAT_SIZE'] ?>.<?= $item['FILE']['FORMAT'] ?></span>
                                </span>
                                    </a>
                                    <div class="tile-info-wrap info-clear">
                                        <a download="" href="<?= $item['FILE']['SRC'] ?>" class="btn-action-icon">
                                            <span class="button-title"><?= GetMessage('DOWNLOAD_BTN') ?></span>
                                            <span class="button-ico">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/download.svg" alt="">
                                    </span>
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <?
                            break;
                    }
                    ?>


                <? endforeach; ?>
            </div>
        </div>
    <? endforeach; ?>
<? endif; ?>
