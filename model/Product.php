<?php
class Product {
    
    public function getProducts($customer){
        $conn = openConnection();
        $reg = null;
        $json = null;
        try{
            $sql = "SELECT P.product_id, P.`name`, P.price, P.product_description 
            FROM product P, customer C, customer_permission CP
            WHERE C.customer_id=".$customer." and C.customer_id = CP.customer_id and P.product_id = CP.product_id";
            $reg = mysqli_query($conn, $sql);
            while (($r = mysqli_fetch_array($reg, MYSQLI_ASSOC)) != NULL)
            {
                $json[] = $r;
            }  
        }catch(Exception $ex){
            return null;
        }
        closeConnection($conn);
        return $json;
    }    

}