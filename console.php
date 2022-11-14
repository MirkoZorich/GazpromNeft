<?php

//title: ИБ
\Bitrix\Main\Loader::includeModule('iblock');

$ibParams = ['fields' => [
    'IBLOCK_TYPE_ID' => 'news',
    'CODE' => 'ymap',
    'API_CODE' => 'ymap',
    'NAME' => 'Карта',
    'ACTIVE' => 'Y',
    'SORT' => 500,
    'LIST_PAGE_URL' => '#SITE_DIR#/ymap/',
    'DETAIL_PAGE_URL' => '#SITE_DIR#/news/#ELEMENT_CODE#/',
    'LID' => 's1',
],
];

$iBlock = \Bitrix\Iblock\IblockTable::add($ibParams);

//title: папка
use Bitrix\Main\IO;
use Bitrix\Main\Application;

$dir = new IO\Directory(Application::getDocumentRoot() . "/ymap/");
if(!$dir->isExists())
    $dir->create();

//title: свойства
\Bitrix\Main\Loader::includeModule('iblock');

$obIBlock = \Bitrix\Iblock\IblockTable::getList(['filter' => ['CODE' => 'ymap']]);

if(!$obIBlock) return;

$iBlockId = $obIBlock->fetch()['ID'];

$ibProps[] = [
    'IBLOCK_ID' => $iBlockId,
    'NAME' => 'Телефон',
    'ACTIVE' => 'Y',
    'CODE' => 'PHONE',
    'PROPERTY_TYPE' => 'S',
];
$ibProps[] = [
    'IBLOCK_ID' => $iBlockId,
    'NAME' => 'Email',
    'ACTIVE' => 'Y',
    'CODE' => 'EMAIL',
    'PROPERTY_TYPE' => 'S',
];
$ibProps[] = [
    'IBLOCK_ID' => $iBlockId,
    'NAME' => 'Широта',
    'ACTIVE' => 'Y',
    'CODE' => 'LATITUDE',
    'PROPERTY_TYPE' => 'S',
];
$ibProps[] = [
    'IBLOCK_ID' => $iBlockId,
    'NAME' => 'Долгота',
    'ACTIVE' => 'Y',
    'CODE' => 'LONGITUDE',
    'PROPERTY_TYPE' => 'S',
];
$ibProps[] = [
    'IBLOCK_ID' => $iBlockId,
    'NAME' => 'Город',
    'ACTIVE' => 'Y',
    'CODE' => 'CITY',
    'PROPERTY_TYPE' => 'S',
];

foreach($ibProps as $prop)
{
    \Bitrix\Iblock\PropertyTable::add($prop);
}

//title: элементы
\Bitrix\Main\Loader::includeModule('iblock');

$obIBlock = \Bitrix\Iblock\IblockTable::getList(['filter' => ['CODE' => 'ymap']]);

if(!$obIBlock) return;

$iBlockId = $obIBlock->fetch()['ID'];

$iblock = \Bitrix\Iblock\Iblock::wakeUp($iBlockId);

$arValues[] = [
    'NAME' => 'Газпромнефть 1',
    'PHONE' => '88007005151',
    'EMAIL' => '1@gpnbonus.ru',
    'LATITUDE' => '55.736936',
    'LONGITUDE' => '37.511938',
    'CITY' => 'Москва'
];
$arValues[] = [
    'NAME' => 'Газпромнефть 2',
    'PHONE' => '88007005151',
    'EMAIL' => '2@gpnbonus.ru',
    'LATITUDE' => '55.761223',
    'LONGITUDE' => '37.744934',
    'CITY' => 'Москва'
];
$arValues[] = [
    'NAME' => 'Газпромнефть 3',
    'PHONE' => '88007005151',
    'EMAIL' => '3@gpnbonus.ru',
    'LATITUDE' => '55.732108',
    'LONGITUDE' => '37.695425',
    'CITY' => 'Москва'
];
$arValues[] = [
    'NAME' => 'Газпромнефть 4',
    'PHONE' => '88007005151',
    'EMAIL' => '4@gpnbonus.ru',
    'LATITUDE' => '55.690897',
    'LONGITUDE' => '37.565957',
    'CITY' => 'Москва'
];

foreach($arValues as $value) {
    $newElement = $iblock->getEntityDataClass()::createObject();

    $newElement->setName($value['NAME']);
    $newElement->setPhone($value['PHONE']);
    $newElement->setEmail($value['EMAIL']);
    $newElement->setLatitude($value['LATITUDE']);
    $newElement->setLongitude($value['LONGITUDE']);
    $newElement->setCity($value['CITY']);
    $newElement->save();
}