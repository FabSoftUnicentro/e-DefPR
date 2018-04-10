'use strict';

const mongoose = require('mongoose');
const User = mongoose.model('User');

exports.get = async() => {
    const res = await User.find({
        active: true
    }, 'type cpf rg name gender placeOfBirth maritalStatus profession salary serviceNumber dateOfBirth active');
    
    return res;
}

exports.getById = async(id) => {
    const res = await User.find({
        _id: id,
        active: true
    }, 'type cpf rg name gender placeOfBirth maritalStatus profession salary serviceNumber dateOfBirth active');

    return res;
}

exports.create = async(data) => {
    var User = new User(data);

    await User.save();
}

exports.update = async(id, data) => {
    await User
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
    await User
        .findOneAndRemove(id);
}

exports.authenticate = async(data) => {
    const res = await User.findOne({
        email: data.email,
        password: data.password
    });

    return res;
}