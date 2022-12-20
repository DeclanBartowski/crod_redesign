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
$rs_Section = CIBlockSection::GetList(array('name' => 'desc'), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], "SECTION_ID" => $arResult['VARIABLES']['SECTION_ID'], "DEPTH_LEVEL" => '2'));

$res = CIBlockSection::GetByID($arResult['VARIABLES']['SECTION_ID']);
if($ar_res = $res->GetNext()){
    $APPLICATION->AddChainItem(($ar_res['NAME']-1)."-".$ar_res['NAME'], $arParams['SEF_FOLDER'].$arResult['VARIABLES']['SECTION_ID']."/");
    $APPLICATION->SetTitle("Нормативная база за ".($ar_res['NAME']-1)."-".$ar_res['NAME']." год");
}else{
    fun404();
}

$inFirst = 0;
?>
<div class="link-list__wrapper">
    <ul class="link-list">
        <?while($ar_Section = $rs_Section->Fetch()) {
            $subject = $ar_Section['NAME'];
            $pattern = '/муниципальн/';
            preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE, 3);
           if(count($matches)>0){?>
                <li class="link-list__item">
                    <p class="link-list__header"><?= $ar_Section['NAME']?></p>
                    <ul class="link-list link-list-scroll">
                        <?
                        $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
                        $arFilter = Array("IBLOCK_ID"=>17, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>99), $arSelect);
                        while($ob = $res->GetNextElement())
                        {
                            $arFields = $ob->GetFields();?>
                            <li class="link-list__item">
                                <a href="<?= $arParams['SEF_FOLDER'] . $arResult['VARIABLES']['SECTION_ID'] . "/" . $ar_Section['ID'] ?>/?reg=<?=$arFields['ID'];?>"  class="link-list__link"><?=$arFields['NAME']?></a>
                            </li>
                        <?} ?>
                    </ul>
                </li>
            <?}else { ?>
                <li class="link-list__item">
                    <a href="<?= $arParams['SEF_FOLDER'] . $arResult['VARIABLES']['SECTION_ID'] . "/" . $ar_Section['ID'] ?>/"
                       class="link-list__link"><?=$ar_Section['NAME'] ?></a>
                </li>
                <?
            }
            $inFirst++;
        }
        if($inFirst == 0){
            fun404();
        }
        ?>
    </ul>
</div>

