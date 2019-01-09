<?php
/**
 * Documenttion: https://dev.megaplan.ru/api/API_deals.html
 */


namespace Zloykolobok\Megaplan2\Classes;

use Zloykolobok\Megaplan2\Megaplan;

class Deal extends Megaplan
{
    /**
     * Получаем список полей для схемы
     * https://dev.megaplan.ru/api/API_deals.html#api-deal-available-fields-list
     *
     * @param integer $program_id - ID схемы
     * @return void
     */
    public function listFields(int $program_id)
    {
        $this->auth();

        $params = [];
        $params['ProgramId'] = $program_id;

        $raw = $this->req->get('/BumsTradeApiV01/Deal/listFields.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }

    /**
     * Список схем сделок
     * https://dev.megaplan.ru/api/API_deals.html#id13
     *
     * @param [type] $limit - Сколько выбрать объектов (LIMIT)
     * @param [type] $offset - Начиная с какого порядкового номера выбирать объекты (OFFSET)
     * @return void
     */
    public function programList($limit = null, $offset = null)
    {
        $this->auth();

        $params = [];
        if(!is_null($limit)){
            $params['Limit'] = $limit;
        };

        if(!is_null($offset)){
            $params['Offset'] = $offset;
        };

        $raw = $this->req->get('/BumsTradeApiV01/Program/list.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }

    /**
     * Карточка сделки
     * https://dev.megaplan.ru/api/API_deals.html#api-deals-card
     *
     * @param integer $deal_id - ID сделки
     * @param [type] $requestedFields - Запрашиваемые поля ( меняет набор полей по умолчанию )
     * @param [type] $extraFields - Дополнительные поля ( дополняют набор полей по умолчанию )
     * @return void
     */
    public function card(int $deal_id, $requestedFields = null, $extraFields = null)
    {
        $this->auth();

        $params = [];
        $params['Id'] = $deal_id;
        $params['RequestedFields'] = $requestedFields;
        $params['ExtraFields'] = $extraFields;

        $raw = $this->req->get('/BumsTradeApiV01/Deal/card.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }

    /**
     * Список сделок
     * https://dev.megaplan.ru/api/API_deals.html#id9
     *
     * @param [type] $filterId - ID Идентификатор фильтра
     * @param [type] $filters - Массив параметров для фильтрации в формате поле => значение
     * @param [type] $requestedFields - Запрашиваемые поля ( меняет набор полей по умолчанию )
     * @param [type] $extraFields - Запрашиваемые поля ( меняет набор полей по умолчанию )
     * @param [type] $limit - Сколько выбрать объектов (LIMIT)
     * @param [type] $offset - Начиная с какого выбирать объекты (OFFSET)
     * @return void
     */
    public function list($filterId = null, $filters = null, $requestedFields = null, $extraFields = null, $limit = null, $offset = null)
    {
        $this->auth();
        $params = [];
        $params['FilterId'] = $filterId;
        $params['FilterFields'] = $filters;
        $params['RequestedFields'] = $requestedFields;
        $params['ExtraFields'] = $extraFields;
        $params['Limit'] = $limit;
        $params['Offset'] = $offset;

        $raw = $this->req->get('/BumsTradeApiV01/Deal/list.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }

    public function save(
        $id, $program_id, $status_id, $strict_logic, $manager_id, $contractor_id, $contact_id,
        $auditors, $description, $paid_value, $paid_rate, $paid_currency, $cost_value, $cost_rate,
        $cost_currency, $files, $customs, $positions
    )
    {
        $this->auth();

        $params = [];

        if(!$id){
            $params['Id'] = $id;
        }

        $params['ProgramId'] = $program_id;
        $params['StatusId'] = $status_id;
        $params['StrictLogic'] = $strict_logic;
        $params['Model[Manager]'] = $manager_id;
        $params['Model[Contractor]'] = $contractor_id;
        $params['Model[Contact]'] = $contact_id;
        $params['Model[Auditors]'] = $auditors;
        $params['Model[Description]'] = $description;
        $params['Model[Paid][Value]'] = $paid_value;
        $params['Model[Paid][Rate]'] = $paid_rate;
        $params['Model[Paid][Currency]'] = $paid_currency;
        $params['Model[Cost][Value]'] = $cost_value;
        $params['Model[Cost][Rate]'] = $cost_rate;
        $params['Model[Cost][Currency]'] = $cost_currency;

        // $files = [
        //     '<имя поля>' => [
        //          ['Name','Content'],
        //     ]
        // ]

        foreach ($files as $field => $file){
            foreach($file as $key=>$f){
                $params['Model['.$field.'][Add]['.$key.'][Content]'] = $f[1];
                $params['Model['.$field.'][Add]['.$key.'][Name]'] = $f[0];
            }
        }

        //кастомные поля <имя поля> => <значение поля>
        foreach ($customs as $key => $value) {
            $this->params['Model['.$key.']'] = $value;
        }

        $params['Positions'] = $positions;

        $raw = $this->req->post('/BumsTradeApiV01/Deal/save.api',$this->params);
        $raw = json_decode($raw);

        return $raw;
    }
}
