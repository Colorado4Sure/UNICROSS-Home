<!-- App Capsule -->
<div id="appCapsule">
    
<h2>Firebase Web Push Notification by <a href="https://shinerweb.com/">shinerweb.com</a></h2>

<p style="color:white" id="token"></p>

<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
<script>
    var firebaseConfig = {
    apiKey: "AIzaSyAEqvWjS6ATlX8ZCrqU27khNVqrN63f8Ro",
    authDomain: "ditepay-notify.firebaseapp.com",
    projectId: "ditepay-notify",
    storageBucket: "ditepay-notify.appspot.com",
    messagingSenderId: "556597980599",
    appId: "1:556597980599:web:cde70fc272b34991ff8c32",
    measurementId: "G-HHR6R4JJKH"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging=firebase.messaging();

    function IntitalizeFireBaseMessaging() {
        messaging
            .requestPermission()
            .then(function () {
                console.log("Notification Permission");
                return messaging.getToken();
            })
            .then(function (token) {
                console.log("Token : "+token);
                document.getElementById("token").innerHTML=token;
            })
            .catch(function (reason) {
                console.log(reason);
            });
    }

    messaging.onMessage(function (payload) {
        console.log(payload);
        const notificationOption={
            body:payload.notification.body,
            icon:payload.notification.icon
        };

        if(Notification.permission==="granted"){
            var notification=new Notification(payload.notification.title,notificationOption);

            notification.onclick=function (ev) {
                ev.preventDefault();
                window.open(payload.notification.click_action,'_blank');
                notification.close();
            }
        }

    });
    messaging.onTokenRefresh(function () {
        messaging.getToken()
            .then(function (newtoken) {
                console.log("New Token : "+ newtoken);
            })
            .catch(function (reason) {
                console.log(reason);
				//alert(reason);
            })
    })
    IntitalizeFireBaseMessaging();
</script>
</div>