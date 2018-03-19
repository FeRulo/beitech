<?php

    $app->get('/Product/listProducts/:idee/', function($idee){
            $bll = new Product();
            $r = $bll->getProducts($idee);
            echo json_encode($r);
      });
?>