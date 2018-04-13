import React, { Component } from 'react'
import {
  Pivot,
  PivotItem,
  PivotLinkFormat,
  DefaultButton
} from 'office-ui-fabric-react'

import '../../styles/FormStepper.css'

class FormStepper extends Component {
  constructor (props) {
    super(props)

    this.state = {
      selectedKey: 2
    }

    this.onNextStep = this.onNextStep.bind(this)
    this.onBackStep = this.onBackStep.bind(this)
  }

  onNextStep () {
    if (this.state.selectedKey === this.props.steps.length - 1) {
      return
    }

    this.setState((prevState) => (
      { selectedKey: (prevState.selectedKey + 1) }
    ))
  }

  onBackStep () {
    this.setState((prevState) => (
      { selectedKey: (prevState.selectedKey - 1) }
    ))
  }

  render () {
    const { selectedKey } = this.state
    const isLastKey = (selectedKey === this.props.steps.length - 1)

    return <div className='form-stepper'>
      <Pivot linkFormat={PivotLinkFormat.tabs} selectedKey={`${selectedKey}`}>
        {this.props.steps.map(step => (
          <PivotItem
            key={step.key}
            linkText={step.name}
            itemIcon={(step.completed) ? 'SkypeCircleCheck' : 'CircleRing'}
            itemKey={step.key}
          >
            { step.component && step.component }
          </PivotItem>
        ))}
      </Pivot>

      <div className='form-stepper-footer'>
        <DefaultButton
          text='Passo anterior'
          iconProps={{ iconName: 'Back' }}
          onClick={this.onBackStep}
          disabled={(selectedKey === 0)}
        />

        <DefaultButton
          primary
          text={isLastKey ? 'Salvar' : 'Próximo passo'}
          iconProps={{ iconName: isLastKey ? 'CheckMark' : 'Forward' }}
          onClick={this.onNextStep}
        />
      </div>
    </div>
  }
}

export default FormStepper
