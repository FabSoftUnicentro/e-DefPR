'use strict';

const mongoose = require('mongoose');
const Person = mongoose.model('Person');

exports.get = async() => {
    const res = await Person.find({
        active: true
    }, 'type cpf rg name gender placeOfBirth maritalStatus profession salary serviceNumber dateOfBirth active');
    
    return res;
}

exports.getById = async(id) => {
    const res = await Person.find({
        _id: id,
        active: true
    }, 'type cpf rg name gender placeOfBirth maritalStatus profession salary serviceNumber dateOfBirth active');

    return res;
}

exports.create = async(data) => {
    var Person = new Person(data);

    await Person.save();
}

exports.update = async(id, data) => {
    await Person
        .findByIdAndUpdate(id, {
            $set: {
                type: data.type,
                cpf: data.cpf,
                rg: data.rg,
                name: data.name,
                gender: data.gender,
                placeOfBirth: data.placeOfBirth,
                maritalStatus: data.maritalStatus,
                password: data.password,
                profession: data.profession,
                serviceNumber: data.serviceNumber,
                dateOfBirth: data.dateOfBirth,
                active: data.active,
            }
        });
}

exports.delete = async(id) => {
    await Person
        .findOneAndRemove(id);
}

exports.authenticate = async(data) => {
    const res = await Person.findOne({
        email: data.email,
        password: data.password
    });

    return res;
}