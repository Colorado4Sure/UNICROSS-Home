<?php
 require '../../main/classes/user.class.php';

   $action = $_GET['action'];
	
   if($action == 'update'){
        if(empty($_POST['token'])){
            echo json_encode(['status' => 'false', 'msg' => 'Tokens Are Empty' ]);
        }
        else{
            $app->UpdateNotifyToken($_POST['userid'], $_POST['token']);
        }
   }

   if($action == 'buy'){
        if(empty($_POST['gift_amount'])){
            echo json_encode(['status' => 'false', 'msg' => 'Amount Must Greater Than 0.00']);
        }
        else if($_POST['gift_amount'] > $_POST['user_balance']){
            echo json_encode(['status' => 'false', 'msg' => 'Insufficient Funds']);
        }
        else{
            $app->BuyGiftPin($_POST['gift_amount'], $_POST['user_id']);
        }
   }