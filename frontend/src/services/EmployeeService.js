import Service from './Service'

class EmployeeService extends Service {
  constructor () {
    super('/person')
  }
}

export default (new EmployeeService())
