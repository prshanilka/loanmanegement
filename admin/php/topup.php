<?php

    
    //connect with the database

    include('../../connection.php');
    $data = [];
    $indi="error";
    $b=0;
    if(isset($_POST['nic'])) 
    {

        $searchTerm = $_POST['nic'];
        
        $query2 = $conn->query("SELECT * FROM loan WHERE l_total!=0 and nic='".$searchTerm."'");
        $row2 = $query2->fetch_assoc();
        if (!$row2)
            {
                $data[]='inv';

            }
        else
        {
            $query = $conn->query("SELECT * FROM loantype WHERE l_id =".$row2['l_id']);
            $row = $query->fetch_assoc();
            $query3 = $conn->query("SELECT SUM(amount_paid) AS total FROM payment_history WHERE l_num =".$row2['l_num']." and nic='".$searchTerm."'");
            $row3 = $query3->fetch_assoc();


        
	        //$date = new DateTime($row2['l_date']); 
         // $date->modify("-1 day");

         $date1 = new DateTime($row2['l_date']);
         $date2 = new DateTime();
         $diff = $date2->diff($date1)->format("%a");
         $weeks=ceil($diff/7);
         $a=$row2['l_total'] / $row['l_time'];



         /*


            if( $row['l_time']<$weeks)
                {
                     //fisrt week   
                }
            elseif($weeks==1){

            }
            else
            {
                $b=$a*($weeks-1);
                $c=$a*($weeks-2);
                $instb=ceil($b);
                $instc=ceil($c);
                if($row3['total']>=$instb)
                {
                    $indi="paid";
                }
                elseif($row3['total']>$instc){
                    $indi="Under_paid";
                }
                else {
                    $indi="not_paid";
                }


            }*/

            $data[] = $row['l_interest'];
            $data[] = $row['l_time'];
            $data[] = $row['l_amount'];
            $data[] = $row2['l_total'];
            $data[] = $weeks ;
            $data[] = $row3['total'];
            $data[] = $row2['l_num'];
           // $data[] = $indi;
            //$data[] = $instb;
           
            
            
           

        
        }
    }


    echo json_encode($data);















?>
