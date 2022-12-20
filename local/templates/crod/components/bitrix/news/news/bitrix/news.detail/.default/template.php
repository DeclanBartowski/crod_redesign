<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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
?>
<div class="new-box">
    <div class="title-outer-wrap">
        <div class="actions-inner-wrap">
            <div class="action-wrap">
                <a href="<?= $arResult["LIST_PAGE_URL"] ?>" class="btn button-back button-menu">
                                <span class="button-ico">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/arrow-back.svg" alt="">
                                </span>
                    <span class="button-title"><?= GetMessage('BACK_TO_LIST') ?></span>
                </a>
            </div>
            <div class="action-wrap">
                <div class="frm-select-wrap js-popup-wrap">
                    <a href="" class="btn-action-icon button-light btn-popup js-btn-toggle">
                                    <span class="button-ico">
                                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/share.svg" alt="">
                                    </span>
                        <span class="button-title">Поделиться</span>
                    </a>
                    <div class="popup-content-block js-popup-block">
                        <ul class="menu">
                            <li>
                                <a href="" class="btn-action-icon">
                                                <span class="button-ico btn button-border">
                                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/copy.svg" alt="">
                                                </span>
                                    <span class="button-title">Копировать ссылку</span>
                                </a>
                            </li>
                            <li>
                                <a href="" class="btn-action-icon">
                                                <span class="button-ico btn button-border">
                                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/ms-wa.svg" alt="">
                                                </span>
                                    <span class="button-title">WhatsApp</span>
                                </a>
                            </li>
                            <li>
                                <a href="" class="btn-action-icon">
                                                <span class="button-ico btn button-border">
                                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/ms-tg.svg" alt="">
                                                </span>
                                    <span class="button-title">Telegram</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="title-inner-wrap">
            <h1 class="h1-title"><?= $arResult['NAME'] ?></h1>
            <p><?= $arResult['PREVIEW_TEXT'] ?></p>
            <p class="text-light"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></p>
        </div>
    </div>


    <?= $arResult['DETAIL_TEXT'] ?>

    <!--gallery-slider-box-->
    <div class="gallery-slider-box">
        <div class="slider-wrap">
            <div class="slider">
                <!--sl-wrap-->
                <div class="sl-wrap">
                    <div class="elm-photo photo-cover">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/photo.jpg" alt="">
                    </div>
                    <div class="sl-title">Название фото</div>
                </div>
                <!--/sl-wrap-->
                <!--sl-wrap-->
                <div class="sl-wrap">
                    <div class="elm-photo photo-cover">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/photo.jpg" alt="">
                    </div>
                    <div class="sl-title">Название фото</div>
                </div>
                <!--/sl-wrap-->
                <!--sl-wrap-->
                <div class="sl-wrap">
                    <div class="elm-photo photo-cover">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/photo.jpg" alt="">
                    </div>
                    <div class="sl-title">Название фото</div>
                </div>
                <!--/sl-wrap-->
                <!--sl-wrap-->
                <div class="sl-wrap">
                    <div class="elm-photo photo-cover">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/photo.jpg" alt="">
                    </div>
                    <div class="sl-title">Название фото</div>
                </div>
                <!--/sl-wrap-->
                <!--sl-wrap-->
                <div class="sl-wrap">
                    <div class="elm-photo photo-cover">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/photo.jpg" alt="">
                    </div>
                    <div class="sl-title">Название фото</div>
                </div>
                <!--/sl-wrap-->
                <!--sl-wrap-->
                <div class="sl-wrap">
                    <div class="elm-photo photo-cover">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/photo.jpg" alt="">
                    </div>
                    <div class="sl-title">Название фото</div>
                </div>
                <!--/sl-wrap-->
            </div>
        </div>
    </div>
    <!--/gallery-slider-box-->

    <h2 class="h2-title">Заголовок</h2>
    <div class="text-columns-wrap">
        <div class="text-column">
            <ul>
                <li>Задача организации, в особенности же постоянный количественный рост и сфера нашей активности играет
                    важную роль в формировании позиций, занимаемых участниками в отношении поставленных задач. Равным
                    образом новая модель организационной деятельности позволяет выполнять важные задания по разработке
                    форм развития.
                </li>
                <li>С другой стороны консультация с широким активом позволяет выполнять важные задания по разработке
                    позиций, занимаемых участниками в отношении поставленных задач.
                </li>
                <li>Равным образом постоянный количественный рост и сфера нашей активности позволяет выполнять важные
                    задания по разработке направлений прогрессивного развития. Повседневная практика показывает, что
                    начало повседневной работы по формированию позиции в значительной степени обуславливает создание
                    новых предложений.
                </li>
            </ul>
        </div>
        <div class="text-column">
            <ol>
                <li>Задача организации, в особенности же постоянный количественный рост и сфера нашей активности играет
                    важную роль в формировании позиций, занимаемых участниками в отношении поставленных задач. Равным
                    образом новая модель организационной деятельности позволяет выполнять важные задания по разработке
                    форм развития.
                </li>
                <li>С другой стороны консультация с широким активом позволяет выполнять важные задания по разработке
                    позиций, занимаемых участниками в отношении поставленных задач.
                </li>
                <li>Равным образом постоянный количественный рост и сфера нашей активности позволяет выполнять важные
                    задания по разработке направлений прогрессивного развития. Повседневная практика показывает, что
                    начало повседневной работы по формированию позиции в значительной степени обуславливает создание
                    новых предложений.
                </li>
            </ol>
        </div>
    </div>

    <blockquote class="bq-text">
        <p>Задача организации, в особенности же постоянный количественный рост и сфера нашей активности играет важную
            роль в формировании позиций, занимаемых участниками в отношении поставленных задач. Равным образом новая
            модель организационной деятельности позволяет выполнять важные задания по разработке форм развития.</p>
        <p>С другой стороны консультация с широким активом позволяет выполнять важные задания по разработке позиций,
            занимаемых участниками в отношении поставленных задач. Равным образом постоянный количественный рост и сфера
            нашей активности позволяет выполнять важные задания по разработке направлений прогрессивного развития.
            Повседневная практика показывает, что начало повседневной работы по формированию позиции в значительной
            степени обуславливает создание новых предложений.</p>
    </blockquote>


    <div class="footer-outer-wrap">
        <div class="action-wrap">
            <a href="<?= $arResult["LIST_PAGE_URL"] ?>" class="btn button-border">
                            <span class="button-ico">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/arrow-back.svg" alt="">
                            </span>
                <span class="button-title"><?= GetMessage('BACK_TO_LIST') ?></span>
            </a>
        </div>
        <? if (!empty($arResult['AUTHOR'])): ?>
            <div class="info-wrap"><b><?= GetMessage('AUTHOR_TITLE') ?></b> <?= $arResult['AUTHOR'] ?></div>
        <? endif; ?>
    </div>

</div>
