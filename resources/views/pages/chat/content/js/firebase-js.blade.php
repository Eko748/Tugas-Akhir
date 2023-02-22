<script>
    // Import the functions you need from the SDKs you need
import { initializeApp } from "assets/js/firebase/app";
import { getAnalytics } from "assets/js/firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyCBAOUzUsLcgAWvI2I1LN0WyaFoWuDuiqo",
  authDomain: "web-scraping-3980b.firebaseapp.com",
  projectId: "web-scraping-3980b",
  storageBucket: "web-scraping-3980b.appspot.com",
  messagingSenderId: "107123350711",
  appId: "1:107123350711:web:eefbc2ad2b250512f74132",
  measurementId: "G-5XVWMNCYX9"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
// const analytics = getAnalytics(app);
firebase.initializeApp(firebaseConfig);

// Get a reference to the database service
const database = firebase.database();

// Get the message form and messages container elements
const messageForm = document.getElementById('message-form');
const messagesContainer = document.getElementById('messages');

// Listen for new messages added to the database
database.ref('messages').on('child_added', (snapshot) => {
  const message = snapshot.val();
  const messageElement = document.createElement('div');
  messageElement.innerText = message.sender_id + ': ' + message.content;
  messagesContainer.appendChild(messageElement);
});

// Listen for form submission to add a new message to the database
messageForm.addEventListener('submit', (event) => {
  event.preventDefault();
  const content = messageForm.content.value;
  const receiver_id = messageForm.receiver_id.value;
  const sender_id = USER_ID; // Replace with the authenticated user ID
  const message = {
    sender_id,
    receiver_id,
    content,
  };
  database.ref('messages').push(message);
  messageForm.reset();
});
Da
</script>