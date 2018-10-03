import React, { Children } from 'react'
import Steps, { Step } from 'antd/lib/steps'
import Button from 'antd/lib/button'
import Icon from 'antd/lib/icon'
import PropTypes from 'prop-types'
import Form from './Form'
import { StyledWizardForm } from './WizardForm.style'

class WizardForm extends Form {
  static Page = ({ children }) => <div>{ children }</div>

  static propTypes = {
    validateSchema: PropTypes.array
  }

  static defaultProps = {
    styledForm: true
  }

  constructor (props) {
    super(props)

    this.state = {
      steps: [],
      currentPage: 0
    }

    this.nextPage = this.nextPage.bind(this)
    this.prevPage = this.prevPage.bind(this)
  }

  componentDidMount () {
    const { children } = this.props

    this.setState({
      steps: children.map(({ props }) => props)
    })
  }

  async onSubmit (values) {
    if (this.isLastPage) {
      return super.onSubmit(values)
    }

    return this.nextPage()
  }

  async onValidate (values) {
    const { validateSchema } = this.props
    if (!validateSchema) {
      return undefined
    }

    try {
      await validateSchema[this.state.currentPage].validate(values)
      return undefined // returns undefined if is valid
    } catch (error) {
      const errors = {}
      errors[error.path] = error.message
      return errors
    }
  }

  nextPage () {
    this.setState({ currentPage: this.state.currentPage + 1 })
  }

  prevPage () {
    this.setState({ currentPage: this.state.currentPage - 1 })
  }

  renderForm () {
    const { steps, currentPage } = this.state
    return <StyledWizardForm>
      <Steps current={currentPage}>
        {steps.map(({ title, icon, ...props }) => <Step key={title} title={title} {...props} icon={<Icon type={icon} />} />)}
      </Steps>
      <div className='steps-content'>{ this.currentStep }</div>
      <div className='steps-action'>
        <Button size='large' disabled={this.isFirstPage} onClick={this.prevPage} icon='arrow-left'>Passo anterior</Button>
        {
          this.isLastPage ? (
            <Button type='primary' size='large' htmlType='submit' icon='check'>Finalizar</Button>
          ) : (
            <Button type='primary' size='large' htmlType='submit'>Próximo passo <Icon type='arrow-right' /></Button>
          )
        }
      </div>
    </StyledWizardForm>
  }

  get currentStep () {
    const { children } = this.props
    return Children.toArray(children)[this.state.currentPage]
  }

  get isFirstPage () {
    return this.state.currentPage === 0
  }

  get isLastPage () {
    return this.state.currentPage === this.props.children.length - 1
  }
}

export default WizardForm
