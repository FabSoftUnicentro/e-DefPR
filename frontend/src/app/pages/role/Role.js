import React, { Component } from 'react'
import { Switch, Route } from 'react-router-dom'
import RoleOverview from './RoleOverview'
import RoleCreate from './RoleCreate'
import RoleAssign from './RoleAssign'

class Role extends Component {
  render () {
    return <Switch>
      <Route exact path='/role' component={RoleOverview} />
      <Route path='/role/new' component={RoleCreate} />
      <Route path='/role/assign' component={RoleAssign} />
    </Switch>
  }
}

export default Role
