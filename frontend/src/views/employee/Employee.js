import React, { Component, Fragment } from 'react'
import { DetailsList, CommandBar, SelectionMode, MessageBar, MessageBarType, ProgressIndicator } from 'office-ui-fabric-react'
import { userService } from 'services'

const CmdBtRefresh = { key: 'headerBtRefresh', name: 'Atualizar', icon: 'Refresh', iconOnly: true }
const CmdBtNewEmployee = {key: 'headerBtNewEmployee', name: 'Novo funcionário', icon: 'AddFriend' }

class Employee extends Component {
  constructor (props) {
    super(props)

    this.state = {
      isLoading: false,
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
    this.setState({ isLoading: true })
    userService.index()
      .then(users => {
        this.setState({ employeeList: users })
      })
      .catch(err => console.log(err))
      .finally(() => this.setState({ isLoading: false }))
  }

  render () {
    const { error, employeeList, isLoading } = this.state

    console.log(employeeList)

    return <Fragment>
      <div className='schedule-table'>

        { error && <MessageBar messageBarType={MessageBarType.severeWarning}>
          { error }
        </MessageBar> }

        <CommandBar
          farItems={[
            { ...CmdBtRefresh, onClick: this.refreshEmployeeList },
            { ...CmdBtNewEmployee, onClick: () => this.openLink('/employee/new') }
          ]}
        />

        { isLoading && <ProgressIndicator className="pd-inset-remove" /> }
        
        <DetailsList
          columns={EmployeeListColumns}
          items={employeeList}
          selectionMode={SelectionMode.none}
          selectionPreservedOnEmptyClick
        />
      </div>
    </Fragment>
  }
}

const EmployeeListColumns =
[
  {
    key: 'col1',
    name: 'Nome',
    minWidth: 150,
    maxWidth: 300,
    isRowHeader: true,
    isPadded: true,
    isSorted: true,
    isSortedDescending: false,
    onRender: item => <span>{ item.name }</span>
  }, {
    key: 'col3',
    minWidth: 120,
    maxWidth: 200,
    isResizable: true,
    name: 'E-mail',
    onRender: item => <span>{ item.email }</span>
  }, {
    key: 'col4',
    minWidth: 50,
    maxWidth: 100,
    isResizable: true,
    name: 'Último acesso',
    onRender: item => <span>Não implementado</span>
  }
]

export default Employee
