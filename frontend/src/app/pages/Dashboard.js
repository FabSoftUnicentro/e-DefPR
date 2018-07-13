import React, { Component } from 'react'
import Page from '../components/page/Page'
import { Button } from 'antd'

class Dashboard extends Component {
  constructor (props) {
    super(props)
  }

  render () {
    return <Page>
      <Page.Header>
        <Button>Atualizar</Button>
        <Button>Filtrar</Button>
        <Button type="success">Cadastrar</Button>
      </Page.Header>

      <Page.Context>
        <h2>Funcionários (12)</h2>
        <div>
        </div>
        
      </Page.Context>
    </Page>
  }
}

export default Dashboard
