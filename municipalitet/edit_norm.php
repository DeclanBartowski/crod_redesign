<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редактирование");
global $USER;
if (!$USER->IsAuthorized())LocalRedirect("authorize.php");
$userId = $USER->GetID();
CModule::IncludeModule("iblock");

$edit = !empty($_REQUEST['EDIT_MODE'])?true:false;
$add = !empty($_REQUEST['ADD_MODE'])?true:false;

$elementId = !empty($_REQUEST['ELEMENT_ID'])?$_REQUEST['ELEMENT_ID']:false;
if(!$elementId && !$add)LocalRedirect(SITE_SERVER_NAME . '/404.php');
$errors = array();

//document file array
$arrFile = array_merge(
    $_FILES["FILE"],
    array(
        "del" => ${"FILE_del"},
        "MODULE_ID" => "iblock",
        'DESCRIPTION' => $_FILES['FILE']['name']
    )
);

//file check
$fileCheckResult = CFile::CheckFile($arrFile, 0, false, 'txt, pdf, doc, docx, xls, xlsx, odt, rtf, ptx, pptx');
if (mb_strlen($fileCheckResult)>0) $fileError = $fileCheckResult;

//collect element properties
$elementProperties = array(
    'SUB' 		=> htmlspecialchars(strip_tags($_POST['SUBJECT'])),
    'REG' 		=> !empty($_POST['REGION'])?htmlspecialchars(strip_tags($_POST['REGION'])):CURRENT_USER_REGION_ID,
    'YEAR' 		=> !empty($_POST['YEAR'])?htmlspecialchars(strip_tags($_POST['YEAR'])):'',
//    'FILE'      => $arrFile
);

//get year by it's id
$yearValueRes = CIBlockElement::GetByID($_POST['YEAR']);
if($yearValueData = $yearValueRes->GetNext()){
    $yearValue = $yearValueData['NAME'];
}else{
    $yearValue = '';
}
//get current year section id
$yearSectionIdRes = CIBlockSection::GetList(array("SORT"=>"ASC"), array('IBLOCK_ID'=> 27, 'NAME'=>$yearValue), array('ID'));
if($yearSectionIdData = $yearSectionIdRes->GetNext()){
    $yearSectionId = $yearSectionIdData['ID'];
}
//get current years municipality section id
$yearMunicipalitySectionRes = CIBlockSection::GetList(array("SORT"=>"ASC"), array('SECTION_ID'=>$yearSectionId, 'NAME'=>'Нормативная база муниципального этапа'), false, array('ID'));
if($yearMunicipalitySectionData = $yearMunicipalitySectionRes->GetNext()){
    $yearMunicipalitySectionId = $yearMunicipalitySectionData['ID'];
}

if($_FILES['FILE']['error'] === 0 || !empty($_POST['FILE_del']) ) $elementProperties['FILE'] = $arrFile;
$elementData = array(
    'NAME' 					=> htmlspecialchars(strip_tags($_POST['NAME'])),
    'IBLOCK_SECTION'        => array($yearSectionId, $yearMunicipalitySectionId),
    'PREVIEW_TEXT' 			=> htmlspecialchars(strip_tags($_POST['PREVIEW_TEXT'])),
    'MODIFIED_BY'   		=> $userId,
);

//check input fields
if(empty($elementData['NAME']))$errors[] 			= 1;
// if(empty($elementProperties['SUB']))$errors[] 	    = 2;
// if(empty($elementData['PREVIEW_TEXT']))$errors[] 	= 3;

if($edit){
    if(count($errors) == 0 && empty($fileError)){
        $el = new CIBlockElement;
        if($el->Update($elementId, $elementData) && $el->SetPropertyValuesEx($elementId, false, $elementProperties) === null){
            LocalRedirect('norm.php?ELEMENT_ID=' . $elementId . '&SUCCESS=EDIT');
        }else{
            LocalRedirect('norm.php?EDIT_MODE=Y&ELEMENT_ID=' . $elementId . '&ERRORS=' . urlencode(serialize(array(4))) . '&ERROR_CODE=' . urlencode(serialize($el->LAST_ERROR)) );
        }
    }else{
        $errors_string = urlencode(serialize($errors));
        LocalRedirect('norm.php?EDIT_MODE=Y&ELEMENT_ID=' . $elementId . '&ERRORS=' . $errors_string . (!empty($fileError)?'&ERROR_CODE=' . urlencode($fileError):''));
    }
}
if($add){
    if(count($errors) == 0 && empty($fileError)){
        $el = new CIBlockElement;
        $elementData['PROPERTY_VALUES'] = $elementProperties;
        $elementData['IBLOCK_ID'] = 27;
        $elementData['CODE'] = Cutil::translit($elementData['NAME'],"ru",array("replace_space"=>"-","replace_other"=>"-"));
        if($newElementId = $el->Add($elementData)) {
            $_SESSION['SUCCESS_ALERT'] = true;
            LocalRedirect('norm.php?SUCCESS=ADD&ADDED_ELEMENT_ID=' . $newElementId);
        }else{
            $_SESSION['ERROR_ALERT'] = true;
            LocalRedirect('norm.php?ADD_MODE=Y&ELEMENT_ID=' . $elementId . '&ERRORS=' . urlencode(serialize(array(4))) . '&ERROR_CODE=' . urlencode(serialize($el->LAST_ERROR)) );
        }
    }else{
        $_SESSION['ERROR_ALERT'] = true;
        $errors_string = urlencode(serialize($errors));
        LocalRedirect('norm.php?ADD_MODE=Y&ELEMENT_ID=' . $elementId . '&ERRORS=' . $errors_string . (!empty($fileError)?'&ERROR_CODE=' . urlencode($fileError):''));
    }
} ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
