<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetTitle('Вход на сайт');
?>
<div class="login-form-box">
    <div class="form-inner-wrap">
        <div class="frm-title h1-title"><?=GetMessage('AUTH_TITLE')?></div>
        <form  class="form-wrap" name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="AUTH" />
            <?if (strlen($arResult["BACKURL"]) > 0):?>
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?endif?>
            <?foreach ($arResult["POST"] as $key => $value):?>
                <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
            <?endforeach?>
            <div class="frm-row">
                <div class="frm-field">
                    <div class="frm-field-input js-input">
                        <label class="field-title"><?=GetMessage('AUTH_LOGIN')?></label>
                        <input name="USER_LOGIN" type="text" class="form-input" value="<?=$arResult["LAST_LOGIN"]?>">
                    </div>
                </div>
            </div>
            <div class="frm-row">
                <div class="frm-field">
                    <div class="frm-field-input js-input frm-field-password inp-valid">
                        <label class="field-title"><?=GetMessage('AUTH_PASSWORD')?></label>
                        <input type="password" class="form-input" value="" name="USER_PASSWORD" autocomplete="off">
                        <a href="" class="btn-action-ico ico-view-toggle field-button-password js-password-toggle"></a>
                    </div>
                    <div class="frm-select">
                        <input type="checkbox" id="select" name="USER_REMEMBER" value="Y">
                        <label for="select"><?=GetMessage('AUTH_REMEMBER_ME')?></label>
                    </div>
                </div>
            </div>
            <div class="frm-row-submit">
                <div class="frm-field">
                    <?
                    ShowMessage($arParams["~AUTH_RESULT"]);
                    ShowMessage($arResult['ERROR_MESSAGE']);
                    ?>
                    <button type="submit" name="Login" class="btn"><?=GetMessage('AUTH_AUTHORIZE')?></button>
                </div>
            </div>
        </form>
    </div>
    <div class="photo-inner-wrap">
        <div class="elm-photo">
            <img src="<?=SITE_TEMPLATE_PATH?>/img/auth-pic.svg" alt="">
        </div>
    </div>
</div>



