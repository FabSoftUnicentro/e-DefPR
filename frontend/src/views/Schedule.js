import React, { Component } from 'react'
import {
  DocumentCard,
  DocumentCardTitle,
  DocumentCardLocation,
  DocumentCardActivity,
  DetailsList,
  CommandBar
} from 'office-ui-fabric-react'
import 'styles/Schedule.css'

class Schedule extends Component {
  render () {
    return <div className='schedule'>
      <div className='schedule-cards'>
        <DocumentCard>
          <DocumentCardLocation location='Será arquivado em 10 dias' />
          <DocumentCardTitle title='O assistido não entregou os documentos necessários.' />
          <DocumentCardActivity
            activity='Criado em 10 Jan, 2017'
            people={[
              { name: 'Some One' }
            ]}
          />
        </DocumentCard>

        <DocumentCard>
          <DocumentCardLocation location='Será arquivado em 10 dias' />
          <DocumentCardTitle title='Example card 1.' />
          <DocumentCardActivity
            activity='Criado em 10 Jan, 2017'
            people={[
              { name: 'Person Linda' }
            ]}
          />
        </DocumentCard>
      </div>

      <div className='schedule-table'>
        <CommandBar
          isSearchBoxVisible
          searchPlaceholderText='Procurar...'
          items={[
            { key: 'k1', name: 'Atualizar', icon: 'Refresh' },
            { key: 'k2', name: 'Gerar Relatório', icon: 'TextDocument' },
            { key: 'l1', name: 'Filtrar', icon: 'Filter' }
          ]}
        />
        <DetailsList
          columns={ProcessListColumns}
          items={ProcessList}
        />
      </div>
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
    onRender: item => <span>{ item.id }</span>
  }, {
    key: 'col2',
    name: 'Assistido',
    minWidth: 210,
    maxWidth: 300,
    isRowHeader: true,
    isPadded: true,
    isSorted: true,
    isSortedDescending: false,
    onRender: item => <span>{ item.assistido }</span>
  }, {
    key: 'col3',
    minWidth: 50,
    maxWidth: 100,
    isResizable: true,
    name: 'Criação',
    onRender: item => <span>{ item.dtCreation.toLocaleDateString() }</span>
  }, {
    key: 'col4',
    minWidth: 50,
    maxWidth: 100,
    isResizable: true,
    name: 'Última',
    onRender: item => <span>{ item.dtUpdate.toLocaleDateString() }</span>
  }, {
    key: 'col5',
    minWidth: 50,
    isResizable: true,
    name: 'Status',
    onRender: item => <span>Aguardando avaliação psicológica.</span>
  }
]

const ProcessList =
[
  {
    key: 'p1',
    id: '54313',
    assistido: 'Person One',
    dtCreation: new Date(),
    dtUpdate: new Date(),
    status: 'Aguardando avaliação psicológica.'
  },
  {
    key: 'p2',
    id: '54313',
    assistido: 'Person Linda',
    dtCreation: new Date(),
    dtUpdate: new Date(),
    status: 'Aguardando avaliação psicológica.'
  }

]

export default Schedule
