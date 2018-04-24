'use strict'

const mongoose = require('mongoose')
const Person = mongoose.model('Person')
const bcrypt = require('bcryptjs')

exports.get = async () => {
  const res = await Person.find({
    active: true
  }, 'type cpf rg name gender placeOfBirth maritalStatus profession salary serviceNumber dateOfBirth active')

  return res
}

exports.getById = async (id) => {
  const res = await Person.findOne({
    _id: id,
    active: true
  }, 'type cpf rg name gender placeOfBirth maritalStatus profession salary serviceNumber dateOfBirth active')

  return res
}

exports.create = async (data) => {
  let newPerson = new Person(data)
  await newPerson.save()
}

exports.update = async (id, data) => {
  await Person
    .findByIdAndUpdate(id, {
      $set: {
        type: data.type,
        cpf: data.cpf,
        rg: data.rg,
        name: data.name,
        gender: data.gender,
        placeOfBirth: data.placeOfBirth,
        maritalStatus: data.maritalStatus,
        password: data.password,
        profession: data.profession,
        serviceNumber: data.serviceNumber,
        dateOfBirth: data.dateOfBirth,
        active: data.active
      }
    })
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
