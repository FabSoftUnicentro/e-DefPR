import React, { Component, Fragment } from 'react'
import { Router, Switch, Route, Redirect } from 'react-router-dom'
import { createBrowserHistory } from 'history'
import Header from './components/header/Header'
import Sidebar from './components/sidebar/Sidebar'
import Dashboard from './pages/Dashboard'
import Employee from './pages/employee/Employee'
import Authentication from './pages/signin/Authentication'
import Assisted from './pages/assisted/Assisted'
import { authentication } from './services'

import './App.css'

const browserHistory = createBrowserHistory()

const Home = ({pathname}) => (
  <div className='app'>
    <Header region={{ name: 'Guarapuava' }} />

    <main>
      <Sidebar pathname={pathname} />
      <Switch>
        <Route exact path='/' component={Dashboard} />
        <Route path='/assisted' component={Assisted} />
        <Route path='/employee' component={Employee} />
      </Switch>
    </main>
  </div>
)

const PrivateRoute = ({ component: Component, ...rest }) => (
  <Route {...rest} render={(props) => (
    authentication.isAuthenticated === true 
      ? authentication.account.must_change_password === 1 
        ? <Redirect to='/signin/change-password' />
        : <Component {...props} /> 
      : <Redirect to='/signin' />
  )} />
)

class App extends Component {
  constructor (props) {
    super(props)

    this.state = {
      pathname: '/'
    }
  }

  componentWillMount () {
    this.removeHistoryListener = browserHistory.listen((location) => {
      const { pathname } = location
      this.setState({ pathname })
    })
  }

  componentDidMount () {
    const { pathname } = window.location
    this.setState({ pathname })
  }

  componentWillUnmount () {
    this.removeHistoryListener()
  }

  render () {
    const { pathname } = this.state

    return <Router history={browserHistory}>
      <Fragment>
        <Route path='/signin' component={Authentication} />
        <PrivateRoute path='/' component={() => <Home pathname={pathname} />} />
      </Fragment>
    </Router>
  }
}

export default App
