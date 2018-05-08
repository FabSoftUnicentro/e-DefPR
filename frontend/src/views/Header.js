import React, { Component } from 'react'
import {
  Persona,
  PersonaSize,
  IconButton,
  Panel,
  Link
} from 'office-ui-fabric-react'
import authService from 'services/AuthService'

import '../styles/Header.css'

class Header extends Component {
  constructor (props) {
    super(props)

    this.state = {
      accountMenuIsOpen: false,
      userAccount: null
    }

    this.toggleAccountMenu = this.toggleAccountMenu.bind(this)
    this.closeAccountMenu = this.closeAccountMenu.bind(this)
    this.onSignout = this.onLogout.bind(this)
  }

  componentDidMount () {
    this.setState({ userAccount: this.props.account })
  }

  toggleAccountMenu () {
    this.setState((prevState) => ({ accountMenuIsOpen: !prevState.accountMenuIsOpen }))
  }

  closeAccountMenu () {
    this.setState({ accountMenuIsOpen: false })
  }

  onLogout () {
    authService.logout()
  }

  render () {
    const { userAccount } = this.state

    return (<header className='header'>

      <div className='header-logo'>
        <span id='app-name'>Defensoria Pública</span>
        <span id='location'>Guarapuava, PR</span>
      </div>

      <div className='header-account'>

        <IconButton
          iconProps={{ iconName: 'ChatInviteFriend' }}
          title='Notificações'
        />

        { userAccount && <Persona
          className='ms-Custom-Persona'
          primaryText={userAccount.name}
          size={PersonaSize.size32}
          onClick={this.toggleAccountMenu}
        /> }

        <Panel
          isOpen={this.state.accountMenuIsOpen}
          isBlocking={false}
          headerText='Minha conta'
          className='ms-Account-Panel'
          isLightDismiss
          onDismissed={this.closeAccountMenu}
        >
          <p>{ userAccount && userAccount.name }</p><br /><br />
          <Link>Editar dados</Link><br /><br />
          { userAccount && <Link to={`/employee/v/${userAccount._id}`}>Ver meus dados</Link> }
          <br /><br />
          <Link onClick={this.onLogout}>Sair</Link>
        </Panel>
      </div>
    </header>)
  }
}

export default Header
