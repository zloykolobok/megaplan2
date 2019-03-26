<?php
/**
 * Documenttion: https://dev.megaplan.ru/api/API_payers.html
 */


namespace Zloykolobok\Megaplan2\Classes;

use Zloykolobok\Megaplan2\Megaplan;

class Payer extends Megaplan
{
    /**
     * Создание / редактирование плательщика
     *
     * @param [type] $contractorId - ID клиента, к которому относится плательщик
     * @param [type] $payerId - ID плательшика. Если не указан, то будет создан новый плательщик
     * @param [type] $payerType - Тип клиента: Natural (физическое лицо) — по умолчанию, Legal (юридическое лицо)
     * @param [type] $payerCountry - Двухзначный код страны (RU, UA, KZ и др.), по умолчанию — страна, указанная в настройках аккаунта
     * @param [type] $firstName - Имя (для физического лица)
     * @param [type] $lastName - Фамилия (для физического лица)
     * @param [type] $naturalInn - ИНН плательщика (для физического лица)
     * @param [type] $name - Наименование организации (для юридического лица)
     * @param [type] $inn - ИНН плательщика (для юридического лица)
     * @param [type] $kpp - КПП плательщика (для юридического лица)
     * @param [type] $legalAddress - Юридический адрес (для юридического лица)
     * @param [type] $address - Фактический адрес (для юридического лица)
     * @param [type] $ogrn - ОГРН (для юридического лица)
     * @param [type] $currentAccount - Номер счета (для юридического лица)
     * @param [type] $bank - Наименование банка (для юридического лица)
     * @param [type] $correspondentAccount - Номер корреспонденского счета (для юридического лица)
     * @param [type] $bik - Бик (для юридического лица)
     * @return void
     */
    public function save($contractorId, $payerId, $payerType, $payerCountry, $firstName, $lastName, $naturalInn,
        $name, $inn, $kpp, $legalAddress, $address, $ogrn, $currentAccount, $bank, $correspondentAccount, $bik
    )
    {
        $this->auth();

        $params = [];

        if(!is_null($contractorId))
            $params['ContractorId'] = $contractorId;
        if(!is_null($payerId))
            $params['PayerId'];
        if(!is_null($payerType))
            $params['PayerType'] = $payerType;
        if(!is_null($payerCountry))
            $params['PayerCountry'] = $payerCountry;
        if(!is_null($firstName))
            $params['Model[FirstName]'] = $firstName;
        if(!is_null($lastName))
            $params['Model[LastName]'] = $lastName;
        if(!is_null($naturalInn))
            $params['Model[NaturalInn]'] = $naturalInn;
        if(!is_null($name))
            $params['Model[Name]'] = $name;
        if(!is_null($inn))
            $params['Model[Inn]'] = $inn;
        if(!is_null($kpp))
            $params['Model[Kpp]'] = $kpp;
        if(!is_null($legalAddress))
            $params['Model[LegalAddress]'] = $legalAddress;
        if(!is_null($address))
            $params['Model[Address]'] = $address;
        if(!is_null($ogrn))
            $params['Model[Ogrn]'] = $ogrn;
        if(!is_null($currentAccount))
            $params['Model[CurrentAccount]'] = $currentAccount;
        if(!is_null($bank))
            $params['Model[Bank]'] = $bank;
        if(!is_null($correspondentAccount))
            $params['Model[CorrespondentAccount]'] = $correspondentAccount;
        if(!is_null($bik))
            $params['Model[Bik]'] = $bik;

        $raw = $this->req->post('/BumsCrmApiV01/Payer/save.api',$params);
        $raw = json_decode($raw);

        return $raw;

    }


    /**
     * Список плательщиков
     *
     * @param [type] $extraFields - Список системных имен дополнительных полей ( см. https://help.megaplan.ru/API_payer_fieldslist )
     * @param [type] $contractorId - Идентификатор клиента
     * @param [type] $inn - ИНН плательщика
     * @param boolean $droppedOnly - Если true, вернутся только удаленные плательщики
     * @return void
     */
    public function list($extraFields, $contractorId, $inn, $droppedOnly = false)
    {
        $this->auth();

        $params = [];

        if(!is_null($extraFields))
            $params['ExtraFields'] = $extraFields;
        if(!is_null($contractorId))
            $params['FilterFields[Contractor]'] = $contractorId;
        if(!is_null($inn))
            $params['FilterFields[Inn]'] = $inn;
        $params['DroppedOnly'] = $droppedOnly;

        $raw = $this->req->post('/BumsCrmApiV01/Payer/list.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }
}