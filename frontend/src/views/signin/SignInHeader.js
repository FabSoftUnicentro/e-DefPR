import React from 'react'
import { IconButton, Spinner } from 'office-ui-fabric-react'

const SignInHeader = ({isLoading}) => (
  <div className='login-header'>
    <div>
      <IconButton
        iconProps={{ iconName: 'SecurityGroup' }}
        title='Voltar'
        ariaLabel='Emoji'
      />
      <span>eDef-PR</span>
    </div>
    { isLoading && <Spinner /> }
  </div>
)

export default SignInHeader
