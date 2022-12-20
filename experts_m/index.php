<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Жюри");
CModule::IncludeModule('iblock');

?><div id="wrp">
	 <?
        if(isset($_REQUEST['id_sub']) && $_REQUEST['id_sub'] !== ""){
        $title = "Жюри по ";
        if ($_REQUEST["AJAX"] == "Y") $APPLICATION->RestartBuffer();
        $arSelect = Array("ID", "IBLOCK_ID", "NAME");
        $arFilter = Array("IBLOCK_ID"=>9, "=ID" => $_REQUEST['id_sub']);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount"=>1), $arSelect);

        if($res->SelectedRowsCount()){
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $title .= $arFields['NAME'];
        }

        $APPLICATION->SetTitle($title);
        $APPLICATION->AddChainItem(HTMLToTxt($title));
        ?>
	<div class="result__table-wrapper">
		 <?
                if($_REQUEST['NEWS_COUNT']) $num_page = $_REQUEST['NEWS_COUNT'];
                else $num_page = 20;
                $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT", "DATE_ACTIVE_FROM", "PROPERTY_*", "PROPERTY_REG.NAME");
                $arFilter = Array("IBLOCK_ID" => 11, "=PROPERTY_SUB" => $_REQUEST['id_sub']);
                $res = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter, false, Array("nPageSize" => $num_page), $arSelect);
                $NAV_STRING = $res->GetPageNavStringEx($navComponentObject, 'Заголовок', 'mm_pag', 'Y');
                if(!$res->SelectedRowsCount()) fun404();
                while ($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    $arProps = $ob->GetProperties();
                    echo "<tr>";
                    echo "<td>{$arFields['NAME']}</td>";
                    echo "<td>{$arFields['~PREVIEW_TEXT']}</td>";
                    echo "<td>{$arFields['PROPERTY_REG_NAME']}</td>";
                    echo "</tr>";
                }
                ?>
		<table class="result__table">
		<thead>
		<tr>
			<td class="result__balls">
				 Имя
			</td>
			<td class="result__place">
				 Место работы
			</td>
			<td class="result_balls">
				 Муниципалитет
			</td>
		</tr>
		</thead>
		<tbody>
		</tbody>
		</table>
		 <?=$NAV_STRING; ?> <script>var page_num = "<?=$res->NavPageNomer?>";</script>
	</div>
	 <script>
            var page = "<?=$APPLICATION->GetCurPage(false)?>";
            var news_count = <?=$num_page?>;
            var news_count_option = <?=$num_page?>;
            var dir_section = '/experts_m/?id_sub=<?=$_REQUEST['id_sub']?>';
        </script> <script>
            function mm_createElement(t) {
                return;
            }

            $(document).ready(function() {

                $(document).on('change', '#_select', function (e) {
                    var select_val = $(this).val();
                    ajax_section(news_count,select_val);
                });

                $(document).on('click', '#mm_button_add', function (e) {
                    news_count = news_count + news_count_option;
                    ajax_section(news_count,page_num);
                });

                function ajax_section(news_count,page_num) {
                    $.ajax({
                        url: page,
                        method: "get",
                        data: {
                            AJAX: "Y",
                            NEWS_COUNT: news_count,
                            PAGEN_1: page_num,
                            id_sub: "<?=$_REQUEST['id_sub']?>"
                        },
                        beforeSend: function () {
                            $('#wrp').fadeOut(200);
                        },
                        error: function () {
                            alert("Ошибка запроса");
                        },
                        success: function (result) {
                            console.log(result);
                            $('#wrp').html(result).fadeIn(200);
                            $(".mm_select select").styler();
                            window.history.pushState(null, null, dir_section + "&PAGEN_1=" + page_num);
                        }
                    })
                }
            });
        </script> <?
            if ($_REQUEST["AJAX"] == "Y") die;
            }else{
                $title = "Нет такого предмета";
                $APPLICATION->SetTitle($title);
                $APPLICATION->AddChainItem(HTMLToTxt($title));
            }
        }else{
            $title = "Нет такого предмета";
            $APPLICATION->SetTitle($title);
            $APPLICATION->AddChainItem(HTMLToTxt($title));
        }
        ?>
</div>
<br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>