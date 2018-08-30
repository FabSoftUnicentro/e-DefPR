import React, { Component } from 'react'
import { Switch, Route } from 'react-router-dom'
import AssistedOverview from './AssistedOverview'
import AssistedCreate from './AssistedCreate'

class Assisted extends Component {
  render () {
    return <Switch>
      <Route exact path='/assisted' component={AssistedOverview} />
      <Route path='/assisted/new' component={AssistedCreate} />
    </Switch>
  }
}

export default Assisted
