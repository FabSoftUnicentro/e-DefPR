import fetcher from "../helpers/fetcher";

class EmployeeService extends Service
{
    constructor() {
        super('/person');
    }
}

export default (new EmployeeService());
