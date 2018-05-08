'use strict'

const mongoose = require('mongoose')
const City = mongoose.model('City')

exports.get = async () => {
  const res = await City.find({
  }, 'ibgeCode name ufCode latitude longitude')

  return res
}

exports.getById = async (id) => {
  const res = await City.findOne({
    _id: id
  }, 'ibgeCode name ufCode latitude longitude')

  return res
}

exports.getByState = async (ufCode) => {
  const res = await City.find({
    ufCode: ufCode
  }, 'ibgeCode name ufCode latitude longitude')

  return res
}

exports.create = async (data) => {
  let newCity = new City(data)

  await newCity.save()
}

exports.update = async (id, data) => {
  let city = await City.findById(id)

  for (var key in data) {
    city[key] = data[key]
  }

  await city.save()
}

exports.delete = async (id) => {
  await City
    .findByIdAndRemove(id)
}
