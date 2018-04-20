<?php

namespace app\commands;

use yii\console\Controller;

class CurrencyController extends  Controller
{
    public function actionIndex()
    {
        $client = new \GuzzleHttp\Client();
        $url = 'http://www.sedlabanki.is/xmltimeseries/Default.aspx?DagsFra=LATEST&GroupID=9&Type=xml';
        $res = $client->request('GET', $url);
        echo $res->getBody();
    }
}