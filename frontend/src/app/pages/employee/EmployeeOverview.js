import React, { Component } from 'react'
import Page from '../../components/page/Page'
import Button from 'antd/lib/button'

class EmployeeOverview extends Component {
  render () {
    return <Page>
      <Page.Header>
        <Button>Atualizar</Button>
        <Button>Filtrar</Button>
        <Button type="primary">Cadastrar</Button>
      </Page.Header>

      <Page.Context>
        <h2>Funcionários (21)</h2>
      </Page.Context>
    </Page>
  }
}

export default EmployeeOverview
