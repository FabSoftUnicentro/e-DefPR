import React, { Component } from 'react'
import { Label } from 'office-ui-fabric-react'
import Select, { Async } from 'react-select'
import CitiesService from 'services/CitiesService'
import StatesService from 'services/StatesService'

class CitySelect extends Component {
  constructor (props) {
    super(props)

    this.state = {
      selectedState: null,
      selectedCity: null,
      cityList: [],
      stateList: []
    }

    this.updateSelectedState = this.updateSelectedState.bind(this)
    this.selectCity = this.selectCity.bind(this)
  }

  updateSelectedState (item) {
    if (!item) {
      this.setState({ selectedState: null, cityList: [] })
      return // Fix bug on clear input.
    }

    CitiesService.listByState(item.value)
      .then(response => {
        const cityList = response.data.map(item => ({ value: item.cidadeId, label: item.nome }))
        this.setState({ cityList: cityList })
      })

    this.setState({ selectedState: item.value })
  }

  selectCity (item) {
    if (!item) {
      this.setState({ selectedCity: null })
      return // Fix bug on clear input.
    }

    this.setState({ selectedCity: item.value })
    this.props.onChange(({ cidadeId: item.value }))
  }

  render () {
    return (<div className='ms-TextField-wrapper'>
      <Label>{ this.props.label }</Label>
      <div className='Form-Select-City'>
        <Async
          placeholder='UF'
          searchable
          style={{width: 100}}
          value={this.state.selectedState}
          loadOptions={LoadStateList}
          onChange={this.updateSelectedState}
        />
        <Select
          placeholder='Cidade'
          searchable
          value={this.state.selectedCity}
          disabled={this.state.cityList.length === 0}
          options={this.state.cityList}
          onChange={this.selectCity}
        />
      </div>
    </div>)
  }
}

const LoadStateList = input => {
  return StatesService.index()
    .then(response => {
      const selectOptions = response.data.map(item => ({ value: item.estadoId, label: item.uf }))
      return { options: selectOptions }
    })
}

export default CitySelect
