<?php
/**
 * Documenttion: https://dev.megaplan.ru/api/API_contractors_types.html
 */


namespace Zloykolobok\Megaplan2\Classes;

use Zloykolobok\Megaplan2\Megaplan;


class ContractorType extends Megaplan
{
    /**
     * Список типов
     *
     * @return void
     */
    public function list()
    {
        $this->auth();

        $params = [];


        $raw = $this->req->post('/BumsCrmApiV01/ContractorType/list.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }


    /**
     * Редактирование/Создание типа
     *
     * @param [type] $id - integer	ID типа	Если не указан то будет создан новый тип
     * @param [type] $name - Имя типа	Обязательный параметр при создании нового
     * @return void
     */
    public function save($id, $name)
    {
        $this->auth();
        $params = [];

        if(!is_null($id))
            $params['Id'] = $id;
        $params['Model[Name]'] = $name;

        $raw = $this->req->post('/BumsCrmApiV01/ContractorType/save.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }
}