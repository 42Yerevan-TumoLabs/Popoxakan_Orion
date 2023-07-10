const express = require('express');
const app = express();
const path = require('path');

// Serve static files from the root directory
app.use(express.static(path.join(__dirname)));

// Route for Forums HTML file
app.get('/forums', (req, res) => {
  res.sendFile(path.join(__dirname, 'Forums/forums.html'));
});

// Route for FProfile HTML file
app.get('/fprofile', (req, res) => {
  res.sendFile(path.join(__dirname, 'FProfile/profile-forum.html'));
});

// Route for FCategory HTML file
app.get('/fcategory', (req, res) => {
  res.sendFile(path.join(__dirname, 'FCategory/forums-category.html'));
});

// Route for FDiscussion HTML file
app.get('/fdiscussion', (req, res) => {
  res.sendFile(path.join(__dirname, 'FDiscussion/forums-discussion.html'));
});

// Start the server
app.listen(3000, () => {
  console.log('Server is running on port 3000');
});
