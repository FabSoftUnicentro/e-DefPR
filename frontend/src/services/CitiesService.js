import Service from "./Service"

class CityService extends Service{
        
    constructor() {
        super("/cities");
    }
    
}

export default (new CityService());