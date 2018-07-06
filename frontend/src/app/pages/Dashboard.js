import React, { Component } from 'react'
import Page from '../components/page/Page'
import { Button } from 'element-react'

class Dashboard extends Component {
  render () {
    return <Page>
      <Page.Header title="Dashboard">
        <Button type="primary">Hello</Button>
      </Page.Header>

      <Page.Context>
        dfdsfasd
      </Page.Context>
    </Page>
  }
}

export default Dashboard
