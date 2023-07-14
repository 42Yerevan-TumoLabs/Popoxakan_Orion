const express = require('express');
const axios = require('axios');
const app = express();
const path = require('path');
const port = 3000;
const java_url = 'localhost:8080';

const { exec } = require('child_process');

// Serve static files
app.use(express.static(path.join(__dirname)));
app.use(express.urlencoded({ extended: true }));
app.use(express.json());

// Define routes for your PHP files
app.get('/vikinger/*', (req, res) => {
  const phpFile = req.params[0];
  const filePath = path.join(__dirname, 'Popoxakan_Orion/vikinger', phpFile);

  // Execute the PHP script using the PHP binary
  exec(`php ${filePath}`, (error, stdout, stderr) => {
    if (error) {
      console.error(`Error executing PHP script: ${error.message}`);
      res.status(500).send('Internal Server Error');
      return;
    }
    // Send the PHP script output as the response
    res.send(stdout);
  });
});

app.get('/', (req, res) => {res.sendFile(path.join(__dirname, 'index.html'));});
app.get('/profile-timeline', (req, res) => {res.sendFile(path.join(__dirname, 'Profile-timeline/profile-timeline.html'));});
app.get('/newsfeed', (req, res) => {res.sendFile(path.join(__dirname, 'Newsfeed/newsfeed.html'));});
app.get('/profile-about', (req, res) => {res.sendFile(path.join(__dirname, 'Profile-about/profile-about.html'));});
app.get('/profile-friends', (req, res) => {res.sendFile(path.join(__dirname, 'Profile-friends/profile-friends.html'));});
app.get('/profile-forum', (req, res) => {res.sendFile(path.join(__dirname, 'Profile-forum/profile-forum.html'));});
app.get('/profile-photos', (req, res) => {res.sendFile(path.join(__dirname, 'Profile-photos//profile-photos'));});
app.get('/profile-photos-inside', (req, res) => {res.sendFile(path.join(__dirname, 'Profile-photos-inside/profile-photos-inside.html'));});
app.get('/profile-videos', (req, res) => {res.sendFile(path.join(__dirname, 'Profile-videos/profile-videos.html'));});
app.get('/overview', (req, res) => {res.sendFile(path.join(__dirname, 'Overview/overview.html'));});
app.get('/members', (req, res) => {res.sendFile(path.join(__dirname, 'Members/members.html'));});
app.get('/forums', (req, res) => {res.sendFile(path.join(__dirname, 'Forums/forums.html'));});
app.get('/forums-category', (req, res) => {res.sendFile(path.join(__dirname, 'Forums-category/forums-category.html'));});
app.get('/forums-discussion', (req, res) => {res.sendFile(path.join(__dirname, 'Forums-discussion/forums-discussion.html'));});
app.get('/forums-create-discussion', (req, res) => {res.sendFile(path.join(__dirname, 'Forums-create-discussion/forums-create-discussion.html'));});
app.get('/hub-profile-info', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-profile-info/hub-profile-info.html'));});
app.get('/hub-profile-social', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-profile-social/hub-profile-social.html'));});
app.get('/hub-profile-notifications', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-profile-notifications/hub-profile-notifications.html'));});
app.get('/hub-profile-messages', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-profile-messages/hub-profile-messages.html'));});
app.get('/hub-profile-requests', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-profile-requests/hub-profile-requests.html'));});
app.get('/hub-account-info', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-account-info/hub-account-info.html'));});
app.get('/hub-account-password', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-account-password/hub-account-password.html'));});
app.get('/hub-account-settings', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-account-settings/hub-account-settings.html'));});
app.get('/404', (req, res) => {res.sendFile(path.join(__dirname, '404/404.html'));});
app.get('/logged-out-and-icons', (req, res) => {res.sendFile(path.join(__dirname, 'Logged-out-and-icons/logged-out-and-icons.html'));});

app.post('/send-post-request', async (req, res) => {
  try {
    const url = java_url; // Replace with the actual URL of your Java application

    const data = {
      title: req.body.title,
      description: req.body.description
    };

    const response = await axios.post(url, data);
    console.log('post');
    // Handle the Java application response as needed

    res.status(200).json({ success: true });
  } catch (error) {
    console.error(error);
    res.status(500).json({ error: 'An error occurred' });
  }
});

app.listen(3000, () => {
  console.log('Server is running on port 3000');
});
