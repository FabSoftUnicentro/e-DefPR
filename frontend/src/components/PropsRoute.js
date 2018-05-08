import React from 'react'
import Route from 'react-router-dom/Route'
import PropTypes from 'prop-types'

export const renderMergedProps = (component, ...rest) => {
  const finalProps = Object.assign({}, ...rest)
  return React.createElement(component, finalProps)
}

/**
 * Combines ReactRouter.Route with custom props.
 */
const PropsRoute = ({component, ...rest}) => (
  <Route {...rest} render={routeProps => (
    renderMergedProps(component, routeProps, rest)
  )} />
)

PropsRoute.propTypes = {
  component: PropTypes.func.isRequired
}

export default PropsRoute
