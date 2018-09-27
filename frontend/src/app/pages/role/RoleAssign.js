import React, { Component } from 'react'
import Page from '../../components/page/Page'
import Form from '../../components/form/Form'
import message from 'antd/lib/message'
import Icon from 'antd/lib/icon'
import Button from 'antd/lib/button'
import { Cascader, Transfer, Row, Col } from 'antd';
import { roleService } from '../../services'
import * as yup from 'yup'
import { Redirect } from 'react-router-dom'

class RoleAssign extends Component {
  constructor (props) {
    super(props)

    this.state = {
      data: undefined,
      total: 0,
      visible: false,
      redirect: false,
      selected: {
        name: ''
      },

      mockData: [],
      targetKeys: [],
    }

    this.onSubmit = this.onSubmit.bind(this)
  }

  componentWillMount () {
    console.log("montou")
    roleService.list()
      .then(({ data, meta }) => {
        data = data.map(item => ({ value: item.id, label: item.name }))
        this.setState({ data, total: meta.total })
      })
      .catch(() => message.error('Não foi possível acessar os níveis de acesso.'))
  }

  componentDidMount () {
    this.getMock();
  }

  async onSubmit (values) {
    const removeCreatingMessage = message.loading('Cadastrando nível de acesso', 0)

    try {
      const result = await roleService.create(values)

      if (result.status === 201) {
        message.success('Nível de acesso cadastrado com sucesso!')

        this.setState({
          redirect: true
        })
      } else if (result.status === 403) {
        message.error('Preencha corretamente o nome!')
      } else {
        return message.error('Não foi possível cadastrar o nível de acesso!', 2)
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

  onChange(values, selectedOptions) {
    console.log(values);
  }

  getMock = () => {
    const targetKeys = [];
    const mockData = [];
    for (let i = 0; i < 10; i++) {
      const data = {
        key: i.toString(),
        title: `content${i + 1}`,
        chosen: Math.random() * 2 > 1,
      };
      if (data.chosen) {
        targetKeys.push(data.key);
      }
      mockData.push(data);
    }
    this.setState({ mockData, targetKeys });
  }

  handleChange = (targetKeys, direction, moveKeys) => {
    console.log(targetKeys)
    console.log(direction)
    console.log(moveKeys)
    this.setState({ targetKeys });
  }


  render () {
    const { data, total } = this.state
    if (this.state.redirect === true) {
      return <Redirect to='/role' />
    }

    return <Page>
      <Page.Header />

      <Page.Context>
        <h2>Associar nível de acesso a permissões</h2>

        <div className='app-page-box'>
          <Form
            onSubmit={this.onSubmit}
            >
            <Form.Step title='Informações do nível de acesso'>
              <label>Escolha um nível de acesso:</label>
              <Cascader style={{marginTop: 5, marginBottom: 20}} options={data} onChange={this.onChange} placeholder="Escolha um nível de acesso" />

              <Transfer
                titles={['Inativas','Ativas']}
                style={{marginTop: 5, marginBottom: 20}}
                dataSource={this.state.mockData}
                showSearch
                listStyle={{
                  width: 250,
                  height: 300,
                }}
                operations={['Ativar', 'Desativar']}
                targetKeys={this.state.targetKeys}
                onChange={this.handleChange}
                render={item => `${item.title}`}
                //footer={this.renderFooter}
              />
            </Form.Step>
            <Button size='large'type='primary'htmlType='submit'>Salvar <Icon type='check' /></Button>
          </Form>
        </div>
      </Page.Context>
    </Page>
  }
}

export default RoleAssign
