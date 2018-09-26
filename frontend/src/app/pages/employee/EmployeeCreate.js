import React, { Component } from 'react'
import Page from '../../components/page/Page'
import Form from '../../components/form/Form'
import message from 'antd/lib/message'
import Icon from 'antd/lib/icon'
import Button from 'antd/lib/button'
import { userService } from '../../services'
import { Redirect } from 'react-router-dom'
import * as yup from 'yup'

const validateSchema = yup.object().shape({
  password: yup.string().required('Informe a senha de acesso do funcionário'),
  email: yup.string().email('Informe um email válido').required('Informe o e-mail do funcionário'),
  address: yup.object().shape({
    neighbourhood: yup.string().min(2, 'O bairro deve ter pelo menos 2 caracteres').max(100, 'Informe um bairro válido').required('Informe o bairro do funcionário'),
    city: yup.string().required('Informe a cidade do funcionário'),
    number: yup.number().positive().required('Informe o número residencial do funcionário'),
    cep: yup.string().min(2, 'O CEP deve ter pelo menos 2 caracteres').max(8, 'Informe um CEP válido').required('Informe o CEP do endereço do funcionário')
  }),
  profession: yup.string().matches(/^(([a-zA-Z ]|[\u00C0-\u017F])*)$/, 'Informe uma profissão válida').required('Informe a profissão do funcionário'),
  marital_status: yup.string().required('Informe o estado civil do funcionário'),
  gender: yup.string().max(1).required('Informe o gênero do funcionário'),
  rg_issuer: yup.string().min(2, 'O orgão emissor deve ter pelo menos 2 caracteres').matches(/^(([a-zA-Z ]|[\u00C0-\u017F])*)$/, 'Informe um orgão emissor válido').required('Informe o orgão emissor'),
  rg: yup.string().min(2, 'O RG deve ter pelo menos 2 caracteres').max(20, 'Informe um RG válido').required('Informe o RG do funcionáiro'),
  birth_date: yup.string().required('Informe a data de nascimento do funcionário'),
  cpf: yup.string().required('Informe o cpf do funcionário').matches(/([0-9]{3}[.]?[0-9]{3}[.]?[0-9]{3}[-]?[0-9]{2})/, 'Informe um CPF válido'),
  name: yup.string().min(3, 'O nome do assistido deve ter pelo menos 3 caracteres').required('Informe o nome do funcionário')
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
    values.birthplace = values.birthplace.city
    values.addresses = [ values.address ]

    const removeCreatingMessage = message.loading('Cadastrando funcioonário', 0)

    try {
      const result = await userService.create(values)

      if (result.status === 201) {
        message.success('Funcionário cadastrado com sucesso!')
        this.setState({
          redirect: true
        })
      } else if (result.status === 403) {
        message.error('Preencha corretamente as informações!')
      } else {
        return message.error('Não foi possível cadastrar o funcionário!', 2)
      }
    } catch (error) {
      return message.error('Erro inesperado, tente novamente!', 2)
    } finally {
      removeCreatingMessage()
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
                required
              />

              <Form.TextField
                label='CPF'
                name='cpf'
                required
              />

              <Form.DatePicker
                label='Data de nascimento'
                name='birth_date'
                placeholder='dia/mês/ano'
                required
              />

              <Form.Inline>
                <Form.TextField label='RG' name='rg' required />
                <Form.TextField label='Orgão emissor' name='rg_issuer' required />
              </Form.Inline>

              <Form.Select label='Gênero' name='gender' required options={[
                { value: 'M', name: 'Masculino' },
                { value: 'F', name: 'Feminino' }
              ]} />

              <Form.CitySelect label='Cidade natal' name='birthplace' />

              <Form.Select label='Estado civil' name='marital_status' required options={[
                { value: 'solteiro', name: 'Solteiro(a)' },
                { value: 'casado', name: 'Casado(a)' },
                { value: 'separado/divorciado', name: 'Separado(a)/Divorciado(a)' },
                { value: 'viuvo', name: 'Viúvo(a)' },
                { value: 'uniao-estavel', name: 'União Estável' },
                { value: 'outro', name: 'Outro' }
              ]} />

              <Form.TextField
                label='Profissão'
                name='profession'
                required
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
                required
              />

              <Form.Inline>
                <Form.TextField label='Rua' name='address[street]' />
                <Form.TextField label='Número' name='address[number]' required />
              </Form.Inline>

              <Form.Inline>
                <Form.CitySelect label='Cidade' name='address' required />
                <Form.TextField label='Bairro' name='address[neighbourhood]' required />
              </Form.Inline>

              <Form.TextField
                label='Complemento'
                name='address[complement]'
              />

            </Form.Step>
            <Form.Step title='Informações de acesso'>
              <Form.Inline>
                <Form.TextField label='E-mail' name='email' required />
                <Form.TextField label='Senha' name='password' type='password' required />
              </Form.Inline>
            </Form.Step>
            <Button size='large'type='primary'htmlType='submit'>Salvar <Icon type='check' /></Button>
          </Form>
        </div>
      </Page.Context>
    </Page>
  }
}

export default EmployeeCreate
