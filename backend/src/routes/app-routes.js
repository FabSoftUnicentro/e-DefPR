'use strict'

const express = require('express')
const router = express.Router()
const personRoutes = require('./person-routes')

router.use('/person', personRoutes)

module.exports = router
