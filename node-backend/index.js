const express     = require('express')
const mongoose    = require('mongoose')
const morgan      = require('morgan')
const bodyParser  = require('body-parser')

const EmployeeRoute = require('./routes/employee')
const AuthRoute     = require('./routes/auth')

mongoose.connect("mongodb+srv://Aramxxx8691:Aramxxx8691@cluster0.s2kz6b1.mongodb.net/?retryWrites=true&w=majority")
const db          = mongoose.connection

db.on('error', (err) => {console.log(err)})
db.once('open', (err) => {console.log('Database Connection Established!')})

const app = express()

app.use(morgan('dev'))
app.use(bodyParser.urlencoded({extended: true}))
app.use(bodyParser.json())
app.use('/uploads', express.static('uploads'))

//express.Router("/api",backRouts)
app.listen(7000, () => {
  console.log('Server is running on port 7000');
});

app.use('/api/employee', EmployeeRoute)
app.use('/api', AuthRoute)