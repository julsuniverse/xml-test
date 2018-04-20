<?php


namespace app\services;


class CurrencyService
{
    private $url = 'http://www.sedlabanki.is/xmltimeseries/Default.aspx?DagsFra=LATEST&GroupID=9&Type=xml';

    public function getXml()
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $this->url);
        echo $res->getBody();
    }
}