import React, { Component } from 'react'
import Page from '../components/page/Page'
import { Button, Table } from 'element-react'

class Dashboard extends Component {
  constructor (props) {
    super(props)

    this.state = {
      columns: [
        {
          type: 'selection'
        },
        {
          label: "Date",
          prop: "date",
          width: 150
        },
        {
          label: "Name",
          prop: "name",
          width: 160
        },
        {
          label: "Address",
          prop: "address"
        }
      ],
      data: [{
        date: '2016-05-03',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-02',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-04',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-01',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-08',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-06',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-07',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }]
    }
  }

  render () {
    return <Page>
      <Page.Header title="Dashboard">
        <Button>Atualizar</Button>
        <Button>Filtrar</Button>
        <Button type="success">Cadastrar</Button>
      </Page.Header>

      <Page.Context>
        <h2>Funcionários (12)</h2>
        <div>
        </div>
        <Table
          style={{width: '100%'}}
          columns={this.state.columns}
          data={this.state.data}
          border={true}
          onSelectChange={(selection) => { console.log(selection) }}
          onSelectAll={(selection) => { console.log(selection) }}
        />
      </Page.Context>
    </Page>
  }
}

export default Dashboard
