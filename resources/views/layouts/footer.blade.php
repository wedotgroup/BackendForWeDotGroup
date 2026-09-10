
  <script>

    document.addEventListener('DOMContentLoaded', function() {
      const navLinks = document.querySelectorAll('nav a');
      navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          if (this.getAttribute('href') === '#') {
            e.preventDefault();
          }
          navLinks.forEach(l => {
            l.classList.remove('bg-slate-800', 'text-white');
            l.classList.add('text-slate-300');
          });
          this.classList.add('bg-slate-800', 'text-white');
          this.classList.remove('text-slate-300');
        });
      });

      const actionButtons = document.querySelectorAll('.grid-cols-2 button');
      actionButtons.forEach(btn => {
        btn.addEventListener('click', function() {
          const label = this.innerText.trim();
          alert(`⚡ We Dot Group admin: "${label}" action triggered.`);
        });
      });

      const bell = document.querySelector('.fa-bell')?.closest('button');
      if (bell) {
        bell.addEventListener('click', () => alert('🔔 You have 3 new notifications.'));
      }

      const userAvatar = document.querySelector('.h-8.w-8.rounded-full');
      if (userAvatar) {
        userAvatar.addEventListener('click', () => alert('👤 Profile menu (demo).'));
      }
    });
  </script>
