import React, { Component } from 'react'
import Page from '../../components/page/Page'
import Form from '../../components/form/Form'

class EmployeeCreate extends Component {
  render () {
    return <Page>
      <Page.Header>
      </Page.Header>

      <Page.Context>
        <h2>Cadastrar funcionário</h2>
        <div className="app-page-box">
          <Form>
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
                name="birthday"
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

            </Form.Step>
            <Form.Step title="Endereço">
            </Form.Step>
            <Form.Step title="Informações de acesso">
            </Form.Step>
          </Form>
        </div>
      </Page.Context>
    </Page>
  }
}

export default EmployeeCreate
