import React, { Component } from 'react'
import Menu from 'antd/lib/menu'
import Icon from 'antd/lib/icon'

import './Sidebar.css'

class Sidebar extends Component {
  render () {
    return <div className="app-sidebar">
      <Menu
        mode="inline"
        style={{border:'none'}}
        defaultSelectedKeys={['a-1']}
        defaultOpenKeys={['sub1']}
      >
        <Menu.Item key="a-1"><Icon type="home" /> Visão geral</Menu.Item>
        <Menu.Item key="a-2"><Icon type="team" /> Assistidos</Menu.Item>
        <Menu.Item key="a-3"><Icon type="solution" /> Processos</Menu.Item>
        <Menu.SubMenu key="sub1" title={<span><Icon type="book" /><span>Recursos Humanos</span></span>}>
          <Menu.Item key="b-1">Cadastrar funcionário</Menu.Item>
          <Menu.Item key="b-2">Funcionários</Menu.Item>
          <Menu.Item key="b-3">Relatórios</Menu.Item>
        </Menu.SubMenu>
      </Menu>
    </div>
  }
}

export default Sidebar
