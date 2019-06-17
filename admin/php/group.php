<?php
        session_start();
        include('../../connection.php');
  
        if(isset($_POST['c_id'])) 
       
        {

            $c_id=$_POST['c_id'];
            $stmt = $conn->prepare("SELECT m_group,nic,first_name,last_name FROM member WHERE c_id=?  ORDER BY m_group");
            $stmt->bind_param('i',$c_id);
            $stmt->execute();
        
            $resultSet = $stmt->get_result();
            $result = $resultSet->fetch_all();
            echo json_encode($result);
    
        }
        elseif(isset($_POST['nic']) && isset($_POST['gid']) ){
            $stmt = $conn->prepare("UPDATE member SET m_group=? where nic=?");
            $stmt->bind_param('is',$_POST['gid'],$_POST['nic']);
            $stmt->execute();
        }
        elseif(isset($_POST['newg'])){
            $stmt = $conn->prepare("SELECT COUNT(*) as tot from groups");
             $stmt->execute();
             $resultSet = $stmt->get_result();
             $result = $resultSet->fetch_all();
             
             $x=$result[0][0]+1;
             $stmt1 = $conn->prepare("INSERT INTO `groups`(`c_id`, `g_id`, `c_date`) VALUES (?,?,now())");
             $stmt1->bind_param('ii',$_POST['cid'],$x);
             $stmt1->execute();
 
         }
        elseif(isset($_POST['cid'])){
            $c_id=$_POST['cid'];
            $stmt = $conn->prepare("SELECT g_id from groups WHERE c_id=? ");
            $stmt->bind_param('i',$c_id);
            $stmt->execute();
        
            $resultSet = $stmt->get_result();
            $result = $resultSet->fetch_all();
            echo json_encode($result);
    
        }

?>
