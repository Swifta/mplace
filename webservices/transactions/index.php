<?php
$ret = array();
$code_error = false;
$ret['status'] = false;
$ret['description'] = "InComplete Request. Check Documentation";
$ret['data'] = array();
$product_breakdown = array();
$job = "details";
if(isset($_REQUEST['job'])){
    $job = $_REQUEST['job'];
}
if(isset($_REQUEST['transaction_id']) && isset($_REQUEST['admin']) && isset($_REQUEST['key']) && 
        isset($_REQUEST['transaction_id']) && isset($_REQUEST['amount'])){

    require_once '../db_connect.php';
    
    $admin = addslashes(strip_tags($_REQUEST['admin']));
    $key = $_REQUEST['key'];
    $transaction_id = addslashes(strip_tags($_REQUEST['transaction_id']));
    $amount_paid = addslashes(strip_tags($_REQUEST['amount']));
    
    $sql = "SELECT * FROM users WHERE email='".$admin."' AND password=md5('".$key."') ";
    //$sql.="AND user_type=1";
    $result = mysql_query($sql) or $code_error = true;
    if($code_error){
        $ret['description'] = "Server Error";
        //echo mysql_error();//comment this out after debugging
    }
    else{
        if(mysql_num_rows($result) == 1){
            //login successful
    
            if($job == "details"){
                $sql = "SELECT * FROM transaction JOIN product ON transaction.product_id=product.deal_id ".
                    //"JOIN stores product.merchant_id=stores.merchant_id ".
                    "JOIN users ON transaction.user_id=users.user_id JOIN city ON ".
                    "users.city_id=city.city_id WHERE transaction_id='".$transaction_id."'";

                $result = mysql_query($sql) or $code_error = true;
                if($code_error){
                    $ret['description'] = "Server Error";
                    //echo mysql_error();//comment this out after debugging
                }
                else{
                    if(mysql_num_rows($result) > 0){
                        $total_amount = 0;
                        $loop = 0;
                        while($row = mysql_fetch_assoc($result)){
                            if($row['approve_status'] != 1){
                                $ret['status'] = false;
                                $ret['description'] = "User Account Blocked or Suspended";
                                break;
                            }

                            $data['fullname'] = $row['firstname'];
                            $data['address'] = $row['address1'].", ".$row['address2'].". ".$row['city_name'];
                            $data['telephone'] = $row['phone_number'];
                            $data['email'] = $row['email'];
                            $data['currency_code'] = $row['currency_code'];
                            $data['transaction_date'] = $row['transaction_date'];
                            $data['transaction_type'] = $row['transaction_type'];

                            $product = array();
                            $product['product_id'] = $row['product_id'];
                            $product['product_descr'] = $row['deal_title'];
                            $product['quantity'] = $row['quantity'];
                            $product['merchant_id'] = $row['merchant_id'];
                            $product['shop_id'] = $row['shop_id'];
                            $product['payment_status'] = $row['payment_status'];
                            $product['amount'] = $row['amount'];

                            $product_breakdown[$loop] = $product;

                            $total_amount += $row['amount'];
                            //var_dump($result);
                            $loop++;
                        }
                        if($total_amount == $amount_paid){
                            $ret['status'] = true;
                            $ret['description'] = "OK";
                            $data['total_amount'] = $total_amount;
                            $data['product_breakdown'] = $product_breakdown;
                            $ret['data'] = $data;
                        }
                        else{
                            $ret['description'] = "Transaction Not Found [INVALID AMOUNT]";
                        }
                    }
                    else{
                        $ret['description'] = "Transaction Not Found";
                    }
                }

            }
            elseif($job == "pay"){
                //do authentication and etc
                if(isset($_REQUEST['transaction_description'])){
                    $transaction_description = addslashes(strip_tags($_REQUEST['transaction_description']));
                    //confirm the total amount provided is whats on invoice
                    $sql2 = "SELECT * FROM transaction WHERE transaction_id='".$transaction_id."'";
                    $result2 = mysql_query($sql2) or $code_error = true;
                    if($code_error){
                        $ret['description'] = "Server Error";
                        //echo mysql_error();//comment this out after debugging
                    }
                    else{
                        $total_amount = 0;
                        while($row = mysql_fetch_assoc($result2)){
                            $total_amount += $row['amount'];
                        }
                        if($total_amount == $amount_paid){
                            //fine.... this is the amount paid by user which is same as whats on invoice
                            //then update the table appropriately
                            $sql3 = "UPDATE transaction SET payment_status='Success', pending_reason='".
                                    $transaction_description."' WHERE transaction_id='".$transaction_id."'";
                            mysql_query($sql3) or $code_error = true;
                            if($code_error || mysql_affected_rows() < 1){
                                //echo mysql_error();
                                $ret['description'] = "Internal Error: Cannot Complete Payment Request or Duplicate Payment";
                            }
                            else{
                                $ret['description'] = "Payment Successful";
                                $ret['status'] = true;
                            }
                        }
                        else{
                            $ret['description'] = "Amount Paid not Whats on the Invoice";
                        }
                    }
                }
            }
        }
        else{
            $ret['description'] = "Authentication Failed";
        }
    }
}
echo json_encode($ret);
?>
