app.get('/script.js', (req, res) => {
    res.sendFile(__dirname + '/app.bundle.min.js');
  });