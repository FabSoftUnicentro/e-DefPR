import React, { Component, Fragment } from 'react'
import SignInHeader from './SignInHeader'
import { Label, TextField, DefaultButton } from 'office-ui-fabric-react'

class ChangePassword extends Component {
  constructor (props) {
    super(props)

    this.state = {
      isLoading: false
    }
  }

  render () {
    const { isLoading } = this.state

    return (<Fragment>
      <SignInHeader isLoading={isLoading} />
      <Label>Se o cpf estiver cadastrado você reberá um e-mail com instruções para recurar sua senha.</Label>
      <TextField label='Senha' />
      <TextField label='Confirmar Senha' />

      <div className='login-action'>
        <Fragment />
        <DefaultButton primary text='Alterar Senha' />
      </div>
    </Fragment>)
  }
}

export default ChangePassword
