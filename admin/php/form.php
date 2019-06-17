<?php
include('../../connection.php');



        
        $data=-1;
        $nic=$_POST['nic'];
        $amount=$_POST['tpayment'];
        $ln=$_POST['l_num'];

        $stmt1 = $conn->prepare("SELECT `l_total` FROM `loan` WHERE nic=? and l_num=?");
        $stmt1->bind_param('si',$nic,$ln);
        $stmt1->execute();
        $resultSet = $stmt1->get_result();
        $result = $resultSet->fetch_all();
        $stmt1->close();
       $tot=$result[0][0]-$amount;

       if($result[0][0]==0){
           echo "s";
       }
       elseif($tot<0){
        echo 0;
       }
       elseif($tot==0) {
        // IF this completeted run This will return 0;
        $error='0';
        try {

            $insq = 'INSERT INTO payment_history(nic,amount_paid, payment_date, l_num) VALUES(?,?,now(),?) ';
            $upq = 'UPDATE loan SET l_total=? where nic=? and l_num=?';
            $stmt1 =$conn->prepare($upq);
            if (!$stmt1) {
                $error = "UpdateError";
            }
            
            $stmt1->bind_param('isi',$tot,$nic,$ln);
            $stmt2=$conn->prepare($insq);
            if (!$stmt2) {
                $error = "InsertError";
            }
    
           $stmt2->bind_param('sii',$nic,$amount,$ln);
        
            // Transaction
            //conn->begin_transaction();
            $conn->autocommit(false);
            $stmt1->execute();
            if (mysqli_affected_rows($conn)==0) {
                $conn->rollback();
                $error ="Transaction failed: Couldn't update  account.";
            } else {
                $stmt2->execute();
                if (mysqli_affected_rows($conn)==0) {
                    $conn->rollback();
                    $error = "Transaction failed: ";
                } else {
                    $conn->commit();
                }
            }
            
        
           
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
        /*
        if($error=='0'){
            $echo "1";
        }
        else{
            $echo "error";
        }
        */





















    }

       else{

        $error='0';
        try {

            $insq = 'INSERT INTO payment_history(nic,amount_paid, payment_date, l_num) VALUES(?,?,now(),?) ';
            $upq = 'UPDATE loan SET l_total=? where nic=? and l_num=?';
            $stmt1 =$conn->prepare($upq);
            if (!$stmt1) {
                $error = "UpdateError";
            }
            $stmt1->bind_param('isi',$tot,$nic,$ln);
            $stmt2=$conn->prepare($insq);
            if (!$stmt2) {
                $error = "InsertError";
            }
    
           $stmt2->bind_param('sii',$nic,$amount,$ln);
        
            // Transaction
            $conn->begin_transaction();
            //$conn->autocommit(false);
            $stmt1->execute();
            if (mysqli_affected_rows($conn)==0) {
                $conn->rollback();
                $error ="Transaction failed: Couldn't update  account.";
            } else {
                $stmt2->execute();
                if (mysqli_affected_rows($conn)==0) {
                    $conn->rollback();
                    $error = "Transaction failed: ";
                } else {
                    $conn->commit();
                }
            }
            
        
           
        } catch (Exception $e) {
            
            echo $error;

        }
        /*
        if($error=='0'){
            $echo "1";
        }
        else{
            $echo "error";
        }
        */


























           /*
        try {
            // First of all, let's begin a transaction
            $conn->begin_transaction();
        
            // A set of queries; if one fails, an exception should be thrown
            $stmt = $conn->prepare('INSERT INTO payment_history(nic,amount_paid, payment_date, l_num) VALUES(?,?,now(),?) ');
            $stmt->bind_param('sii',$nic,$amount,$ln);
            $stmt->execute();

            $stmt = $conn->prepare("UPDATE loan SET l_total=? where nic=? and l_num=?");
            $stmt->bind_param('isi',$tot,$nic,$ln);
            $stmt->execute();
            // If we arrive here, it means that no exception was thrown
            // i.e. no query has failed, and we can commit the transaction
            $stmt->close();
            $conn->commit();
        } catch (Exception $e) {
            // An exception has been thrown
            // We must rollback the transaction
            $conn->rollback();
            echo 1;
        }
        echo "else"
        */

    }



       




        

?>
