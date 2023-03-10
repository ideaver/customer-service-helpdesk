// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
const firebaseConfig = {
    apiKey: "AIzaSyB7lHtn6L3qVEBngFI_L5RpBgdkf4LsvwQ",
    authDomain: "maimaid-app.firebaseapp.com",
    projectId: "maimaid-app",
    storageBucket: "maimaid-app.appspot.com",
    messagingSenderId: "839314473238",
    appId: "1:839314473238:web:e0747f2f5af518b4dc5037"
};

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/template/assets/images/favicon.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});