// Initialize Firebase
var config = {
	apiKey: "AIzaSyB7H-IsLaHrUCTpcmGQv1rC6zXUMlqkbXk",
    authDomain: "chatapp-6e462.firebaseapp.com",
    databaseURL: "https://chatapp-6e462.firebaseio.com",
    projectId: "chatapp-6e462",
    storageBucket: "chatapp-6e462.appspot.com",
    messagingSenderId: "248771002205",
    appId: "1:248771002205:web:53bf5c9d58121ba863b2b4",
    measurementId: "G-JG2532TL54"
};

firebase.initializeApp(config);

// Initialize Cloud Firestore through Firebase
var db = firebase.firestore();

// Disable deprecated features
db.settings({
	timestampsInSnapshots: true
});