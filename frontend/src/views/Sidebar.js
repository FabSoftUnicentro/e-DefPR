import React, { Component } from 'react'
import { Nav } from 'office-ui-fabric-react/lib/Nav'

class Sidebar extends Component {
  constructor (props) {
    super(props)

    this.openLinkInRouter = this.openLinkInRouter.bind(this)
  }

  openLinkInRouter (event, item) {
    event.preventDefault()
    this.props.history.push(item.url)
  }

  render () {
    return (<div className='sidebar'>
      <Nav
        groups={
          [
            {
              links: [
                {
                  name: 'Home',
                  url: '/',
                  iconProps: { iconName: 'Home' }
                },
                {
                  name: 'Assistidos',
                  links: [
                    { name: 'Consultar', url: '/persons', iconProps: { iconName: 'ProfileSearch' } },
                    { name: 'Adicionar', url: '/persons/create', iconProps: { iconName: 'AddFriend' } },
                    { name: 'Arquivados', url: '/persons/archive', iconProps: { iconName: 'TemporaryUser' } }
                  ],
                  isExpanded: true
                },
                {
                  name: 'Funcionários',
                  url: '/employee',
                  iconProps: { iconName: 'AccountManagement' }
                }
              ]
            }
          ]
        }
        onLinkClick={this.openLinkInRouter}
      />
    </div>)
  }
}

export default Sidebar
