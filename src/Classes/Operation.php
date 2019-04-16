<?php
/**
 * Documenttion: https://dev.megaplan.ru/api/API_finance.html
 */


namespace Zloykolobok\Megaplan2\Classes;

use Zloykolobok\Megaplan2\Megaplan;


class Operation extends Megaplan
{
    /**
     * Создание/редактирование операции
     *
     * @param [type] $id - integer	ID операции	Если не указан, то будет создана новая операция
     * @param [type] $operationType - integer	ID типа операции
     * @param [type] $sum - object(Value, Currency)	Сумма
     * @param [type] $secondarySum - object(Value, Currency)	Дополнительная сумма
     * @param [type] $realAccount - integer	ID расчетного счета
     * @param [type] $contractor - integer	ID клиента
     * @param [type] $invoice - integer	ID счета
     * @param [type] $description - string	описание
     * @param [type] $date - datetime	Время операции
     * @param [type] $controlDate - datetime	Контрольное время
     * @param [type] $kind - boolean Если расход обязательно true
     * @return void
     */
    public function save($id, $operationType, $sum, $secondarySum, $realAccount, $contractor, $invoice, $description, $date, $controlDate, $kind = false)
    {
        $this->auth();

        $params = [];
        if(!is_null($id))
            $params['Id'] = $id;
        if(!is_null($operationType))
            $params['Model[OperationType]'] = $operationType;
        if(!is_null($sum)) {
            $params['Model[Sum][Value]'] = $sum['value'];
            $params['Model[Sum][Currency]'] = 1;
        }
        if(!is_null($secondarySum)){
            $params['Model[SecondarySum][Value]'] = $secondarySum['value'];
            $params['Model[SecondarySum][Currency]'] = 1;
        }

        if(!is_null($realAccount))
            $params['Model[RealAccount]'] = $realAccount;
        if(!is_null($contractor))
            $params['Model[Contractor]'] = $contractor;
        if(!is_null($invoice))
            $params['Model[Invoice]'] = $invoice;
        if(!is_null($date))
            $params['Model[Date]'] = $date;
        if(!is_null($controlDate))
            $params['Model[ControlDate]'] = $controlDate;

        if(!is_null($description))
            $params['Model[Description]'] = $description;

        if($kind)
            $params['Model[Kind]']='expense';


        $raw = $this->req->post('/BumsFinApiV01/Operation/save.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }

    /**
     * Список типов операций
     *
     * @return void
     */
    public function typeOperation()
    {
        $this->auth();
        $params = [];

        $raw = $this->req->post('/BumsFinApiV01/OperationType/list.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }


    /**
     * Карточка операции
     *
     * @param [type] $id - integer	ID операции
     * @return void
     */
    public function card($id)
    {
        $this->auth();
        $params = [];

        // $params['Id'] = $id;
        // $raw = $this->req->post('/BumsFinApiV01/Operation/card.api',$params);
        // $raw = $this->req->post('/BumsFinApiV01/RealAccount/list.api',$params);
        $raw = $this->req->post('/BumsFinApiV01/Operation/list.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }

    /**
     * Список операций
     *
     * @return void
     */
    public function operationList()
    {
        $this->auth();
        $params = [];

        $raw = $this->req->post('/BumsFinApiV01/Operation/list.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }

    /**
     * Список счетов
     *
     * @return void
     */
    public function realAccountList()
    {
        $this->auth();
        $params = [];

        $raw = $this->req->post('/BumsFinApiV01/Operation/list.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }

    /**
     * Удаление операции
     *
     * @param [type] $id
     * @return void
     */
    public function operationDelete($id)
    {
        $this->auth();
        $params = [];
        $params['Id'] = $id;

        $raw = $this->req->post('/BumsFinApiV01/Operation/delete.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }
}