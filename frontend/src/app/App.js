import React, { Component } from 'react'
import { BrowserRouter as Router, Route } from 'react-router-dom'
import Header from './components/header/Header'
import Sidebar from './components/sidebar/Sidebar'
import Dashboard from './pages/Dashboard'

import './App.css'

class App extends Component {
  render () {
    return <div className="app">
      <Header region={{ name: "Guarapuava" }} />

      <main>
        <Sidebar />
        <Router>
          <Route path="/" component={Dashboard} />
        </Router>
      </main>
    </div>
  }
}

export default App
