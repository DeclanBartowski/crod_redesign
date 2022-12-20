<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
ini_set("memory_limit", "1024M");
set_time_limit(200);
function Out($var){
    echo '<pre style="color:white; background: black; padding: 10px; font-size: 12px; margin:10px;">';
    print_r($var);
    echo '</pre>';
}

/**
* compares results and return true if the matched or false if not matched
 **/
function compareResults($res1, $res2){
    return (
        $res1['NAME'] == $res2['NAME'] &&
        $res1['PROPERTY_SUB_VALUE'] == $res2['PROPERTY_SUB_VALUE'] &&
        $res1['PROPERTY_FIO_TEACH_VALUE'] == $res2['PROPERTY_FIO_TEACH_VALUE'] &&
        $res1['PROPERTY_CLASS_VALUE'] == $res2['PROPERTY_CLASS_VALUE'] &&
        $res1['PROPERTY_MARKS_VALUE'] == $res2['PROPERTY_MARKS_VALUE'] &&
        $res1['PROPERTY_RANK_VALUE'] == $res2['PROPERTY_RANK_VALUE'] &&
        $res1['PROPERTY_STATUS_VALUE'] == $res2['PROPERTY_STATUS_VALUE']

    );
}



$subjectKey = $_REQUEST['SUBJECT_KEY'];

if(empty($subjectKey))exit('Sorry... you got the wrong way');

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
    $iSub++;
}
if(empty($arSubjectsOnly[$subjectKey])){
    Out('Неправильный ключ предмета');
    Out($arSubjectsOnly);
    exit();
}

function synchroniseMunicipalAndGenSections($subjectID){
    $municipalResults  = array();
    $generalResults = array();

    $municipalFilter = array(
        'IBLOCK_ID'             => 24,
        'SECTION_ID'            => array(197),
        'PROPERTY_SUB'          => array($subjectID)
    );

    $resMunicipal = CIBlockElement::GetList(
        array("SORT"=>"ASC"),
        $municipalFilter,
        false,
        false,
        array('IBLOCK_ID',
            'ID',
            'NAME',
            'CODE',
            'PROPERTY_SUB',
            'PROPERTY_REG',
            'PROPERTY_FIO_TEACH',
            'PROPERTY_CLASS',
            'PROPERTY_CLASS_NUM',
            'PROPERTY_BIRTHDATE',
            'PROPERTY_SCHOOL',
            'PROPERTY_RANK',
            'PROPERTY_MARKS',
            'PROPERTY_MARKS_NUM',
            'PROPERTY_STATUS',
            'PROPERTY_YEAR',
            'PROPERTY_SEX',
            'PROPERTY_CITIZENSHIP',
            'PROPERTY_SCHOOL_FULL')
    );
    while($nextMunicipal = $resMunicipal->GetNext()){
        $municipalResults[] = $nextMunicipal;
    }


    $generalFilter = array(
        'IBLOCK_ID'             => 24,
        'SECTION_ID'            => array(196),
        'PROPERTY_SUB'          => array($subjectID)
    );

    $resGeneral = CIBlockElement::GetList(
        array("SORT"=>"ASC"),
        $generalFilter,
        false,
        false,
        array('IBLOCK_ID', 'ID', 'NAME', 'CODE', 'PROPERTY_SUB', 'PROPERTY_REG', 'PROPERTY_FIO_TEACH', 'PROPERTY_CLASS', 'PROPERTY_BIRTHDATE', 'PROPERTY_SCHOOL', 'PROPERTY_RANK', 'PROPERTY_MARKS', 'PROPERTY_STATUS')
    );
    while($nextGeneral = $resGeneral->GetNext()){
        $generalResults[] = $nextGeneral;
    }


    $el = new CIBlockElement;
    $newElems = array();
    $mismatchesCount = 0;
    foreach($municipalResults as $municipalResult){
        $match = false;
        $mismatcedResult = array();
        foreach ($generalResults as $generalResult){
            if(compareResults($municipalResult, $generalResult)){
                $match = true;
                break;
            }
        }
        if(!$match){
            $newElemFields = array(
                'IBLOCK_ID'			=> 24,
                'NAME' 				=> $municipalResult['NAME'],
                'CODE' 				=> Cutil::translit($municipalResult['NAME'],"ru",array("replace_space"=>"-","replace_other"=>"-")) . time() . rand(0, 999),
                'IBLOCK_SECTION'	=> array(194, 196),
                'PROPERTY_VALUES' 	=> array(
                    'YEAR' 				=> $municipalResult['PROPERTY_YEAR_VALUE'],
                    'SUB' 				=> $municipalResult['PROPERTY_SUB_VALUE'],
                    'CLASS' 			=> $municipalResult['PROPERTY_CLASS_VALUE'],
                    'CLASS_NUM' 		=> (int)$municipalResult['PROPERTY_CLASS_NUM_VALUE'],
                    'FIO_TEACH' 		=> $municipalResult['PROPERTY_FIO_TEACH_VALUE'],
                    'MARKS' 			=> (float)$municipalResult['PROPERTY_MARKS_VALUE'],
                    'MARKS_NUM' 		=> (int)$municipalResult['PROPERTY_MARKS_NUM_VALUE'],
                    'RANK' 				=> $municipalResult['PROPERTY_RANK_VALUE'],
                    'SCHOOL' 			=> $municipalResult['PROPERTY_SCHOOL_VALUE'],
                    'STATUS' 			=> $municipalResult['PROPERTY_STATUS_VALUE'],
                    'REG'				=> $municipalResult['PROPERTY_REG_VALUE'],
                    'BIRTHDATE'			=> $municipalResult['PROPERTY_BIRTHDATE_VALUE'],
                    'SEX'				=> $municipalResult['PROPERTY_SEX_VALUE'],
                    'CITIZENSHIP'		=> $municipalResult['PROPERTY_CITIZENSHIP_VALUE'],
                    'SCHOOL_FULL'		=> $municipalResult['PROPERTY_SCHOOL_FULL_VALUE']
                ),
            );


            if($_REQUEST['COPY'] == 'Y'){
                if($id = $el->Add($newElemFields)){
                    Out("Резултата \"" . $municipalResult['NAME'] . "\" не было, успешно добавлено");
                }else{
                    Out("Резултата \"" . $municipalResult['NAME'] . "\" не было, при добавлении произошла ошибка. Текст ошибки: " . $el->LAST_ERROR);
                }
            }else{
                $newElems[] = $newElemFields;
            }


            $mismatchesCount++;
            //Out("There is no result with name \"" . $municipalResult['NAME'] . "\" in general section");
        }
    }



//Out($generalResults);


    Out('GEN: ' . count($generalResults));
    Out('MUNICIPAL: ' . count($municipalResults));

    Out('MISSED: ' . $mismatchesCount . ' ITEMS');

/*    Out('SUBJECT_KEY: ' . $subjectKey);
    Out('SUBJECT_NAME: ' . $arSubjectsOnly[$subjectKey]['NAME']);*/



    Out("MISSED ELEMENT DATA &#8595");
    Out($newElems);
}






if($_REQUEST['LAUNCH_ALL_SUBJECTS'] =='Y'){
    foreach ($arSubjectsOnly as $key => $subject){
        echo $key . '<br>';
        synchroniseMunicipalAndGenSections($subject['ID']);
    }
}else{
    synchroniseMunicipalAndGenSections($arSubjectsOnly[$subjectKey]['ID']);
}

Out($arSubjectsOnly);


?>
