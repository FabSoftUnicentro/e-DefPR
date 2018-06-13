import React, { Component } from 'react'
import { CommandBar } from 'office-ui-fabric-react'
import employeeService from '../../services/EmployeeService'

class EmployeeView extends Component {
  constructor (props) {
    super(props)

    this.state = {
      data: null
    }
  }

  componentDidMount () {
    const { uid } = this.props.match.params
    employeeService.get(uid)
  }

  render () {
    return <div className='page'>
      <CommandBar
        farItems={[
          {
            key: 'headerBtRefresh',
            name: 'Relatório',
            iconProps: {
              iconName: 'CRMReport'
            }
          }, {
            key: 'headerBtNewEmployee',
            name: 'Editar',
            iconProps: {
              iconName: 'Edit'
            }
          }
        ]}
      />

      { !this.state.data && <div>Loading...</div> }
      { this.state.data && <pre>{ JSON.stringify(this.state.data, null, 2) }</pre> }
    </div>
  }
}

export default EmployeeView
