import React, { Component } from 'react'
import { Route, Switch } from 'react-router-dom'
import { Breadcrumb } from 'office-ui-fabric-react'
import Header from './Header'
import Schedule from './Schedule'
import authService from 'services/AuthService'
import Sidebar from './Sidebar'
import 'styles/Dashboard.css'
import Employee from './employee/Employee'
import EmployeeNew from './employee/EmployeeNew'

class Dashboard extends Component {
  constructor (props) {
    super(props)

    this.state = {
      selectedKey: '/',
      authenticatedEmployee: null
    }
  }

  openNavLink (event, element) {
    if (element && this.props.history) {
      this.setState({ selectedKey: element.key })
      this.props.history.push(element.link)
    }
  }

  componentWillReceiveProps (nextProps) {
    this.setState({ selectedKey: nextProps.location.pathname })
  }

  componentDidMount () {
    this.setState({ selectedKey: window.location.pathname })

    if (authService.isAuthenticated()) {
      this.setState({authenticatedEmployee: authService.user})
    }
  }

  render () {
    // Get user from server.
    if (!this.state.authenticatedEmployee) {
      return <div>
        Loading user..
      </div>
    }

    const authAccount = this.state.authenticatedEmployee

    return <div className='dashboard'>
      <Header account={authAccount} />

      <main>
        <Sidebar history={this.props.history} />

        <div className='content'>
          <div className='main-header'>
            <Breadcrumb items={[
              { text: 'Home', href: '/' }
              // { text: 'Agenda' }
            ]} />
          </div>

          <div className='main-page'>
            <Switch>
              <Route exact path='/' component={Schedule} />
              <Route exact path='/employee' component={Employee} />
              <Route exact path='/employee/new' component={EmployeeNew} />
            </Switch>
          </div>
        </div>
      </main>
    </div>
  }
}

export default Dashboard
