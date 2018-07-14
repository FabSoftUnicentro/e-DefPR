import React, { Component } from 'react'
import Page from '../components/page/Page'
import { Button } from 'antd'
import { authentication } from '../services'

class Dashboard extends Component {
  constructor (props) {
    super(props)
  }

  test () {
    console.log('test')
    authentication.signin('jessyca.runte@example.org', 'secret')
  }

  render () {
    return <Page>
      <Page.Header>
        <Button onClick={this.test.bind(this)}>Atualizar</Button>
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
