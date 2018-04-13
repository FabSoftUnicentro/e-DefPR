import React, { Component } from 'react'
import { CommandBar, DetailsList } from 'office-ui-fabric-react'

import Fetch from '../../helpers/Fetcher'

class Assist extends Component {
  constructor (props) {
    super(props)

    this.state = {
      assistedList: []
    }
  }

  componentDidMount () {
    Fetch.get('/assistido/all')
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
            icon: 'CRMReport'
          }, {
            key: 'cmdBarAssist',
            name: 'Novo Assistido',
            icon: 'Add',
            onClick: () => this.openLink('/assist/create')
          }
        ]}
      />

      <DetailsList
        columns={ProcessListColumns}
        items={this.state.assistedList}
      />
    </div>
  }
}

const ProcessListColumns =
[
  {
    key: 'col1',
    name: 'Processo',
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
    name: 'Telefone',
    onRender: item => <span>{ item.dtUpdate.toLocaleDateString() }</span>
  }, {
    key: 'col5',
    minWidth: 50,
    isResizable: true,
    name: 'Status',
    onRender: item => <span>Aguardando avaliação psicológica.</span>
  }
]

export default Assist
