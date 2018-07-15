import React, { Component } from 'react'
import PropTypes from 'prop-types'
import Avatar from 'antd/lib/avatar'
import Popover from 'antd/lib/popover'

class Persona extends Component {
  static propTypes = {
    name: PropTypes.string.isRequired,
    onLogout: PropTypes.func.isRequired
  }

  constructor (props) {
    super(props)

    this.logoutHandler = this.logoutHandler.bind(this)
  }

  render () {
    const { name } = this.props
    return <div className="app-persona">
      <Popover placement="bottomRight" trigger="click" {...this.AccountPopover}>
        { name }
        <Avatar icon="user" />
      </Popover>
    </div>
  }

  logoutHandler (event) {
    event.preventDefault()
    this.props.onLogout()
  }

  get AccountPopover () {
    return {
      title: <div style={{display:'flex', flexDirection:'column', padding:'5px 0'}}>
        <span><strong>Paulo Pieczarka</strong></span>
        <span style={{fontSize:13, color:'#666'}}>Defensor</span>
      </div>,
      content: <div>
        <p><a href="">Minha conta</a></p>
        <p><a href="" onClick={this.logoutHandler}>Sair</a></p>
      </div>
    }
  }
}

export default Persona
