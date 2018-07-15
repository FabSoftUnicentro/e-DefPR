import React, { Component } from 'react'
import Page from '../components/page/Page'
import Button from 'antd/lib/button'
import Table from 'antd/lib/table'

const columns = [{
  title: 'Name',
  dataIndex: 'name',
  render: text => <a href="">{text}</a>,
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
  render () {
    return <Page>
      <Page.Header>
        <Button>Atualizar</Button>
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
