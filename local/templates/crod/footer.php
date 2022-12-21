<?

/**
 * @global $APPLICATION
 */
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<?if(NEED_AUTH === true):?></div><?endif;?>


<? if (ERROR_404 != 'Y' &&  NEED_AUTH !== true): ?>

<? if ($APPLICATION->GetProperty('text_pages') == 'Y'): ?>
    </div>
    <? endif; ?>
</div>
<footer class="footer">
    <div class="inner-wrap">
        <div class="logo-wrap">
            <a href="" class="logo">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/main/logo.svg" alt="">
            </a>
        </div>
        <div class="footer-menu-wrap">
            <div class="menu-inner-wrap">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer",
                    Array(
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
                );?>
            </div>
            <div class="actions-inner-wrap">
                <div class="action-wrap">
                    <a href="javascript:void(0)" class="btn button-clear">
                                <span class="button-ico">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/view.svg" alt="">
                                </span>
                        <span class="button-title">Версия для слабовидящих</span>
                    </a>
                </div>
                <div class="action-wrap">
                    <a href="<?if($USER->IsAuthorized()):?>/personal/<?else:?>/login/<?endif;?>" class="btn button-border">
                                <span class="button-ico">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/user.svg" alt="">
                                </span>
                        <span class="button-title">Вход в личный кабинет</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-contacts-wrap">
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
        </div>
        <div class="footer-info-wrap">
            <div class="footer-info">
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
            </div>
            <div class="footer-info">
                <p><a href="/politika-konfidentsialnosti/">Политика конфиденциальности</a></p>
            </div>
            <div class="footer-info">
                <p>
                    <a href="https://webmedia39.ru/" target="_blank" class="footer-studio">
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/main/logo-studio.svg" alt="">
                    </a>
                </p>
            </div>
        </div>
    </div>
</footer>
<div class="popup-outer-box" id="popup-message01">
    <div class="popup-box">
        <a href="" class="btn-action-ico ico-close js-popup-close"></a>
        <div class="popup-content-wrap">
            <div class="elm-ico">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/succefull.svg" alt="">
            </div>
            <div class="popup-title">Публикация прошла успешно</div>
        </div>
    </div>
</div>
<div class="popup-outer-box" id="popup-message02">
    <div class="popup-box">
        <a href="" class="btn-action-ico ico-close js-popup-close"></a>
        <div class="popup-content-wrap">
            <div class="elm-ico">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/succefull.svg" alt="">
            </div>
            <div class="popup-title">Таблица сохранена</div>
        </div>
    </div>
</div>
</div>

<div style="display: none" id="ajaxHtml">
</div>
<? endif; ?>
</body>
</html>
