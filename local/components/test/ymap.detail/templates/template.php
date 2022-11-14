<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$this->addExternalJS("https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=ea93dadc-54ee-47dc-98f5-1ba0b910548f");
$APPLICATION->AddHeadString("<style>html, body, #map {width: 100%; height: 100%; padding: 0; margin: 0;}</style>");
?>
<div id="map"></div>

<script>
    ymaps.ready(function () {
        var data = <?=CUtil::PhpToJSObject($arResult['ITEMS'])?>;
        var arrData = Array.from(data);

        var myMap = new ymaps.Map('map', {
            center: [55.751574, 37.573856],
            zoom: 9
        }, {
            searchControlProvider: 'yandex#search'
        });

        MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
            '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
        );

        arrData.forEach(function(item, i, arr) {
            myPlacemarkWithContent = new ymaps.Placemark([item.LATITUDE_VALUE, item.LONGITUDE_VALUE], {
                hintContent: item.NAME,
                balloonContent: `${item.NAME}
                                 ${item.PHONE_VALUE}
                                 ${item.EMAIL_VALUE}
								 ${item.CITY_VALUE}`,
            }, {
                iconLayout: 'default#imageWithContent',
                iconImageSize: [48, 48],
                iconImageOffset: [-24, -24],
                iconContentOffset: [15, 15],
                iconContentLayout: MyIconContentLayout
            });
            myMap.geoObjects.add(myPlacemarkWithContent);
        });
    });
</script>
