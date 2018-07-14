import React, { Component, Fragment } from 'react'
import { BrowserRouter as Router, Route, Redirect } from 'react-router-dom'
import Header from './components/header/Header'
import Sidebar from './components/sidebar/Sidebar'
import Dashboard from './pages/Dashboard'
import Signin from './pages/signin/Signin'
import { authentication } from './services'

import './App.css'

const Home = props => (
  <div className="app">
    <Header region={{ name: "Guarapuava" }} />

    <main>
      <Sidebar />
      <Dashboard />
    </main>
  </div>
)

const PrivateRoute = ({ component: Component, ...rest }) => (
  <Route {...rest} render={(props) => (
    authentication.isAuthenticated === true
      ? <Component {...props} />
      : <Redirect to='/signin' />
  )} />
)

class App extends Component {
  render () {
    return <Router>
    <Fragment>
      <Route path="/signin" component={Signin} />
      <PrivateRoute path="/" component={Home} />
    </Fragment>
  </Router>
  }
}

export default App
