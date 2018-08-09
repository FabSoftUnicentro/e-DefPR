import React from 'react'
import DatePicker from 'antd/lib/date-picker'
import FormItem from 'antd/lib/form/FormItem'

const DATE_FORMAT = 'DD/MM/YYYY' 

const DatePickerAdapter = ({ input: { onChange, value }, label, ...rest }) => (
  <FormItem label={label} style={{margin: 0, padding: 0}}>
    <DatePicker
      onChange={date => onChange(date.format(DATE_FORMAT))}
      // value={value}
      format={DATE_FORMAT}
      {...rest}
    />
  </FormItem>
)

export default DatePickerAdapter
