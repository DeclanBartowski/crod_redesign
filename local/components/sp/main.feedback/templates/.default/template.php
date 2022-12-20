<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<? if (!empty($arResult["ERROR_MESSAGE"])) {
    foreach ($arResult["ERROR_MESSAGE"] as $v) {
        ShowError($v);
    }
}

?>
<div class="form-box <? if (strlen($arResult["OK_MESSAGE"]) > 0): ?>submit-active<? endif; ?>" id="form">
    <div class="box-inner-wrap">
        <form action="<?= POST_FORM_ACTION_URI ?>" method="POST" class="form-inner-wrap">
            <?= bitrix_sessid_post() ?>
            <div class="form-wrap">
                <h2 class="h1-title title-large"><?= GetMessage('TITLE_FORM') ?></h2>
                <div class="frm-row">
                    <div class="frm-field">
                        <input type="text" class="form-input inp-second" placeholder="<?= GetMessage('MFT_NAME') ?>"
                               name="NAME" required>
                    </div>
                    <div class="frm-field">
                        <input type="tel" class="form-input inp-second" placeholder="<?= GetMessage('MFT_PHONE') ?>"
                               name="PHONE" required>
                    </div>
                </div>
                <div class="frm-row-submit">
                    <div class="frm-field field-info"><?= GetMessage('RULES_FORM', ['#LINK#' => '/personal-agree/']) ?>
                    </div>
                    <div class="frm-field field-submit">
                        <button type="submit" name="submit" value="<?= GetMessage("MFT_SUBMIT") ?>"
                                class="btn button-border"><?= GetMessage('MFT_SUBMIT') ?>
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-message-wrap">
                <div class="elm-ico">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/succefull.svg" alt="">
                </div>
                <div class="h1-title title-large"><?= GetMessage('MFT_SUCCESS_TITLE') ?></div>
                <div class="h3-title"><?= GetMessage('MFT_SUCCESS_TEXT') ?></div>
            </div>
            <? if ($arParams["USE_CAPTCHA"] == "Y"): ?>
                <div class="mf-captcha">
                    <div class="mf-text"><?= GetMessage("MFT_CAPTCHA") ?></div>
                    <input type="hidden" name="captcha_sid" value="<?= $arResult["capCode"] ?>">
                    <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["capCode"] ?>" width="180"
                         height="40" alt="CAPTCHA">
                    <div class="mf-text"><?= GetMessage("MFT_CAPTCHA_CODE") ?><span class="mf-req">*</span></div>
                    <input type="text" name="captcha_word" size="30" maxlength="50" value="">
                </div>
            <? endif; ?>
            <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
        </form>
        <div class="photo-inner-wrap">
            <div class="elm-photo">
                <img src="<?= SITE_TEMPLATE_PATH ?>/img/form-pic.svg" alt="">
            </div>
        </div>
    </div>
</div>
