<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Context,
    Bitrix\Main\Type\DateTime,
    Bitrix\Main\Loader,
    Bitrix\Iblock;

class YmapDetail extends CBitrixComponent
{
    /**
     * Возвращает массив точек на карте
     * @return array
     */
    protected function getData() : array
    {
        \Bitrix\Main\Loader::includeModule('iblock');

        $items = \Bitrix\Iblock\Elements\ElementYmapTable::getList([
            'select' => ['NAME', 'PHONE_VALUE' => 'PHONE.VALUE', 'EMAIL_VALUE' => 'EMAIL.VALUE', 'LATITUDE_VALUE' => 'LATITUDE.VALUE', 'LONGITUDE_VALUE' => 'LONGITUDE.VALUE', 'CITY_VALUE' => 'CITY.VALUE']
        ]);

        return ($items) ? $items->fetchAll() : [];
    }

    public function executeComponent()
    {
        if($this->startResultCache())
        {
            $this->arResult['ITEMS'] = $this->getData();

            $this->includeComponentTemplate();
        }

        return $this->arResult['ITEMS'];
    }
}
?>