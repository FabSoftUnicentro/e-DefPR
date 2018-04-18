import React, { Component } from 'react'
import SignInHeader from './SignInHeader'
import { Label, TextField, DefaultButton } from 'office-ui-fabric-react';

class RecoveryPassword extends Component {
  constructor (props) {
    super(props)

    this.state = {
      isLoading: false
    }
  }

  render () {
    const { isLoading } = this.state

    return <div>
      <SignInHeader isLoading={isLoading} />
      <Label>Se o cpf estiver cadastrado você reberá um e-mail com
        instruções para recurar sua senha.</Label>
      <TextField label='CPF' />

      <div className='login-action'>
        <div />
        <DefaultButton primary text='Recuperar' />
      </div>
    </div>
  }
}

export default RecoveryPassword
