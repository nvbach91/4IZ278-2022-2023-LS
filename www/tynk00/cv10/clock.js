function clockCEST() {
  var hours = document.getElementById('hour-CEST');
  var minutes = document.getElementById('minutes-CEST');
  var seconds = document.getElementById('seconds-CEST');

  var h = convertHours(0);
  var m = new Date().getMinutes();
  var s = new Date().getSeconds();

  hours.innerHTML = h;
  minutes.innerHTML = m;
  seconds.innerHTML = s;
}



function clockEDT() {
  var hours = document.getElementById('hour-EDT');
  var minutes = document.getElementById('minutes-EDT');
  var seconds = document.getElementById('seconds-EDT');

  var h = convertHours(-6);
  var m = new Date().getMinutes();
  var s = new Date().getSeconds();

  hours.innerHTML = h;
  minutes.innerHTML = m;
  seconds.innerHTML = s;
}

function clockGMT() {
  var hours = document.getElementById('hour-GMT');
  var minutes = document.getElementById('minutes-GMT');
  var seconds = document.getElementById('seconds-GMT');

  var h = convertHours(-2);
  var m = new Date().getMinutes();
  var s = new Date().getSeconds();

  hours.innerHTML = h;
  minutes.innerHTML = m;
  seconds.innerHTML = s;
}

function clockJST() {
  var hours = document.getElementById('hour-JST');
  var minutes = document.getElementById('minutes-JST');
  var seconds = document.getElementById('seconds-JST');

  var h = convertHours(7);
  var m = new Date().getMinutes();
  var s = new Date().getSeconds();

  hours.innerHTML = h;
  minutes.innerHTML = m;
  seconds.innerHTML = s;
}

function clockAEST() {
  var hours = document.getElementById('hour-AEST');
  var minutes = document.getElementById('minutes-AEST');
  var seconds = document.getElementById('seconds-AEST');

  var h = convertHours(8);
  var m = new Date().getMinutes();
  var s = new Date().getSeconds();

  hours.innerHTML = h;
  minutes.innerHTML = m;
  seconds.innerHTML = s;
}

function clockMSK() {
  var hours = document.getElementById('hour-MSK');
  var minutes = document.getElementById('minutes-MSK');
  var seconds = document.getElementById('seconds-MSK');

  var h = convertHours(1);
  var m = new Date().getMinutes();
  var s = new Date().getSeconds();

  hours.innerHTML = h;
  minutes.innerHTML = m;
  seconds.innerHTML = s;
}

function clockCST() {
  var hours = document.getElementById('hour-CST');
  var minutes = document.getElementById('minutes-CST');
  var seconds = document.getElementById('seconds-CST');

  var h = convertHours(6);
  var m = new Date().getMinutes();
  var s = new Date().getSeconds();

  hours.innerHTML = h;
  minutes.innerHTML = m;
  seconds.innerHTML = s;
}


function convertHours(hour){
  if(new Date().getHours() + hour >= 24){
    return new Date().getHours() + hour - 24;
  }
  else {
    if(new Date().getHours() + hour <= 0){
      return new Date().getHours() + hour + 24;
    }
    else {
      return new Date().getHours() + hour
    }
  }
}

var interval = setInterval(clockCEST, 1000);
var interval = setInterval(clockEDT, 1000);
var interval = setInterval(clockGMT, 1000);
var interval = setInterval(clockJST, 1000);
var interval = setInterval(clockAEST, 1000);
var interval = setInterval(clockMSK, 1000);
var interval = setInterval(clockCST, 1000);