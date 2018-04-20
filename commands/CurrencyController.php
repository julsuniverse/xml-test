<?php

namespace app\commands;

use app\services\CurrencyService;
use yii\console\Controller;

class CurrencyController extends  Controller
{
    private $currencyService;

    public function __construct(
        $id,
        $module,
        CurrencyService $currencyService,
        array $config = []
    )
    {
        $this->currencyService = $currencyService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $this->currencyService->getXml();
    }
}