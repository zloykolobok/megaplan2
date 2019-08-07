<?php

namespace Zloykolobok\Megaplan2\Classes;
use Zloykolobok\Megaplan2\Megaplan;


class File extends Megaplan
{
    public function getFile($url)
    {
        $this->auth();
        $params = [];

        $raw = $this->req->get('/BumsCommonApiV01/File/downloadAttach?url='.$url,$params);

        return $raw;
    }
}