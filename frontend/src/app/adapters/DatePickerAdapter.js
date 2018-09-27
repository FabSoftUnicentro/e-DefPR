import React from 'react'
import DatePicker from 'antd/lib/date-picker'
import FormItem from 'antd/lib/form/FormItem'
import inputValidateProps from './inputValidateProps'

const DATE_FORMAT = 'DD/MM/YYYY' 

const DatePickerAdapter = ({ input: { onChange, value }, label, meta, required, ...rest }) => (
  <FormItem 
    label={label} 
    // style={{margin: 0, padding: 0}}
    {...inputValidateProps(meta)}
    hasFeedback
    required={required}
    >
    <DatePicker
      onChange={date => onChange(date ? date.format(DATE_FORMAT) : [])}
      // value={value}
      format={DATE_FORMAT}
      {...rest}
    />
  </FormItem>
)

export default DatePickerAdapter
