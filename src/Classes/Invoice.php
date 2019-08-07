<?php
/**
 * Documenttion: https://dev.megaplan.ru/api/API_invoices.html#
 */

namespace Zloykolobok\Megaplan2\Classes;
use Zloykolobok\Megaplan2\Megaplan;


class Invoice extends Megaplan
{
    /**
     * Карточка счета
     *
     * @param int $id - ID счета
     * @param array $requestedFields - Запрашиваемые поля ( меняет набор полей по умолчанию )
     * @param array $extraFields - Дополнительные поля ( дополняют набор полей по умолчанию )
     * @return mixed
     * @throws \Zloykolobok\Megaplan2\Exception\ConnectionException
     */
    public function card(int $id, array $requestedFields, array $extraFields)
    {
        $this->auth();

        $params = [];
        $params['Id'] = $id;

        foreach ($requestedFields as $val ){
            $params['RequestedFields'][] = $val;
        }

        foreach ($extraFields as $val){
            $params['ExtraFields'][] = $val;
        }

        $raw = $this->req->get('/BumsInvoiceApiV01/Invoice/card.api',$params);

        $raw = json_decode($raw);

        return $raw;
    }

    /**
     * Удаление счета
     *
     * @param int $id - ID счета
     * @return mixed
     * @throws \Zloykolobok\Megaplan2\Exception\ConnectionException
     */
    public function delete(int $id)
    {
        $this->auth();

        $params = [];
        $params['Id'] = $id;

        $raw = $this->req->get('/BumsInvoiceApiV01/Invoice/delete.api',$params);

        $raw = json_decode($raw);

        return $raw;
    }

    public function list(array $filterFields, array $requestedFields, array $extraFields, int $limit = 100, int $offset = 0)
    {
        $this->auth();

        $params = [];
        foreach ($filterFields as $key => $val){
            $params['FilterFields'][$key] = $val;
        }

        foreach ($requestedFields as $val){
            $params['RequestedFields'][] = $val;
        }

        foreach ($extraFields as $val){
            $params['ExtraFields'][] = $val;
        }

        $params['Limit'] = $limit;
        $params['Offset'] = $offset;

        $raw = $this->req->get('/BumsInvoiceApiV01/Invoice/list.api',$params);

        $raw = json_decode($raw);

        return $raw;
    }
}