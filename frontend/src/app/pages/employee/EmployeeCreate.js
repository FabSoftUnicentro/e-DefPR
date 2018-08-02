import React, { Component } from 'react'
import Page from '../../components/page/Page'
import Form from '../../components/form/Form'
import { userService } from '../../services'

class EmployeeCreate extends Component {
  constructor (props) {
    super(props)
    this.onSubmit = this.onSubmit.bind(this)
  }

  async onSubmit (values) {
    console.log(values)
    await userService.create(values)
  }

  render () {
    return <Page>
      <Page.Header>
      </Page.Header>

      <Page.Context>
        <h2>Cadastrar funcionário</h2>
        <div className="app-page-box">
          <Form onSubmit={this.onSubmit} >
            <Form.Step title="Informações pessoais">
              <Form.TextField
                label="Nome"
                name="name"
                placeholder="Nome completo do funcionário"
              />
              
              <Form.TextField
                label="CPF"
                name="cpf"
              />
              
              <Form.DatePicker
                label="Data de nascimento"
                name="birth_date"
                placeholder="dia/mês/ano"
              />

              <Form.Inline>
                <Form.TextField label="RG" name="rg" />
                <Form.TextField label="Orgão emissor" name="rg_issuer" />
              </Form.Inline>

              <Form.Select label="Gênero" name="gender" options={[
                { value: 'male', name: 'Masculino' },
                { value: 'female', name: 'Feminino' },
                { value: 'neither', name: 'Outro' }
              ]} />

              <Form.CitySelect label="Cidade natal" name="birthplace" />

              <Form.Select label="Estado civil" name="civil_state" options={[
                { value: 'solteiro', name: 'Solteiro(a)' },
                { value: 'casado', name: 'Casado(a)' },
                { value: 'separado/divorciado', name: 'Separado(a)/Divorciado(a)' },
                { value: 'viuvo', name: 'Viúvo(a)' },
                { value: 'outro', name: 'Outro' }
              ]} />

              <Form.TextField
                label="Profissão"
                name="profession"
              />

              <Form.TextField
                label="Relatório"
                name="notes"
              />

            </Form.Step>
            <Form.Step title="Endereço">
              
              <Form.TextField
                label="CEP"
                name="address[cep]"
              />

              <Form.Inline>
                <Form.TextField label="Rua" name="address[street]" />
                <Form.TextField label="Número" name="address[number]" />
              </Form.Inline>

              <Form.Inline>
                <Form.CitySelect label="Cidade" name="address[city]" />
                <Form.TextField label="Bairro" name="address[neighbourhood]" />
              </Form.Inline>

              <Form.TextField
                label="Complemento"
                name="address[complement]"
              />

            </Form.Step>
            <Form.Step title="Informações de acesso">
            <Form.Inline>
                <Form.TextField label="E-mail" name="email" />
                <Form.TextField label="Senha" name="password" />
              </Form.Inline>

            </Form.Step>
          </Form>
        </div>
      </Page.Context>
    </Page>
  }
}

export default EmployeeCreate
