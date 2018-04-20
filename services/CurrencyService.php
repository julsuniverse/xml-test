<?php


namespace app\services;


use app\models\CurrencyRate;
use SimpleXMLElement;
use GuzzleHttp\Client;

class CurrencyService
{
    private $url;
    private $client;

    public function __construct()
    {
        $this->url = 'http://www.sedlabanki.is/xmltimeseries/Default.aspx?DagsFra=LATEST&GroupID=9&Type=xml';
        $this->client = new Client();
    }

    public function getXml()
    {
        $xml = $this->client->request('GET', $this->url);

        $xml = new SimpleXMLElement($xml->getBody());
        $result = $this->getRate($xml);

        //print_r($result);
        $this->save($result);
    }

    private function getRate($xml)
    {
        $result = [];

        foreach ($xml as $currency) {
            if ($currency->FameName == CurrencyRate::USD || $currency->FameName == CurrencyRate::EUR) {
                $res['name'] = (string)$currency->FameName;
                $res['date'] = (string)$currency->TimeSeriesData->Entry->Date;
                $res['value'] = (double)$currency->TimeSeriesData->Entry->Value;

                $result[] = $res;
            }
        }
        return $result;
    }

    private function save($data)
    {
        foreach ($data as $array) {
            /** @var CurrencyRate $currency */
            $currency = CurrencyRate::findByName($array['name']);
            $currency->setValues($array);
            $currency->save();
        }
    }

    public function getCurrentRate()
    {
        $usd = CurrencyRate::find()->where(['code' => CurrencyRate::USD])->limit(1)->one();
        $eur = CurrencyRate::find()->where(['code' => CurrencyRate::EUR])->limit(1)->one();

        return [
            'usd' => $usd,
            'eur' => $eur
        ];
    }
}