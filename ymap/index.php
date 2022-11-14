<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>

<?
$APPLICATION->IncludeComponent(
    "test:ymap.detail",
    "",
    []
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
