'use strict'

const express = require('express')
const router = express.Router()
const controller = require('../controllers/person-controller')
const authService = require('../services/auth-service')

router.get('/', authService.authorize, controller.get)
router.get('/:id', authService.authorize, controller.getById)
router.post('/', authService.authorize, controller.post)
router.post('/authenticate', controller.authenticate)
router.post('/refresh-token', authService.authorize, controller.refreshToken)
router.put('/:id', authService.authorize, controller.put)
router.delete('/:id', authService.authorize, controller.delete)

module.exports = router
