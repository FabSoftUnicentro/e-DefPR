import React, { Component } from 'react'
import Page from '../../components/page/Page'
import Form from '../../components/form/Form'
import message from 'antd/lib/message'
import { Cascader, Row, Col, Checkbox, Button, Icon } from 'antd'
import { roleService } from '../../services'
import { Redirect } from 'react-router-dom'

class RoleAssign extends Component {
  constructor (props) {
    super(props)

    this.state = {
      data: undefined,
      permissionList: undefined,
      permissions: undefined,
      selectedRole: undefined,
      total: 0,
      visible: false,
      redirect: false,
      selected: {
        name: ''
      }
    }

    this.onClick = this.onClick.bind(this)
    this.onChange = this.onChange.bind(this)
    this.onChangePermissionState = this.onChangePermissionState.bind(this)
  }

  async componentDidMount () {
    try {
      const { data } = await roleService.listAllRoles()
      const mappedData = data.map(item => ({ value: item.id, label: item.name }))
      this.setState({ data: mappedData })
    } catch (error) {
      message.error('Não foi possível acessar os níveis de acesso.')
    }
  }

  attachMessage (type, message) {
    this.setState({ alertProps: { type, message } })
  }

  async onChange (values, selectedOptions) {
    try {
      this.setState({ permissionList: undefined })
      const [ id ] = values
      const data = await roleService.listPermissions(id)
      const permissionList = Object.values(data).map(item => ({ key: item.id, title: item.name, chosen: item.chosen }))
      this.setState({ selectedRole: id, permissionList })
    } catch (error) {
      message.error('Não foi possível acessar as informações dos funcionários.')
    }
  }

  async onChangePermissionState (checkedValue) {
    const removeAssignMessage = message.loading('Associando permissão a nível de acesso', 0)

    const { selectedRole } = this.state
    const { target: { value, checked } } = checkedValue

    try {
      const result = checked ? await roleService.assignPermission(selectedRole, value) : await roleService.unassignPermission(selectedRole, value)

      if (result.status === 200) {
        message.success('Associado permissão a nível de acesso com sucesso!')
      } else {
        return message.error('Não foi possível associar permissão a nível de acesso!', 2)
      }
    } catch (error) {
      return message.error('Erro inesperado, tente novamente!', 2)
    } finally {
      removeAssignMessage()
    }
  }

  handleChange (targetKeys, direction, moveKeys) {
    this.setState({ targetKeys })
  }

  onClick () {
    this.setState({
      redirect: true
    })
  }

  render () {
    const { data, permissionList } = this.state
    if (this.state.redirect === true) {
      return <Redirect to='/role' />
    }

    return <Page>
      <Page.Header />

      <Page.Context>
        <h2>Associar permissões a nível de acesso</h2>

        <div className='app-page-box'>
          <Form
            onSubmit={this.onSubmit}
          >
            <label>Escolha um nível de acesso e marque as permissões que deseja associar:</label>
            <Cascader style={{ marginTop: 5, marginBottom: 20 }} options={data} onChange={this.onChange} placeholder='Escolha um nível de acesso' />

            <Row>
              { permissionList && permissionList.map(item => (
                <Col span={8} >
                  <Checkbox defaultChecked={item.chosen} value={item.key} onChange={this.onChangePermissionState}>{item.title}</Checkbox>
                </Col>
              )) }
            </Row>
            <Button style={{ marginTop: 15 + 'px' }} size='large' type='primary' onClick={this.onClick} htmlType='submit'>Encerrar edição<Icon type='check' /></Button>
          </Form>
        </div>
      </Page.Context>
    </Page>
  }
}

export default RoleAssign
