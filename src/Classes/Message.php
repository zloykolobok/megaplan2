<?php
/**
 * Documenttion: https://dev.megaplan.ru/api/API_messages.html
 */


namespace Zloykolobok\Megaplan2\Classes;

use Zloykolobok\Megaplan2\Megaplan;

class Message extends Megaplan
{
    /**
     * Создать сообщение
     *
     * @param string $content - Текст сообщения
     * @param string $subject - Тема сообщения
     * @param string $to - ID пользователя (получателя сообщения). Можно указать получателей через запятую
     * @return void
     */
    public function create(
        string $content,
        string $subject,
        string $to
    )
    {
        $this->auth();

        $params = [];
        $params['Model[Content]'] = $content;
        $params['Model[Subject]'] = $subject;
        $params['Model[To]'] = $to;

        $raw = $this->req->get('/BumsCommonApiV01/Message/create.api',$params);
        $raw = json_decode($raw);

        return $raw;
    }
}