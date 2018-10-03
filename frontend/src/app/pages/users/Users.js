import React, { Component } from 'react'
import { Switch, Route } from 'react-router-dom'
import UsersOverview from './UsersOverview'
import UsersCreate from './UsersCreate'

class Users extends Component {
  render () {
    return <Switch>
      <Route exact path='/users' component={UsersOverview} />
      <Route path='/users/create' component={UsersCreate} />
    </Switch>
  }
}

export default Users
