import React, { Component } from 'react'
import Page from '../../components/page/Page'
import Form from '../../components/form/Form'
import message from 'antd/lib/message'
import Icon from 'antd/lib/icon'
import Button from 'antd/lib/button'
import { assistedService } from '../../services'
import { Redirect } from 'react-router-dom'

class AssistedCreate extends Component {
  constructor (props) {
    super(props)
    this.onSubmit = this.onSubmit.bind(this)

    this.state = {
      redirect: false
    }
  }

  async onSubmit (values) {
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
          <Form onSubmit={this.onSubmit} >
            <Form.Step title='Informações pessoais'>
              <Form.TextField
                label='Nome'
                name='name'
                placeholder='Nome completo do assistido'
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

              <Form.CitySelect label='Cidade natal' name='birthplace' />

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
                name='note'
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
            <Form.Step title='Informações de contato'>
              <Form.Inline>
                <Form.TextField label='E-mail' name='email' />
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
