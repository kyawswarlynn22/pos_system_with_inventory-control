// Get the current date and time
const today = new Date();

// Get the hours, minutes, and seconds
const hours = today.getHours();
const minutes = today.getMinutes();
const seconds = today.getSeconds();

// Add a leading zero to the hours and minutes if they are less than 10
const hoursWithLeadingZero = hours < 10 ? "0" + hours : hours;
const minutesWithLeadingZero = minutes < 10 ? "0" + minutes : minutes;

// Get the day of the week, month, and year
const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const dayOfWeek = daysOfWeek[today.getDay()];
const month = months[today.getMonth()];
const year = today.getFullYear();

// Create a string to display the current date and time
const amPm = hours < 12 ? "AM" : "PM";
const time = hoursWithLeadingZero + ":" + minutesWithLeadingZero + ":" + seconds + " " + amPm;
const date = dayOfWeek + ", " + month + " " + today.getDate() + ", " + year;

// Display the clock and date
document.getElementById("clock").innerHTML = time + "<br>" + date;

// Set a timeout function to update the clock every second
setInterval(function() {
  startTime();
}, 1000);
