import React, { Component } from 'react'
import { DefaultButton, MessageBar, MessageBarType } from 'office-ui-fabric-react'

import '../../styles/FabricStepper.css'

class FabricStepper extends Component {
  constructor (props) {
    super(props)

    this.state = {
      currentStep: 0,
      submitting: false,
      error: null
    }

    this.nextStep = this.nextStep.bind(this)
    this.lastStep = this.lastStep.bind(this)
    this.handleSubmit = this.handleSubmit.bind(this)
  }

  nextStep () {
    this.setState((prevState) => ({ currentStep: prevState.currentStep + 1 }))
  }

  lastStep () {
    this.setState((prevState) => ({ currentStep: prevState.currentStep - 1 }))
  }

  handleSubmit (event) {
    event.preventDefault()
    this.setState({ error: null })

    let stepRequiredInputs = event.target
      .querySelectorAll('div.Fabric-Stepper-Step.is-open input:required:not(:valid)')

    let stepValidRequiredInputs = event.target
      .querySelectorAll('div.Fabric-Stepper-Step.is-open input:required:valid')

    stepValidRequiredInputs.forEach(i => i.setAttribute('aria-invalid', 'false'))

    if (stepRequiredInputs.length > 0) {
      this.setState({ error: 'Alguns campos obrigatórios não foram preenchidos.' })
      stepRequiredInputs.forEach(i => i.setAttribute('aria-invalid', 'true'))
      return
    }

    if (this.state.currentStep === this.props.children.length - 1) {
      this.props.onSubmit(event)
      return
    }

    this.nextStep()
  }

  render () {
    const { currentStep } = this.state

    return <form className='ms-form' onSubmit={this.handleSubmit} noValidate>

      <div className='Fabric-Stepper-Header'>
        { this.props.children.map(({ props }, i) => (
          <div key={i} className={(this.state.currentStep === i) ? 'is-open' : ''}>{ props.title }</div>
        )) }
      </div>

      {this.state.error && <MessageBar
        messageBarType={MessageBarType.warning}
        style={{ marginBottom: 20 }}>
        { this.state.error }
      </MessageBar> }

      <div className='Fabric-Stepper'>
        { this.props.children.map(({ props }, i) => (
          <FabricStepper.Step key={i} itemKey={i} {...props} step={this.state.currentStep} />
        )) }
      </div>

      <div className='Fabric-Stepper-Buttons'>
        <DefaultButton
          type='button'
          text='Passo anterior'
          disabled={currentStep === 0}
          onClick={this.lastStep}
        />

        <DefaultButton
          type='submit'
          primary
          text='Próximo passo'
          disabled={this.state.submitting}
        />
      </div>
    </form>
  }
}

FabricStepper.Step = class FabricStepperStep extends Component {
  constructor (props) {
    super(props)

    this.state = {
      isOpen: props.itemKey === props.step
    }
  }

  componentWillReceiveProps (nextProps) {
    if (nextProps.step !== null) {
      this.setState({ isOpen: this.props.itemKey === nextProps.step })
    }
  }

  render () {
    return <div className={`Fabric-Stepper-Step${(this.state.isOpen ? ' is-open' : '')}`}>
      { this.props.children }
    </div>
  }
}

export default FabricStepper
