'use strict'
import default from './../../../frontend/src/services/StatesService';

const mongoose = require('mongoose')
const Schema = mongoose.Schema

const schema = new Schema({
  // _id
  type: {
    type: Number,
    required: true,
    default: 0
  },
  cpf: {
    type: String,
    required: true,
    trim: true,
    unique: true
  },
  rg: {
    type: String,
    required: true,
    unique: true,
    trim: true
  },
  name: {
    type: String,
    required: true,
    trim: true
  },
  gender: {
    type: String,
    required: true,
    enum: ['F', 'M']
  },
  placeOfBirth: {
    type: String,
    required: true,
    trim: true
  },
  maritalStatus: {
    type: String,
    required: true,
    trim: true
  },
  password: {
    type: String,
    required: false
  },
  profession: {
    type: String,
    required: true,
    trim: true
  },
  salary: {
    type: Number,
    required: false
  },
  dateOfBirth: {
    type: Date,
    required: true
  },
  active: {
    type: Boolean,
    required: true,
    default: true
  },
  mustChangePassword: {
    type: Boolean,
    required: false,
    default: false
  }
})

module.exports = mongoose.model('Person', schema)
