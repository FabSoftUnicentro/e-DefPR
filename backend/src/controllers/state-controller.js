'use strict'

const repository = require('../repositories/state-repository.js')
const authService = require('../services/auth-service')


exports.get = async (req, res, next) => {
  try {
    var data = await repository.get()
    res.status(200).send(data)
  } catch (e) {
    res.status(500).send({
      message: 'Failed to process your request'
    })
  }
}

exports.getById = async (req, res, next) => {
  try {
    var data = await repository.getById(req.params.id)
    res.status(200).send(data)
  } catch (e) {
    res.status(500).send({
      message: 'Failed to process your request'
    })
  }
}

exports.post = async (req, res, next) => {
  try {

    await repository.create({
      ibgeCode: req.body.ibgeCode,
      name: req.body.name,
      initials: req.body.initials,
    })

    res.status(201).send({
      message: 'State successfully registered'
    })
  } catch (e) {
    res.status(500).send({
      message: 'Failed to process your request'
    })
  }
}

exports.put = async (req, res, next) => {
  try {

    await repository.update(req.params.id, {
        ibgeCode: req.body.ibgeCode,
        name: req.body.name,
        initials: req.body.initials,
    })
    res.status(200).send({
      message: 'State successfuly updated'
    })
  } catch (e) {
    res.status(500).send({
      message: 'Failed to process your request'
    })
  }
}

exports.delete = async (req, res, next) => {
  try {
    await repository.delete(req.params.id)
    res.status(200).send({
      message: 'State successfully deleted'
    })
  } catch (e) {
    res.status(500).send({
      message: 'Failed to process your request'
    })
  }
}
