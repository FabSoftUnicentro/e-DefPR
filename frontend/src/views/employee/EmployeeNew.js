import React, { Component } from 'react'
import { Form, Field } from 'react-final-form'
import employeeService from 'services/UserService'

import FabricStepper from 'components/FabricStepper'
import {
  TextFieldAdapter,
  CitySelectAdapter,
  GenderSelect,
  CivilStateSelect
} from 'adapters'

class EmployeeNew extends Component {
  onSubmit (values) {
    console.log(values)
    employeeService.create(values)
  }

  render () {
    return <div className='page'>
      <Form
        onSubmit={this.onSubmit.bind(this)}
        render={({ handleSubmit, reset, submitting, pristine, values, meta }) => (
          <div>
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
                  <Field name='gender' label='Genêro' searchable={false} component={GenderSelect} />
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
                <div className='textfield-group'>
                  <Field name='addresses[postcode]' label='CEP' required component={TextFieldAdapter} />
                  <div /> <div />
                </div>

                <div className='textfield-group'>
                  <Field name='addresses[street]' label='Rua' required component={TextFieldAdapter} />
                  <Field name='addresses[number]' label='Número' required component={TextFieldAdapter} />
                </div>

                <div className='textfield-group'>
                  <Field name='addresses[city]' label='Cidade' required component={CitySelectAdapter} />
                  <Field name='addresses[neighborhood]' label='Bairro' required component={TextFieldAdapter} />
                </div>

                <div className='textfield-group'>
                  <Field name='addresses[complement]' label='Complemento' component={TextFieldAdapter} />
                </div>
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
          </div>
        )}
      />
    </div>
  }
}

export default EmployeeNew
