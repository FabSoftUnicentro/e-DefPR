'use strict'
const bcrypt = require('bcryptjs')
const saltRounds = 10

exports.encryptPassword = function (password) {
  let hash = bcrypt.hash(password, saltRounds).then(function (hash) {
    return hash
  })
  return hash
}

exports.checkPassword = function (password, hash) {
  let result = bcrypt.compare(password, hash).then(function (res) {
    return res
  })
  return result
}
