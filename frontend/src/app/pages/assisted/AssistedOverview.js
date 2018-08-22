import React, { Component } from 'react'
import { assistedService } from '../../services'
import { Link } from 'react-router-dom'
import Page from '../../components/page/Page'
import DescriptionItem from '../../adapters/DescriptionItem'
import Button from 'antd/lib/button'
import message from 'antd/lib/message'
import Table from 'antd/lib/table'
import Drawer from 'antd/lib/drawer'
import Row from 'antd/lib/row'
import Divider from 'antd/lib/divider'

class AssistedOverview extends Component {
  constructor (props) {
    super(props)

    this.state = {
      data: undefined,
      total: 0,
      visible: false,
      selected: {
        name: '',
        gender: '',
        birth_date: '',
        marital_status: '',
        rg: '',
        rg_issuer: '',
        profession: '',
        email: '',
        addresses: []
      }
    }

    this.onChangePage = this.onChangePage.bind(this)
    this.showDrawer = this.showDrawer.bind(this)
    this.onCloseDrawer = this.onCloseDrawer.bind(this)
  }

  componentDidMount () {
    assistedService.list()
      .then(result => {
        console.log(result)
        this.setState({ data: result.data, total: result.meta.total })
      })
      .catch(() => message.error('Não foi possível acessar as informações dos assistidos.'))
  }

  onChangePage (page, pageSize) {
    this.setState({ data: undefined})
    assistedService.list(page)
      .then(result => {
        console.log(result)
        this.setState({ data: result.data, total: result.meta.total })
      })
      .catch(() => message.error('Não foi possível acessar as informações dos assistidos.'))
  }

  showDrawer (record) {
    this.setState({
      visible: true,
      selected: record
    })
    console.log(record)
  }

  onCloseDrawer () {
    this.setState({
      visible: false
    })
  }

  render () {
    const { data, total, visible, selected } = this.state
    const pStyle = {
      fontSize: 16,
      color: 'rgba(0,0,0,0.85)',
      lineHeight: '24px',
      display: 'block',
      marginBottom: 16
    }
    return <Page>
      <Page.Header>
        <Button>Atualizar</Button>
        <Button>Filtrar</Button>
        <Link to='/assisted/new'><Button type='primary'>Cadastrar</Button></Link>
      </Page.Header>

      <Page.Context>
        <h2>Assistidos ({total})</h2>
        <Table
          loading={!data}
          borded
          dataSource={data}
          bodyStyle={{background: 'white'}}
          onRow={(record, index) => {
            return {
              onClick: () => { this.showDrawer(record) }
            }
          }}
          columns={[
            {title: 'Nome', dataIndex: 'name', key: 'name'},
            {title: 'E-mail', dataIndex: 'email'},
            {title: 'Profissão', dataIndex: 'profession'}
          ]}
          pagination={{
            total,
            onChange: this.onChangePage
          }}
        />
        <Drawer
          width={640}
          placement='right'
          closable={false}
          onClose={this.onCloseDrawer}
          visible={visible}
          title={selected.name}
        >
          <p style={pStyle}>
            Informações Pessoais
          </p>
          <Row>
            <DescriptionItem title='Gênero' content={selected.gender} />
          </Row>
          <Row>
            <DescriptionItem title='Data de Nascimento' content={selected.birth_date} />
          </Row>
          <Row>
            <DescriptionItem title='Estado Civil' content={selected.marital_status} />
          </Row>
          <Row>
            <DescriptionItem title='RG' content={`${selected.rg} | ${selected.rg_issuer}`} />
          </Row>
          <Row>
            <DescriptionItem title='Profissão' content={selected.profession} />
          </Row>
          <Divider />
          <p style={pStyle}>
            Endereços e Contato
          </p>
          <Row>
            <DescriptionItem title='E-mail' content={selected.email} />
          </Row>
        </Drawer>
      </Page.Context>
    </Page>
  }
}

export default AssistedOverview
