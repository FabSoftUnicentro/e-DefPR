import React, { Component } from 'react'
import { Link } from 'react-router-dom'
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
        defaultOpenKeys={['sub2']}
      >
        <Menu.Item key="a-1"><Icon type="home" /> <Link to="/">Visão geral</Link></Menu.Item>
        <Menu.Item key="a-2"><Icon type="team" /> Assistidos</Menu.Item>
        <Menu.Item key="a-3"><Icon type="solution" /> Processos</Menu.Item>
        <Menu.SubMenu key="sub1" title={<span><Icon type="profile" /><span>Triagens</span></span>}>
          <Menu.Item key="b-1">Triagem inicial</Menu.Item>
          <Menu.Item key="b-2">Triagem socioeconômica</Menu.Item>
        </Menu.SubMenu>
        <Menu.SubMenu key="sub2" title={<span><Icon type="book" /><span>Recursos Humanos</span></span>}>
          <Menu.Item key="c-1"><Link to="/employee/new">Cadastrar funcionário</Link></Menu.Item>
          <Menu.Item key="c-2"><Link to="/employee">Funcionários</Link></Menu.Item>
          <Menu.Item key="c-3">Relatórios</Menu.Item>
        </Menu.SubMenu>
      </Menu>
    </div>
  }
}

export default Sidebar
