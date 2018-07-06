import React, { Component } from 'react'
import Header from './components/header/Header'
import Sidebar from './components/sidebar/Sidebar'
import Dashboard from './pages/Dashboard'

import 'element-theme-default'
import './App.css'

class App extends Component {
  render () {
    return <div className="app">
      <Header region={{ name: "Guarapuava" }} />

      <main>
        <Sidebar />
        <Dashboard />
      </main>
    </div>
  }
}

export default App
