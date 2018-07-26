import React, { Component } from 'react'
import Page from '../../components/page/Page'
import Button from 'antd/lib/button'
import { user } from '../../services'
import message from 'antd/lib/message'
import Table from 'antd/lib/table'
import Icon from 'antd/lib/icon'

class EmployeeOverview extends Component {
  constructor (props) {
    super(props)

    this.state = {
      data: undefined,
      total: 0,
      visible: false,
      selectedEmployee: undefined
    }

    this.onChangePage = this.onChangePage.bind(this)
  }

  componentDidMount () {
    user.list()
      .then(result => {
        this.setState({ data: result.data, total: result.meta.total })
      })
      .catch(error => message.error('Não foi possível acessar as informações dos funcionários.'))
  }

  onChangePage (page, pageSize) {
    this.setState({ data: undefined})
    user.list(page)
      .then(result => {
        this.setState({ data: result.data, total: result.meta.total})
      })
      .catch(error => message.error('Não foi possível acessar as informações dos funcionários.'))
  }
  
  render () {
    const { data, total, visible } = this.state
    return <Page>
      <Page.Header>
        <Button>Atualizar</Button>
        <Button>Filtrar</Button>
        <Button type="primary">Cadastrar</Button>
      </Page.Header>

      <Page.Context>
        <h2>Funcionários ({total})</h2>
        <Table
          loading={!data}
          borded={true}
          dataSource={data}
          bodyStyle={{background: 'white'}}
          columns={[
            {title: 'Nome', dataIndex: 'name', key: 'name'},
            {title: 'E-mail', dataIndex: 'email'},
            {title: 'Profissão', dataIndex: 'profession'},
            {title: 'Ver funcionário', key: 'action', align: 'center', render: (text, record) => (
              <a href="javascript:;" onClick={this.showDrawer}> <Icon type="info-circle-o" /> </a>
            )}
          ]}
          pagination={ { 
            total, 
            onChange: this.onChangePage
          }}
        />
      </Page.Context>
    </Page>
  }
}

export default EmployeeOverview
