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
    _id: id
  }, 'ibgeCode name initials')

  return res
}

exports.create = async (data) => {
  let newState = new State(data)

  await newState.save()
}

exports.update = async (id, data) => {
  let state = await State.findById(id)

  for (var key in data) {
    state[key] = data[key]
  }

  await state.save()
}

exports.delete = async (id) => {
  await State
    .findByIdAndRemove(id)
}
