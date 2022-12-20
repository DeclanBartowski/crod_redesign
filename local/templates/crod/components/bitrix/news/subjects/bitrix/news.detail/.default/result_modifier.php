<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
use \Bitrix\Iblock\ElementTable;


$arSelect = array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE");
$arFilter = array("IBLOCK_ID" => 25, "PROPERTY_SUB" => $arResult['ID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array(), $arFilter, false, array("nTopCount" => 1), $arSelect);
if ($ob = $res->Fetch()) {
    $arResult['EXPERT'] = [
        'NAME' => $ob['NAME'],
        'PREVIEW_TEXT' => $ob['PREVIEW_TEXT'],
        'PREVIEW_PICTURE' => (!empty($ob['PREVIEW_PICTURE'])) ? CFile::GetPath($ob['PREVIEW_PICTURE']) : '',
    ];
}

$resultSections = [];

$resSections = \Bitrix\Iblock\SectionTable::getList([
    'filter' => ['IBLOCK_ID' => 24],
    'select' => ['NAME', 'ID', 'IBLOCK_SECTION_ID']
]);

while ($arSection = $resSections->fetch())
{
    if(!empty($arSection['IBLOCK_SECTION_ID'])) {
        $resultSections['SECTIONS_RESULT'][$arSection['IBLOCK_SECTION_ID']][] = $arSection;
    } else {
        $resultSections['MAIN'][$arSection['ID']] = $arSection['NAME'];
    }

    $resultSections['FULL'][$arSection['ID']] = (empty($arSection['IBLOCK_SECTION_ID'])) ? $arSection['ID'] : $arSection['IBLOCK_SECTION_ID'] ;
}



$arSelect = array("ID", "IBLOCK_ID", "NAME", "IBLOCK_SECTION_ID", 'PROPERTY_YEAR');
$arFilter = array("IBLOCK_ID" => 24, "PROPERTY_SUB" => $arResult['ID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array("PROPERTY_YEAR_VALUE" => "DESC", "ID" => "DESC"), $arFilter, ['IBLOCK_SECTION_ID'], false, $arSelect);

while ($ob = $res->Fetch()) {
    $parentID = $resultSections['FULL'][$ob["IBLOCK_SECTION_ID"]];
    if(empty($arResult['SECTION_RESULT'][$resultSections['MAIN'][$parentID]]))
    {
        $arResult['SECTION_RESULT'][(int)$resultSections['MAIN'][$parentID]] = $resultSections['SECTIONS_RESULT'][$parentID];
    }
}

krsort( $arResult['SECTION_RESULT']);



/**
 * Методические материалы
 */
$result = [];
$resultCombine = [];
$arSelect = array("ID", "IBLOCK_ID", "NAME", "PROPERTY_YEAR", "PROPERTY_FILE");
$arFilter = array("IBLOCK_ID" => 21, "PROPERTY_SUB" => $arResult['ID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array("PROPERTY_YEAR_VALUE" => "DESC", "ID" => "DESC"), $arFilter, false, array("nTopCount" => 99999), $arSelect);
while ($ob = $res->Fetch()) {


    if(!empty($ob['PROPERTY_FILE_VALUE']))
    {
        $ob['FILE_ARRAY'] = CFile::GetFileArray($ob['PROPERTY_FILE_VALUE']);
        $ob['FILE_ARRAY']['FORMAT_SIZE'] = CFile::FormatSize($ob['FILE_ARRAY']['FILE_SIZE'], 1);
        $ob['FILE_ARRAY']['FORMAT'] = \Bitrix\Main\IO\Path::getExtension($ob['FILE_ARRAY']["SRC"]);
    }
    $result[]  = $ob;
    $resultCombine[$ob['PROPERTY_YEAR_VALUE']][] = $ob;
}

$years = array_filter(array_unique(array_column($result, 'PROPERTY_YEAR_VALUE')));

if(!empty($years))
{
    $resYear = ElementTable::getList([
        'filter' => ['ID' => $years, 'IBLOCK_ID' => 19],
        'select' => ['ID', 'NAME']
    ]);
    while($arYear = $resYear->fetch())
    {

        $files =[];

        foreach ($resultCombine[$arYear['ID']] as $file)
        {
            $files[] = [
                'NAME' => $file['NAME'],
                'FORMAT' => $file['FILE_ARRAY']["FORMAT"],
                'SIZE' => $file['FILE_ARRAY']["FORMAT_SIZE"],
                'LINK' => $file['FILE_ARRAY']["SRC"],
            ];

        }

       $arResult['METHOD_MATERIAL'][(int)$arYear['NAME']] = $files;
    }
}
krsort($arResult['METHOD_MATERIAL']);


/**
 * Блок с результатами
 */
$arSelect = array("ID", "IBLOCK_ID", "NAME", "PROPERTY_YEAR", "PROPERTY_FILE");
$arFilter = array("IBLOCK_ID" => 28, "PROPERTY_SUB" => $arResult['ID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
$res = CIBlockElement::GetList(array("PROPERTY_YEAR" => "DESC"), $arFilter, false, array("nTopCount" => 99999), $arSelect);
$result = [];
$resultCombine = [];
while ($ob = $res->Fetch()) {
    if(!empty($ob['PROPERTY_FILE_VALUE']))
    {
        $ob['FILE_ARRAY'] = CFile::GetFileArray($ob['PROPERTY_FILE_VALUE']);
        $ob['FILE_ARRAY']['FORMAT_SIZE'] = CFile::FormatSize($ob['FILE_ARRAY']['FILE_SIZE'], 1);
        $ob['FILE_ARRAY']['FORMAT'] = \Bitrix\Main\IO\Path::getExtension($ob['FILE_ARRAY']["SRC"]);
    }
    $result[]  = $ob;
    $resultCombine[$ob['PROPERTY_YEAR_VALUE']][] = $ob;
}
$years = array_filter(array_unique(array_column($result, 'PROPERTY_YEAR_VALUE')));
if(!empty($years))
{
    $resYear = ElementTable::getList([
        'filter' => ['ID' => $years, 'IBLOCK_ID' => 19],
        'select' => ['ID', 'NAME']
    ]);
    while($arYear = $resYear->fetch())
    {

        $files =[];

        foreach ($resultCombine[$arYear['ID']] as $file)
        {
            $files[] = [
                'NAME' => $file['NAME'],
                'FORMAT' => $file['FILE_ARRAY']["FORMAT"],
                'SIZE' => $file['FILE_ARRAY']["FORMAT_SIZE"],
                'LINK' => $file['FILE_ARRAY']["SRC"],
            ];

        }

        $arResult['RESULT'][(int)$arYear['NAME']] = $files;
    }
}
krsort($arResult['RESULT']);
