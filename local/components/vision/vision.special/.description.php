<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); 
$arComponentDescription = array(
	"NAME" => GetMessage('ALIN_VISION_NAME'),
	"DESCRIPTION" => GetMessage('ALIN_VISION_COMPONENT'),
	"PATH" => array(
	"ID" => "special_vision",
	"CHILD" => array(
	"ID" => "vision",
	"NAME" => GetMessage('ALIN_VISION_COMPONENT'),
)
)
);
?>