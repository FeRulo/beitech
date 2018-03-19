<?php

$app->get('/Order/getOrder/:user/:date',function($user, $date){
    $bll = new Order();
    $r = $bll->getOrders($user,$date);
    echo json_encode($r);
});

$app->post('/orders', function () {
    $bll = new Order();
    $r = $bll->postOrders();
    print_r($r);
});

$app->get('/createOrder/:products/:customer/:address', function ($products, $customer, $address) {
    $bll = new Order();
    $r = $bll->createOrder($products,$customer,$address);
    print_r($r);
});

?>