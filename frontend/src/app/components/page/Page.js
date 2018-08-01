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
    const [header, ...context] = children

    return <div className="app-page">
      { header }
      <div className="app-page-context">{ context }</div>
    </div>
  }
}

export default Page
