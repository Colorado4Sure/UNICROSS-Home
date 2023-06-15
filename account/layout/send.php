   <!-- App Capsule -->
    <div id="appCapsule">
        <form method="post" action="send">
Title<input type="text" name="title">
Message<input type="text" name="message">
<!--Icon path<input type="text" name="icon">-->
Token<input type="text" name="token">
<input type="submit" value="Send notification">
</form>

<?php
function sendNotification(){
    $url ="https://fcm.googleapis.com/fcm/send";

    $fields=array(
        "to"=>$_REQUEST['token'],
        "notification"=>array(
            "body"=>$_REQUEST['message'],
            "title"=>$_REQUEST['title'],
            "icon"=>'https://ditepay.com/_nuxt/img/ditepay.png',
            "click_action"=>"https://shinerweb.com"
        )
    );

    $headers=array(
        'Authorization: key=AAAAgZfTLbc:APA91bH8Au9lI2XeNRCRjgLzbKReBkwX1gB8zDx1-dp9199e9E4MtPSH9vKp-imWeQTa5PBp8uDHJm9e7PFvWQK9Rnt5X8gKX95UKn3DNRZpbm18X0eSWgXMzkwC3oaSNcXOWW3qFfl5',
        'Content-Type:application/json'
    );

    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
    $result=curl_exec($ch);
    print_r($result);
    curl_close($ch);
}
sendNotification();
?>
    </div>