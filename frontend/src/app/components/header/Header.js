import React, { Component } from 'react'
import PropTypes from 'prop-types'
import Persona from '../persona/Persona'
import Button from 'antd/lib/button'
import Badge from 'antd/lib/badge'
import Icon from 'antd/lib/icon'

import './Header.css'

class Header extends Component {
  static propTypes = {
    region: PropTypes.object.isRequired
  }

  render () {
    const { region } = this.props

    return <header className="app-header">
      <div className="app-name">
        <div>
          <span>e-DefPR</span>
          <span>{ region.name }</span>
        </div>
      </div>
      <div className="app-account">
        <Badge dot>
          <Icon type="notification" />
        </Badge>
        <Persona name="Paulo Pieczarka" />
      </div>
    </header>
  }
}

export default Header
