const express = require('express');
const app = express();

app.get('/', (req, res) => {
    res.sendFile(__dirname + '/forums.html');
  });
  
  app.listen(3000, () => {
    console.log('Server is running on port 3000');
  });
  
  app.use(express.static(__dirname));
