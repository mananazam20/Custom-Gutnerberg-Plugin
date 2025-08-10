document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('.sam-newsletter-form');

  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const name = form.querySelector('[name="name"]').value.trim();
      const email = form.querySelector('[name="email"]').value.trim();
      const messageBox = form.querySelector('#message');

      try {
        const response = await fetch(samData.restUrl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': samData.nonce 
          },
          body: JSON.stringify({ name, email })
        });

        const data = await response.json();

        if (!response.ok) {
          throw new Error(data.message || 'Something went wrong');
        }

        messageBox.innerHTML = `<p style="color: green;">${data.message}</p>`;
        form.reset();
      } catch (error) {
        messageBox.innerHTML = `<p style="color: red;">${error.message}</p>`;
      }
    });
  }
});
