import React, { Component } from 'react'
import Page from '../../components/page/Page'
import Form from '../../components/form/Form'
import message from 'antd/lib/message'
import Icon from 'antd/lib/icon'
import Button from 'antd/lib/button'
import { assistedService } from '../../services'
import * as yup from 'yup'
import { Redirect } from 'react-router-dom'

const validateSchema = yup.object().shape({
  email: yup.string().email().required('Informe o email do assistido'),
  address: yup.object().shape({
    neighbourhood: yup.string().required('Informe o bairro do assistido'),
    city: yup.string().required('Informe a cidade do assistido'),
    number: yup.number().required('Informe o número residencial do assistido'),
    street: yup.string().required('Informe a rua do assistido'),
    cep: yup.string().min(2, 'O CEP deve ter pelo menos 2 caracteres').required('Informe o CEP do assistido'),
  }),
  profession: yup.string().required('Informe a profissão do assistido'),
  marital_status: yup.string().required('Informe o estado civil do assistido'),
  birthplace: yup.string().required('Informe o local de nascimento do assistido'),
  gender: yup.string().required('Informe o genêro do assistido'),
  rg_issuer: yup.string().min(2, 'O orgão emissor deve ter pelo menos 2 caracteres').required('Informe o orgão emissor do assistido').required('Informe o orgão emissor'),
  rg: yup.string().min(2, 'O RG deve ter pelo menos 2 caracteres').required('Informe o RG do assistido'),
  birth_date: yup.string().required('Informe a data de nascimento do assistido'),
  cpf: yup.string().matches(/([0-9]{3}[.]?[0-9]{3}[.]?[0-9]{3}[-]?[0-9]{2})/, 'Informe um CPF válido'),
  name: yup.string().min(3, 'O nome do assistido deve ter pelo menos 3 caracteres').required('Informe o nome do assistido')
})

class AssistedCreate extends Component {
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

    const removeCreatingMessage = message.loading('Cadastrando assistido', 0)

    try {
      const result = await assistedService.create(values)

      if (result.status === 201) {
        message.success('Assistido cadastrado com sucesso!')

        this.setState({
          redirect: true
        })
      } else if (result.status === 403) {
        message.error('Preencha corretamente as informações!')
      } else {
        return message.error('Não foi possível cadastrar o assistido!', 2)
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
        <h2>Cadastrar assistido</h2>
        <div className='app-page-box'>
          <Form
            onSubmit={this.onSubmit}
            validateSchema={validateSchema}
          >
            <Form.Step title='Informações pessoais'>
              <Form.TextField
                label='Nome'
                name='name'
                placeholder='Nome completo do assistido'
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

              <Form.CitySelect label='Cidade natal' name='birthplace' required />

              <Form.Select label='Estado civil' name='marital_status' required options={[
                { value: 'solteiro', name: 'Solteiro(a)' },
                { value: 'casado', name: 'Casado(a)' },
                { value: 'separado/divorciado', name: 'Separado(a)/Divorciado(a)' },
                { value: 'viuvo', name: 'Viúvo(a)' },
                { value: 'outro', name: 'Outro' }
              ]} />

              <Form.TextField
                label='Profissão'
                name='profession'
                required
              />

              <Form.TextField
                label='Relatório'
                name='note'
                required
              />

            </Form.Step>
            <Form.Step title='Endereço'>

              <Form.TextField
                label='CEP'
                name='address[cep]'
                required
              />

              <Form.Inline>
                <Form.TextField label='Rua' name='address[street]' required />
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
            <Form.Step title='Informações de contato'>
              <Form.Inline>
                <Form.TextField label='E-mail' name='email' required />
              </Form.Inline>
            </Form.Step>
            <Button size='large'type='primary'htmlType='submit'>Salvar <Icon type='check' /></Button>
          </Form>
        </div>
      </Page.Context>
    </Page>
  }
}

export default AssistedCreate
