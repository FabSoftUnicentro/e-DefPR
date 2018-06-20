import React, { Component, Fragment } from 'react'
import { Form, Field } from 'react-final-form'
import employeeService from 'services/UserService'
import { MessageBar, MessageBarType } from 'office-ui-fabric-react'

import FabricStepper from 'components/FabricStepper'
import {
  TextFieldAdapter,
  CitySelectAdapter,
  GenderSelect,
  CivilStateSelect,
  AddressAdapter
} from 'adapters'

const WarningCreateEmployee = (
  <MessageBar messageBarType={MessageBarType.warning}>
    Existem campos obrigatórios não preenchidos.
  </MessageBar>
)

const SuccessCreateEmployee = (
  <MessageBar messageBarType={MessageBarType.success}>
    Funcionário cadastrado com sucesso.
  </MessageBar>
)

class EmployeeNew extends Component {
  constructor (props) {
    super(props)

    this.state = {
      messageComponent: null
    }
  }
  onSubmit (values) {
    console.log(values)
    employeeService.create(values)
      .then(result => {
        if (result.status !== 201) {
          this.setState({
            messageComponent: WarningCreateEmployee
          })
        } else {
          this.setState({
            messageComponent: SuccessCreateEmployee
          })
        }
      })
  }

  render () {
    return <div className='page'>
      {this.state.messageComponent && this.state.messageComponent}
      <Form
        onSubmit={this.onSubmit.bind(this)}
        render={({ handleSubmit, reset, submitting, pristine, values, meta }) => (
          <Fragment>
            <FabricStepper
              onSubmit={handleSubmit}
              isSubmitting={submitting}
            >
              <FabricStepper.Step
                title='Informações pessoais'
              >
                <div className='textfield-group'>
                  <Field name='name' label='Nome' required component={TextFieldAdapter} />
                </div>

                <div className='textfield-group'>
                  <Field name='cpf' label='CPF' required component={TextFieldAdapter} />
                  <div />
                </div>

                <div className='textfield-group'>
                  <Field type='date' name='birthDate' label='Data de nascimento' component={TextFieldAdapter} />
                  <div />
                </div>

                <div className='textfield-group'>
                  <Field name='rg' label='RG' required component={TextFieldAdapter} />
                  <Field name='rgIssuer' label='Orgão emissor' required component={TextFieldAdapter} />
                </div>

                <div className='textfield-group'>
                  <Field name='gender' label='Gênero' searchable={false} component={GenderSelect} />
                  <div />
                </div>

                <div className='textfield-group'>
                  <Field name='naturalidade' label='Cidade natal' component={CitySelectAdapter} />
                  <div />
                </div>

                <div className='textfield-group'>
                  <Field name='maritalStatus' label='Estado civil' searchable={false} component={CivilStateSelect} />
                  <div />
                </div>

                <div className='textfield-group'>
                  <Field name='profession' label='Profissão' component={TextFieldAdapter} />
                  <div />
                </div>

                <div className='textfield-group'>
                  <Field name='note' label='Relatório' multiline component={TextFieldAdapter} />
                </div>
              </FabricStepper.Step>

              <FabricStepper.Step
                title='Endereços'
              >
                <AddressAdapter />
              </FabricStepper.Step>

              <FabricStepper.Step
                title='Informações de acesso'
              >
                <div className='textfield-group'>
                  <Field name='email' label='E-mail' required component={TextFieldAdapter} />
                  <Field type='password' name='password' label='Senha' required component={TextFieldAdapter} />
                  <div /> <div />
                </div>
              </FabricStepper.Step>
            </FabricStepper>
          </Fragment>
        )}
      />
    </div>
  }
}

export default EmployeeNew
