<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>

<? if (!empty($arResult)): ?>
    <div class="tabs-buttons-box js-tabs-nav">
        <ul class="menu">

            <?
            foreach ($arResult as $arItem):
                if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) {
                    continue;
                }
                ?>
                <li>
                    <a href="<?= $arItem["LINK"] ?>" class="btn-tab <?if($arItem['SELECTED']):?>active<?endif;?>">
                        <? if (!empty($arItem['PARAMS']['svg'])):?>
                            <span class="button-ico">
                                <img src="<?= $arItem['PARAMS']['svg'] ?>" alt="">
                            </span>
                        <? endif; ?>
                        <span class="butotn-title"><?= $arItem["TEXT"] ?></span>
                    </a>
                </li>

            <? endforeach ?>

        </ul>
    </div>
<? endif ?>
