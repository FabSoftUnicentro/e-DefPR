import React, { Component } from 'react'
import { Switch, Route } from 'react-router-dom'
import PermissionOverview from './PermissionOverview'
import PermissionCreate from './PermissionCreate'

class Permission extends Component {
  render () {
    return <Switch>
      <Route exact path='/permission' component={PermissionOverview} />
      <Route path='/permission/new' component={PermissionCreate} />
    </Switch>
  }
}

export default Permission
