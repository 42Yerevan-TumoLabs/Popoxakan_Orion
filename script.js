const express = require('express');
const app = express();
const path = require('path');

app.use(express.static(__dirname));

app.get('/script.js', (req, res) => {
  res.sendFile(path.join(__dirname, 'app.bundle.min.js'));
});

app.listen(3000, () => {
  console.log('Server is running on port 3000');
});
