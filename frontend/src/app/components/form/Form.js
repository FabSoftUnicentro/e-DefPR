import React, { Component, Children } from 'react'
import Steps from 'antd/lib/steps'
import { Form as FinalForm, Field } from 'react-final-form'
import Input from 'antd/lib/input'
import Select from 'antd/lib/select'
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
      current: 0
    }

    this.handleSubmit = this.handleSubmit.bind(this)
  }

  componentDidMount () {
    const { children } = this.props
    this.setState({
      steps: children.map(({props}) => props)
    })
  }

  handleSubmit (values) {
    console.log(values)
  }

  render () {
    const { steps } = this.state
    
    return <div>
      <Steps>
        { steps.map(step => <Steps.Step key={step.title} title={step.title} />) }
      </Steps>

      <FinalForm
        onSubmit={this.handleSubmit}
      >
        {({ handleSubmit, submitting, values }) => (
          <form onSubmit={handleSubmit}>
            { this.currentStep }
          </form>
        )}
      </FinalForm>
    </div>
  }

  get currentStep () {
    const { children } = this.props
    return Children.toArray(children)[this.state.current]
  }
}

export default Form
