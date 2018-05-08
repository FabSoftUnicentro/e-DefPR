'use strict'
const bcrypt = require('bcryptjs')
const saltRounds = 10

exports.encryptPassword = password => {
  bcrypt.hash(password, saltRounds)
    .then(hash => { return hash })
    .catch(err => { throw err })
}

exports.checkPassword = function (password, hash) {
  bcrypt.compare(password, hash)
    .then(res => { return res })
    .finally(err => { throw err })
}
