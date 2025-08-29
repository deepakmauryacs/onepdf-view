<?php
require_once __DIR__ . '/../config.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';
?>
<style>
  /* ---------- Card & table polish ---------- */
  .files-card{ border:1px solid #e5e7eb; border-radius:12px; }
  .table thead th{ border-bottom:1px solid #e5e7eb; font-weight:700; color:#374151; }
  .table tbody td{ vertical-align:middle; }
  .file-name{ max-width:520px; }
  .file-icon{ width:36px; height:36px; display:grid; place-items:center; border-radius:10px; background:#eef2ff; color:#4338ca; }

  /* ---------- Header tools layout ---------- */
  .mf-header{
    display:flex; align-items:center; gap:12px;
    /* No space-between; we’ll let actions stretch to the right */
    justify-content:flex-start;
  }
  .mf-left{ flex:0 0 auto; }                 /* title area width = content */
  .mf-actions{
    flex:1 1 auto;                           /* take all remaining space */
    display:flex; align-items:center; gap:12px;
    flex-wrap:nowrap;                        /* keep in one row */
    margin-left:auto;                        /* push to the right */
  }

  /* Search input should stretch to fill row (removes right-side blank space) */
  .mf-search.input-group{
    flex:1 1 auto;                           /* grow to fill */
    min-width:260px;
    max-width:none;                          /* no hard cap */
  }

  /* Seamless rounded search */
  .mf-search.input-group > .input-group-prepend .input-group-text{
    background:#fff; height:40px; padding:.45rem .70rem;
    border-top-left-radius:10px !important; border-bottom-left-radius:10px !important;
    border-top-right-radius:0 !important; border-bottom-right-radius:0 !important;
    border-right:0 !important; display:flex; align-items:center;
  }
  .mf-search.input-group > .form-control{
    height:40px; padding:.45rem .75rem;
    border-top-right-radius:10px !important; border-bottom-right-radius:10px !important;
    border-top-left-radius:0 !important; border-bottom-left-radius:0 !important;
    border-left:0 !important; box-shadow:none !important;
  }

  /* “Delete selected” button aligned & same height */
  .mf-actions .btn{
    height:40px; padding:0 .9rem; border-radius:10px;
    display:inline-flex; align-items:center; gap:.35rem; line-height:1;
    flex:0 0 auto;                           /* don’t stretch */
  }

  /* Badges & buttons */
  .badge-secure{ background:#16a34a; color:#fff; border-radius:999px; padding:.2rem .5rem; font-weight:600; }
  .btn-icon{ display:inline-flex; align-items:center; gap:.35rem; }

  /* Empty state */
  .empty{
    padding:32px; text-align:center; color:#6b7280;
    border-top:1px dashed #e5e7eb; border-bottom-left-radius:12px; border-bottom-right-radius:12px;
  }

  /* Small tweaks */
  .card-header{ padding:.85rem 1.1rem; }
  @media (max-width: 768px){
    .mf-header{ flex-wrap:wrap; }
    .mf-actions{ width:100%; margin-left:0; }
    .mf-search.input-group{ min-width:0; }
  }
</style>

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Managed Files</h1>
  </div>

  <div class="card shadow-sm files-card">
    <div class="card-header">
      <div class="mf-header">
        <div class="mf-left">
          <i class="bi bi-folder2-open mr-2"></i>
          <span class="font-weight-bold">Files</span>
          <span class="badge badge-primary ml-1" id="countBadge">0</span>
        </div>

        <div class="mf-actions">
          <!-- Search stretches; button hugs the right -->
          <div class="input-group mf-search">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="bi bi-search"></i></span>
            </div>
            <input id="searchInput" type="text" class="form-control" placeholder="Search files..." autocomplete="off">
          </div>
          <button id="bulkDelete" class="btn btn-outline-danger" disabled>
            <i class="bi bi-trash"></i> Delete selected
          </button>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table mb-0" id="filesTable">
        <thead>
          <tr>
            <th style="width:36px;"><input type="checkbox" id="checkAll"></th>
            <th class="file-name">File Name</th>
            <th style="width:120px;">Size</th>
            <th style="width:160px;">Modified</th>
            <th style="width:110px;">Status</th>
            <th style="width:260px;">Actions</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      <div id="emptyState" class="empty d-none">
        <div class="mb-2"><i class="bi bi-inbox"></i></div>
        No files yet. Upload some to see them here.
      </div>
    </div>
  </div>

  <div id="alert" class="mt-3"></div>
</div>

<!-- Permissions Modal -->
<div class="modal fade" id="permModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Link Permissions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="permDownload" checked>
          <label class="form-check-label" for="permDownload">Allow Download</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="permSearch" checked>
          <label class="form-check-label" for="permSearch">Allow Search</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="permAnalytics" checked>
          <label class="form-check-label" for="permAnalytics">Enable Analytics</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="createLink">Create Link</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
(function($){
  const $tbody   = $('#filesTable tbody');
  const $count   = $('#countBadge');
  const $empty   = $('#emptyState');
  const $bulkBtn = $('#bulkDelete');
  const $checkAll= $('#checkAll');
  let genBtn = null;
  let linkHolder = null;

  function humanSize(bytes){
    if (bytes === 0 || bytes == null) return '—';
    const u = ['B','KB','MB','GB']; let i=0, n=bytes;
    while(n >= 1024 && i < u.length-1){ n/=1024; i++; }
    return (i ? n.toFixed(2) : n.toFixed(0)) + ' ' + u[i];
  }
  function iconFor(name){
    const ext = (name.split('.').pop() || '').toLowerCase();
    if (ext === 'pdf') return '<div class="file-icon text-danger" title="PDF"><i class="bi bi-file-earmark-pdf"></i></div>';
    if (['png','jpg','jpeg','gif','webp','bmp','svg'].includes(ext))
      return '<div class="file-icon" title="Image"><i class="bi bi-file-image"></i></div>';
    return '<div class="file-icon" title="File"><i class="bi bi-file-earmark"></i></div>';
  }
  function showAlert(msg, type){
    $('#alert').html('<div class="alert alert-'+type+'">'+msg+'</div>');
    setTimeout(()=> $('#alert .alert').fadeOut(250, function(){ $(this).remove(); }), 2200);
  }

  function renderRows(files){
    $tbody.empty();
    if(!files || !files.length){
      $empty.removeClass('d-none'); $count.text('0'); return;
    }
    $empty.addClass('d-none'); $count.text(files.length);

    files.forEach(f=>{
      const size = humanSize(f.size);
      const mod  = f.modified || f.updated_at || '';
      const url  = f.url || '';

      const $tr = $('<tr>');
      $tr.append('<td><input type="checkbox" class="row-check" data-id="'+f.id+'"></td>');
      $tr.append(`
        <td class="text-truncate" title="${f.filename}">
          <div class="d-flex align-items-center" style="gap:10px;">
            ${iconFor(f.filename)}
            <span class="text-truncate">${f.filename}</span>
          </div>
        </td>
      `);
      $tr.append('<td>'+size+'</td>');
      $tr.append('<td>'+mod+'</td>');
      $tr.append('<td><span class="badge-secure">Secure</span></td>');
      $tr.append(`
        <td>
          <div class="d-flex align-items-center" style="gap:8px;">
            <button class="btn btn-outline-primary btn-sm btn-icon generate" data-id="${f.id}">
              <i class="bi bi-link-45deg"></i> Generate
            </button>
            <button class="btn btn-outline-secondary btn-sm btn-icon copy" data-url="${url}" ${url ? '' : 'disabled'}>
              <i class="bi bi-clipboard"></i> Copy
            </button>
            <button class="btn btn-outline-info btn-sm btn-icon embed" data-url="${url}" ${url ? '' : 'disabled'}>
              <i class="bi bi-code-slash"></i> Embed
            </button>
            <button class="btn btn-outline-danger btn-sm delete" data-id="${f.id}">
              <i class="bi bi-trash"></i>
            </button>
          </div>
          <div class="small text-muted mt-1 link-holder">${url ? `<code>${url}</code>` : ''}</div>
        </td>
      `);
      $tbody.append($tr);
    });
    syncBulkBtn();
  }

  function loadFiles(){
    $.get('api/list_files.php', function(res){
      renderRows((res && res.files) ? res.files : []);
      $checkAll.prop('checked', false);
    }, 'json').fail(()=> showAlert('Failed to load files.', 'danger'));
  }

  // Search filter
  $('#searchInput').on('input', function(){
    const q = this.value.toLowerCase();
    $('#filesTable tbody tr').each(function(){
      const name = $(this).children().eq(1).text().toLowerCase();
      $(this).toggle(name.indexOf(q) !== -1);
    });
    $checkAll.prop('checked', false);
    syncBulkBtn();
  });

  // Single delete
  $tbody.on('click', '.delete', function(){
    const id = $(this).data('id');
    if(!confirm('Delete this file?')) return;
    $.post('api/delete_file.php', { id }, loadFiles)
     .fail(()=> showAlert('Delete failed.', 'danger'));
  });

  // Open permissions modal
  $tbody.on('click', '.generate', function(){
    genBtn = $(this);
    linkHolder = genBtn.closest('td').find('.link-holder');
    $('#permModal').data('id', genBtn.data('id')).modal('show');
  });

  // Create link with permissions
  $('#createLink').on('click', function(){
    const id = $('#permModal').data('id');
    const perms = {
      download: $('#permDownload').prop('checked'),
      search: $('#permSearch').prop('checked'),
      analytics: $('#permAnalytics').prop('checked')
    };
    $('#permModal').modal('hide');
    genBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm mr-1"></span>Generating');
    $.post('api/generate_link.php', { id, permissions: JSON.stringify(perms) }, function(res){
      const url = (res && res.url) ? res.url : '';
      if(url){
        linkHolder.html('<code>'+url+'</code>');
        genBtn.closest('td').find('.copy').prop('disabled', false).data('url', url);
      }else{
        linkHolder.html('<span class="text-danger">No URL returned</span>');
      }
    }, 'json').fail(function(){
      linkHolder.html('<span class="text-danger">Failed to generate link</span>');
    }).always(function(){
      genBtn.prop('disabled', false).html('<i class="bi bi-link-45deg"></i> Generate');
    });
  });

  // Copy
  $tbody.on('click', '.copy', function(){
    const url = $(this).data('url') || '';
    if(!url) return;
    const ta = document.createElement('textarea');
    ta.value = url; document.body.appendChild(ta); ta.select(); document.execCommand('copy'); document.body.removeChild(ta);
    showAlert('Link copied to clipboard.', 'success');
  });

  // Embed
  $tbody.on('click', '.embed', function(){
    const url = $(this).data('url') || '';
    if(!url) return;
    window.open('embed.php?url=' + encodeURIComponent(url), '_blank');
  });

  // Bulk select
  $('#checkAll').on('change', function(){
    $('.row-check:visible').prop('checked', this.checked);
    syncBulkBtn();
  });
  $tbody.on('change', '.row-check', syncBulkBtn);

  function syncBulkBtn(){
    const checked = $('.row-check:checked:visible').length;
    $bulkBtn.prop('disabled', checked === 0);
  }

  // Bulk delete
  $bulkBtn.on('click', function(){
    const ids = $('.row-check:checked:visible').map(function(){ return $(this).data('id'); }).get();
    if(!ids.length) return;
    if(!confirm('Delete '+ids.length+' selected file(s)?')) return;
    let done=0, failed=0;
    const next = () => {
      if(!ids.length){ loadFiles(); showAlert((failed? failed+' failed, ' : '')+done+' deleted.', failed?'danger':'success'); return; }
      const id = ids.pop();
      $.post('api/delete_file.php', { id })
        .done(()=>{ done++; next(); })
        .fail(()=>{ failed++; next(); });
    };
    next();
  });

  // Init
  loadFiles();
})(jQuery);
</script>

<?php include 'includes/footer.php'; ?>
