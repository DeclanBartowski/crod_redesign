<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

?>

<form class="filter-box">
    <h2 class="h2-title"><?= GetMessage('TITLE_BLOCK') ?></h2>
    <div class="frm-row row-3">
        <div class="frm-field">
            <select name="region" class="form-input form-select" data-reload
                    data-placeholder="<?= GetMessage('REGION_TITLE') ?>">
                <option selected disabled hidden value=""><?= GetMessage('REGION_TITLE') ?></option>
                <? foreach ($arResult["REGION"] as $region): ?>
                    <option <?if($arResult['REQUEST']['region'] == $region['ID']):?>selected<?endif;?> value="<?= $region['ID'] ?>"><?= $region['NAME'] ?></option>
                <? endforeach; ?>
            </select>
        </div>
        <div class="frm-field">
            <select name="YEAR" class="form-input form-select" data-reload
                    data-placeholder="<?= GetMessage('YEAR_TITLE') ?>">
                <option selected disabled hidden value=""><?= GetMessage('YEAR_TITLE') ?></option>
                <? foreach ($arResult["YEAR"]['MAIN'] as $year): ?>
                    <optgroup label="<?= $year['NAME'] ?>">
                        <? foreach ($arResult["YEAR"]['SUB'][$year['ID']] as $value): ?>
                            <option <?if($arResult['REQUEST']['YEAR'] == $value['ID']):?>selected<?endif;?> value="<?= $value['ID'] ?>"><?= $value['NAME'] ?></option>
                        <? endforeach; ?>
                    </optgroup>
                <? endforeach; ?>
            </select>
        </div>
        <div class="frm-field">
            <select name="SUBJECT" class="form-input form-select" data-reload
                    data-placeholder="<?= GetMessage('SUBJECT') ?>">
                <option selected disabled hidden value=""><?= GetMessage('SUBJECT') ?></option>
                <? foreach ($arResult["SUBJECT"] as $subject): ?>
                    <option <?if($arResult['REQUEST']['SUBJECT'] == $subject['ID']):?>selected<?endif;?> value="<?= $subject['ID'] ?>"><?= $subject['NAME'] ?></option>
                <? endforeach; ?>
            </select>
        </div>
    </div>
</form>

<div class="tab-box active" >

    <div class="table-box table-full table-center">
        <div class="table-inner-wrap">
            <div class="table-scroll-wrap">
                <table class="tbl-main tbl-main-inner tbl-fix">
                    <thead>

                    <tr>
                        <th>Удалить строку</th>
                        <th>Активность</th>
                        <th>Название</th>
                        <th>Файл</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?foreach ($arResult['ITEMS'] as $item):?>
                    <tr>
                        <td>
                            <a href="javascript:void(0)" class="btn button-second btn-action-ico ico-trash js-tooltip" title="Удалить строку"></a>
                        </td>
                        <td><?=$item['ACTIVE']?></td>
                        <td><?=$item['NAME']?></td>
                        <td><a href="<?=CFile::GetPath($item['PROPERTY_FILE_VALUE'])?>" download="">Скачать</a></td>

                    </tr>
                    <?endforeach;?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--actions-buttons-box-->
    <div class="actions-buttons-box">
        <div class="frm-row">
            <div class="frm-field field-full">
                <a href="/personal/documents/add_result/" class="btn button-second">
                    <span class="button-title">Добавить </span>
                </a>
            </div>
        </div>
        <div class="frm-row">
            <div class="frm-field field-full">
                <a href="javascript:void(0);" class="btn butotn-border-att">
                    <span class="button-title">Опубликовать на сайте</span>
                </a>
            </div>
        </div>
    </div>
    <!--/actions-buttons-box-->

</div>

<div class="news-box section-inner">



    <div class="page-actions-box" id="btn_017253f6576239832478cd3f783787fd">

        <div class="pages-wrap">
            <?=$arResult['PAGINATION']?>
        </div>

        <div class="more-wrap">
        </div>
    </div>
</div>
