'use strict'

const express = require('express')
const bodyParser = require('body-parser')
const mongoose = require('mongoose')

const app = express()
const router = express.Router()
const mongooseExpressErrorHandler = require('mongoose-express-error-handler')

// Environment variables
require('dotenv').config()

// DB Connection
mongoose.connect(process.env.DB_CONNECTION_STRING)

// Mongoose error handler
app.use(mongooseExpressErrorHandler)

// Models
const Person = require('./models/person')

// Routes
const routes = require('./routes/app-routes')

// BodyParser
app.use(bodyParser.json({
  limit: '5mb'
}))
app.use(bodyParser.urlencoded({
  extended: false
}))

// Cors
app.use(function (req, res, next) {
  res.header('Access-Control-Allow-Origin', '*')
  res.header('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept, x-access-token')
  res.header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
  next()
})

// Routes
app.use('/api', routes)

module.exports = app
