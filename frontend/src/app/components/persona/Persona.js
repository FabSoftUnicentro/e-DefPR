import React, { Component } from 'react'
import PropTypes from 'prop-types'
import Dropdown from 'antd/lib/dropdown'
import Avatar from 'antd/lib/avatar'

class Persona extends Component {
  static propTypes = {
    name: PropTypes.string.isRequired
  }

  render () {
    const { name } = this.props
    return <div className="app-persona">
      { name }
      <Avatar icon="user" />
    </div>
  }
}

export default Persona
