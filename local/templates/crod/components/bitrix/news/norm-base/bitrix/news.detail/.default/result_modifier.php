<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

function getExtension($filename, $origname, $prefix_ext = "_") {
    $filename = explode(".", $filename);

    $arFile = array();
    $arFile["name_file"] = str_replace(".".$filename[1], "", $origname);
    $arFile["name"] = $filename[1];
    $arFile["prefix"] = $prefix_ext;

    switch ($arFile["name"]) {
        case "doc":
            $arFile["class"] = "doc";
            break;
        case "docx":
            $arFile["class"] = "doc";
            break;
        case "rtf":
            $arFile["class"] = "doc";
            break;
        case "xls":
            $arFile["class"] = "xls";
            break;
        case "xlsx":
            $arFile["class"] = "xls";
            break;
        case "pdf":
            $arFile["class"] = "pdf";
            break;
        case "ppt":
            $arFile["class"] = "doc";
            break;
        case "pptx":
            $arFile["class"] = "doc";
            break;
        case "zip":
            $arFile["class"] = "zip";
            break;
        case "rar":
            $arFile["class"] = "zip";
            break;
        default:
            $arFile["class"] = "doc";
            break;
    }

    $arFile["extension"] = $arFile["prefix"].$arFile["class"];

    return $arFile;
}

foreach($arResult["DISPLAY_PROPERTIES"] as &$arPropFile) {
    if ($arPropFile["PROPERTY_TYPE"] == "F" && count($arPropFile["FILE_VALUE"]) > 0) {
        if (!empty($arPropFile["FILE_VALUE"][0])) {
            foreach ($arPropFile["FILE_VALUE"] as &$arFile) {
                $arFileExt = getExtension($arFile["FILE_NAME"], $arFile["ORIGINAL_NAME"] );
                $arFile["EXTENSION_CLASS"] = $arFileExt["extension"];
                $arFile["EXTENSION"] = $arFileExt["name"];
                $arFile["NAME"] = $arFileExt["name_file"];
                $arFile["FILE_SIZE_BYTE"] = CFile::FormatSize($arFile["FILE_SIZE"], 0);
            }
        } else {
            $arFileExt = getExtension($arPropFile["FILE_VALUE"]["FILE_NAME"], $arPropFile["FILE_VALUE"]["ORIGINAL_NAME"]);
            $arPropFile["FILE_VALUE"]["EXTENSION_CLASS"] = $arFileExt["extension"];
            $arPropFile["FILE_VALUE"]["EXTENSION"] = $arFileExt["name"];
            $arPropFile["FILE_VALUE"]["NAME"] = $arFileExt["name_file"];
            $arPropFile["FILE_VALUE"]["FILE_SIZE_BYTE"] = CFile::FormatSize($arPropFile["FILE_VALUE"]["FILE_SIZE"], 0);
        }
    }
}
?>