import React, { Component } from 'react'
import { DetailsList, CommandBar, SelectionMode, MessageBar, MessageBarType } from 'office-ui-fabric-react'
import employeeService from '../../services/EmployeeService'

class Employee extends Component {
  constructor (props) {
    super(props)

    this.state = {
      error: null,
      employeeList: {}
    }

    this.openLink = this.openLink.bind(this)
    this.refreshEmployeeList = this.refreshEmployeeList.bind(this)
  }

  componentDidMount () {
    this.refreshEmployeeList()
  }

  openLink (pathname) {
    this.props.history.push(pathname)
  }

  refreshEmployeeList () {
    this.setState({ employeeList: {} })
    employeeService.list()
  }

  render () {
    return <div>
      <div className='schedule-table'>

        { this.state.error && <MessageBar
          messageBarType={MessageBarType.severeWarning}
        >
          { this.state.error }
        </MessageBar> }

        <CommandBar
          isSearchBoxVisible
          searchPlaceholderText='Procurar...'
          items={[
            { key: 'k2', name: 'Gerar Relatório', icon: 'TextDocument' },
            { key: 'l1', name: 'Filtrar', icon: 'Filter' }
          ]}
          farItems={[
            {
              key: 'headerBtRefresh',
              name: 'Atualizar',
              icon: 'Refresh',
              iconOnly: true,
              onClick: this.refreshEmployeeList
            }, {
              key: 'headerBtNewEmployee',
              name: 'Novo funcionário',
              icon: 'AddFriend',
              onClick: () => this.openLink('/employee/new')
            }
          ]}
        />
        <DetailsList
          columns={EmployeeListColumns}
          items={this.state.employeeList}
          selectionMode={SelectionMode.none}
          selectionPreservedOnEmptyClick
        />
      </div>

      <br />

      { JSON.stringify(this.state.employeeList, null, 2) }
    </div>
  }
}

const EmployeeListColumns =
[
  {
    key: 'col1',
    name: 'Nome',
    minWidth: 210,
    maxWidth: 300,
    isRowHeader: true,
    isPadded: true,
    isSorted: true,
    isSortedDescending: false,
    onRender: item => <span>{ item.nomeCompleto }</span>
  }, {
    key: 'col2',
    minWidth: 80,
    maxWidth: 100,
    isResizable: true,
    name: 'CPF',
    onRender: item => <span>{ item.cpf }</span>
  }, {
    key: 'col3',
    minWidth: 120,
    maxWidth: 160,
    isResizable: true,
    name: 'E-mail',
    onRender: item => <span>{ item.email }</span>
  }, {
    key: 'col4',
    minWidth: 50,
    maxWidth: 100,
    isResizable: true,
    name: 'Último acesso'
    // onRender: item => <span>{ item.dtUpdate.toLocaleDateString() }</span>
  }
  // , {
  //     key: "col5",
  //     minWidth: 50,
  //     isResizable: true,
  //     name: "Relatório",
  //     onRender: item => <span>{ item.relatorio }</span>
  // }
]

export default Employee
