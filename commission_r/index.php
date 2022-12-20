<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Комиссия");
CModule::IncludeModule('iblock');

?>    <div id="wrp">
        <?
        if(isset($_REQUEST['id_sub']) && $_REQUEST['id_sub'] !== ""){
        $title = "Комиссия по предмету ";
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

        <div class="result__table-wrapper"  >

            <table class="result__table">
                <thead>
                <tr>
                    <td class="result__balls">Имя</td>
                    <td class="result__place">Место работы</td>
                </tr>
                </thead>
                <tbody>

                <?
                if($_REQUEST['NEWS_COUNT']) $num_page = $_REQUEST['NEWS_COUNT'];
                else $num_page = 20;
                $arSelect2 = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT", "DATE_ACTIVE_FROM", "PROPERTY_*");
                $arFilter2 = Array("IBLOCK_ID" => 16, "=PROPERTY_SUB" => $_REQUEST['id_sub']);
                $res2 = CIBlockElement::GetList(Array("NAME" => "ASC"), $arFilter2, false, Array("nPageSize" => $num_page), $arSelect2);
                $NAV_STRING = $res2->GetPageNavStringEx($navComponentObject, 'Заголовок', 'mm_pag', 'Y');
                if(!$res2->SelectedRowsCount()) fun404();
                while ($ob2 = $res2->GetNextElement()) {
                    $arFields = $ob2->GetFields();
                    $arProps = $ob2->GetProperties();
                    echo "<tr>";
                    echo "<td>{$arFields['NAME']}</td>";
                    echo "<td>{$arFields['~PREVIEW_TEXT']}</td>";;
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
            <?=$NAV_STRING; ?>
            <script>var page_num = "<?=$res->NavPageNomer?>";</script>

        </div>


        <script>
            var page = "<?=$APPLICATION->GetCurPage(false)?>";
            var news_count = <?=$num_page?>;
            var news_count_option = <?=$num_page?>;
            var dir_section = '/commission_r/?id_sub=<?=$_REQUEST['id_sub']?>';
        </script>

        <script>
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
        </script>
        <?
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

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>