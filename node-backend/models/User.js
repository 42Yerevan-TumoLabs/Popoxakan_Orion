const mongoose      = require('mongoose')
const Schema        = mongoose.Schema

const usetSchema    = new Schema({
    email: {type: String},
    username: {type: String},
    password: {type: String},
}, {timestamps: true})

const User          = mongoose.model('User', usetSchema)
model.exports       = User