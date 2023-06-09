class DeviceComponent extends HTMLElement {
    constructor() {
      super();
      this.isHistoryOpen = false;
      this.isStatisticsOpen = false;
      
      // this.selected = false;

      const shadow = this.attachShadow({ mode: "open" });
      const style = document.createElement("style");
      style.textContent = `
              .container{
                border: 1px solid black;
                margin-top: 10px;
                padding: 4px;
                padding-left: 9px;
                padding-right: 9px;
                display: flex;
                align-items:center;
              }

              .history-container{
                border: 1px solid black;
                border-top: 0;
                display: flex;
                align-items: center;
                flex-direction: column;
              }

              .history-records-container{
                padding: 12px;
                height: 270px;
                width: 80%;
                min-width: 336px;
                display: flex;
                flex-direction: column;
                flex-wrap: wrap;
                align-items: flex-start;
                align-content: space-between;
                gap: 10px;
              }

              .history-pagination{
                margin:auto;
                margin:auto;
                padding-bottom: 15px;
                position: relative;
              }

              .statistics-container{
                border: 1px solid black;
                border-top: 0;
                display: flex;
                align-items: center;
                flex-direction: column;
              }

              .statistics-records-container{
                padding: 12px;
                height: 270px;
                width: 80%;
                min-width: 336px;
                display: flex;
                flex-direction: column;
                flex-wrap: wrap;
                align-items: flex-start;
                align-content: space-between;
                gap: 10px;
              }

              .statistics-pagination{
                margin:auto;
                margin:auto;
                padding-bottom: 15px;
                position: relative;
              }

              .center{
                margin-left:auto;
                margin-right:auto;
              }
              .right{
                margin-left:auto;
              }

              text.device-online-status{
                font-size: 10px;
                margin-left: 5px;
              }

              text.device-online-status.online{
                color: green;
              }

              text.device-online-status.offline{
                color: red;
              }

              .settings-modal {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-50%);
                border: 1px solid black;
                z-index: 20;
                background-color: white;
              }
              
              .overlay{
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0,0,0,.5);
                // z-index: 19;
                // pointer-events: none;
              }

              .settings-modal-header {
                  padding: 7px 15px;
                  display: flex;
                  justify-content: space-between;
                  align-items: center;
                  border-bottom: 1px solid black;
              }
              
              .settings-modal-body {
                padding: 10px 15px;
                display: flex;
                gap: 7px;
                flex-direction: column;
                justify-content: start;
                align-items: start;
              }
              .settings-modal-body > form {
                padding-left: 7px;
              }
          `;
      shadow.appendChild(style);
  
      const container = document.createElement("div");
      container.setAttribute("class", "container");
       container.innerHTML = 
        `
          <div class="left last-state-icon">
            door-state-icon
          </div>
          <div>
            <div class="device-name">
              <text class = "device-name" >serial</text><text class="device-online-status">online-status</text>
            </div>
            <div class="alarm-button">
              alarm-button
            </div>
          </div>
          <div class="center history-button">
            <img class="history-button" src="../img/history-list.svg" alt="History button" width="40px" height="40px">
          </div>
          <div class="center statistics-button">
            <img class="statistics-button" src="../img/statistics.svg" alt="statistics button" width="40px" height="40px">
          </div>
          <div class="settings-button">
            <img src="../img/settings.svg" alt="Settings button" width="40px" height="40px">
          </div>
          <div class="users-button">
            <img src="../img/users.svg" alt="Users button" width="40px" height="40px">
          </div>
        `;
      shadow.appendChild(container);

      shadow.querySelector(".history-button > img").addEventListener("click", (e) => {
        if(this.isHistoryOpen){
          this.closeHistory();
        }else{
          this.openHistory();
        }
      });

      shadow.querySelector(".statistics-button > img").addEventListener("click", (e) => {
        if(this.isStatisticsOpen){
          this.closeStatistics();
        }else{
          this.openStatistics();
        }
      });

      shadow.querySelector(".settings-button > img").addEventListener("click", (e) => {
        this.openSettings();
      });
    }

    connectedCallback() {
      // this.shadowRoot.querySelector("text.device-name").innerText = this.getAttribute("device_name");
      this.getAttribute("device_name")==null  ?this.setAttribute("device_name",this.getAttribute("serial_number"))    :null;
      this.getAttribute("is_online")==null    ?this.setAttribute("is_online","-1")    :null;
      this.getAttribute("is_door_open")==null ?this.setAttribute("is_door_open","-1") :null;
      this.getAttribute("is_alarm_on")==null  ?this.setAttribute("is_alarm_on","-1")  :null;
    }

    static get observedAttributes() {
      return ["is_online","is_door_open","is_alarm_on","device_name"];
    }

    attributeChangedCallback(attrName, oldVal, newVal){
      if(oldVal != newVal){
        switch(attrName){
          case "is_online":
            const isOnlineText = this.shadowRoot.querySelector("text.device-online-status");
            if (newVal=="1"){
              isOnlineText.setAttribute("class","device-online-status online");
              isOnlineText.innerText='online';
            }else{
              isOnlineText.setAttribute("class","device-online-status offline");
              isOnlineText.innerText='offline';
            }
            break;

          case "is_door_open":
            if (newVal=="1"){
              this.shadowRoot.querySelector("div.last-state-icon").innerHTML = 
                '<img src="../img/door-open.svg" alt="OPEN" width="50px" height="50px">'
            }else if(newVal=="0"){
              this.shadowRoot.querySelector("div.last-state-icon").innerHTML = 
                '<img src="../img/door-closed.svg" alt="CLOSED" width="50px" height="50px">'
            }else{
              this.shadowRoot.querySelector("div.last-state-icon").innerHTML = 
                '<img src="../img/error-sign.svg" alt="ERROR" width="50px" height="50px">'
            }
            break;
          

            case "is_alarm_on":
              if (newVal=="1"){
                this.shadowRoot.querySelector("div.alarm-button").innerHTML = 
                  '<img src="../img/alarm-on.svg" alt="ALARM ON" width="35px" height="35px">'
              }else if(newVal=="0"){
                this.shadowRoot.querySelector("div.alarm-button").innerHTML = 
                  '<img src="../img/alarm-off.svg" alt="ALARM OFF" width="35px" height="35px">'
              }else{
                this.shadowRoot.querySelector("div.alarm-button").innerHTML = 
                  '<img src="../img/error-sign.svg" alt="ERROR" width="35px" height="35px">'
              }
              break;

            case "device_name":
              this.shadowRoot.querySelector("text.device-name").innerText = newVal;
              break;
        }
      }
    }

    loadDeviceHistory() {
      const url = "./api/get-device-history.php";
      const body = {
        device_serial: this.getAttribute("serial_number")
      }
      const post = JSON.stringify(body);
      const request = {
          method: 'post',
          body: post,
          headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
          }
      };
      
      fetch(url,request)
          // .then(response => response.ok ? res : response.json().then(err => Promise.reject(err)));
          .then(response =>{
              if(response.ok){
                  response.json()
                      .then(data => {
                          if(data[0]["success"]=="0"){
                              window.location.replace("../logout.php");
                          }else{
                            let container = this.shadowRoot.querySelector(".history-records-container");
                            container.innerHTML=``;
                            
                            data.forEach(record => {
                                let recordElement = document.createElement("text");
                                recordElement.innerText= record.time + " " + record.event;
                                container.appendChild(recordElement);
                            });
                          }
                      })
              }else{
                  console.log("Error fetching data")
              } 
          });
  }

  openHistory() {
    this.closeStatistics();
    const container = document.createElement("div");
    container.setAttribute("class", "history-container");
    container.innerHTML=`
      <div class="history-records-container">
        <text class="history-record">No data</text>
      </div>
      <div class="history-pagination">pagination</text>
    `;
    this.shadowRoot.appendChild(container);
    this.isHistoryOpen = true;

    this.loadDeviceHistory();
    this.refreshDeviceHistory = setInterval(this.loadDeviceHistory.bind(this), 5000);
  }

  closeHistory(){
    if(this.isHistoryOpen){
      clearInterval(this.refreshDeviceHistory)
      this.shadowRoot.querySelector(".history-container").remove();
      this.isHistoryOpen = false;
    }
  }

  loadDeviceStatistics() {
    const url = "./api/get-device-statistics.php";
    const body = {
      device_serial: this.getAttribute("serial_number")
    }
    const post = JSON.stringify(body);
    const request = {
        method: 'post',
        body: post,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    };
    
    fetch(url,request)
        // .then(response => response.ok ? res : response.json().then(err => Promise.reject(err)));
        .then(response =>{
            if(response.ok){
                response.json()
                    .then(data => {
                        if(data[0]["success"]=="0"){
                            window.location.replace("../logout.php");
                        }else{
                          let container = this.shadowRoot.querySelector(".statistics-records-container");
                          container.innerHTML=``;
                          
                          data.forEach(record => {
                              let recordElement = document.createElement("text");
                              recordElement.innerText= record.date + " Opened/Closed " + record.times_opened_closed + "times, was online for " + record.time_online + " seconds";
                              container.appendChild(recordElement);
                          });
                        }
                    })
            }else{
                console.log("Error fetching data")
                let container = this.shadowRoot.querySelector(".statistics-records-container");
                container.innerHTML=`Error fetching data`;
            } 
        });
  }

  openStatistics() {
    this.closeHistory();

    const container = document.createElement("div");
    container.setAttribute("class", "statistics-container");
    container.innerHTML=`
      <div class="statistics-records-container">
        <text class="statistic-record">No data</text>
      </div>
      <div class="statistics-pagination">pagination</text>
    `;
    this.shadowRoot.appendChild(container);
    this.isStatisticsOpen = true;

    this.loadDeviceStatistics();
  }

  closeStatistics(){
    if(this.isStatisticsOpen){
      this.shadowRoot.querySelector(".statistics-container").remove();
      this.isStatisticsOpen = false;
    }
  }

  openSettings(){
    const container = document.createElement("div");
    container.setAttribute("class","settings-modal-container");
    container.innerHTML= `
                          <div class="overlay">
                          </div>
                          <div class = "settings-modal">
                            <div class="settings-modal-header">
                              <text class="modal-title">Device settings</text>
                              <button class="close-modal-button">X</button>
                            </div>
                            <div class="settings-modal-body">
                              Serial number: `+ this.getAttribute("serial_number") +`
                              <form onsubmit="return false">
                                <label for="device-name-setting">Device name:</label>
                                <input type="text" id="device-name-setting" name = "device-name-setting" value="`+this.getAttribute("device_name")+`" >
                              </form>
                              <button class= "submit-settings">SAVE</button>
                            </div>
                            
                          </div>
                        `;
    container.querySelector(".close-modal-button").addEventListener("click",() =>{
      this.closeSettings();
    })
    container.querySelector("button.submit-settings").addEventListener("click",() =>{
      this.saveSettings();
    })
    this.shadowRoot.appendChild(container)
  }

  closeSettings(){
    this.shadowRoot.querySelector(".settings-modal-container").remove();
  }

  saveSettings(){
    const settingDeviceName = this.shadowRoot.querySelector("input#device-name-setting").value;
    const url = "./api/push-device-settings.php";
    const body = {
      device_name: settingDeviceName
      ,device_serial: this.getAttribute("serial_number")
    }
    const post = JSON.stringify(body);
    const request = {
        method: 'post',
        body: post,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    };
    
    fetch(url,request)
        .then(response =>{
            if(response.ok){
                response.json()
                    .then(data => {
                        if(data[0]["success"]=="0"){
                            window.location.replace("../logout.php");
                        }else if(data[0]["success"]=="1"){   
                           this.setAttribute("device_name",settingDeviceName);
                        }
                    })
            }else{
                console.log("Error fetching data")
            }
        });
    this.closeSettings()
  }

  }
  customElements.define("device-component", DeviceComponent);
  