import React, { Component } from 'react'
import SelectAdapter from './SelectAdapter'
import { Field } from 'react-final-form'
import Input from 'antd/lib/input'
import FormItem from 'antd/lib/form/FormItem'
import message from 'antd/lib/message'
import Spin from 'antd/lib/spin'
import { location } from '../services'

class CitySelectAdapter extends Component {
  constructor (props) {
    super(props)

    this.state = {
      states: [],
      cities: [],
      loadingStates: false,
      loadingCities: false
    }

    this.handleOnChange = this.handleOnChange.bind(this)
    this.selectState = this.selectState.bind(this)
  }

  componentDidMount () {
    this.setState({ loadingStates: true })
  }

  componentDidUpdate () {
    if (this.state.states.length === 0) {
      location.states()
        .then(({data}) => this.setState({ states: data }))
        .catch(() => message.error('Não foi possível retornar lista de estados'))
        .finally(() => this.setState({ loadingStates: false }))
    }
  }

  selectState (stateName) {
    this.setState({ loadingCities: true, cities: [] })
    location.getStateCities(stateName)
      .then(({data}) => this.setState({ cities: data }))
      .catch(() => message.error('Não foi possível retornar lista de cidades'))
      .finally(() => this.setState({ loadingCities: false }))
  }

  handleOnChange (city) {
    this.props.onChange && this.props.onChange(city)
  }

  render () {
    const { states, cities, loadingStates, loadingCities } = this.state
    const { label, input: { name }, required } = this.props

    return <FormItem label={label} style={{margin: 0}} required={required}>
      <Input.Group compact>
        <Spin size='small' spinning={loadingStates}>
          <Field
            showSearch
            name={`${name}[state]`}
            component={SelectAdapter}
            style={{width: 120, marginRight: 20}}
            placeholder='Estado'
            disabled={states.length === 0}
            onSelect={this.selectState}
            options={states.map(({id, abbr}) => ({ value: id, name: abbr }))}
            filterOption={this.filterByName}
          />
        </Spin>

        <Spin size='small' spinning={loadingCities}>
          <Field
            showSearch
            name={`${name}[city]`}
            component={SelectAdapter}
            style={{width: 300}}
            onSelect={this.handleOnChange}
            placeholder='Cidade'
            options={cities.map(({id, name}) => ({ value: id, name: name }))}
            disabled={cities.length === 0}
            filterOption={this.filterByName}
          />
        </Spin>
      </Input.Group>
    </FormItem>
  }

  get filterByName () {
    return (input, option) => option.props.children.toLowerCase().indexOf(input.toLowerCase()) >= 0
  }
}

export default CitySelectAdapter
