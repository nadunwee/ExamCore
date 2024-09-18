const searchInput = document.getElementById('searchInput');
const mostRecentExamsSection = document.querySelector('.most-recent-exams');
const notificationsSection = document.querySelector('.notifications');

searchInput.addEventListener('input', () => {
  const searchQuery = searchInput.value.toLowerCase();

  // Filter most recent exams
  const filteredExams = mostRecentExams.filter(exam => {
    return exam.title.toLowerCase().includes(searchQuery) ||
           exam.description.toLowerCase().includes(searchQuery);
  });
  // Update the most recent exams section with filtered data

  // Filter notifications
  const filteredNotifications = notifications.filter(notification => {
    return notification.title.toLowerCase().includes(searchQuery) ||
           notification.content.toLowerCase().includes(searchQuery);
  });
  // Update the notifications section with filtered data
});