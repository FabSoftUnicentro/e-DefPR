import React, { Component } from 'react'
import { Switch, Route } from 'react-router-dom'
import UsersCreate from './UsersCreate'

class Users extends Component {
  render () {
    return <Switch>
      {/* <Route exact path='/employee' component={EmployeeOverview} /> */}
      <Route path='/users/create' component={UsersCreate} />
    </Switch>
  }
}

export default Users
