<?php
class Customer {
    
    public function getCustomers(){
        $conn = openConnection();
        $reg = null;
        $json = null;
        try{
            $sql = "SELECT customer_id, `name`, email FROM customer";
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
?>