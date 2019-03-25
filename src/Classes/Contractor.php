<?php
/**
 * Documenttion: https://dev.megaplan.ru/api/API_contractors.html
 */


namespace Zloykolobok\Megaplan2\Classes;

use Zloykolobok\Megaplan2\Megaplan;


class Contractor extends Megaplan
{
    public function list(int $filterId, int $limit, int $offset, string $qs, string $phone, array $model, bool $droppedOnly = false)
    {
        $this->auth();

        $params = [];
        if(!is_null($filterId))
            $params['FilterId'] = $filterId;
        if(!is_null($limit))
            $params['Limit'] = $limit;
        if(!is_null($offset))
            $params['Offset'] = $offset;
        if(!is_null($qs))
            $params['qs'] = $qs;
        if(!is_null($phone))
            $params['Phone'] = $phone;
        if(!is_null($model)){
            foreach ($model as $key => $value) {
                $params['Model['.$key.']'] = $value;
            }
        }
        $params['DroppedOnly'] = $droppedOnly;

        $raw = $this->req->post('/BumsCrmApiV01/Contractor/list.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }
}