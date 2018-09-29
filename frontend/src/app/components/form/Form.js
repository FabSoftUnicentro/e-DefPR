import React, { PureComponent } from 'react'
import { Form as FinalForm, Field } from 'react-final-form'
import PropTypes from 'prop-types'
import Input from 'antd/lib/input'
import Select from 'antd/lib/select'
import InputAdapter from '../../adapters/InputAdapter'
import DatePickerAdapter from '../../adapters/DatePickerAdapter'
import RadioAdapter from '../../adapters/RadioAdapter'
import CitySelectAdapter from '../../adapters/CitySelectAdapter'
import SelectAdapter from '../../adapters/SelectAdapter'
import { StyledForm } from './Form.style'

class Form extends PureComponent {
  static TextField = props => <Field {...props} component={InputAdapter} />
  static DatePicker = props => <Field {...props} component={DatePickerAdapter} />
  static Radio = props => <Field {...props} component={RadioAdapter} />
  static CitySelect = props => <Field {...props} component={CitySelectAdapter} />
  static Inline = ({ children }) => <Input.Group compact>{ children }</Input.Group>
  static Select = ({options, ...props}) => (<Field {...props} component={SelectAdapter}>
    { options.map(item => <Select.Option key={item.value} value={item.value}>{item.name}</Select.Option>) }
  </Field>)

  static propTypes = {
    onSubmit: PropTypes.func.isRequired,
    validateSchema: PropTypes.object,
    styledForm: PropTypes.bool
  }

  static defaultProps = {
    styledForm: false
  }

  constructor (props) {
    super(props)

    this.onSubmit = this.onSubmit.bind(this)
    this.onValidate = this.onValidate.bind(this)
  }

  onSubmit (values) {
    const { onSubmit } = this.props
    return onSubmit && onSubmit(values)
  }

  async onValidate (values, validateSchema = this.props.validateSchema) {
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
    const { styledForm } = this.props

    if (styledForm) {
      return <StyledForm> { this.renderFinalForm() } </StyledForm>
    }

    return <div> { this.renderFinalForm() } </div>
  }

  renderFinalForm () {
    return <FinalForm
      onSubmit={this.onSubmit}
      validate={this.onValidate}
      initialValues={{ name: 'Paulo ' }}
      render={({ handleSubmit }) => (
        <form onSubmit={handleSubmit}>
          { this.renderForm() }
        </form>
      )}
    />
  }

  renderForm () {
    const { children } = this.props

    return <div>
      { children }
    </div>
  }
}

export default Form
