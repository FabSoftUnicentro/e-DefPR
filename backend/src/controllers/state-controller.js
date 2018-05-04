'use strict'

const repository = require('../repositories/state-repository')

exports.get = async (req, res, next) => {
  try {
    var data = await repository.get()
    res.status(200).send(data)
  } catch (e) {
    res.status(500).send({
      message: 'Failed to process your request',
      errors: e.errors
    })
  }
}

exports.getById = async (req, res, next) => {
  try {
    var data = await repository.getById(req.params.id)
    res.status(200).send(data)
  } catch (e) {
    res.status(500).send({
      message: 'Failed to process your request',
      errors: e.errors
    })
  }
}

exports.post = async (req, res, next) => {
  try {
    await repository.create({
      ibgeCode: req.body.ibgeCode,
      name: req.body.name,
      initials: req.body.initials
    })

    res.status(201).send({
      message: 'State successfully registered'
    })
  } catch (e) {
    res.status(500).send({
      message: 'Failed to process your request',
      errors: e.errors
    })
  }
}

exports.put = async (req, res, next) => {
  try {
    let data = []

    for (var key in req.body) {
      data[key] = req.body[key]
    }

    await repository.update(req.params.id, data)

    res.status(200).send({
      message: 'State successfuly updated'
    })
  } catch (e) {
    res.status(500).send({
      message: 'Failed to process your request',
      errors: e.errors
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
      message: 'Failed to process your request',
      errors: e.errors
    })
  }
}
