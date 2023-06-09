class Device {
    constructor(serial,isOnline,isDoorOpen){
        this.serial = serial;
        this.isOnline = isOnline;
        this.isDoorOpen = isDoorOpen;
    }

    getEvents(quantity,offset){
        return loadDeviceEvents(this.serial,quantity,offset);
    }
}