<?
ini_set("memory_limit", "512M");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редактирование");
global $USER;
if (!$USER->IsAuthorized())LocalRedirect("authorize.php");
$userId = $USER->GetID();
CModule::IncludeModule("iblock");
$fromFile = !empty($_REQUEST['FROM_FILE'])&&$_REQUEST['FROM_FILE'] == 'Y'?true:false;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function Output($data){
	echo'<pre>';
	print_r($data);
	echo'</pre>';
}

//Output(CURRENT_USER_REGION_NAME);

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
 * @param string municipality section directory
 * @param array filter - filter of elements which will be written to file
 * @param string yearValue value of selected year
 * @param integer yearSectionId id of section of selected year
 * @param int yearMunicipalitySectionId file section (non general)
 * @param array elementsList list of elements which added (new added results)
 * @param int yearGenMunicipalitySectionId file section for general (all regions)
 * @param bool isGeneral - if results are general (all regions municipal)
 * @param int yearGenRegionalSectionId general regional section id
 * @param bool isRegional - if results are regional general
 */

function createXlsx($excellSheetRowStructure, $dir, $filter, $yearValue, $yearSectionId, $yearMunicipalitySectionId, $elementsList=array(), $yearGenMunicipalitySectionId = 0,$isGeneral = false, $yearGenRegionalSectionId = 0, $isRegional = false){

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
				'PROPERTY_REG_NAME' => !empty(CURRENT_USER_REGION_NAME)?CURRENT_USER_REGION_NAME:getElementName(array('IBLOCK_ID'=>17, 'ID'=>$Elem['PROPERTY_VALUES']['REG'])),
				'PROPERTY_SCHOOL_FULL_VALUE' => $Elem['PROPERTY_VALUES']['SCHOOL'],
				'PROPERTY_SCHOOL_VALUE' => $Elem['PROPERTY_VALUES']['SCHOOL'],
				'PROPERTY_CLASS_VALUE' => $Elem['PROPERTY_VALUES']['CLASS'],
				'PROPERTY_SUB_NAME' => getElementName(array('IBLOCK_ID'=>9, 'ID'=>$Elem['PROPERTY_VALUES']['SUB'])),
				'PROPERTY_SUB_CODE'	=> getElementCode(array('IBLOCK_ID'=>9, 'ID'=>$Elem['PROPERTY_VALUES']['SUB'])),
                'PROPERTY_VALUES' => $Elem['PROPERTY_VALUES']
		);
	}

	//$fElementsList = array_merge($fElementsList, $elementsListExt); //merge added and old items*/
	$fElementsList = $elementsListExt;

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
		if($isRegional)$sheetFullName = $dir . '/subjects/' . $fSubject . '-regional-' . $yearValue .'.xlsx';

		$fileNameRu = 'Результаты олимпиад (муниципальный этап)-' . $subjectName . '-' . $yearValue . '-' . checkIfEmpty(CURRENT_USER_REGION_NAME);//file name in infoblock
		if($isGeneral) $fileNameRu = 'Общие результаты олимпиад (муниципальный этап)-' . $subjectName . '-' . $yearValue;
		if($isRegional) $fileNameRu = 'Общие результаты олимпиад (региональный этап)-' . $subjectName . '-' . $yearValue;

		//check if file already exists with these properties
		$fileCheckFilter = array(
			'IBLOCK_TYPE' 			=> 'documents',
			'IBLOCK_ID'				=> 30,
			'NAME'					=> $fileNameRu,
			'PROPERTY_RESULT_REG'	=> (!$isGeneral && !$isRegional?CURRENT_USER_REGION_ID:''),
			'PROPERTY_RESULT_SUB'	=> $subjectId,
			'SECTION_ID'		 	=> ($isGeneral?$yearGenMunicipalitySectionId:$yearMunicipalitySectionId),
			'ACTIVE '				=> 'Y'

		);

		if($isRegional) $fileCheckFilter['SECTION_ID'] = $yearGenRegionalSectionId;

		if($existingFileId = checkIfItemExists($fileCheckFilter)){
			$existingFileRes = CIBlockElement::GetList(array('NAME'=>'asc'), array('IBLOCK_ID' => 30, 'ID'=>$existingFileId, 'ACTIVE'=>'Y'), false, false, array('NAME', 'PROPERTY_RESULT_FILE'));
			if($existingFile = $existingFileRes->GetNext()){
				$filePath = $_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($existingFile['PROPERTY_RESULT_FILE_VALUE']);
				$spreadSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
				$sheet = $spreadSheet -> getActiveSheet();
				$lastRow = $sheet->getHighestDataRow();

				$lastRow++;
				foreach ($elementsListExtSortedBySub[$fSubject] as $elemKey => $nextElement){
					$nameBroken = array_filter(explode(' ', $nextElement['NAME']));
                    $nameBroken= array_values($nameBroken);
					$teacherNameBroken = explode(' ', $nextElement['PROPERTY_VALUES']['FIO_TEACH']);
					$subjectName = getElementName(array('IBLOCK_ID'=>9, 'ID'=>$nextElement['PROPERTY_VALUES']['SUB']));
					if(!empty($nextElement['PROPERTY_VALUES']['REG'])){
                        $regionName = getElementName(array('IBLOCK_ID'=>17, 'ID'=>$nextElement['PROPERTY_VALUES']['REG']));
                    }elseif(!empty($nextElement['PROPERTY_REG_NAME'])){
                        $regionName = $nextElement['PROPERTY_REG_NAME'];
                    }else{
						$regionName = '';
					}

					$sheet->getColumnDimension('A:Q')->setAutoSize(true);

					$sheet->setCellValue('A' . $lastRow, checkIfEmpty($nameBroken[0]));
					$sheet->setCellValue('B' . $lastRow, checkIfEmpty($nameBroken[1]));
					$sheet->setCellValue('C' . $lastRow, checkIfEmpty($nameBroken[2]));
					$sheet->setCellValue('D' . $lastRow, $nextElement['PROPERTY_VALUES']['BIRTHDATE']);
					$sheet->setCellValue('E' . $lastRow, $nextElement['PROPERTY_VALUES']['SEX']);
					$sheet->setCellValue('F' . $lastRow, $nextElement['PROPERTY_VALUES']['CITIZENSHIP']);
					$sheet->setCellValue('G' . $lastRow, checkIfEmpty($teacherNameBroken[0]));
					$sheet->setCellValue('H' . $lastRow, checkIfEmpty($teacherNameBroken[1]));
					$sheet->setCellValue('I' . $lastRow, checkIfEmpty($teacherNameBroken[2]));
					$sheet->setCellValue('J' . $lastRow, $regionName);
					$sheet->setCellValue('K' . $lastRow, htmlspecialchars_decode($nextElement['PROPERTY_VALUES']['SCHOOL']));
					$sheet->setCellValue('L' . $lastRow, htmlspecialchars_decode($nextElement['PROPERTY_VALUES']['SCHOOL_FULL']));
					$sheet->setCellValue('M' . $lastRow, $nextElement['PROPERTY_VALUES']['CLASS']);
					$sheet->setCellValue('N' . $lastRow, $subjectName);
					$sheet->setCellValue('O' . $lastRow, $nextElement['PROPERTY_VALUES']['STATUS']);
					$sheet->setCellValue('P' . $lastRow, $nextElement['PROPERTY_VALUES']['MARKS']);
					$sheet->setCellValue('Q' . $lastRow, $nextElement['PROPERTY_VALUES']['RANK']);


					$lastRow++;
				}
				if($fSubject == 'geografiya'){
					$sheet->setCellValue('A35', 'aaa');
					$sheet->setCellValue('B35', 'bbb');
					$sheet->setCellValue('C35', 'ccc');
				}

				$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadSheet);
				$writer->save($filePath);
			}


		}else{
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
				$sheet->setCellValue('D' . ($subKey+3), htmlspecialchars_decode($fSubjectElement['PROPERTY_VALUES']['BIRTHDATE']));
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
				$sheet->setCellValue('O' . ($subKey+3), $fSubjectElement['PROPERTY_VALUES']['STATUS']);
				$sheet->setCellValue('P' . ($subKey+3), $fSubjectElement['PROPERTY_VALUES']['MARKS']);
				$sheet->setCellValue('Q' . ($subKey+3), $fSubjectElement['PROPERTY_VALUES']['RANK']);
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
					'RESULT_SECTION'	=> ($isGeneral?array($yearSectionId, $yearGenMunicipalitySectionId):array($yearSectionId, $yearMunicipalitySectionId)),
					'RESULT_REG'		=> ($isGeneral || $isRegional?'':CURRENT_USER_REGION_ID),
					'RESULT_SUB'		=> $subjectId
				)
			);
			if($isRegional){
				$arResultsFileFields['PROPERTY_VALUES']['RESULT_SECTION'] = $yearGenRegionalSectionId;
			}
			$el = new CIBlockElement;
			$el->Add($arResultsFileFields);

		}

	}
}



?>

<?if($fromFile){

	//import from file
	/*
	 * deletes all files and folders from $dir directory
	 * */
	function rrmdir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
					if (is_dir($dir."/".$object))
						rrmdir($dir."/".$object);
					else
						unlink($dir."/".$object);
				}
			}
			rmdir($dir);
		}
	}

	//if user is regional (for general regional results)
	$regionalUserGroupId = 9;
	$userGroups = CUser::GetUserGroup($USER->GetID());
	$isRegional = in_array($regionalUserGroupId, $userGroups);

	//get year by it's id
	$resultsYear = strip_tags($_POST['RESULTS_YEAR']);
	$yearValueRes = CIBlockElement::GetByID($resultsYear);

	if($yearValueData = $yearValueRes->GetNext()){
		$yearValue = $yearValueData['NAME'];
	}else{
		$yearValue = '';
	}

	//get current year section id
	$yearSectionIdRes = CIBlockSection::GetList(array("SORT"=>"ASC"), array('IBLOCK_ID'=> 24, 'NAME'=>$yearValue), array('ID'));
	if($yearSectionIdData = $yearSectionIdRes->GetNext()){

		$yearSectionId = $yearSectionIdData['ID'];
	}else{
		$yearSectionId = '';
	}
	//get current years municipality section id
	$yearMunicipalitySectionRes = CIBlockSection::GetList(array("SORT"=>"ASC"), array('SECTION_ID'=>$yearSectionId, 'NAME'=>'Результаты (муниципальный) этап'), false, array('ID'));
	if($yearMunicipalitySectionData = $yearMunicipalitySectionRes->GetNext()){
		$yearMunicipalitySectionId = $yearMunicipalitySectionData['ID'];
	}else{
		$yearMunicipalitySectionId = '';
	}
	//get current years general municipality section id
	$yearGenMunicipalitySectionRes = CIBlockSection::GetList(array("SORT"=>"ASC"), array('SECTION_ID'=>$yearSectionId, 'NAME'=>'Общие результаты (муниципального) этапа'), false,
		array('ID'));
	if($yearGenMunicipalitySectionData = $yearGenMunicipalitySectionRes->GetNext()){
		$yearGenMunicipalitySectionId = $yearGenMunicipalitySectionData['ID'];
	}else{
		$yearGenMunicipalitySectionId = '';
	}

	//get current years general regional section id
	$yearGenSectionRes = CIBlockSection::GetList(array("SORT"=>"ASC"), array('SECTION_ID'=>$yearSectionId, 'NAME'=>'Результаты (региональный) этап'), false,
		array('ID'));
	if($yearGenSectionData = $yearGenSectionRes->GetNext()){
		$yearGenSectionId = $yearGenSectionData['ID'];
	}else{
		$yearGenSectionId = '';
	}


	$dir = $_SERVER['DOCUMENT_ROOT'] . '/municipalitet';
	$fileName = 'upload-file';
	if($_FILES['RESULTS']['error'] == 4)$errors[] = 12;
	if($_FILES['RESULTS']['error'] == 0){
		$extension = pathinfo($_FILES['RESULTS']['name'], PATHINFO_EXTENSION );
		if($extension != 'xls' && $extension != 'xlsx')$errors[] = 11;
	}
	if(count($errors) == 0){
		$fileFullPath = $dir . '/' . $fileName . '.' . $extension;
		move_uploaded_file($_FILES['RESULTS']['tmp_name'], $fileFullPath);
	}else{
		$_SESSION['ERROR_ALERT'] = true;
		LocalRedirect('subject_results.php?ERRORS=' . urlencode(serialize($errors)));
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
	if(!is_dir($dir . '/files'))mkdir($dir . '/files');

	$zip = new ZipArchive();
	$zip->open($fileFullPath);
	$zip->extractTo($dir . '/files');

	$strings = simplexml_load_file($dir . '/files/xl/sharedStrings.xml');
	$sheet   = simplexml_load_file($dir . '/files/xl/worksheets/sheet1.xml');

	// Parse the rows
	$xlrows = $sheet->sheetData->row;
	$fileSheetResult = array();//array with file parsing result




	$row_cnt = 1; //counter for rows
	foreach ($xlrows as $xlrow) {
		$arr = array();
		// In each row, grab it's value
		foreach ($xlrow->c as $cell) {
			$cellid = preg_replace('/[^A-Z]/i', '', $cell['r']);//get excell sheet col identifier
			$v = (string) $cell->v;
			// If it has a "t" (type?) of "s" (string?), use the value to look up string value
			if (isset($cell['t']) && $cell['t'] == 's') {
				$s  = array();
				$si = $strings->si[(int) $v];
				// Register & alias the default namespace or you'll get empty results in the xpath query
				$si->registerXPathNamespace('n', 'http://schemas.openxmlformats.org/spreadsheetml/2006/main');
				// Cat together all of the 't' (text?) node values
				foreach($si->xpath('.//n:t') as $t) {
					$s[] = (string) $t;
				}
				$v = implode($s);
			}
			$arr[(string)$cellid] = $v;
		}
		$fileSheetResult[] = $arr;
		$row_cnt++;
	}



	// remove first two rows of sheet
	unset($fileSheetResult[0]);
	unset($fileSheetResult[1]);

	$fileSheetResult = array_values($fileSheetResult); // reset keys of items array

	$last_key = ''; // end of fields we need ro parse in document
	foreach($fileSheetResult as $key => $result){
		if(empty($result['A']) && empty($result['B']) && empty($result['C']) ){ //  We need to parse up to this row
			$last_key = $key;
			break;
		}
	}


	if(!$last_key)$last_key = count($fileSheetResult);
	if(!$last_key)$last_key = 1;
	$fileSheetResult = array_splice($fileSheetResult, 0, $last_key);//cut the results array part we need


	$elementsList = array(); //array with elements ready to input to iblocks

	//$yearId = getElementId( array('IBLOCK_ID'=>19, 'NAME' => $resultsYear ) );//get year id
	$yearId = $resultsYear;

	foreach ($fileSheetResult as $key => $result) {
		$subjectId = getElementId( array('IBLOCK_ID'=>9, 'NAME' => $result['N']) );//get subject id

		$birthDate = !empty($result['D'])?date('d.m.Y', (($result['D'] - 25569) * 86400) ):''; // convert birthdate from excell to unix

		if($isRegional)$regionId = getElementId( array('IBLOCK_ID'=>17, 'NAME' => $result['J']) );//get region id

		$nextElement = array(
			'IBLOCK_ID'			=> 24,
			'NAME' 				=> checkIfEmpty($result['A']) . ' ' . checkIfEmpty($result['B']) . ' ' . checkIfEmpty($result['C']),
			'MODIFIED_BY' 		=> $userId,
			'IBLOCK_SECTION'	=> $isRegional?array($yearGenSectionId):array($yearSectionId, $yearGenMunicipalitySectionId, $yearMunicipalitySectionId),
			'PROPERTY_VALUES' 	=> array(
				'YEAR' 				=> checkIfEmpty($yearId),
				'SUB' 				=> checkIfEmpty($subjectId),
				'CLASS' 			=> checkIfEmpty($result['M']),
				'CLASS_NUM' 		=> (int)$result['M'],
				'FIO_TEACH' 		=> checkIfEmpty($result['G']) . ' ' .  checkIfEmpty($result['H']) . ' ' . checkIfEmpty($result['I']),
				'MARKS' 			=> (float)checkIfEmpty($result['P']),
				'MARKS_NUM' 		=> (int)$result['P'],
				'RANK' 				=> ceil(checkIfEmpty($result['Q'])),
				'SCHOOL' 			=> checkIfEmpty($result['L']),
				'STATUS' 			=> checkIfEmpty($result['O']),
				'REG'				=> $isRegional?$regionId:CURRENT_USER_REGION_ID,
				'BIRTHDATE'			=> checkIfEmpty($birthDate),
				'SEX'				=> checkIfEmpty($result['E']),
				'CITIZENSHIP'		=> checkIfEmpty($result['F']),
				'SCHOOL_FULL'		=> checkIfEmpty($result['K']),
			),
		);

		$nextElement['CODE'] = Cutil::translit($nextElement['NAME'],"ru",array("replace_space"=>"-","replace_other"=>"-")) . time() . rand(0, 999);

		$elementsList[] = $nextElement;

	}


	//adding elements to iblock
	$result = false;
	$new_items_added = 0;

	$notAdded = 0;
	$Added = 0;

	$elementsToAdd = array();

	foreach ($elementsList as $key => $elementToAdd) {
		if(!empty(trim($elementToAdd['NAME']))){
			$checkIfExixtsFilter = array(
				'IBLOCK_ID'			 =>24,
				'NAME'				 =>$elementToAdd['NAME'],
				'PROPERTY_REG'	     =>$elementToAdd['PROPERTY_VALUES']['REG'],
				'PROPERTY_STATUS'	 =>$elementToAdd['PROPERTY_VALUES']['STATUS'],
				'PROPERTY_CLASS'	 =>$elementToAdd['PROPERTY_VALUES']['CLASS'],
				/*'PROPERTY_BIRTHDATE' =>$elementToAdd['PROPERTY_VALUES']['BIRTHDATE'],*/
				'PROPERTY_SUB' 		 =>$elementToAdd['PROPERTY_VALUES']['SUB'],
				'PROPERTY_YEAR' 	 =>$elementToAdd['PROPERTY_VALUES']['YEAR']
			);
			if($isRegional)$checkIfExixtsFilter['SECTION_ID'] = $yearGenSectionId;
            $debugMode = false; // debug mode allows to check if results will be added without actually adding it

			if(!checkIfItemExists($checkIfExixtsFilter)){
				$elementsToAdd[$key] =  $elementToAdd;
                if($debugMode){
                    echo $elementToAdd['NAME'] . ' (баллов: ' . $elementToAdd['PROPERTY_VALUES']['MARKS'] . ', класс:' . $elementToAdd['PROPERTY_VALUES']['CLASS'] . ') <span style="color:green;">добавится</span><br><br>';
                    $Added++;
                    $new_items_added++;
                }else{
                    $elem = new CIBlockElement;
                    if($elem->Add($elementToAdd)){
                        $result = true;
                        $new_items_added ++;
                    }else{
                        /*echo $elem->LAST_ERROR;
                        exit('END');*/
                    }

					/** add item also to a general municipal section**/
					$checkInGeneralFilter = $checkIfExixtsFilter;
					$checkInGeneralFilter['SECTION_ID'] = $yearGenMunicipalitySectionId;
					if(!checkIfItemExists($checkInGeneralFilter)){
						$elementGeneral = $elementToAdd;
						$elementGeneral['SECTION_ID'] = $yearGenMunicipalitySectionId;
						$elem->Add($elementToAdd);
					}

                }
			}else{
			    if($debugMode){
                echo $elementToAdd['NAME'] . ' (баллов: ' . $elementToAdd['PROPERTY_VALUES']['MARKS'] . ', класс:' . $elementToAdd['PROPERTY_VALUES']['CLASS'] . ') <span style="color:red;">не добавится, такой результат уже есть</span><br><br>';
                $notAdded++;
                }
			}
		}
	}

	//delete temporary files
	$dir_to_delete = $dir . '/files';
	rrmdir($dir_to_delete);
	unlink($fileFullPath);

    if($debugMode){
        echo 'Добавятся: ' . $Added . '<br>';
        echo 'Не добавятся: ' . $notAdded . '<br>';
        exit('<br>***END OF IMPORT **');
    }

	if($new_items_added == 0){
		$errors[] = 13;
		$_SESSION['ERROR_ALERT'] = true;
		LocalRedirect('subject_results.php?ERRORS=' . urlencode(serialize($errors)));
		exit();
	}

/* create/update file with results for each subject (for download link on results page) */
	if($isRegional){
		//general regional section
		$filter = array(
			'IBLOCK_TYPE' 	=> 'documents',
			'IBLOCK_ID'	  	=> 24,
			'PROPERTY_YEAR'	=> $resultsYear,
			'SECTION_ID'	=> $yearGenSectionId
		);

		createXlsx($excellSheetRowStructure, $dir, $filter, $yearValue, $yearSectionId, $yearMunicipalitySectionId, $elementsToAdd, $yearGenMunicipalitySectionId,
			false, $yearGenSectionId, true);
	}else{
		//municipal each region
		$filter = array(
			'IBLOCK_TYPE' 	=> 'documents',
			'IBLOCK_ID'	  	=> 24,
			'PROPERTY_YEAR'	=> $resultsYear,
			'PROPERTY_REG'	=> CURRENT_USER_REGION_ID
		);
		createXlsx($excellSheetRowStructure, $dir, $filter, $yearValue, $yearSectionId, $yearMunicipalitySectionId, $elementsToAdd);
		//municipal all regions
		$filter = array(
			'IBLOCK_TYPE' 	=> 'documents',
			'IBLOCK_ID'	  	=> 24,
			'PROPERTY_YEAR'	=> $resultsYear,
			'SECTION_ID'	=> $yearGenMunicipalitySectionId
		);

		createXlsx($excellSheetRowStructure, $dir, $filter, $yearValue, $yearSectionId, $yearMunicipalitySectionId, $elementsToAdd, $yearGenMunicipalitySectionId,
			true);
	}


	//delete temporary files
	$dir_to_delete = $dir . '/subjects';
    rrmdir($dir_to_delete);


if($debugMode){
	echo 'Добавятся: ' . $Added . '<br>';
	echo 'Не добавятся: ' . $notAdded . '<br>';
	echo '<pre>';
//	print_r($elementsToAdd);
	echo '</pre>';
	exit('<br>***END OF IMPORT **');
}


	if($result){
		$_SESSION['SUCCESS_ALERT'] = true;
		LocalRedirect('subject_results.php?SUCCESS=EDIT&ITEMS_ADDED=' . $new_items_added);
		exit();
	}else{
		$_SESSION['ERROR_ALERT'] = true;
		LocalRedirect('subject_results.php?EDIT_MODE=Y&ELEMENT_ID=' . $elementId . '&ERRORS=' . urlencode(serialize(array(10))) . '&ERROR_CODE=' . urlencode($elem->LAST_ERROR));
		exit();
	}

	?>

<?}else{//endif from file?>
	<?
	$elementId = !empty($_REQUEST['ELEMENT_ID'])?$_REQUEST['ELEMENT_ID']:false;
	if(!$elementId && !$fromFile)LocalRedirect(SITE_SERVER_NAME . '/404.php');

	$errors = array();

	$elementProperties = array(
		'YEAR' 			=> htmlspecialchars(strip_tags($_POST['YEAR'])),
		'SUBJECT' 		=> htmlspecialchars(strip_tags($_POST['SUBJECT'])),
		'CLASS' 		=> htmlspecialchars(strip_tags($_POST['CLASS'])),
		'FIO_TEACH' 	=> htmlspecialchars(strip_tags($_POST['FIO_TEACH'])),
		'MARKS' 		=> htmlspecialchars(strip_tags($_POST['MARKS'])),
		'RANK' 			=> htmlspecialchars(strip_tags($_POST['RANK'])),
		'SCHOOL' 		=> htmlspecialchars(strip_tags($_POST['SCHOOL'])),
		'STATUS' 		=> htmlspecialchars(strip_tags($_POST['STATUS'])),
	);
	$elementData = array(
		'NAME' 					=> htmlspecialchars(strip_tags($_POST['NAME'])),
		'MODIFIED_BY'   		=> $userId
	);

	//edit element
	if(empty($elementData['NAME']))$errors[] 			= 1;
	if(empty($elementProperties['YEAR']))$errors[] 		= 2;
	if(empty($elementProperties['SUBJECT']))$errors[] 	= 3;
	if(empty($elementProperties['CLASS']))$errors[] 	= 4;
	if(empty($elementProperties['FIO_TEACH']))$errors[] = 5;
	if(empty($elementProperties['MARKS']))$errors[] 	= 6;
	if(empty($elementProperties['RANK']))$errors[] 		= 7;
	if(empty($elementProperties['SCHOOL']))$errors[] 	= 8;
	if(empty($elementProperties['STATUS']))$errors[] 	= 9;

	if(count($errors) == 0){
		$el = new CIBlockElement;
		if($el->Update($elementId, $elementData) && $el->SetPropertyValuesEx($elementId, false, $elementProperties) === null){
			$_SESSION['SUCCESS_ALERT'] = true;
			LocalRedirect('subject_results.php?ELEMENT_ID=' . $elementId . '&SUCCESS=EDIT');
		}else{
			$_SESSION['ERROR_ALERT'] = true;
			LocalRedirect('subject_results.php?EDIT_MODE=Y&ELEMENT_ID=' . $elementId . '&ERRORS=' . urlencode(serialize(array(10))));
		}
	}else{
		$_SESSION['ERROR_ALERT'] = true;
		$errors_string = urlencode(serialize($errors));
		LocalRedirect('subject_results.php?EDIT_MODE=Y&ELEMENT_ID=' . $elementId . '&ERRORS=' . $errors_string);
	}

	?>
<?}?>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
