<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<?if(!empty($arResult["ITEMS"])):?>
TEST
<header class="mm_section-header">
    <div class="mm_tabs _480">
        <ul id="_tabs" class="mm_tabs-list">
            <?foreach ($arResult["SECTIONS"] as $key => $sTabs):?>
                <li class="mm_tabs-list__item<?=$key == 0 ? " _active" : ""?>">
                    <a data-target="#_<?=$sTabs["CODE"]?>" href="javascript:void(0);" class="mm_tabs-list__link<?=$key == 0 ? " _active" : ""?>"><?=$sTabs["NAME"]?></a>
                </li>
            <?endforeach;?>
        </ul>
        <div class="mm_tabs-select">
            <select id="_tabs-select">
                <?foreach ($arResult["SECTIONS"] as $key => $sTabs):?>
                    <option value="#_<?=$sTabs["CODE"]?>" <?=$key == 0 ? "selected" : ""?>><?=$sTabs["NAME"]?></option>
                <?endforeach;?>
            </select>
        </div>
    </div>
</header>
<div class="mm_section-body">
    <div class="mm_tabs-container">
        <?foreach ($arResult["SECTIONS"] as $key => $sTabs):?>
            <div id="_<?=$sTabs["CODE"]?>" class="mm_tabs-pane<?=$key == 0 ? " _active" : ""?>">
                <?if(!empty($sTabs["ITEMS"])):?>
                    <div class="mm_docs_list _important">
                        <?foreach ($sTabs["ITEMS"] as $sItem):
                            $this->AddEditAction($sItem['ID'], $sItem['EDIT_LINK'], CIBlock::GetArrayByID($sItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($sItem['ID'], $sItem['DELETE_LINK'], CIBlock::GetArrayByID($sItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div class="mm_docs_list-item" id="<?=$this->GetEditAreaId($sItem['ID']);?>">
                               <div class="mm_docs_list-item">
                                   <a href="<?=$sItem["DETAIL_PAGE_URL"]?>" class="mm_docs_list-item__link"><?=$sItem["NAME"]?></a>
                                    <?if($arParams["DISPLAY_DATE"]!="N" && $sItem["DISPLAY_ACTIVE_FROM"]):?>
                                        <div class="mm_docs_list-item__date">
                                            <span class="mm_value"><?=$sItem["DISPLAY_ACTIVE_FROM"]?></span>
                                        </div>
                                   <?endif;?>
                                </div>
                            </div>
                        <?endforeach;?>
                    </div>
                <?else:?>
                    <p><?=GetMessage('NO_ITEMS')?></p>
                <?endif;?>
            </div>
        <?endforeach;?>
    </div>
</div>
<?endif;?>
