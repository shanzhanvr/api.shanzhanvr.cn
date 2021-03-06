<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2018/6/13
 * Time: 13:08
 */
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Merchant\V1\Controllers\Pay','middleware' => ['api.merchant']],function ($api) {
        $api->POST('merchant/pay/receiver', 'RechangePayController@receivePay');//支付回调
        $api->group(['middleware' => ['before' => 'jwt.auth']], function ($api){
            $api->POST('merchant/pay/receivefront', 'RechangePayController@checkOrder');//检查支付订单
            $api->POST('merchant/pay/unified', 'RechangePayController@alipayPay');//下单
        });
    });
});