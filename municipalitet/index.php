<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Муниципалитет " . CURRENT_USER_REGION_NAME);
global $USER;
if (!$USER->IsAuthorized())LocalRedirect("authorize.php");

//if user is regional (for general regional results)
$regionalUserGroupId = 9;
$userGroups = CUser::GetUserGroup($USER->GetID());
$isRegional = in_array($regionalUserGroupId, $userGroups);

?>
<a href="?logout=yes">Выйти из аккаунта | <?=$USER->GetFullName()?> [<?=$USER->GetLogin()?>]</a>
<ul>
    <?if(!$isRegional):?>
        <li><a href="jury.php">Жюри муниципалитета</a></li>
        <li><a href="norm.php">Нормативная база</a></li>
    <?endif;?>
	<li><a href="subject_results.php">Результаты олимпиад</a></li>
</ul><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>