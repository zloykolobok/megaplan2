<?php
/**
 * Documenttion: https://dev.megaplan.ru/api/API_comments.html
 */


namespace Zloykolobok\Megaplan2\Classes;

use Zloykolobok\Megaplan2\Megaplan;

class Comment extends Megaplan
{
    /**
     * Создание комментария
     *
     * @param string $subjectType - Тип комментируемого объекта: task (задача),
     * project (проект), contractor (клиент), deal (сделка), discuss (обсуждение)
     * @param integer $subjectId - ID комментируемого объекта
     * @param string $text - Текст комментария
     * @param integer $work
     * @return void
     */
    public function create(string $subjectType, int $subjectId, string $text, int $work = null)
    {
        $this->auth();

        $params = [];
        $params['SubjectType'] = $subjectType;
        $params['SubjectId'] = $subjectId;
        $params['SubjectId'] = $subjectId;
        $params['Model[Text]'] = $text;
        $params['Model[Work]'] = $work;

        $raw = $this->req->pot('/BumsCommonApiV01/Comment/create.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }
}