import React, { Component } from 'react'
import { Field } from 'react-final-form'
import { TextFieldAdapter } from 'adapters'
import CitySelect from 'components/CitySelect'
import { TextField } from 'office-ui-fabric-react'
import PostcodeService from '../services/PostcodeService'

class Address extends Component {
  constructor (props) {
    super(props)
    this.addressesNumber = React.createRef()

    this.state = {
      cep: '',
      address: {
        street: '',
        city: '',
        neighborhood: ''
      }
    }
  }

  render () {
    return <div>
      <div className='textfield-group'>
        <TextField
          label='CEP'
          onChanged={cep => {
            this.setState({cep})
            if (cep.length === 8) {
              PostcodeService.get(cep)
                .then(result => {
                  this.setState({address: result.data})
                  this.addressesNumber.current.focus()
                })
                .catch(error => {
                  console.log(error)
                })
            }
          }}
        />
        <div /> <div />
      </div>

      <div className='textfield-group'>
        <TextField
          label='Rua'
          name='addresses[street]'
          required
          value={this.state.address.street}
        />
        <TextField
          label='Número'
          name='addresses[number]'
          required
          ref={this.addressesNumber}
        />
      </div>

      <div className='textfield-group'>
        <CitySelect
          label='Cidade'
          name='addresses[city]'
          required
          value={this.state.address.city}
        />
        <TextField
          label='Bairro'
          name='addresses[neighborhood]'
          required
          value={this.state.address.neighborhood}
        />
      </div>

      <div className='textfield-group'>
        <Field name='addresses[complement]' label='Complemento' component={TextFieldAdapter} />
      </div>
    </div>
  }
}

export default Address
