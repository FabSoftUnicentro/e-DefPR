import React, { Component } from 'react'
import Select from 'react-select'

class BasicSelect extends Component {
  constructor (props) {
    super(props)

    this.state = {
      value: undefined
    }
  }

  onChange (input, name) {
    this.setState({ value: input.value })
    this.props.onChange(input.value)
  }

  render () {
    return (<Select
      {...this.props}
      value={this.state.value}
      onChange={value => this.onChange(value, this.props.name)}
    />)
  }
}

export default BasicSelect
