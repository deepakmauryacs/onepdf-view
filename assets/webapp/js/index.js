    // Copy hero snippet
    document.getElementById('copySnippet')?.addEventListener('click', async () => {
      const code = document.getElementById('snippet').innerText;
      try { await navigator.clipboard.writeText(code); } catch(e){}
      const btn = document.getElementById('copySnippet');
      const original = btn.innerHTML;
      btn.innerHTML = '<i class="bi bi-check2-circle me-1"></i>Copied';
      setTimeout(()=> btn.innerHTML = original, 1600);
    });

    // Copy token in demo section
    document.getElementById('copyToken')?.addEventListener('click', async () => {
      try { await navigator.clipboard.writeText('DEMO_TOKEN'); } catch(e){}
      const btn = document.getElementById('copyToken');
      const original = btn.innerHTML;
      btn.innerHTML = '<i class="bi bi-check2-circle"></i>';
      setTimeout(()=> btn.innerHTML = original, 1600);
    });

    // Navbar scroll effect
    window.addEventListener('scroll', function() {
      const navbar = document.querySelector('.navbar');
      if (window.scrollY > 50) {
        navbar.classList.add('shadow');
      } else {
        navbar.classList.remove('shadow');
      }
    });

