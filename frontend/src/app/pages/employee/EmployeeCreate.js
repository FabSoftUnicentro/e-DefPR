import React, { Component } from 'react'
import Page from '../../components/page/Page'
import Form from '../../components/form/Form'
import message from 'antd/lib/message'
import { userService } from '../../services'
import { Redirect } from 'react-router-dom'
import * as yup from 'yup'

const validateSchema = yup.object().shape({
  name: yup.string().required('Informe o nome do funcionário'),
  cpf: yup.string().required('Informe o CPF do funcionário'),
  birthDate: yup.string().required('Informe a data de nascimento do funcionário'),
  rg: yup.string().required('Informe o RG do funcionáiro'),
  rgIssuer: yup.string().required('Informe o orgão emissor do RG do funcionário'),
  gender: yup.string().max(1).required('Informe o gênero do funcionário'),
  marital_status: yup.string().required('Informe o estado civil do funcionário'),
  profession: yup.string().required('Informe a profissão do funcionário'),
  email: yup.string().email().required('Informe o e-mail do funcionário'),
  address: { 
    cep: yup.string().required('Informe o CEP do endereço do funcionário'),
    number: yup.number().positive().required('Informe o número do endereço do funcionário'),
    neighbourhood: yup.string().required('Informe o bairro do endereço do funcionário')
  },
  email: yup.string().email(),
  password: yup.string().required('Informe a senha de acesso do funcionário')
})

class EmployeeCreate extends Component {
  constructor (props) {
    super(props)
    this.onSubmit = this.onSubmit.bind(this)

    this.state = {
      redirect: false
    }
  }

  async onSubmit (values) {
    console.log(values)
    values.addresses = [ values.address ]

    const createEmployee = message.loading('Cadastrando funcioonário', 0)

    try {
      const result = await userService.create(values)

      if (result.status === 201) {
        createEmployee()
        message.success('Funcionário cadastrado com sucesso!')

        this.setState({
          redirect: true
        })

        return createEmployee()
      } else if (result.status === 403) {
        createEmployee()
        message.error('Preencha corretamente as informações!')
      }

      createEmployee()
      return message.error('Não foi possível cadastrar o funcionário!', 2)
    } catch (error) {
      console.log(error)
    }
  }

  attachMessage (type, message) {
    this.setState({ alertProps: { type, message } })
  }

  render () {
    if (this.state.redirect === true) {
      return <Redirect to='/' />
    }

    return <Page>
      <Page.Header />

      <Page.Context>
        <h2>Cadastrar funcionário</h2>
        <div className='app-page-box'>
          <Form onSubmit={this.onSubmit} validateSchema={validateSchema}>
            <Form.Step title='Informações pessoais'>
              <Form.TextField
                label='Nome'
                name='name'
                placeholder='Nome completo do funcionário'
              />

              <Form.TextField
                label='CPF'
                name='cpf'
              />

              <Form.DatePicker
                label='Data de nascimento'
                name='birthDate'
                placeholder='dia/mês/ano'
              />

              <Form.Inline>
                <Form.TextField label='RG' name='rg' />
                <Form.TextField label='Orgão emissor' name='rgIssuer' />
              </Form.Inline>

              <Form.Select label='Gênero' name='gender' options={[
                { value: 'M', name: 'Masculino' },
                { value: 'F', name: 'Feminino' }
              ]} />

              <Form.CitySelect label='Cidade natal' name='  ' />

              <Form.Select label='Estado civil' name='maritalStatus' options={[
                { value: 'solteiro', name: 'Solteiro(a)' },
                { value: 'casado', name: 'Casado(a)' },
                { value: 'separado/divorciado', name: 'Separado(a)/Divorciado(a)' },
                { value: 'viuvo', name: 'Viúvo(a)' },
                { value: 'outro', name: 'Outro' }
              ]} />

              <Form.TextField
                label='Profissão'
                name='profession'
              />

              <Form.TextField
                label='Relatório'
                name='notes'
              />

            </Form.Step>
            <Form.Step title='Endereço'>

              <Form.TextField
                label='CEP'
                name='address[cep]'
              />

              <Form.Inline>
                <Form.TextField label='Rua' name='address[street]' />
                <Form.TextField label='Número' name='address[number]' />
              </Form.Inline>

              <Form.Inline>
                <Form.CitySelect label='Cidade' name='address[city]' />
                <Form.TextField label='Bairro' name='address[neighbourhood]' />
              </Form.Inline>

              <Form.TextField
                label='Complemento'
                name='address[complement]'
              />

            </Form.Step>
            <Form.Step title='Informações de acesso'>
              <Form.Inline>
                <Form.TextField label='E-mail' name='email' />
                <Form.TextField label='Senha' name='password' type='password' />
              </Form.Inline>
            </Form.Step>
          </Form>
        </div>
      </Page.Context>
    </Page>
  }
}

export default EmployeeCreate
