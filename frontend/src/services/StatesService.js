import Service from "./Service"

class StatesService extends Service{
        
    constructor() {
        super("/states");
    }
    
}

export default (new StatesService());
