import React, { Component } from 'react'
import { attendmentTypeService } from '../../services'
import { Link } from 'react-router-dom'
import Page from '../../components/page/Page'
import Button from 'antd/lib/button'
import message from 'antd/lib/message'
import Table from 'antd/lib/table'

class AttendmentTypeOverview extends Component {
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
    attendmentTypeService.list()
      .then(result => {
        this.setState({ data: result.data, total: result.meta.total })
      })
      .catch(() => message.error('Não foi possível acessar os tipos de atendimento.'))
  }

  onChangePage (page, pageSize) {
    this.setState({ data: undefined })
    attendmentTypeService.list(page)
      .then(result => {
        this.setState({ data: result.data, total: result.meta.total })
      })
      .catch(() => message.error('Não foi possível acessar os tipos de atendimento.'))
  }

  render () {
    const { data, total } = this.state
    return <Page>
      <Page.Header>
        <Button>Atualizar</Button>
        <Button>Filtrar</Button>
        <Link to='/attendmentType/new'><Button type='primary'>Cadastrar</Button></Link>
      </Page.Header>

      <Page.Context>
        <h2>Tipo de Atendimento ({total})</h2>
        <Table
          loading={!data}
          borded
          dataSource={data}
          bodyStyle={{ background: 'white' }}
          columns={[
            { title: 'Nome', dataIndex: 'name', key: 'name' },
            { title: 'Descrição', dataIndex: 'description', key: 'description' }
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

export default AttendmentTypeOverview
