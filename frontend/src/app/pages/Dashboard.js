import React, { Component } from 'react'
import Page from '../components/page/Page'
import Button from 'antd/lib/button'
import Table from 'antd/lib/table'
import { authentication } from '../services'

const columns = [{
  title: 'Name',
  dataIndex: 'name',
  render: text => <a href="javascript:;">{text}</a>,
}, {
  title: 'Age',
  dataIndex: 'age',
}, {
  title: 'Address',
  dataIndex: 'address',
}]

const data = [{
  key: '1',
  name: 'John Brown',
  age: 32,
  address: 'New York No. 1 Lake Park',
}, {
  key: '2',
  name: 'Jim Green',
  age: 42,
  address: 'London No. 1 Lake Park',
}, {
  key: '3',
  name: 'Joe Black',
  age: 32,
  address: 'Sidney No. 1 Lake Park',
}, {
  key: '4',
  name: 'Disabled User',
  age: 99,
  address: 'Sidney No. 1 Lake Park',
}]

class Dashboard extends Component {
  constructor (props) {
    super(props)
  }

  test () {
    authentication.signin('jessyca.runte@example.org', 'secret')
  }

  render () {
    return <Page>
      <Page.Header>
        <Button onClick={this.test.bind(this)}>Atualizar</Button>
        <Button>Filtrar</Button>
        <Button type="primary">Cadastrar</Button>
      </Page.Header>

      <Page.Context>
        <h2>Processos</h2>
        <Table columns={columns} dataSource={data} />,
        
      </Page.Context>
    </Page>
  }
}

export default Dashboard
