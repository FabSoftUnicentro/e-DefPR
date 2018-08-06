import React from 'react'
import DatePicker from 'antd/lib/date-picker'
import FormItem from 'antd/lib/form/FormItem'

const DatePickerAdapter = ({ input: { onChange, value }, label, ...rest }) => (
  <FormItem label={label} style={{margin: 0, padding: 0}}>
    <DatePicker
      onChange={onChange}
      // value={value}
      format='DD/MM/YYYY'
      {...rest}
    />
  </FormItem>
)

export default DatePickerAdapter
