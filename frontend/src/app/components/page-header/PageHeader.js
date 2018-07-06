import React, { Component } from 'react'
import PropTypes from 'prop-types'

import './PageHeader.css'

class PageHeader extends Component {
  static propTypes = {
    title: PropTypes.string.isRequired
  }

  render () {
    const { title, children } = this.props

    return <div className="app-page-header">
      <div>{ title }</div>
      <div>{ children }</div>
    </div>
  }
}

export default PageHeader
