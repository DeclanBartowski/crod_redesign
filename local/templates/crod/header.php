<?

use \Bitrix\Main\Page\Asset;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
$page = $APPLICATION->GetCurPage();
?>
    <!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
    <head>
        <title><? $APPLICATION->ShowTitle() ?></title>
        <?
        Asset::getInstance()->addString('<meta http-equiv="X-UA-Compatible" content="IE=edge">');
        Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');
        Asset::getInstance()->addString('<link rel="icon" href="' . SITE_TEMPLATE_PATH . '/favicon.svg">');
        Asset::getInstance()->addString('<script src="https://api-maps.yandex.ru/2.1/?apikey=3f591581-d039-451c-9188-c2b55c58bc0e&lang=ru_RU" type="text/javascript"></script>');
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/reset.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/swipebox.min.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/slick.css");
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/style.min.css");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/slick.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.swipebox.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.maskedinput.min.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/scripts.js");
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");
        ?>
        <? $APPLICATION->ShowHead(); ?>

    </head>
<? $APPLICATION->ShowPanel(); ?>
<body>
<div class="wrap <?if(NEED_AUTH === true):?> wrap-lk <?endif;?>">


    <?if(NEED_AUTH === true):?>
        <header class="header">
        <div class="inner-wrap">
            <div class="logo-wrap">
                <a href="/" class="logo">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/main/logo.svg" alt="">
                </a>
            </div>
            <div class="breadcrumbs-wrap">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "main",
                    [
                        "PATH" => "",
                        "SITE_ID" => "s1",
                        "START_FROM" => "0"
                    ]
                ); ?>
            </div>
        </div>
    </header>
    <div class="page-full">
    <?endif;?>


<?
if (ERROR_404 != 'Y' &&  NEED_AUTH !== true): ?>
    <header class="header">
        <div class="inner-wrap">
            <div class="logo-wrap">
                <a href="/" class="logo">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/main/logo.svg" alt="">
                </a>
            </div>
            <div class="actions-outer-wrap">
                <div class="actions-wrap">
                    <div class="action-wrap">
                        <a href="javascript:void(0);" class="btn button-second">
                                <span class="button-ico">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/view.svg" alt="">
                                </span>
                            <span class="button-title">Версия для слабовидящих</span>
                        </a>
                    </div>
                </div>
                <div class="actions-wrap">
                    <div class="action-wrap popup-search-wrap js-popup-wrap">
                        <a href="/search/" class="btn button-clear btn-popup js-btn-toggle">
                                <span class="button-ico">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/search.svg" alt="">
                                </span>
                            <span class="button-title">Поиск</span>
                        </a>
                        <div class="popup-content-block js-popup-block">
                            <a href="" class="btn-popup-close btn-action-ico ico-close js-btn-close"></a>
                            <form action="/search/" class="frm-field-search">
                                <input type="text" class="form-input" name="q" placeholder="Поиск">
                            </form>
                        </div>
                    </div>
                    <div class="action-wrap">
                        <a href="<?if($USER->IsAuthorized()):?>/personal/<?else:?>/login/<?endif;?>" class="btn button-clear">
                                <span class="button-ico">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/user.svg" alt="">
                                </span>
                            <span class="button-title">Личный кабинет</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-wrap popup-menu-wrap js-popup-wrap">
                <a href="" class="btn-popup btn-action-ico ico-menu js-btn-toggle"></a>
                <div class="popup-content-block js-popup-block">
                    <div class="menu-inner-wrap">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "top",
                                "USE_EXT" => "N"
                            )
                        ); ?>

                    </div>
                    <div class="actions-inner-wrap">
                        <div class="action-wrap">
                            <a href="<?if($USER->IsAuthorized()):?>/personal/<?else:?>/login/<?endif;?>" class="btn">
                                    <span class="button-ico">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/user.svg" alt="">
                                    </span>
                                <span class="button-title">Личный кабинет</span>
                            </a>
                        </div>
                        <div class="action-wrap">
                            <a href="javascript:void(0)" class="btn button-second">
                                    <span class="button-ico">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/view.svg" alt="">
                                    </span>
                                <span class="button-title">Версия для слабовидящих</span>
                            </a>
                        </div>
                    </div>
                    <div class="footer-inner-wrap">
                        <div class="footer-phones-wrap">
                            <?
                            $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/phone.php",
                                "EDIT_TEMPLATE" => ""
                            ], false, []);
                            ?>
                        </div>
                        <div class="footer-soc-wrap">
                            <?
                            $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/vk.php",
                                "EDIT_TEMPLATE" => ""
                            ], false, []);
                            ?>
                        </div>
                        <div class="footer-info-wrap">
                            <p>
                                <?
                                $APPLICATION->IncludeComponent("bitrix:main.include", "", [
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_TEMPLATE_PATH . "/include/politic.php",
                                    "EDIT_TEMPLATE" => ""
                                ], false, []);
                                ?>
                                <br>
                                <a href="/personal-agree/" class="link-main">Соглашение об обработке персональных данных</a>
                            </p>
                            <p><a href="/politika-konfidentsialnosti/">Политика конфиденциальности</a></p>
                            <p>
                                <a href="https://webmedia39.ru/" target="_blank" class="footer-studio">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/main/logo-studio.svg" alt="">
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="page-full">
    <? if ($APPLICATION->GetProperty('not_show_bread_h1') != 'Y' && $page != '/'): ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "main",
            [
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0"
            ]
        ); ?>
        <div class="title-box">
            <div class="title-wrap">
                <h1 class="h1-title"><?= $APPLICATION->ShowTitle(false) ?></h1>
            </div>
        </div>
    <? endif; ?>

    <? if ($APPLICATION->GetProperty('text_pages') == 'Y' && $page != '/'): ?>
    <div class="article-box">
<? endif; ?>
<? endif; ?>
