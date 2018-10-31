import React, { Component } from 'react'
import { roleService } from '../../services'
import { Link } from 'react-router-dom'
import Page from '../../components/page/Page'
import Button from 'antd/lib/button'
import message from 'antd/lib/message'
import Table from 'antd/lib/table'

class RoleOverview extends Component {
  constructor (props) {
    super(props)

    this.state = {
      data: undefined,
      total: 0,
      visible: false,
      selected: {
        name: ''
      }
    }

    this.onChangePage = this.onChangePage.bind(this)
  }

  componentDidMount () {
    roleService.list()
      .then(result => {
        this.setState({ data: result.data, total: result.meta.total })
      })
      .catch(() => message.error('Não foi possível acessar os níveis de acesso.'))
  }

  onChangePage (page, pageSize) {
    this.setState({ data: undefined })
    roleService.list(page)
      .then(result => {
        this.setState({ data: result.data, total: result.meta.total })
      })
      .catch(() => message.error('Não foi possível acessar os níveis de acesso.'))
  }

  render () {
    const { data, total } = this.state
    return <Page>
      <Page.Header>
        <Button>Atualizar</Button>
        <Button>Filtrar</Button>
        <Link to='/role/new'><Button type='primary'>Cadastrar</Button></Link>
        <Link to='/role/assign'><Button type='primary'>Associar permissões a nível de acesso</Button></Link>
      </Page.Header>

      <Page.Context>
        <h2>Níveis de acesso ({total})</h2>
        <Table
          loading={!data}
          borded
          dataSource={data}
          bodyStyle={{ background: 'white' }}
          columns={[
            { title: 'Nome', dataIndex: 'name', key: 'name' }
          ]}
          pagination={{
            total,
            onChange: this.onChangePage
          }}
        />
      </Page.Context>
    </Page>
  }
}

export default RoleOverview
