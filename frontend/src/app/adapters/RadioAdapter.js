import React from 'react'
import Radio from 'antd/lib/radio'
import FormItem from 'antd/lib/form/FormItem'
import inputValidateProps from './inputValidateProps'

const RadioAdapter = ({ input: { onChange, value }, required, label, options, asButtons, meta, ...rest }) => {
  return <FormItem
    label={label}
    {...inputValidateProps(meta, required)}
    hasFeedback
    required={required}
  >
    <Radio.Group
      options={(asButtons ? undefined : options)}
      onChange={onChange}
      {...rest}
    >
      { asButtons && options.map(({ label, ...props }) => (
        <Radio.Button key={props.value} {...props}>{ label }</Radio.Button>
      )) }
    </Radio.Group>
  </FormItem>
}

export default RadioAdapter