import React, { Component } from 'react'
import { Route, Switch } from 'react-router-dom'
import {
  Nav,
  DefaultButton,
  Breadcrumb
} from 'office-ui-fabric-react'

import Header from './Header'
import Schedule from './pages/Schedule'
import Employee from './pages/Employee'
import EmployeeNew from './pages/EmployeeNew'
import EmployeeView from './pages/EmployeeView'
import Assist from './pages/Assist'
import AssistCreate from './pages/AssistCreate'

import '../styles/Dashboard.css'

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

    // OAuth.getEmployeeData()
    //   .then(result => {
    //     this.setState({ authenticatedEmployee: result })
    //   })
  }

  render () {
    const authAccount = this.state.authenticatedEmployee
    const navMenuItems = authAccount ? authAccount.authorizedLinks : []

    return <div className='dashboard'>
      <Header account={this.state.authenticatedEmployee} />

      <main>
        <div className='sidebar'>
          <div className='user-button'>
            <DefaultButton
              primary
              iconProps={{ iconName: 'CalendarAgenda' }}
            >
                            Agenda
            </DefaultButton>
          </div>

          <Nav
            groups={[{ links: navMenuItems }]}
            selectedKey={this.state.selectedKey}
            onLinkClick={this.openNavLink.bind(this)}
          />
        </div>

        <div className='content'>
          <div className='main-header'>
            <Breadcrumb items={[
              { text: 'Home', href: '/' },
              { text: 'Agenda' }
            ]} />
          </div>

          <div className='main-page'>
            <Switch>
              <Route exact path='/' component={Schedule} />
              <Route path='/employee' component={Employee} />
              <Route path='/employee/new' component={EmployeeNew} />
              <Route path='/employee/v/:uid' component={EmployeeView} />
              <Route path='/assist' component={Assist} />
              <Route path='/assist/create' component={AssistCreate} user={this.state.authenticatedEmployee} />
            </Switch>
          </div>
        </div>
      </main>
    </div>
  }
}

export default Dashboard
