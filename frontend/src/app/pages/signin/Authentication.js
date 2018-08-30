import React, { Component } from 'react'
import { Switch, Route } from 'react-router-dom'
import Singin from './Signin'
import RecoveryPassword from './RecoveryPassword'
import ChangePassword from './ChangePassword'

class Employee extends Component {
  render () {
    return <Switch>
      <Route path='/signin/recovery-password' component={RecoveryPassword} />
      <Route path='/signin/change-password' component={ChangePassword} />
      <Route exact path='/signin' component={Singin} />
    </Switch>
  }
}

export default Employee
