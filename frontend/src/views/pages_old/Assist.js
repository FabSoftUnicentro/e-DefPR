import React, { Component } from 'react'
import { CommandBar, DetailsList } from 'office-ui-fabric-react'

import fetch from '../../helpers/fetcher'

class Assist extends Component {
  constructor (props) {
    super(props)

    this.state = {
      assistedList: []
    }
  }

  componentDidMount () {
    fetch.get('/assistido/all')
      .then(response => response.json())
      .then(result => {
        this.setState({ assistedList: result.data })
      })
      .catch(err => console.log(err))
  }

  openLink (pathname) {
    this.props.history.push(pathname)
  }

  render () {
    return <div className='page'>
      <CommandBar
        isSearchBoxVisible
        searchPlaceholderText='Procurar um assistido..'
        farItems={[
          {
            key: 'headerBtRefresh',
            name: 'Relatório',
            iconProps: {
              icon: 'CRMReport' 
            }
          }, {
            key: 'cmdBarAssist',
            name: 'Novo Assistido',
            iconProps: {
              icon: 'Add'
            },
            onClick: () => this.openLink('/assist/create')
          }
        ]}
      />

      <DetailsList
        columns={ProcessListColumns}
        items={this.state.assistedList}
      />

      { this.state.assistedList.length === 0 && <div>Nenhum assistido..</div> }
    </div>
  }
}

const ProcessListColumns =
[
  {
    key: 'col1',
    name: 'Código',
    iconName: 'Page',
    isIconOnly: true,
    minWidth: 50,
    maxWidth: 80,
    isResizable: true,
    onRender: item => <span>{ item.pessoaId }</span>
  }, {
    key: 'col2',
    name: 'Assistido',
    minWidth: 210,
    maxWidth: 300,
    isRowHeader: true,
    isPadded: true,
    isSorted: true,
    isSortedDescending: false,
    onRender: item => <span>{ item.nomeCompleto }</span>
  }, {
    key: 'col3',
    minWidth: 50,
    maxWidth: 100,
    isResizable: true,
    name: 'CPF',
    onRender: item => <span>{ item.cpf }</span>
  }, {
    key: 'col4',
    minWidth: 50,
    maxWidth: 100,
    isResizable: true,
    name: 'Responsável',
    onRender: item => <span>{ item.dtUpdate.toLocaleDateString() }</span>
  }, {
    key: 'col5',
    minWidth: 50,
    isResizable: true,
    name: 'Last',
    onRender: item => <span>Aguardando avaliação psicológica.</span>
  }
]

export default Assist
