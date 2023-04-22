let hour = document.querySelector('.hour');
let minute = document.querySelector('.minute');

function refreshTime(){
  window.requestAnimationFrame(refreshTime);
  let d = new Date();
  let hr = d.getHours();
  let mins = d.getMinutes();
  hour.innerText = hr < 10 ? `0${hr}` : hr;
  minute.innerText = mins < 10 ? `0${mins}` : mins;
}

refreshTime();

// Inspired from: https://in.pinterest.com/pin/671599363153676015/