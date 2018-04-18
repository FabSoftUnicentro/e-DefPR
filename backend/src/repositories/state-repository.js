'use strict'

const mongoose = require('mongoose')
const State = mongoose.model('State')

exports.get = async () => {
  const res = await State.find({
  }, 'ibgeCode name initials')

  return res
}

exports.getById = async (id) => {
  const res = await State.findOne({
    _id: id,
  }, 'ibgeCode name initials')

  return res
}

exports.create = async (data) => {
  let newState = new State(data)

  await newState.save()
}

exports.update = async (id, data) => {
  await State
    .findByIdAndUpdate(id, {
      $set: {
        ibgeCode: data.ibgeCode,
        name: data.name,
        initials: data.initials,
      }
    })
}

exports.delete = async (id) => {
  await State
    .findByIdAndRemove(id)
}
