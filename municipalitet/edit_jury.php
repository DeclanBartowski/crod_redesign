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

//detail image file array
$arrFile = array_merge(
    $_FILES["DETAIL_PICTURE"],
    array(
        "del" => ${"DETAIL_PICTURE_del"},
        "MODULE_ID" => "iblock"
    )
);

//file check
$fileCheckResult = CFile::CheckFile($arrFile, 900, "image/", CFile::GetImageExtensions());
if (mb_strlen($fileCheckResult)>0) $fileError = $fileCheckResult;

//resize image
if(!empty($fileError)){
    $newWidth = 200;
    $newHeight = 400;
    CFile::ResizeImage($arrFile, Array("width" => $newWidth, "height" => $newHeight), BX_RESIZE_IMAGE_PROPORTIONAL);
}

//collect element properties
$elementProperties = array(
    'SUB' 		=> htmlspecialchars(strip_tags($_POST['SUBJECT'])),
    'REG' 		=> !empty($_POST['REGION'])?htmlspecialchars(strip_tags($_POST['REGION'])):CURRENT_USER_REGION_ID,
);
$elementData = array(
    'NAME' 					=> htmlspecialchars(strip_tags($_POST['NAME'])),
    'PREVIEW_TEXT' 			=> htmlspecialchars(strip_tags($_POST['PREVIEW_TEXT'])),
    'MODIFIED_BY'   		=> $userId,
    'PREVIEW_PICTURE'       => $arrFile
);

//check input fields
if(empty($elementData['NAME']))$errors[] 			= 1;
if(empty($elementProperties['SUB']))$errors[] 	    = 2;
if(empty($elementData['PREVIEW_TEXT']))$errors[] 	= 3;

if($edit){
    if(count($errors) == 0){
        $el = new CIBlockElement;
        if($el->Update($elementId, $elementData) && $el->SetPropertyValuesEx($elementId, false, $elementProperties) === null){
            $_SESSION['SUCCESS_ALERT'] = true;
            LocalRedirect('jury.php?ELEMENT_ID=' . $elementId . '&SUCCESS=EDIT');
        }else{
            $_SESSION['ERROR_ALERT'] = true;
            LocalRedirect('jury.php?EDIT_MODE=Y&ELEMENT_ID=' . $elementId . '&ERRORS=' . urlencode(serialize(array(4))) . '&ERROR_CODE=' . urlencode(serialize($el->LAST_ERROR)) );
        }
    }else{
        $_SESSION['ERROR_ALERT'] = true;
        $errors_string = urlencode(serialize($errors));
        LocalRedirect('jury.php?EDIT_MODE=Y&ELEMENT_ID=' . $elementId . '&ERRORS=' . $errors_string . (!empty($fileError)?'&ERROR_CODE=' . urlencode(serialize($fileError)):''));
    }
}
if($add){
    if(count($errors) == 0){
        $el = new CIBlockElement;
        $elementData['PROPERTY_VALUES'] = $elementProperties;
        $elementData['IBLOCK_ID'] = 11;
        $elementData['CODE'] = Cutil::translit($elementData['NAME'],"ru",array("replace_space"=>"-","replace_other"=>"-"));
        if($newElementId = $el->Add($elementData)) {
            $_SESSION['SUCCESS_ALERT'] = true;
            LocalRedirect('jury.php?SUCCESS=ADD&ADDED_ELEMENT_ID=' . $newElementId);
        }else{
            $_SESSION['ERROR_ALERT'] = true;
            LocalRedirect('jury.php?ADD_MODE=Y&ELEMENT_ID=' . $elementId . '&ERRORS=' . urlencode(serialize(array(4))) . '&ERROR_CODE=' . urlencode(serialize($el->LAST_ERROR)) );
        }

    }else{
        $_SESSION['ERROR_ALERT'] = true;
        $errors_string = urlencode(serialize($errors));
        LocalRedirect('jury.php?ADD_MODE=Y&ELEMENT_ID=' . $elementId . '&ERRORS=' . $errors_string . (!empty($fileError)?'&ERROR_CODE=' . urlencode($fileError):''));
    }
} ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
