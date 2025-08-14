document.addEventListener('DOMContentLoaded', function () {
  // Countdown Timer
  function updateCountdown() {
    const weddingDate = new Date('June 28, 2026 00:00:00').getTime();
    const now = new Date().getTime();
    const distance = weddingDate - now;

    if (distance < 0) {
      document.querySelector('.countdown').innerHTML = "The wedding day has arrived!";
      clearInterval(countdownInterval);
      return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById('days').textContent = days + " days ";
    document.getElementById('hours').textContent = hours + " hrs ";
    document.getElementById('minutes').textContent = minutes + " mins ";
    document.getElementById('seconds').textContent = seconds + " secs ";
  }

  const countdownInterval = setInterval(updateCountdown, 1000);
  updateCountdown();

  // RSVP form submission handling
  const form = document.querySelector('form.form-inline');

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();

    if (!name) {
      alert('Please enter your name.');
      return;
    }
    if (!email) {
      alert('Please enter your email.');
      return;
    }

    // Basic email format validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      alert('Please enter a valid email address.');
      return;
    }

    // Since no backend, just show a thank you message
    alert(`Thank you, ${name}! We have received your RSVP.`);
    form.reset();
  });
});
