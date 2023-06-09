import "./Device.js";
import "./device-component.js";

function loadUserDevices() {
    let url = "./api/get-devices.php";
    let request = {
        method: 'post',
        // body: post,
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
                            refreshDevices(data);
                        }
                    })
            }else{
                console.log("Error fetching data")
            } 
        });
}

function refreshDevices(devices){
    let mainContainer = document.querySelector(".app-main-container");
    let deviceComponent;
    // devices = loadUserDevices();
    devices.forEach(device => {
        //looking for device component of the device
        deviceComponent = document.querySelector("device-component#"+device.serial_number)
        //if not found, creating new
        if(deviceComponent==null){
            // deviceComponent = new DeviceComponent(device.serial_number,device.device_online,device.last_state);
            deviceComponent = document.createElement("device-component");
            deviceComponent.setAttribute("id",device.serial_number);
            deviceComponent.setAttribute("serial_number",device.serial_number);
            deviceComponent.setAttribute("device_name",device.device_name);
            deviceComponent.setAttribute("is_online",device.device_online);
            deviceComponent.setAttribute("is_door_open",device.last_state);
            mainContainer.appendChild(deviceComponent);
        //if found, updating attributes
        }else{
            deviceComponent.setAttribute("is_online",device.device_online);
            deviceComponent.setAttribute("is_door_open",device.last_state);
        }
    });
}

// let mainContainer = document.querySelector("div.appMainContainer");
loadUserDevices();
const refresh = setInterval(loadUserDevices, 1000);
window.onbeforeunload = function(){ clearInterval(refresh); }