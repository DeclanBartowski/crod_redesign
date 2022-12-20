<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$rows = array();
$groups = array();
$arResult["SECTIONS"] = array();

$result = Bitrix\Iblock\SectionElementTable::getList(array(
    'order' => array('SORT' => 'ASC'),
    'filter' => array('IBLOCK_SECTION.IBLOCK_ID' => $arParams["IBLOCK_ID"] ,'IBLOCK_SECTION.ACTIVE' => "Y"),
    'select' => array('NAME' => 'IBLOCK_SECTION.NAME', 'CODE' => 'IBLOCK_SECTION.CODE', 'ELEMENT_ID' => 'IBLOCK_ELEMENT_ID', 'SECTION_ID' => 'IBLOCK_SECTION.ID' , 'SORT' => 'IBLOCK_SECTION.SORT')
));
while ($row = $result->fetch())
{
    $groups[$row["ELEMENT_ID"]][] = $row["SECTION_ID"];
    $arResult["SECTIONS"][$row["SECTION_ID"]] = $row;
}

foreach($arResult["ITEMS"] as $key => $item){
    if(!empty($groups[$item["ID"]])){
        $arResult["ITEMS"][$key]["GROUPS"] = $groups[$item["ID"]];
        $item["GROUPS"] = $groups[$item["ID"]];
    }
    if(!empty($item["IBLOCK_SECTION_ID"]) && !empty($item["GROUPS"])){
        foreach ($item["GROUPS"] as $group){
            if(count($arResult["SECTIONS"][$group]["ITEMS"]) >= $arParams["NEWS_LIMIT"]){
                continue;
            }
            $arResult["SECTIONS"][$group]["ITEMS"][$item["ID"]] = $item;
            //$arResult["SECTIONS"][$item["IBLOCK_SECTION_ID"]]["ITEMS"][$item["ID"]]["PREVIEW_PICTURE_RESIZE"] = CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width' => 540, 'height' => 390), BX_RESIZE_IMAGE_EXACT, true);
        }
    }
}
$arResult["SECTIONS"] = array_values($arResult["SECTIONS"]);
$this->__component->SetResultCacheKeys(array("SECTIONS"));

?>