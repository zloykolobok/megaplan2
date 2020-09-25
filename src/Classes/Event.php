<?php


namespace Zloykolobok\Megaplan2\Classes;


use Zloykolobok\Megaplan2\Megaplan;

class Event extends Megaplan
{
    /**
     * Карточка события
     * @param int $id - ID события
     * @return mixed
     * @throws \Zloykolobok\Megaplan2\Exception\ConnectionException
     */
    public function card(int $id)
    {
        $this->auth();
        $params = [];
        $params['Id'] = $id;

        $raw = $this->req->post('/BumsTimeApiV01/Event/card.api', $params);
        $raw = json_decode($raw);

        return $raw;
    }

    /**
     * Список категорий события
     * @return mixed
     * @throws \Zloykolobok\Megaplan2\Exception\ConnectionException
     */
    public function categories()
    {
        $this->auth();
        $params = [];

        $raw = $this->req->post('/BumsTimeApiV01/Event/categories.api', $params);
        $raw = json_decode($raw);

        return $raw;
    }

    /**
     * Завершение/возобновление события
     * @param int $id - ID события
     * @param bool $finish - true - завершаем событие
     * @param string $result - результат события
     * @param bool $sendLetter - Отправить результат и прикреплённые файлы участникам. По умолчанию false (не отправлять)
     * @return mixed
     * @throws \Zloykolobok\Megaplan2\Exception\ConnectionException
     */
    public function finish(int $id, bool $finish = true, string $result = '', bool $sendLetter = false)
    {
        $this->auth();
        $params = [];
        $params['Id'] = $id;
        $params['Finish'] = $finish;
        $params['Result'] = $result;
        $params['SendLetter'] = $sendLetter;


        $raw = $this->req->post('/BumsTimeApiV01/Event/categories.api', $params);
        $raw = json_decode($raw);

        return $raw;
    }
}
