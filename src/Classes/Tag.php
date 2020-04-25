<?php


namespace Zloykolobok\Megaplan2\Classes;


use Zloykolobok\Megaplan2\Megaplan;

class Tag extends Megaplan
{
    /**
     * Назначение меток
     * @param string $subjectType - Тип объекта: task (задача), project (проект), можно contractor (клиент) (но нет в доке)
     * @param array $subjectIds - Массив из идентификаторов объектов, которые нужно пометить
     * @param array $tagIds - Массив идентификаторов меток
     * @return mixed
     * @throws \Zloykolobok\Megaplan2\Exception\ConnectionException
     */
    public function assign(string $subjectType, array $subjectIds, array $tagIds)
    {
        $this->auth();

        $params = [];
        $params['SubjectType'] = $subjectType;
        $params['SubjectIds'] = $subjectIds;
        $params['TagIds'] = $tagIds;

        $raw = $this->req->post('/BumsCommonApiV01/Tags/assign.api',$params);

        $raw = json_decode($raw);

        return $raw;
    }

    /**
     * Список меток
     * @param string $subjectType - Тип объекта task (задача), project (проект), event
     * @param bool $includeGlobal - Нужно ли включать в список меток глобальные метки
     * @return mixed
     * @throws \Zloykolobok\Megaplan2\Exception\ConnectionException
     */
    public function list(string $subjectType, bool $includeGlobal = true)
    {
        $this->auth();

        $params = [];
        $params['SubjectType'] = $subjectType;
        $params['IncludeGlobal'] = $includeGlobal;

        $raw = $this->req->post('/BumsCommonApiV01/Tags/list.api',$params);

        $raw = json_decode($raw);

        return $raw;
    }
}
