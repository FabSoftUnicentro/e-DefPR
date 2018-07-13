import React, { Component } from 'react'
import PropTypes from 'prop-types'
import { Dropdown } from 'element-react'

class Persona extends Component {
  static propTypes = {
    name: PropTypes.string.isRequired
  }

  render () {
    const { name } = this.props
    return <div className="app-persona">
      <Dropdown trigger="click" menu={(
        <Dropdown.Menu>
          <Dropdown.Item>Minha conta</Dropdown.Item>
          <Dropdown.Item>Configurações</Dropdown.Item>
          <Dropdown.Item divided>Sair</Dropdown.Item>
        </Dropdown.Menu>
        )}
      >
        <span className="el-dropdown-link">
          { name }{" "}<i className="el-icon-caret-bottom el-icon--right"></i>
        </span>
      </Dropdown>
    </div>
  }
}

export default Persona
