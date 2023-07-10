const express = require('express');
const app = express();
const path = require('path');

app.use(express.static(path.join(__dirname)));

app.get('/', (req, res) => {res.sendFile(path.join(__dirname, 'index.html'));});
app.get('/profile-timeline', (req, res) => {res.sendFile(path.join(__dirname, 'Profile-timeline/profile-timeline.html'));});
app.get('/newsfeed', (req, res) => {res.sendFile(path.join(__dirname, 'Newsfeed/newsfeed.html'));});
app.get('/profile-about', (req, res) => {res.sendFile(path.join(__dirname, 'Profile-about/profile-about.html'));});
app.get('/profile-friends', (req, res) => {res.sendFile(path.join(__dirname, 'Profile-friends/profile-friends.html'));});
app.get('/profile-forum', (req, res) => {res.sendFile(path.join(__dirname, 'Profile-forum/profile-forum.html'));});
app.get('/profile-photos', (req, res) => {res.sendFile(path.join(__dirname, 'Profile-photos/profile-photos.html'));});
app.get('/profile-photos-inside', (req, res) => {res.sendFile(path.join(__dirname, 'Profile-photos-inside/profile-photos-inside.html'));});
app.get('/profile-videos', (req, res) => {res.sendFile(path.join(__dirname, 'Profile-videos/profile-videos.html'));});
app.get('/overview', (req, res) => {res.sendFile(path.join(__dirname, 'Overview/overview.html'));});
app.get('/members', (req, res) => {res.sendFile(path.join(__dirname, 'Members/members.html'));});
app.get('/forums', (req, res) => {res.sendFile(path.join(__dirname, 'Forums/forums.html'));});
app.get('/forums-category', (req, res) => {res.sendFile(path.join(__dirname, 'Forums-category/forums-category.html'));});
app.get('/forums-discussion', (req, res) => {res.sendFile(path.join(__dirname, 'Forums-discussion/forums-discussion.html'));});
app.get('/hub-profile-info', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-profile-info/hub-profile-info.html'));});
app.get('/hub-profile-social', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-profile-social/hub-profile-social.html'));});
app.get('/hub-profile-notifications', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-profile-notifications/hub-profile-notifications.html'));});
app.get('/hub-profile-messages', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-profile-messages/hub-profile-messages.html'));});
app.get('/hub-profile-requests', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-profile-requests/hub-profile-requests.html'));});
app.get('/hub-account-info', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-account-info/hub-account-info.html'));});
app.get('/hub-account-password', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-account-password/hub-account-password.html'));});
app.get('/hub-account-settings', (req, res) => {res.sendFile(path.join(__dirname, 'Hub-account-settings/'));});
app.get('/404', (req, res) => {res.sendFile(path.join(__dirname, '404/404.html'));});
app.get('/logged-out-and-icons', (req, res) => {res.sendFile(path.join(__dirname, 'Logged-out-and-icons/logged-out-and-icons.html'));});

app.listen(3000, () => {
  console.log('Server is running on port 3000');
});
