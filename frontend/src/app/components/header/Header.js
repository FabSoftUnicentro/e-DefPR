import React, { Component } from 'react'
import PropTypes from 'prop-types'

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
      <div>
        <nav>
          
        </nav>
      </div>
    </header>
  }
}

export default Header
