import React, { Fragment } from 'react'
import { IconButton, Spinner } from 'office-ui-fabric-react'

const SignInHeader = ({isLoading}) => (
  <div className='login-header'>
    <Fragment>
      <IconButton
        iconProps={{ iconName: 'SecurityGroup' }}
        title='Voltar'
        ariaLabel='Emoji'
      />
      <span>eDef-PR</span>
    </Fragment>
    { isLoading && <Spinner /> }
  </div>
)

export default SignInHeader
