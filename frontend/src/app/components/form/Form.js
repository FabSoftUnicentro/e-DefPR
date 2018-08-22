import React, { Component, Children } from 'react'
import { Form as FinalForm, Field } from 'react-final-form'
import Icon from 'antd/lib/icon'
import Button from 'antd/lib/button'
import Card from 'antd/lib/card'
import Input from 'antd/lib/input'
import Select from 'antd/lib/select'
import InputAdapter from '../../adapters/InputAdapter'
import DatePickerAdapter from '../../adapters/DatePickerAdapter'
import SelectAdapter from '../../adapters/SelectAdapter'
import CitySelectAdapter from '../../adapters/CitySelectAdapter'
import PropTypes from 'prop-types'

class Form extends Component {
  static Step = ({ children }) => <div>{ children }</div>

  static TextField = props => <Field {...props} component={InputAdapter} />
  static DatePicker = props => <Field {...props} component={DatePickerAdapter} />
  static CitySelect = props => <Field {...props} component={CitySelectAdapter} />

  static propTypes = {
    onSubmit: PropTypes.func.isRequired,
    validateSchema: PropTypes.object
  }

  static defaultProps = {
    noCard: true
  }

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

    this.onSubmit = this.onSubmit.bind(this)
    this.onValidate = this.onValidate.bind(this)
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

  async onSubmit (values) {
    return this.props.onSubmit(values)
  }

  async onValidate (values) {
    const { validateSchema } = this.props
    if (!validateSchema) {
      return undefined
    }

    try {
      await validateSchema.validate(values)
      return undefined // returns undefined if is valid
    } catch (error) {
      const errors = {}
      errors[error.path] = error.message
      return errors
    }
  }

  render () {
    const { noCard } = this.props

    if (noCard) {
      return this.RenderFinalForm
    }

    return <Card bodyStyle={{width: '50%'}}>
      { this.RenderFinalForm }
    </Card>
  }

  get isLastPage () {
    const { current, steps } = this.state
    return current === steps.length - 1
  }

  get currentStep () {
    const { children } = this.props
    return Children.toArray(children)[this.state.current]
  }

  get RenderFinalForm () {
    const { children } = this.props

    return <FinalForm
      onSubmit={this.onSubmit}
      validate={this.onValidate}
      render={({ handleSubmit }) => (
        <form onSubmit={handleSubmit}>
          { children }
          <Button size='large'type='primary'htmlType='submit'>Salvar <Icon type='check' /></Button>
        </form>
      )}
    />
  }
}

export default Form
