<?php


namespace app\models;

use yii\db\ActiveRecord;

class CurrencyRate extends ActiveRecord
{
    const USD = 'USD.ISK.OVMI.S.D';
    const EUR = 'EUR.ISK.OVMI.S.D';

    public function rules()
    {
        return [
            [['date', 'code'], 'string'],
            [['date', 'code', 'rate'], 'required'],
            ['rate', 'double']
        ];
    }

    public function setValues($data)
    {
        $this->date = date('U');
        $this->code = $data['name'];
        $this->rate = $data['value'];
        return $this;
    }

    public static function findByName($name)
    {
        return self::find()->where(['code' => $name])->limit(1)->one();
    }
}