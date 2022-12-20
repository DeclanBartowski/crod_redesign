<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

if($arResult["NavPageCount"] > 1)
{
?>
    <div class="pages-wrap">
<?

	$bFirst = true;

	if ($arResult["NavPageNomer"] > 1):

		if ($arResult["nStartPage"] > 1):
			$bFirst = false;
			if($arResult["bSavePage"]):
?>
                <a onclick=""  href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1" class="btn button-border">1</a>
<?
			else:
?>
                <a onclick=""  href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="btn button-border">1</a>
<?
			endif;
?>

<?
			if ($arResult["nStartPage"] > 2):
?>
<?
			endif;
		endif;
	endif;

	do
	{
		if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
?>
            <a onclick=""  href="javascript:void(0)" class="btn button-border active"><?=$arResult["nStartPage"]?></a>
<?
		elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
?>
            <a onclick=""  href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="btn button-border"><?=$arResult["nStartPage"]?></a>
<?
		else:
?>
            <a onclick=""  href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" class="btn button-border"><?=$arResult["nStartPage"]?></a>
<?
		endif;
?>
<?
		$arResult["nStartPage"]++;
		$bFirst = false;
	} while($arResult["nStartPage"] <= $arResult["nEndPage"]);

	if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
		if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
			if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):
?>
<?
			endif;
?>
        <a onclick="" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>" class="btn button-border"><?=$arResult["NavPageCount"]?></a>
<?
		endif;
?>

<?
	endif;
?>
    </div>
<?
}
?>
