<?php

        include('../../connection.php');

        $nic=$_POST['nic'];
        $l_num=$_POST['l_num']; 
        $stmt = $conn->prepare("SELECT * FROM payment_history WHERE l_num=? and nic=?");
        $stmt->bind_param('is',$l_num,$nic);
        $stmt->execute();
    
		$resultSet = $stmt->get_result();
        $result = $resultSet->fetch_all();
		echo json_encode($result);



?>