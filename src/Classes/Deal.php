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
}
