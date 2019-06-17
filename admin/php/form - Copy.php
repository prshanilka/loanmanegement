<?php
    include('../../connection.php');



         if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
        }
        

        $data=-1;
        $nic=$_POST['nic'];
        $amount=$_POST['tpayment'];
        $ln=$_POST['l_num'];

        $stmt1 = $conn->prepare("SELECT `l_total` FROM `loan` WHERE nic=? and l_num=?");
        $stmt1->bind_param('si',$nic,$ln);
        $stmt1->execute();
        $resultSet = $stmt1->get_result();
        $result = $resultSet->fetch_all();
        
       $tot=$result[0][0]-$amount;
       if($tot<0){
           
       }
       elseif ($tot==0) {
            ajaxCall($nic,$amount,$ln,$tot); 
       }

       else{
            ajaxCall($nic,$amount,$ln,$tot); 
       }

       function ajaxCall($nic,$amount,$ln,$tot,$flag)
       {
            $stmt = $conn->prepare('INSERT INTO payment_history(nic,amount_paid, payment_date, l_num) VALUES(?,?,now(),?) ');
            $stmt->bind_param('sii',$nic,$amount,$ln);


            $stmt3 = $conn->prepare("UPDATE loan SET l_total=? where nic=? and l_num=?");
            $stmt3->bind_param('isi',$tot,$nic,$ln);
            $y=$stmt3->execute();



            $x=$stmt->execute();
            if () { 
                // it worked
                

                $data = 1;
            } else {
                $data = 0;
            }

            $stmt->close();
            echo json_encode($data);
       }





        

?>
