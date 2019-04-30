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
    public function create(string $subjectType, int $subjectId, string $text, $file = null, int $work = null)
    {
        $this->auth();

        $params = [];
        $params['SubjectType'] = $subjectType;
        $params['SubjectId'] = $subjectId;
        $params['SubjectId'] = $subjectId;
        $params['Model[Text]'] = $text;
        $params['Model[Attaches]'][] = $file;
        $params['Model[Work]'] = $work;

        $raw = $this->req->post('/BumsCommonApiV01/Comment/create.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }

    /**
     * Список комментариев по задаче/проекту/клиенту/сделке/делу/переписке
     *
     *
     * @param $subjectType - string
     *      task (задача), project (проект), contractor (клиент),
     *      deal (сделка), item(дело), discuss(переписка) - Тип комментируемого объекта
     * @param $subjectId - integer - ID комментируемого объекта
     * @param $timeUpdated - string	Дата/время в одном из форматов ISO 8601 -
     *      Возвращать только те объекты, которые были изменены после указанный даты
     * @param $order - asc (по возрастанию), desc (по убыванию) -
     *      Направление сортировки по дате (по умолчанию asc)
     * @param $textHtml - bool - Возвращать ли комментарий в Html формате (по умолчанию false)
     * @param $unreadOnly - bool - Возвращает только непрочитанные комментарии если true, по умолчанию false
     * @param $limit - integer - Сколько выбрать комментариев (LIMIT)
     * @param $offset - integer - Начиная с какого выбирать комментарии (OFFSET)
     * @param bool $droppedOnly - true	Возвращать только удаленные комментарии
     * @return mixed
     * @throws \Zloykolobok\Megaplan2\Exception\ConnectionException
     */
    public function list(
        $subjectType,
        $subjectId,
        $timeUpdated,
        $order,
        $textHtml,
        $unreadOnly,
        $limit,
        $offset,
        $droppedOnly = false
    )
    {
        $this->auth();

        $params = [];
        $params['SubjectType'] = $subjectType;
        $params['SubjectId'] = $subjectId;
        if(!is_null($timeUpdated)) {
            $params['TimeUpdated'] = $timeUpdated;
        }
        if(!is_null($order)){
            $params['Order'] = $order;
        }

        if(!is_null($textHtml)){
            $params['TextHtml'] = $textHtml;
        }

        if(!is_null($unreadOnly)){
            $params['UnreadOnly'] = $unreadOnly;
        }

        if(!is_null($limit)){
            $params['Limit'] = $limit;
        }

        if(!is_null($offset)){
            $params['Offset'] = $offset;
        }

        $params['DroppedOnly'] = $droppedOnly;

        $raw = $this->req->post('/BumsCommonApiV01/Comment/list.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }
}