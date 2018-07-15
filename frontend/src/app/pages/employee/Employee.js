import React, { Component } from 'react'
import { Switch, Route } from 'react-router-dom'
import EmployeeOverview from './EmployeeOverview'
import EmployeeCreate from './EmployeeCreate'

class Employee extends Component {
  render () {
    return <Switch>
      <Route exact path="/employee" component={EmployeeOverview} />
      <Route path="/employee/new" component={EmployeeCreate} />
    </Switch>
  }
}

export default Employee
