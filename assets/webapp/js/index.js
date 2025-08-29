
document.addEventListener('DOMContentLoaded', function() {
  // Copy functionality for code snippet
  const copySnippetBtn = document.getElementById('copySnippet');
  if (copySnippetBtn) {
    copySnippetBtn.addEventListener('click', function() {
      const snippet = document.getElementById('snippet').textContent;
      navigator.clipboard.writeText(snippet).then(() => {
        const originalHtml = copySnippetBtn.innerHTML;
        copySnippetBtn.innerHTML = '<i class="bi bi-check"></i> Copied!';
        setTimeout(() => {
          copySnippetBtn.innerHTML = originalHtml;
        }, 2000);
      });
    });
  }

  // Copy functionality for token
  const copyTokenBtn = document.getElementById('copyToken');
  if (copyTokenBtn) {
    copyTokenBtn.addEventListener('click', function() {
      const tokenInput = document.querySelector('.token-input');
      navigator.clipboard.writeText(tokenInput.value).then(() => {
        const originalHtml = copyTokenBtn.innerHTML;
        copyTokenBtn.innerHTML = '<i class="bi bi-check"></i>';
        setTimeout(() => {
          copyTokenBtn.innerHTML = originalHtml;
        }, 2000);
      });
    });
  }
});
=