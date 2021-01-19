<?php
/**
 * Documenttion: https://dev.megaplan.ru/api/API_deals.html
 */


namespace Zloykolobok\Megaplan2\Classes;

use Illuminate\Support\Facades\Storage;
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

    /**
     * Редактирование/Создание сделки
     * https://dev.megaplan.ru/api/API_deals.html#api-deals-save
     *
     * @param [type] $id - ID сделки, Если не указан то будет создана новая сделка
     * @param [type] $customName - Название сделки, в схеме должно быть включено поле
     * @param [type] $program_id - ID программы (схемы), Обязательное поле при создании сделки. При редактировании игнорируется.
     * @param [type] $status_id - ID статуса сделки, Если не указан при создании сделки, то подбирается автоматически. Если указан при изменении сделки, то статус сделки будет изменён в зависимости от выставленного параметра StrictLogic.
     * @param [type] $strict_logic - Строгая логика перехода из статуса в статус. По умолчанию: true., Если включена строгая логика, то для перехода в необходимый статус из текущего должен существовать переход, пользователь должен иметь на него права, отработают все триггеры. Если логика не включена, то статус просто изменится и всё.
     * @param [type] $manager_id - Идентификатор пользователя, являющегося менеджером сделки
     * @param [type] $contractor_id - Идентификатор клиента
     * @param [type] $contact_id - Идентификатор контактного лица
     * @param [type] $auditors - Идентификаторы пользователей являющихся аудиторами по сделке, Id перечисляются через запятую (Пример: „1000005,1013202“)
     * @param [type] $description - Описание сделки
     * @param [type] $paid_value - Заплачено (сумма должна быть передана в текущей базовой валюте системы), Актуально только при выставленном счете
     * @param [type] $paid_rate - Стоимость
     * @param [type] $paid_currency - Курс валюты
     * Предварительная стоимость (сумма должна быть передана в текущей базовой валюте системы) Актуально только если в сделке нет товаров
     * @param [type] $cost_value - Стоимость
     * @param [type] $cost_rate - Курс валюты
     * @param [type] $cost_currency - ID валюты
     * @param [type] $files - Файлы
     * @param [type] $customs - Пользовательские поля
     * @param [type] $positions
     * @return void
     */
    public function save(
        $id, $program_id, $status_id, $strict_logic, $manager_id, $contractor_id, $contact_id,
        $auditors, $description, $paid_value, $paid_rate, $paid_currency, $cost_value, $cost_rate,
        $cost_currency, $files, $customs, $positions, $customName = null
    )
    {
        $this->auth();

        $params = [];

        if($id){
            $params['Id'] = $id;
        }

        if($customName){
            $params['Model[CustomName]'] = $customName;
        }

        $params['ProgramId'] = $program_id;
        if($status_id)
            $params['StatusId'] = $status_id;
        if($strict_logic)
            $params['StrictLogic'] = $strict_logic;
        if($manager_id)
            $params['Model[Manager]'] = $manager_id;
        if($contractor_id)
            $params['Model[Contractor]'] = $contractor_id;
        if($contact_id)
            $params['Model[Contact]'] = $contact_id;
        if($auditors)
            $params['Model[Auditors]'] = $auditors;
        if($description)
            $params['Model[Description]'] = $description;
        if($paid_value)
            $params['Model[Paid][Value]'] = $paid_value;
        if($paid_rate)
            $params['Model[Paid][Rate]'] = $paid_rate;
        if($paid_currency)
            $params['Model[Paid][Currency]'] = $paid_currency;
        if($cost_value)
            $params['Model[Cost][Value]'] = $cost_value;
        if($cost_rate)
            $params['Model[Cost][Rate]'] = $cost_rate;
        if($cost_currency)
            $params['Model[Cost][Currency]'] = $cost_currency;



//        $uploadFiles = [];
//            $filesList = ['readme.txt', 'test.txt'];
//            foreach ($filesList as $f) {
//
//                $uploadFiles['Category1000114CustomFieldTehnicheskoeZadanieFayl'][] = [
//                    'Name' => $f,
//                    'Content' => base64_encode(Storage::get('apex/' . $f)),
//                ];
//            }

        foreach ($files as $field => $file){
            foreach($file as $key=>$f){
                $params['Model['.$field.'][Add]['.$key.'][Content]'] = $f['Content'];
                $params['Model['.$field.'][Add]['.$key.'][Name]'] = $f['Name'];
            }
        }

        //кастомные поля <имя поля> => <значение поля>
        foreach ($customs as $key => $value) {
            $params['Model['.$key.']'] = $value;
        }

        $params['Positions'] = $positions;

        $raw = $this->req->post('/BumsTradeApiV01/Deal/save.api',$params);
        $raw = json_decode($raw);
        return $raw;
    }

    /**
     * Привязка сделки или задачи к сделке
     * https://dev.megaplan.ru/api/API_deals.html#api-deal-link
     *
     * @param integer $id - ID сделки
     * @param integer $relatedObjectId - ID связываемого объекта
     * @param string $relatedObjectType - Тип связываемого объекта: deal, task или project
     * @return void
     */
    public function saveRelation(int $id, int $relatedObjectId, string $relatedObjectType)
    {
        $this->auth();
        
        $params = [];

        $params['Id'] = $id;
        $params['RelatedObjectId'] = $relatedObjectId;
        $params['RelatedObjectType'] = $relatedObjectType;

        $raw = $this->req->post('/BumsTradeApiV01/Deal/saveRelation.api', $params);
        $raw = json_decode($raw);

        return $raw;
    }
}
