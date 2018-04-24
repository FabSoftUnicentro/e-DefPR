'use strict'

const mongoose = require('mongoose')
const Person = mongoose.model('Person')
const bcrypt = require('bcryptjs')

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

  let result = bcrypt.compareSync(data.password, res.password)

  if (!result) {
    return null
  }

  return res
}
