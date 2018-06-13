import React, { Component, Fragment } from 'react'
import SignInHeader from './SignInHeader'
import { Label, TextField, DefaultButton } from 'office-ui-fabric-react'

class RecoveryPassword extends Component {
  constructor (props) {
    super(props)

    this.state = {
      isLoading: false
    }
  }

  goBack () {
    this.props.history.push('/signin')
  }

  render () {
    const { isLoading } = this.state

    return <Fragment>
      <SignInHeader isLoading={isLoading} />
      <Label>Se o cpf estiver cadastrado você reberá um e-mail com
        instruções para recurar sua senha.</Label>
      <TextField label='CPF' />

      <div className='login-action'>
        <Fragment />
        <DefaultButton default text='Voltar' onClick={ this.goBack.bind(this) } />
        <DefaultButton primary text='Recuperar' />
      </div>
    </Fragment>
  }
}

export default RecoveryPassword
