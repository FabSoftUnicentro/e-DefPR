import React, { Component } from 'react'
import PageHeader from '../page-header/PageHeader'

import './Page.css'

class Page extends Component {
  static Header (props) {
    return <PageHeader {...props} />
  }

  static Context ({ children }) {
    return <div className="app-page-context">
      { children }
    </div>
  }

  render () {
    const { children } = this.props

    return <div className="app-page">
      { children }
    </div>
  }
}

export default Page
