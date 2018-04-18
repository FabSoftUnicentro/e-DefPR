'use strict'

const mongoose = require('mongoose')
const Schema = mongoose.Schema

const schema = new Schema({
  // _id
  ibgeCode: {
    type: Number,
    required: true
  },
  name: {
    type: String,
    required: true,
    trim: true
  },
  initials: {
    type: String,
    required: true
  }
})

module.exports = mongoose.model('State', schema)
