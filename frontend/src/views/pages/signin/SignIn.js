import React, { Component } from 'react'
import { Redirect, Switch, Link as RouterLink } from 'react-router-dom'
import LinkTheachingBubble from 'views/components/LinkTeachingBubble'
import PropsRoute from 'views/components/PropsRoute'
import { TextField, DefaultButton, Link, MessageBar, MessageBarType } from 'office-ui-fabric-react'
import SignInHeader from './SignInHeader'
import RecoveryPassword from './RecoveryPassword'
import authService from 'services/AuthService'

import 'styles/SignIn.css'

const PATH = '/signin'
const PATH_RECOVERY = `${PATH}/recovery-password`

const InvalidCpfOrPasswordMessage = (
  <MessageBar messageBarType={MessageBarType.blocked}>
    CPF ou senha inválidos.
  </MessageBar>
)

const WarningSignInMessage = (
  <MessageBar messageBarType={MessageBarType.warning}>
    Campos CPF e senha são obrigatórios.
  </MessageBar>
)

const SuccessSignInMessage = (
  <MessageBar messageBarType={MessageBarType.success}>
    Você entrou, vamos levar você para o painel.
  </MessageBar>
)

class SignIn extends Component {
  constructor (props) {
    super(props)

    this.state = {
      isLoading: false,
      messageComponent: null,
      redirectToReferrer: false,
      form: {}
    }

    this.onTextfieldChange = this.onTextfieldChange.bind(this)
    this.onSignIn = this.onSignIn.bind(this)
    this.onSignInSuccess = this.onSignInSuccess.bind(this)
  }

  onTextfieldChange (name, value) {
    let { form } = this.state
    form[name] = value

    this.setState({ form: form })
  }

  onSignIn () {
    const { cpf, password } = this.state.form

    if (!cpf || !password) {
      this.setState({
        messageComponent: WarningSignInMessage
      })
      return
    }

    this.setState({ isLoading: true })

    authService.login(cpf, password)
      .then(result => {
        this.setState({ isLoading: false }) // stop loading animation
        if (result.status === 404) {
          this.setState({
            messageComponent: InvalidCpfOrPasswordMessage
          })
        } else if (result.status === 200) {
          this.onSignInSuccess(result.data)
        }
      })
      .catch(err => {
        console.log('Error', err)
      })
  }

  onSignInSuccess (data) {
    this.setState({
      redirectToReferrer: true,
      messageComponent: SuccessSignInMessage
    })
  }

  render () {
    /** Must redirect to home. */
    if (this.state.redirectToReferrer) {
      return <Redirect to='/' />
    }

    const { messageComponent, isLoading } = this.state

    return <div className='login'>
      <div className='login-box'>
        <Switch>
          <PropsRoute
            exact
            path={PATH}
            isLoading={isLoading}
            message={messageComponent}
            onSignIn={this.onSignIn}
            component={SignInForm}
            onChange={this.onTextfieldChange}
          />
          <PropsRoute
            path={PATH_RECOVERY}
            component={RecoveryPassword}
            isLoading={isLoading}
          />
        </Switch>

        <div className='login-footer'>
          <LinkTheachingBubble
            linkName='Ajuda'
            description={`Lorem ipsum dolor sit amet, consectetur adipisicing 
            elit.Facere, nulla, ipsum? Molestiae quis aliquam magni harum non?`}
            primaryButton={{
              children: 'Veja a Wiki'
            }}
          />
        </div>
      </div>
    </div>
  }
}

const SignInForm = ({isLoading, onChange, onSignIn, ...rest}) => (
  <div>
    <SignInHeader isLoading={isLoading} />

    { rest.message }

    <TextField
      label='CPF'
      onChanged={val => onChange('cpf', val)}
      validateOnFocusOut
      validateOnLoad={false}
      onGetErrorMessage={value => {
        return value.match(/[0-9]{11}/g) && value.length === 11
          ? ''
          : 'Deve ser um CPF. Somente números.'
      }}
    />
    <TextField type='password' label='Senha' onChanged={val => onChange('password', val)} />

    <div className='login-action'>
      <RouterLink to={PATH_RECOVERY}>
        <Link>Esqueci minha senha</Link>
      </RouterLink>
      <DefaultButton primary text='Acessar' onClick={onSignIn} />
    </div>
  </div>
)

export default SignIn