<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");
?>
    <div class="wrap wrap-error">
        <div class="page-full">

            <div class="error-box">
                <div class="box-inner-wrap">
                    <div class="title-inner-wrap">
                        <div class="h1-title title-large">Ошибка</div>
                        <p>Извините, такой страницы нет</p>
                    </div>
                    <div class="photo-inner-wrap">
                        <div class="elm-photo">
                            <img src="<?=SITE_TEMPLATE_PATH?>/img/error.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="action-inner-wrap">
                    <a href="/" class="btn button-border-att">
                        <span class="button-title">Перейти на главную</span>
                        <span class="button-ico ico-large">
                            <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/arrow-button-att.svg" alt="">
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
