import React, { Component } from 'react'
import { Switch, Route } from 'react-router-dom'
import RoleOverview from './RoleOverview'
import RoleCreate from './RoleCreate'

class Role extends Component {
  render () {
    return <Switch>
      <Route exact path='/role' component={RoleOverview} />
      <Route path='/role/new' component={RoleCreate} />
    </Switch>
  }
}

export default Role
