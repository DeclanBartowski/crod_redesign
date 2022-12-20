<?
/*ini_set("memory_limit", "512M");
ini_set('max_execution_time', 0);
ignore_user_abort();
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

CModule::IncludeModule("iblock");

$res = CIBlockElement::GetList(array(), array('IBLOCK_ID'=>24, 'IBLOCK_TYPE'=>'documents'), false, false, array('ID', 'PROPERTY_MARKS'));

while($nextElem = $res->GetNext()){
	$classNum = (int)$nextElem['PROPERTY_MARKS_VALUE'];
	echo $nextElem['ID'] . ' ' . $nextElem['PROPERTY_MARKS_VALUE'] . '<br>';
	CIBlockElement::SetPropertyValuesEx($nextElem['ID'], 24, array('MARKS_NUM' => $classNum));
}*/


?>
