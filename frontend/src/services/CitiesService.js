import Service from "../../../frontend/src/services/Service.js"

class CityService extends Service{
        
    constructor() {
        super("/cities");
    }
    
}