import React, { Component } from 'react'
import Breadcrumb from 'antd/lib/breadcrumb'

import './PageHeader.css'

class PageHeader extends Component {
  render () {
    const { children } = this.props

    return <div className='app-page-header'>
      <div className='app-breadcrumb'>
        <Breadcrumb>
          <Breadcrumb.Item>Home</Breadcrumb.Item>
        </Breadcrumb>
      </div>
      <div>{ children }</div>
    </div>
  }
}

export default PageHeader
