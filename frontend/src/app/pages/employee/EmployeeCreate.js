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

              <Form.Select label="Estado civil" name="civil_state" options={[
                { value: 'solteiro', name: 'Solteiro(a)' },
                { value: 'casado', name: 'Casado(a)' },
                { value: 'separado/divorciado', name: 'Separado(a)/Divorciado(a)' },
                { value: 'viuvo', name: 'Viúvo(a)' },
                { value: 'outro', name: 'Outro' }
              ]} />

              <Form.TextField
                label="Profissão"
                name="prefession"
              />

              <Form.TextField
                label="Relatório"
                name="notes"
              />

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
