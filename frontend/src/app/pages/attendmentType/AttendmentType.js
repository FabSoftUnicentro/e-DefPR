import React, { Component } from 'react'
import { Switch, Route } from 'react-router-dom'
import AttendmentTypeOverview from './AttendmentTypeOverview'
import AttendmentTypeCreate from './AttendmentTypeCreate'

class AttendmentType extends Component {
  render () {
    return <Switch>
      <Route exact path='/attendmentType' component={AttendmentTypeOverview} />
      <Route path='/attendmentType/new' component={AttendmentTypeCreate} />
    </Switch>
  }
}

export default AttendmentType
