import React, { Component } from 'react'
import { Link } from 'react-router-dom'
import PropTypes from 'prop-types'
import Menu from 'antd/lib/menu'
import Icon from 'antd/lib/icon'

import './Sidebar.css'

class Sidebar extends Component {
  static propTypes = {
    pathname: PropTypes.string.isRequired
  }

  render () {
    const { pathname } = this.props

    return <div className='app-sidebar'>
      <Menu
        mode='inline'
        style={{border: 'none'}}
        defaultSelectedKeys={[`/`]}
        selectedKeys={[`${pathname}`]}
        defaultOpenKeys={['sub2']}
      >
        <Menu.Item key='/'><Icon type='home' /> <Link to='/'>Visão geral</Link></Menu.Item>
        <Menu.Item key='/assisted'><Link to='/assisted'/><Icon type='team' /> Assistidos</Menu.Item>
        <Menu.Item key='a-3'><Icon type='solution' /> Processos</Menu.Item>
        <Menu.SubMenu key='sub1' title={<span><Icon type='profile' /><span>Triagens</span></span>}>
          <Menu.Item key='b-1'>Triagem inicial</Menu.Item>
          <Menu.Item key='b-2'>Triagem socioeconômica</Menu.Item>
        </Menu.SubMenu>
        <Menu.SubMenu key='sub2' title={<span><Icon type='book' /><span>Recursos Humanos</span></span>}>
          <Menu.Item key='/role'><Link to='/role'/><Icon type='key' /> Níveis de acesso</Menu.Item>
          <Menu.Item key='/permission'><Link to='/permission'/><Icon type='idcard' /> Permissões</Menu.Item>
          <Menu.Item key='/employee'><Icon type='team' /><Link to='/employee'>Funcionários</Link></Menu.Item>
          <Menu.Item key='c-3'><Icon type='database' /> Relatórios</Menu.Item>
        </Menu.SubMenu>
      </Menu>
    </div>
  }
}

export default Sidebar
