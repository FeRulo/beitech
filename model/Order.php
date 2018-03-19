<?php
class Order {

    public function postOrders(){
        $conn = openConnection();
        $reg = null;
        $json = null;
        $data = json_decode(file_get_contents('php://input'), true);
        //print_r($data);
        //echo $data["operacion"];
        $products = explode(",", $data["products_id"]);
        if ( count($products) > 5)
        {
            return "you can't select more than 5 products";
        }
        else{            
            try{
                $customer = $data["customer_id"];
                $address = $data["delivery_address"];
                $sql = "INSERT INTO `order` (customer_id, delivery_address) 
                VALUES (".$customer.", '".$address."')";
                $reg = mysqli_query($conn, $sql);
                if (!$reg) return mysqli_error($conn);
                $reg = mysqli_query($conn, "SELECT MAX(order_id) as id FROM `order`");
                $order_id = number_format(mysqli_fetch_array($reg, MYSQLI_ASSOC)['id']);
                $sql = "INSERT INTO `order_detail` (product_id, order_id) VALUES";
                foreach ($products as $product_id) {
                    $sql .= "(".$product_id.", ". $order_id."),";

                }
                $sql = rtrim($sql,",").";";
                $reg = mysqli_query($conn, $sql);
                if (!$reg) return mysqli_error($conn);
                else return "your opperation was successful for the order:".$order_id;
            }catch(Exception $ex){
                return $ex;
            }   
            closeConnection($conn);         
        }
    }

    public function createOrder($products,$customer,$address){
        $conn = openConnection();
        $reg = null;
        $json = null;
        //print_r($data);
        //echo $data["operacion"];
        $products = explode(",", $products);
        if ( count($products) > 5)
        {
            return "you can't select more than 5 products";
        }
        else{            
            try{
                $sql = "INSERT INTO `order` (customer_id, delivery_address) 
                VALUES (".$customer.", '".$address."')";
                $reg = mysqli_query($conn, $sql);
                if (!$reg) return mysqli_error($conn);
                $reg = mysqli_query($conn, "SELECT MAX(order_id) as id FROM `order`");
                $order_id = number_format(mysqli_fetch_array($reg, MYSQLI_ASSOC)['id']);
                $sql = "INSERT INTO `order_detail` (product_id, order_id) VALUES";
                foreach ($products as $product_id) {
                    $sql .= "(".$product_id.", ". $order_id."),";

                }
                $sql = rtrim($sql,",").";";
                $reg = mysqli_query($conn, $sql);
                if (!$reg) return mysqli_error($conn);
                else return "your opperation was successful for the order:".$order_id;
            }catch(Exception $ex){
                return $ex;
            }   
            closeConnection($conn);         
        }
    }
    public function getOrders($customer, $date){
        $conn = openConnection();
        $reg = null;
        $json = null;
        try{
            $sql = "SELECT O.creation_date, O.id, O.delivery_address, sum(P.price) 
            FROM order O, product P, order_detail OD
            WHERE O.order_id = OD.order_id and
                O.product_id=".$customer." and C.customer_id = CP.customer_id and P.product_id = CP.product_id";
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