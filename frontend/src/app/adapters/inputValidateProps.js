const inputValidateProps = meta => {
    const validation = {}
    if (meta.dirty && meta.error) {
        validation.validateStatus = 'error'
      validation.help = meta.error
    } else if (meta.submitError) {
      validation.validateStatus = 'warning'
      validation.help = meta.submitError
    } else if (meta.dirty) {
      validation.validateStatus = 'success' 
    }
  
    return validation
}

export default inputValidateProps