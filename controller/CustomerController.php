<?php

    $app->get('/Customer/listCustomers', function(){
            $bll = new Customer();
            $r = $bll->getCustomers();
            echo json_encode($r);
      });
?>