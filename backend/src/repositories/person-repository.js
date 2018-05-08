'use strict'

const mongoose = require('mongoose')
const Person = mongoose.model('Person')
const encryptService = require('../services/encrypt-service')

exports.get = async () => {
  const res = await Person.find({
    active: true
  }, 'type cpf rg name gender placeOfBirth maritalStatus profession salary serviceNumber dateOfBirth active mustChangePassword')

  return res
}

exports.getById = async (id) => {
  const res = await Person.findOne({
    _id: id,
    active: true
  }, 'type cpf rg name gender placeOfBirth maritalStatus profession salary serviceNumber dateOfBirth active mustChangePassword')
  return res
}

exports.create = async (data) => {
  let newPerson = new Person(data)
  await newPerson.save()
}

exports.update = async (id, data) => {
  let person = await Person.findById(id)

  for (var key in data) {
    person[key] = data[key]
  }

  await person.save()
}

exports.delete = async (id) => {
  await Person
    .findByIdAndRemove(id)
}

exports.authenticate = async (data) => {
  const res = await Person.findOne({
    cpf: data.cpf
  })

  try {
    let result = encryptService.checkPassword(data.password, res.password)

    if (result) {
      return res
    }

    return null
  } catch (e) {
    return null
  }
}

exports.resetPassword = async (id) => {
  let person = await Person.findById(id)

  try {
    person.password = await encryptService.encryptPassword('edef123456')
    person.mustChangePassword = true
  
    await person.save()
  } catch (e) {
    return null
  }
}
