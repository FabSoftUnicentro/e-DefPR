'use strict'

const repository = require('../repositories/person-repository')
const md5 = require('md5')
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
      message: 'Falha ao processar sua requisição!'
    })
  }
}

exports.post = async (req, res, next) => {
  try {
    await repository.create({
      type: req.body.type,
      cpf: req.body.cpf,
      rg: req.body.rg,
      name: req.body.name,
      gender: req.body.gender,
      placeOfBirth: req.body.placeOfBirth,
      maritalStatus: req.body.maritalStatus,
      profession: req.body.profession,
      serviceNumber: req.body.serviceNumber,
      dateOfBirth: req.body.dateOfBirth,
      active: req.body.active,
      password: md5(req.body.password + process.env.SALT_KEY)
    })

    res.status(201).send({
      message: 'Person successfully registered'
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
      type: req.body.type,
      cpf: req.body.cpf,
      rg: req.body.rg,
      name: req.body.name,
      gender: req.body.gender,
      placeOfBirth: req.body.placeOfBirth,
      maritalStatus: req.body.maritalStatus,
      profession: req.body.profession,
      serviceNumber: req.body.serviceNumber,
      dateOfBirth: req.body.dateOfBirth,
      active: req.body.active,
      password: md5(req.body.password + process.env.SALT_KEY)
    })
    res.status(200).send({
      message: 'Person successfuly updated'
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
      message: 'Person successfully deleted'
    })
  } catch (e) {
    res.status(500).send({
      message: 'Failed to process your request'
    })
  }
}

exports.authenticate = async (req, res, next) => {
  try {
    const person = await repository.authenticate({
      cpf: req.body.cpf,
      password: md5(req.body.password + process.env.SALT_KEY)
    })

    if (!person) {
      res.status(404).send({
        message: 'CPF or password incorrect'
      })
      return
    }

    const token = await authService.generateToken({
      id: person._id,
      cpf: person.cpf,
      rg: person.name
    })

    res.status(200).send({
      token: token,
      data: {
        name: person.name
      }
    })
  } catch (e) {
    res.status(500).send({
      message: 'Failed to process your request'
    })
  }
}

exports.refreshToken = async (req, res, next) => {
  try {
    // Token
    const token = req.body.token || req.query.token || req.headers['x-access-token']

    // Decodify token data
    const data = await authService.decodeToken(token)

    const person = await repository.getById(data.id)

    if (!person) {
      res.status(404).send({
        message: 'Person not found'
      })
      return
    }

    const tokenData = await authService.generateToken({
      id: person._id,
      cpf: person.cpf,
      name: person.name
    })

    res.status(201).send({
      token: tokenData,
      data: {
        email: person.email,
        name: person.name
      }
    })
  } catch (e) {
    res.status(500).send({
      message: 'Failed to process your request'
    })
  }
}
