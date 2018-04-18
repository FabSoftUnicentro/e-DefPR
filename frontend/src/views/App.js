import React, { Component } from 'react'
import { BrowserRouter as Router, Route, Redirect } from 'react-router-dom'
import { Fabric } from 'office-ui-fabric-react/lib/Fabric'
import { loadTheme } from 'office-ui-fabric-react/lib/Styling'
import { initializeIcons } from '@uifabric/icons'

import Dashboard from './Dashboard'
import SignIn from './pages/signin/SignIn'
import authService from '../services/AuthService'

import 'react-select/dist/react-select.css'
import '../styles/App.css'

loadTheme({
  palette: {
    themePrimary: '#00b294',
    themeSecondary: '#00b294',
    themeDarkAlt: 'teal',
    themeDark: 'teal'
  }
})

initializeIcons()

class App extends Component {
  render () {
    return <Router>
      <Fabric>
        <Route path='/signin' component={() => <SignIn authService={authService} />} />
        <PrivateRoute path='/' component={Dashboard} />
      </Fabric>
    </Router>
  }
}

const PrivateRoute = ({ component: Component, ...rest }) => (
  <Route {...rest} render={props => (
    authService.isAuthenticated() ? (
      <Component {...props} />
    ) : (
      (!props.history.location.pathname.startsWith('/signin'))
        ? <Redirect to={{ pathname: '/signin', state: { from: props.location } }} />
        : <div />
    )
  )} />
)

export default App
