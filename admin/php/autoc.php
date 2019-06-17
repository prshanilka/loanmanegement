<?php

    
    //connect with the database

    include('../../connection.php');
    $data = [];

    if(isset($_GET['term'])) 
    {
        $searchTerm = $_GET['term'];
        $query = $conn->query("SELECT * FROM member WHERE nic LIKE '%".$searchTerm."%' ");
        while ($row = $query->fetch_assoc()) 
        {
            $data[] = $row['nic'];
        }
        echo json_encode($data);
    }


    elseif(isset($_POST['nic']))
    {
        $searchTerm =$_POST['nic'];
        $query = $conn->query("SELECT first_name,last_name,c_location,m_group FROM member,center  WHERE nic ='".$searchTerm."' and member.c_id=center.c_id");
        $row = $query->fetch_assoc(); 
        $data[] = $row['first_name'];
        $data[] = $row['last_name'];
        $data[] = $row['c_location'];

        $query2 = $conn->query("SELECT `nic`, `l_num`, `l_id`, `l_date`, `l_total`  FROM `loan`  WHERE nic='".$searchTerm."' ORDER BY l_num  DESC LIMIT 1");
        $row2 = $query2->fetch_assoc(); 
    
        $data[] = $row2['l_total'];
        $data[]= $row2['l_num']; 


        $data[]= $row['m_group']; 
        echo json_encode($data);
    }
    elseif(isset($_POST['lid']))
    {
        $searchTerm = $_POST['lid'];
        $query = $conn->query("SELECT * FROM loantype WHERE l_id='".$searchTerm."'");
        $row = $query->fetch_assoc();
        $a=$row['l_amount'];
   		$s=$row['l_interest'];
   		$t=$row['l_time'];
   		$inter=	$a*$s/100;
   		$totalpw=(($a/($t/4))+$inter)/4;
   		$total=ceil($totalpw*$t); 
        $data[] = $total;
        $data[] =$row['l_id'];
       

        echo json_encode($data);
        
    }

    
    


    elseif(isset($_POST['flag']))
    {
        $stmt1 = $conn->prepare("INSERT INTO `loan`(`nic`, `l_num`, `l_m_group`, `l_id`, `l_date`, `l_total`) VALUES(?,?,?,?,now(),?)");
        $stmt1->bind_param('siiii',$_POST['nicn'],$_POST['flag'],$_POST['group'],$_POST['loantype'],$_POST['tot']);
        $status = $stmt1->execute();
        if ($status) {

            echo 1;
         } else {
            echo 0;
         }
    }











?>
