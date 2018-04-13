import React, { Component } from 'react'
import {
  TextField,
  DetailsList,
  SelectionMode,
  CheckboxVisibility,
  Selection,
  Label
} from 'office-ui-fabric-react'

import {
  DropdownGender,
  DropdownStateCity,
  DropdownCivilState
} from '../common/Dropdowns'
import Fetcher from '../../helpers/Fetcher'
import FormStepper from '../common/FormStepper'

class EmployeeNew extends Component {
  constructor (props) {
    super(props)

    this.state = {
      permissionList: [],
      form: {}
    }

    this.onTextfieldChange = this.onTextfieldChange.bind(this)

    this.permissionListSelection = new Selection()
    this.permissionListSelection.setModal(true)
  }

  componentDidMount () {
    if (this.state.permissionList.length === 0) {
      Fetcher.get('/permissao/query?fields=nome,permissaoId&orderBy=nome')
        .then(result => result.json())
        .then(response => this.setState({ permissionList: response.data }))
    }
  }

  onTextfieldChange (name, value, group = null) {
    let { form } = this.state
    if (group) {
      if (!form[group]) form[group] = {}
      form[group][name] = value
    } else {
      form[name] = value
    }

    this.setState({ form: form })
  }

  render () {
    return <div className='page'>
      <FormStepper
        steps={[
          { key: '0', name: 'Informações pessoais', component: <FormPersonal onChange={this.onTextfieldChange} /> },
          { key: '1', name: 'Endereços', component: <FormAddress onChange={this.onTextfieldChange} /> },
          {
            key: '2',
            name: 'Informações de acesso',
            component: <FormEmployeeAccess
              permissionList={this.state.permissionList}
              onChange={this.onTextfieldChange}
              selection={this.permissionListSelection}
            />
          }
        ]}
      />

      <pre>{ JSON.stringify(this.state.form, null, 2) }</pre>
    </div>
  }
}

const FormPersonal = props => (
  <div className='ms-form'>
    <div className='textfield-group'>
      <TextField label='Nome' onChanged={val => props.onChange('nome', val)} />
      <TextField label='Sobrenome' onChanged={val => props.onChange('sobrenome', val)} />
    </div>

    <div className='textfield-group'>
      <TextField label='CPF' onChanged={val => props.onChange('cpf', val)} />
      <TextField label='RG' onChanged={val => props.onChange('rg', val)} />
      <TextField label='Orgão Emissor' onChanged={val => props.onChange('orgaoEmissor', val)} />
    </div>

    <div className='textfield-group'>
      <DropdownGender onChanged={val => props.onChange('genero', val)} />
      <DropdownStateCity onChanged={val => props.onChange('naturalidade', val)} />
    </div>

    <div className='textfield-group'>
      <DropdownCivilState onChanged={val => props.onChange('estadoCivil', val)} />
      <TextField label='Profissão' onChanged={val => props.onChange('profissao', val)} />
    </div>

    <TextField label='Relatório' onChanged={val => props.onChange('relatorio', val)} multiline />
  </div>
)

const FormAddress = props => (
  <div className='ms-form'>
    <div className='textfield-group'>
      <TextField label='CEP' onChanged={val => props.onChange('cep', val, 'enderecos')} />
      <div />
    </div>

    <div className='textfield-group small-second'>
      <TextField label='Rua' onChanged={val => props.onChange('rua', val, 'enderecos')} />
      <TextField label='Número' onChanged={val => props.onChange('numero', val, 'enderecos')} />
    </div>

    <div className='textfield-group'>
      <TextField label='Bairro' onChanged={val => props.onChange('bairro', val, 'enderecos')} />
      <DropdownStateCity onChanged={val => props.onChange('cidade', val, 'enderecos')} />
    </div>

    <TextField label='Complemento' onChanged={val => props.onChange('complemento', val, 'enderecos')} />
  </div>
)

const FormEmployeeAccess = props => (
  <div className='ms-form'>
    <div className='textfield-group'>
      <TextField type='email' label='E-mail' required onChanged={val => props.onChange('email', val)} />
      <div />
    </div>

    <Label>Permissões</Label>

    <DetailsList
      selectionPreservedOnEmptyClick
      items={props.permissionList}
      selectionMode={SelectionMode.multiple}
      checkboxVisibility={CheckboxVisibility.always}
      compact
      constrainMode
      selection={props.selection}
    />
  </div>
)

export default EmployeeNew
