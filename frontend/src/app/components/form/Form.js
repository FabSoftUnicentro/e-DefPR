import React, { Component, Children } from 'react'
import Steps from 'antd/lib/steps'
import { Form as FinalForm, Field } from 'react-final-form'
import Input from 'antd/lib/input'
import Select from 'antd/lib/select'
import Button from 'antd/lib/button'
import Icon from 'antd/lib/icon'
import Divider from 'antd/lib/divider'
import InputAdapter from '../../adapters/InputAdapter'
import DatePickerAdapter from '../../adapters/DatePickerAdapter'
import SelectAdapter from '../../adapters/SelectAdapter'
import CitySelectAdapter from '../../adapters/CitySelectAdapter'

class Form extends Component {
  static Step = ({ children }) => <div>{ children }</div>

  static TextField = props => <Field {...props} component={InputAdapter} />
  static DatePicker = props => <Field {...props} component={DatePickerAdapter} />
  static CitySelect = props => <Field {...props} component={CitySelectAdapter} />
  
  static Select = ({options, ...props}) => (<Field {...props} component={SelectAdapter}>
    { options.map(item => <Select.Option key={item.value} value={item.value}>{item.name}</Select.Option>) }
  </Field>)

  static Inline = ({ children }) => <Input.Group compact>{ children }</Input.Group>

  constructor (props) {
    super(props)

    this.state = {
      steps: [],
      current: 1
    }

    this.handleSubmit = this.handleSubmit.bind(this)
    this.nextStep = this.nextStep.bind(this)
    this.prevStep = this.prevStep.bind(this)
  }

  componentDidMount () {
    const { children } = this.props
    this.setState({
      steps: children.map(({props}) => props)
    })
  }

  nextStep () {
    this.setState({ current: this.state.current + 1 })
  }

  prevStep () {
    this.setState({ current: this.state.current - 1 })
  }

  handleSubmit (values) {
    console.log(values)
  }

  render () {
    const { steps, current } = this.state
    
    return <div>
      <Steps current={current}>
        { steps.map(step => <Steps.Step key={step.title} title={step.title} />) }
      </Steps>

      <FinalForm
        onSubmit={this.handleSubmit}
      >
        {({ handleSubmit, submitting, values }) => (
          <form onSubmit={handleSubmit}>
            { this.currentStep }

            <div style={{marginBottom:30}}>
              <Divider />

              <div style={{display:'flex', justifyContent:'space-between'}}>
                <Button
                  size="large"
                  disabled={current===0}
                  onClick={this.prevStep}
                >
                  <Icon type="arrow-left"/> Anterior
                </Button>

                {!this.isLastPage && <Button
                  size="large"
                  type="primary"
                  onClick={this.nextStep}
                >
                  Próximo <Icon type="arrow-right"/>
                </Button> }

                {this.isLastPage && <Button
                  size="large"
                  type="primary"
                  htmlType="submit"
                >
                  Salvar <Icon type="check"/>
                </Button> }
              </div>
            </div>
          </form>
        )}
      </FinalForm>
    </div>
  }

  get isLastPage () {
    const { current, steps } =  this.state
    return current === steps.length - 1
  }

  get currentStep () {
    const { children } = this.props
    return Children.toArray(children)[this.state.current]
  }
}

export default Form
