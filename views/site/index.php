<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-md-12">
                <p>
                    <b>USD Rate for date <?= date('d M Y', $usd['date']);?>:</b>
                    <?= $usd['rate'];?>
                </p>
                <p>
                    <b>EUR Rate for date <?=  date('d M Y', $eur['date']);?>:</b>
                    <?= $eur['rate'];?>
                </p>
            </div>
        </div>

    </div>
</div>
