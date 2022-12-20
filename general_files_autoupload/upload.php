<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

ini_set("memory_limit", "512M");



function Out($var){
    echo '<pre style="color:white; background: black; padding: 10px; font-size: 12px; margin:10px;">';
    print_r($var);
    echo '</pre>';
}

$subjectKey = $_REQUEST['SUBJECT_KEY'];
$yearValue = 2020;
$yearSectionId = 194;
$yearMunicipalitySectionId = 0;
$yearGenMunicipalitySectionId = 196;


Out('CUURENT_SUBJECT_KEY: ' . $subjectKey);

/**
 * returns element id by element name
 */
function getElementId($filter){
    $res = CIBlockElement::GetList(
        array('SORT'=>'ASC'),
        $filter
    );
    if($resItem = $res->GetNext()){
        $itemId = !empty($resItem['ID'])?$resItem['ID']:'';
        return $itemId;
    }else{
        return '';
    }

}

/**
 * returns element name by filter
 */
function getElementName($filter){
    $res = CIBlockElement::GetList(
        array('SORT'=>'ASC'),
        $filter
    );
    if($resItem = $res->GetNext()){
        $itemName = !empty($resItem['NAME'])?$resItem['NAME']:'';
        return $itemName;
    }else{
        return '';
    }

}
/**
 * returns element code by filter
 */
function getElementCode($filter){
    $res = CIBlockElement::GetList(
        array('SORT'=>'ASC'),
        $filter
    );
    if($resItem = $res->GetNext()){
        $itemName = !empty($resItem['CODE'])?$resItem['CODE']:'';
        return $itemName;
    }else{
        return '';
    }

}

/**
 * checks if variable available and return it/ if not returns empty string
 */
function checkIfEmpty($var){
    if(!empty($var)){
        return $var;
    }else{
        return '';
    }
}

/**
 * checks if item already exists in database
 */
function checkIfItemExists($filter){
    $res = CIBlockElement::GetList(
        array('SORT'=>'ASC'),
        $filter
    );
    if($resItem = $res->GetNext()){
        return $resItem['ID'];
    }else{
        return false;
    }
}


/**
 * creating xls files
 * @param array excellSheetRowStructure structure of excell file sheet (key=>col letter, value=>col name)
 * @param string section directory
 * @param array filter - filter of elements which will be written to file
 * @param string yearValue value of selected year
 * @param integer yearSectionId id of section of selected year
 * @param int yearMunicipalitySectionId file section (non general)
 * @param array elementsList list of elements which added (new added results)
 * @param int yearGenMunicipalitySectionId file section for general (all regions)
 * @param bool isGeneral - if results are general (all regions)
 */

function createXlsx($excellSheetRowStructure, $dir, $filter, $yearValue, $yearSectionId, $yearMunicipalitySectionId, $elementsList=array(), $yearGenMunicipalitySectionId = 0,
                    $isGeneral = false){
    if(!is_dir($dir . '/subjects'))mkdir($dir . '/subjects');
    $fElementsList = array();// list of elements to be added to file
    $fElementsListSortedBySub = array();// list of elements to be added to file sorted by subject
    $fResultsRes = CIBlockElement::GetList(
        array('NAME'=>'ASC'),
        $filter,
        false,
        false,
        array(
            'ID',
            'NAME',
            'PROPERTY_YEAR.NAME',
            'PROPERTY_SEX',
            'PROPERTY_CITIZENSHIP',
            'PROPERTY_FIO_TEACH',
            'PROPERTY_REG.NAME',
            'PROPERTY_SCHOOL_FULL',
            'PROPERTY_SCHOOL',
            'PROPERTY_CLASS',
            'PROPERTY_SUB.NAME',
            'PROPERTY_SUB.CODE',
            'PROPERTY_STATUS',
            'PROPERTY_MARKS',
            'PROPERTY_RANK',
            'PROPERTY_BIRTHDATE',
        )

    );
    while($fNextElement = $fResultsRes->GetNext()){
        $fElementsList[] = $fNextElement;
    }

    foreach ($elementsList as $Elem){
        $elementsListExt[] = array(
            'NAME' => $Elem['NAME'],
            'MODIFIED_BY' => $Elem['MODIFIED_BY'],
            'PROPERTY_YEAR_NAME' => $yearValue,
            'PROPERTY_SEX_VALUE' => $Elem['PROPERTY_VALUES']['SEX'],
            'PROPERTY_CITIZENSHIP_VALUE' => $Elem['PROPERTY_VALUES']['CITIZENSHIP'],
            'PROPERTY_FIO_TEACH_VALUE' => $Elem['PROPERTY_VALUES']['FIO_TEACH'],
            'PROPERTY_REG_NAME' => CURRENT_USER_REGION_NAME,
            'PROPERTY_SCHOOL_FULL_VALUE' => $Elem['PROPERTY_VALUES']['SCHOOL'],
            'PROPERTY_CLASS_VALUE' => $Elem['PROPERTY_VALUES']['CLASS'],
            'PROPERTY_SUB_NAME' => getElementName(array('IBLOCK_ID'=>9, 'ID'=>$Elem['PROPERTY_VALUES']['SUB'])),
            'PROPERTY_SUB_CODE'	=> getElementCode(array('IBLOCK_ID'=>9, 'ID'=>$Elem['PROPERTY_VALUES']['SUB'])),
            'PROPERTY_VALUES' => $Elem['PROPERTY_VALUES']
        );
    }

    //$fElementsList = array_merge($fElementsList, $elementsListExt); //merge added and old items*/

    foreach ($fElementsList as $key => $fElement) {
        if($fElement['PROPERTY_SUB_CODE'])$fElementsListSortedBySub[$fElement['PROPERTY_SUB_CODE']][] = $fElement;
    }

    $elementsListExtSortedBySub = array();
    foreach ($elementsListExt as $elementExt){
        if($elementExt['PROPERTY_SUB_CODE'])$elementsListExtSortedBySub[$elementExt['PROPERTY_SUB_CODE']][] = $elementExt;
    }


    foreach ($fElementsListSortedBySub as $fSubject => $fSubjectElements){
        $subjectName = getElementName(array('IBLOCK_ID'=>9, 'CODE'=>$fSubject));
        $subjectId = getElementId(array('IBLOCK_ID'=>9, 'CODE'=>$fSubject));

        $sheetFullName = $dir . '/subjects/' . $fSubject . '-' . Cutil::translit(CURRENT_USER_REGION_NAME,"ru",array("replace_space"=>"-","replace_other"=>"-")) . '-' .
            $yearValue .'.xlsx';//spreadsheet file dir
        if($isGeneral)$sheetFullName = $dir . '/subjects/' . $fSubject . '-all_regions-' . $yearValue .'.xlsx';

        $fileNameRu = 'Результаты олимпиад (муниципальный этап)-' . $subjectName . '-' . $yearValue . '-' . checkIfEmpty(CURRENT_USER_REGION_NAME);//file name in infoblock
        if($isGeneral) $fileNameRu = 'Общие результаты олимпиад (муниципальный этап)-' . $subjectName . '-' . $yearValue;


            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->getColumnDimension('A:Q')->setAutoSize(true);
            //set font colors
            $sheet->getStyle('A1')->getFont()->getColor()->applyFromArray(['rgb' => 'ffffff']);
            //set cell backgrounds
            $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('0000ff');
            $sheet->getStyle('G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00ccff');
            $sheet->getStyle('J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3366ff');
            $sheet->getStyle('N1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33cccc');
            $sheet->getStyle('A2:Q2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffff00');

            //first row
            $sheet->mergeCells('A1:F1');
            $sheet->mergeCells('G1:I1');
            $sheet->mergeCells('J1:M1');
            $sheet->mergeCells('N1:Q1');
            $sheet->setCellValue('A1', 'Участник')->getStyle('A1')->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('G1', 'Учитель')->getStyle('G1')->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('N1', 'Результаты участия')->getStyle('N1')->getAlignment()->setHorizontal('center');

            //second row
            $sheet->setCellValue('A2', $excellSheetRowStructure['A']);
            $sheet->setCellValue('B2', $excellSheetRowStructure['B']);
            $sheet->setCellValue('C2', $excellSheetRowStructure['C']);
            $sheet->setCellValue('D2', $excellSheetRowStructure['D']);
            $sheet->setCellValue('E2', $excellSheetRowStructure['E']);
            $sheet->setCellValue('F2', $excellSheetRowStructure['F']);
            $sheet->setCellValue('G2', $excellSheetRowStructure['G']);
            $sheet->setCellValue('H2', $excellSheetRowStructure['H']);
            $sheet->setCellValue('I2', $excellSheetRowStructure['I']);
            $sheet->setCellValue('J2', $excellSheetRowStructure['J']);
            $sheet->setCellValue('K2', $excellSheetRowStructure['K']);
            $sheet->setCellValue('L2', $excellSheetRowStructure['L']);
            $sheet->setCellValue('M2', $excellSheetRowStructure['M']);
            $sheet->setCellValue('N2', $excellSheetRowStructure['N']);
            $sheet->setCellValue('O2', $excellSheetRowStructure['O']);
            $sheet->setCellValue('P2', $excellSheetRowStructure['P']);
            $sheet->setCellValue('Q2', $excellSheetRowStructure['Q']);

            //elements
            foreach ($fSubjectElements as $subKey => $fSubjectElement){
                $nameBroken = array_filter(explode(' ', $fSubjectElement['NAME']));
                $nameBroken= array_values($nameBroken);
                $teacherNameBroken = explode(' ', $fSubjectElement['PROPERTY_FIO_TEACH_VALUE']);
                $sheet->setCellValue('A' . ($subKey+3), checkIfEmpty($nameBroken[0]));
                $sheet->setCellValue('B' . ($subKey+3), checkIfEmpty($nameBroken[1]));
                $sheet->setCellValue('C' . ($subKey+3), checkIfEmpty($nameBroken[2]));
                $sheet->setCellValue('D' . ($subKey+3), $fSubjectElement['PROPERTY_VALUES']['BIRTHDATE']);
                $sheet->setCellValue('E' . ($subKey+3), $fSubjectElement['PROPERTY_SEX_VALUE']);
                $sheet->setCellValue('F' . ($subKey+3), $fSubjectElement['PROPERTY_CITIZENSHIP_VALUE']);
                $sheet->setCellValue('G' . ($subKey+3), checkIfEmpty($teacherNameBroken[0]));
                $sheet->setCellValue('H' . ($subKey+3), checkIfEmpty($teacherNameBroken[1]));
                $sheet->setCellValue('I' . ($subKey+3), checkIfEmpty($teacherNameBroken[2]));
                $sheet->setCellValue('J' . ($subKey+3), $fSubjectElement['PROPERTY_REG_NAME']);
                $sheet->setCellValue('K' . ($subKey+3), htmlspecialchars_decode($fSubjectElement['PROPERTY_SCHOOL_VALUE']));
                $sheet->setCellValue('L' . ($subKey+3), htmlspecialchars_decode($fSubjectElement['PROPERTY_SCHOOL_FULL_VALUE']));
                $sheet->setCellValue('M' . ($subKey+3), $fSubjectElement['PROPERTY_CLASS_VALUE']);
                $sheet->setCellValue('N' . ($subKey+3), $fSubjectElement['PROPERTY_SUB_NAME']);
                $sheet->setCellValue('O' . ($subKey+3), $fSubjectElement['PROPERTY_STATUS_VALUE']);
                $sheet->setCellValue('P' . ($subKey+3), $fSubjectElement['PROPERTY_MARKS_VALUE']);
                $sheet->setCellValue('Q' . ($subKey+3), $fSubjectElement['PROPERTY_RANK_VALUE']);
            }
            $writer = new Xlsx($spreadsheet);
            $writer->save($sheetFullName);

            //adding file to infoblock
            $arResultsFileFields = array(
                'IBLOCK_ID' 		=> 30,
                'NAME'				=> $fileNameRu,
                'CODE'				=> Cutil::translit($fileNameRu,"ru",array("replace_space"=>"-","replace_other"=>"-")),
                'PROPERTY_VALUES'	=> array(
                    'RESULT_FILE' 		=> CFile::MakeFileArray($sheetFullName),
                    'RESULT_SECTION'	=> array(194,196),
                    'RESULT_REG'		=> ($isGeneral?'':CURRENT_USER_REGION_ID),
                    'RESULT_SUB'		=> $subjectId
                )
            );
            $el = new CIBlockElement;
            $el->Add($arResultsFileFields);
        }

}


/***GET SUBJECTS WITH ELEMENTS LINKED WITH IT*******/
/*$arResults = array();
$resResults = CIBlockElement::GetList(
    array("SORT"=>"ASC"),
    array('IBLOCK_ID' => 24, 'SECTION_ID' => 196, "PROPERTY_SUB.VALUE"=>3047),
    false,
    false,
    array(
        'ID',
        'NAME',
        'PROPERTY_YEAR.NAME',
        'PROPERTY_SEX',
        'PROPERTY_CITIZENSHIP',
        'PROPERTY_FIO_TEACH',
        'PROPERTY_REG.NAME',
        'PROPERTY_SCHOOL_FULL',
        'PROPERTY_SCHOOL',
        'PROPERTY_CLASS',
        'PROPERTY_SUB.NAME',
        'PROPERTY_SUB.CODE',
        'PROPERTY_STATUS',
        'PROPERTY_MARKS',
        'PROPERTY_RANK',
        'PROPERTY_BIRTHDATE')
);
while($nextResult = $resResults->GetNext()){

    $arResults[] = $nextResult;
}*/


$arSubjects = array();
$arSubjectsOnly = array();
$resSubjects = CIBlockElement::GetList(
    array("SORT"=>"ASC"),
    array('IBLOCK_ID' => 9),
    false,
    false,
    array('ID', 'CODE', 'NAME')
 );
$iSub = 1;
while($nextSubject = $resSubjects->GetNext()){
    $results = array();
    foreach ($arResults as $result) {
        if($result['PROPERTY_SUB_CODE'] == $nextSubject['CODE']){
            $results[] = $result;
        }
    }
    $arSubjectsOnly[$iSub] = $nextSubject;
    $nextSubject['results_list'] = $results;
    $arSubjects[$iSub] = $nextSubject;
    $iSub++;
}

/***GET GLOBAL FILE**/

$currentSubject = $arSubjects[$subjectKey];
$resFile = CIBlockElement::GetList(
    array("SORT"=>"ASC"),
    array('IBLOCK_ID' => 30, 'PROPERTY_RESULT_SECTION'=>array(196), 'PROPERTY_RESULT_SUB' => $currentSubject['ID']),
    false,
    false,
    array('IBLOCK_ID', 'ID', 'CODE', 'NAME', 'PROPERTY_RESULT_FILE', 'PROPERTY_RESULT_SECTION')
);
$currentFile = array();
if($nextFile = $resFile->GetNext()){


//    $fields['PROPERTY_VALUES'] = $nextFile->GetProperties();
    $currentFile = $nextFile;
}





//structure of excell file row
$excellSheetRowStructure = array(
    'A' => 'Фамилия',
    'B' => 'Имя',
    'C' => 'Отчество',
    'D' => 'Дата рождения',
    'E' => 'Пол',
    'F' => 'Гражданство',
    'G' => 'Фамилия',//teacher
    'H' => 'Имя',//teacher
    'I' => 'Отчество',//teacher
    'J' => 'Муниципалитет',
    'K' => 'Полное название ОУ',
    'L' => 'Сокр. название ОУ',
    'M' => 'Класс обучения',
    'N' => 'Предмет',
    'O' => 'Статус участника',
    'P' => 'Результат',
    'Q' => 'Место'

);
$dir = $_SERVER['DOCUMENT_ROOT'] . '/municipalitet';
$resultsFilter = array('IBLOCK_ID' => 24, 'SECTION_ID' => 196, "PROPERTY_SUB"=>$arSubjects[$subjectKey]['ID']);
//Out($arResults);

if(!empty($subjectKey) && !empty($arSubjects[$subjectKey])){
    /****DELETE GLOBAL FILE ****/
    global $DB;
    if(!empty($currentFile['ID'])){
        $DB->StartTransaction();
        if(!CIBlockElement::Delete($currentFile['ID'])) {
            echo 'Result not deleted<br>';
            $DB->Rollback();
        }else{
            echo 'Result deleted<br>';
            $DB->Commit();
        }

    }

Out('CREATING_FILE...');
    /****CREATING NEW FILE*****/
    createXlsx($excellSheetRowStructure, $dir, $resultsFilter, $yearValue, $yearSectionId, $yearMunicipalitySectionId, array(),$yearGenMunicipalitySectionId, true);

}


//Out(count($arSubjects));
//Out($currentFile);
Out($arSubjectsOnly);

//Out($arSubjects[$subjectKey]);

?>
