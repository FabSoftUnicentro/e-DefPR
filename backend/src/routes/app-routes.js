'use strict'

const express = require('express')
const router = express.Router()
const personRoutes = require('./person-routes')
const stateRoutes = require('./state-routes')
const cityRoutes = require('./city-routes')

router.use('/person', personRoutes)
router.use('/state', stateRoutes)
router.use('/city', cityRoutes)

module.exports = router
