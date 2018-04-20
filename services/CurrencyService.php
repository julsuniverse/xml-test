<?php


namespace app\services;


use SimpleXMLElement;

class CurrencyService
{
    private $url = 'http://www.sedlabanki.is/xmltimeseries/Default.aspx?DagsFra=LATEST&GroupID=9&Type=xml';

    const USD = 'USD.ISK.OVMI.S.D';
    const EUR = 'EUR.ISK.OVMI.S.D';

    public function getXml()
    {
        $client = new \GuzzleHttp\Client();
        $xml = $client->request('GET', $this->url);

        $xml = new SimpleXMLElement($xml->getBody());
        $result = $this->getRate($xml);

        print_r($result);
    }

    public function getRate($xml)
    {
        $result = [];

        foreach ($xml as $currency) {
            if ($currency->FameName == self::USD || $currency->FameName == self::EUR) {
                $res['name'] = (string)$currency->FameName;
                $res['date'] = (string)$currency->TimeSeriesData->Entry->Date;
                $res['value'] = (string)$currency->TimeSeriesData->Entry->Value;

                $result[] = $res;
            }
        }
        return $result;
    }
}