<?php
require_once __DIR__ . '/../config.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';
?>

<!-- Page-only styles (light, boxy, dashed drop zone, progress rows) -->
<style>
  .upload-card { border: 1px solid #e5e7eb; border-radius: 12px; }
  .upload-drop {
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    background: #f8fafc;
    padding: 36px;
    transition: all .2s ease;
  }
  .upload-drop.is-dragover { border-color: #8b5cf6; background: #f5f3ff; }
  .upload-drop .cloud { font-size: 40px; opacity: .7; }
  .upload-drop .browse { color: #6d28d9; text-decoration: underline; cursor: pointer; }
  .muted { color: #6b7280; }

  /* Uploading list (progress rows) */
  .upload-row {
    display: grid; grid-template-columns: 56px 1fr 110px 150px; gap: 12px;
    align-items: center; border: 1px solid #e5e7eb; border-radius: 10px;
    padding: 10px 12px; background: #fff;
  }
  .file-badge {
    width: 40px; height: 40px; border-radius: 10px; display: grid; place-items: center;
    background: #eef2ff; font-weight: 700; color: #4338ca; font-size: .8rem;
  }
  .progress { height: 8px; border-radius: 999px; }
  .progress-bar { background: linear-gradient(90deg,#7c3aed,#3b82f6); }

  /* Managed table tweaks */
  .table thead th { border-bottom: 1px solid #e5e7eb; font-weight: 700; }
  .table tbody td { vertical-align: middle; }
  .badge-secure { background:#16a34a; color:#fff; border-radius: 999px; padding: .25rem .5rem; font-weight:600; }

  /* Small helpers */
  .icon-btn { border: 1px solid #d1d5db; background: #fff; border-radius: 8px; padding: .35rem .6rem; }
  .icon-btn i { vertical-align: middle; }

  /* ============================
     FIX: Search input group radius
     ============================ */
  .mf-search > .input-group-prepend .input-group-text{
    background:#fff;
    border-top-left-radius: var(--ui-radius, 10px) !important;
    border-bottom-left-radius: var(--ui-radius, 10px) !important;
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
    border-right: 0 !important;                 /* remove seam */
    display:flex; align-items:center;            /* vertical align icon */
  }
  .mf-search > .form-control{
    border-top-right-radius: var(--ui-radius, 10px) !important;
    border-bottom-right-radius: var(--ui-radius, 10px) !important;
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
    border-left: 0 !important;                  /* remove seam */
  }
</style>

<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Upload Your Files</h1>
  </div>

  <!-- Upload card -->
  <div class="card shadow-sm upload-card mb-4">
    <div class="card-body">
      <p class="mb-2 muted">to attach to the project</p>

      <!-- Drop zone -->
      <div id="dropArea" class="upload-drop text-center">
        <div class="cloud mb-2"><i class="bi bi-cloud-upload"></i></div>
        <div class="h5 mb-1">Drag & drop your files here or <span id="browseLink" class="browse">Browse</span></div>
        <div class="muted">50 MB max file size • PDF files only</div>
        <input id="fileInput" type="file" class="d-none" multiple accept="application/pdf">
      </div>
    </div>
  </div>

  <!-- Uploading list -->
  <div id="uploadingBox" class="card shadow-sm mb-4 d-none">
    <div class="card-header font-weight-bold">Uploading</div>
    <div class="card-body">
      <div id="uploadList" class="d-grid" style="gap:12px;"></div>
    </div>
  </div>

  <!-- Managed files -->
  <div class="card shadow-sm mb-5">
    <div class="card-header d-flex align-items-center justify-content-between">
      <div class="font-weight-bold">
        <i class="bi bi-folder2-open mr-2"></i> Managed Files <span class="badge badge-primary ml-1" id="filesCount">0</span>
      </div>
      <!-- add mf-search class here -->
      <div class="input-group mf-search" style="max-width:280px;">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="bi bi-search"></i></span>
        </div>
        <input id="searchFiles" type="text" class="form-control" placeholder="Search files..." autocomplete="off">
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table mb-0" id="filesTable">
          <thead>
            <tr>
              <th style="width:44px;"></th>
              <th>File Name</th>
              <th style="width:120px;">Size</th>
              <th style="width:160px;">Modified</th>
              <th style="width:120px;">Status</th>
              <th style="width:260px;">Actions</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Alerts -->
  <div id="alert" class="mt-3"></div>
</div>

<!-- Uses jQuery from your template footer -->
<script>
(function($){
  const MAX_SIZE = 50 * 1024 * 1024; // 50MB
  const drop = $('#dropArea');
  const input = $('#fileInput');
  const browse = $('#browseLink');
  const uploadingBox = $('#uploadingBox');
  const uploadList = $('#uploadList');
  const filesTableBody = $('#filesTable tbody');
  const filesCount = $('#filesCount');

  function humanSize(bytes){
    if (bytes === 0 || bytes === undefined || bytes === null) return '—';
    const units = ['B','KB','MB','GB'];
    let i = 0; let num = bytes;
    while (num >= 1024 && i < units.length-1){ num /= 1024; i++; }
    return num.toFixed(i ? 2 : 0) + ' ' + units[i];
  }
  function extIcon(filename){
    const ext = (filename.split('.').pop() || '').toLowerCase();
    if (['pdf'].includes(ext)) return '<i class="bi bi-file-earmark-pdf text-danger"></i>';
    return '<i class="bi bi-file-earmark"></i>';
  }
  function extBadge(filename){
    const ext = (filename.split('.').pop() || '').toUpperCase();
    return '<div class="file-badge">'+ (ext || 'FILE') +'</div>';
  }

  // --- Uploading UI row
  function makeUploadRow(file){
    const $row = $('<div class="upload-row"></div>');
    $row.append(extBadge(file.name));
    $row.append('<div class="text-truncate">'+file.name+'</div>');
    $row.append('<div class="muted">'+humanSize(file.size)+'</div>');
    const prog = $(`
      <div>
        <div class="progress mb-1">
          <div class="progress-bar" role="progressbar" style="width:0%"></div>
        </div>
        <div class="d-flex justify-content-between small muted">
          <span class="pct">0%</span><span class="done text-success d-none">100% done</span>
        </div>
      </div>
    `);
    $row.append(prog);
    uploadList.append($row);
    uploadingBox.removeClass('d-none');
    return {row:$row, bar:prog.find('.progress-bar'), pct:prog.find('.pct'), done:prog.find('.done')};
  }

  // --- Upload function (one file per request -> supports multiple)
  function uploadFiles(fileList){
    const files = Array.from(fileList || []);
    if(!files.length) return;

    // Validate and filter
    const valid = files.filter(f=>{
      const typeOk = /^application\/pdf$/.test(f.type);
      const sizeOk = f.size <= MAX_SIZE;
      if(!typeOk){
        showAlert('Only PDF files are allowed: ' + f.name, 'danger');
      }else if(!sizeOk){
        showAlert('File too large (max 50MB): ' + f.name, 'danger');
      }
      return typeOk && sizeOk;
    });
    if(!valid.length) return;

    valid.forEach(function(file){
      const ui = makeUploadRow(file);

      const fd = new FormData();
      // server expects "pdf" earlier — support both "file" and "pdf"
      fd.append('file', file);
      fd.append('pdf', file); // in case your upload_file.php reads 'pdf'

      $.ajax({
        url: 'api/upload_file.php',
        type: 'POST',
        data: fd,
        contentType: false,
        processData: false,
        dataType: 'json',
        xhr: function(){
          const xhr = $.ajaxSettings.xhr();
          if(xhr.upload){
            xhr.upload.addEventListener('progress', function(e){
              if(e.lengthComputable){
                const pct = Math.round((e.loaded / e.total) * 100);
                ui.bar.css('width', pct + '%');
                ui.pct.text(pct + '%');
              }
            });
          }
          return xhr;
        },
        success: function(res){
          ui.bar.css('width','100%');
          ui.pct.text('100%');
          ui.done.removeClass('d-none');
          setTimeout(()=> { ui.row.fadeOut(300, function(){ $(this).remove(); if(!uploadList.children().length){ uploadingBox.addClass('d-none'); } }); }, 800);
          if(res && res.url){
            showAlert('Link generated: ' + res.url, 'success');
          }
          loadFiles();
        },
        error: function(xhr){
          const msg = xhr.responseJSON ? (xhr.responseJSON.error || 'Upload failed') : 'Upload failed';
          showAlert(msg, 'danger');
        }
      });
    });
  }

  // --- Drop events
  drop.on('drag dragstart dragend dragover dragenter dragleave drop', function(e){ e.preventDefault(); e.stopPropagation(); });
  drop.on('dragover dragenter', function(){ drop.addClass('is-dragover'); });
  drop.on('dragleave dragend drop', function(){ drop.removeClass('is-dragover'); });
  drop.on('drop', function(e){ uploadFiles(e.originalEvent.dataTransfer.files); });

  // Browse link
  browse.on('click', function(){ input.trigger('click'); });
  input.on('change', function(){ uploadFiles(this.files); this.value=''; });

  // --- Managed files table
  function loadFiles(){
    $.get('api/list_files.php', function(res){
      const files = (res && res.files) ? res.files : [];
      filesCount.text(files.length);
      filesTableBody.empty();

      files.forEach(function(file){
        const modified = file.modified || file.updated_at || '';
        const url = file.url || ''; // if your API returns a url

        const row = $('<tr>');
        row.append(`<td class="text-center">${extIcon(file.filename)}</td>`);
        row.append(`<td class="text-truncate" title="${file.filename}">${file.filename}</td>`);
        row.append(`<td>${humanSize(file.size)}</td>`);
        row.append(`<td>${modified}</td>`);
        row.append(`<td><span class="badge-secure">Secure</span></td>`);
        const actions = $(`
          <td>
            <div class="d-flex align-items-center" style="gap:8px;">
              <button class="btn btn-outline-primary btn-sm generate" data-id="${file.id}">
                <i class="bi bi-link-45deg mr-1"></i> Generate
              </button>
              <button class="btn btn-outline-secondary btn-sm copy" data-url="${url || ''}" ${url ? '' : 'disabled'}>
                <i class="bi bi-clipboard mr-1"></i> Copy
              </button>
              <button class="btn btn-outline-danger btn-sm delete" data-id="${file.id}">
                <i class="bi bi-trash"></i>
              </button>
            </div>
            <div class="small muted mt-1 link-holder"></div>
          </td>
        `);
        row.append(actions);
        if(url){
          actions.find('.generate').prop('disabled', true);
          actions.find('.link-holder').html(`<code>${url}</code>`);
        }
        filesTableBody.append(row);
      });
    }, 'json').fail(function(){
      showAlert('Failed to load files list.', 'danger');
    });
  }

  // Search filter
  $('#searchFiles').on('input', function(){
    const q = this.value.toLowerCase();
    $('#filesTable tbody tr').each(function(){
      const name = $(this).children().eq(1).text().toLowerCase();
      $(this).toggle(name.indexOf(q) !== -1);
    });
  });

  // Delete
  filesTableBody.on('click', '.delete', function(){
    const id = $(this).data('id');
    $.post('api/delete_file.php', { id }, function(){ loadFiles(); })
    .fail(function(){ showAlert('Delete failed.', 'danger'); });
  });

  // Generate link (optional endpoint)
  filesTableBody.on('click', '.generate', function(){
    const btn = $(this);
    const row = btn.closest('td');
    const holder = row.find('.link-holder');
    const id = btn.data('id');
    btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm mr-1"></span>Generating');
    $.post('api/generate_link.php', { id }, function(res){
      const url = (res && res.url) ? res.url : '';
      if(url){
        holder.html(`<code>${url}</code>`);
        row.find('.copy').prop('disabled', false).data('url', url);
      }else{
        holder.html('<span class="text-danger">No URL returned</span>');
      }
    }, 'json').fail(function(){
      holder.html('<span class="text-danger">Failed to generate link</span>');
    }).always(function(){
      btn.prop('disabled', false).html('<i class="bi bi-link-45deg mr-1"></i> Generate');
    });
  });

  // Copy
  filesTableBody.on('click', '.copy', function(){
    const url = $(this).data('url') || '';
    if(!url){ return; }
    const ta = document.createElement('textarea');
    ta.value = url;
    document.body.appendChild(ta);
    ta.select(); document.execCommand('copy');
    document.body.removeChild(ta);
    showAlert('Link copied to clipboard.', 'success');
  });

  function showAlert(msg, type){
    $('#alert').html(`<div class="alert alert-${type}">${msg}</div>`);
    setTimeout(()=> $('#alert .alert').fadeOut(300, function(){ $(this).remove(); }), 2500);
  }

  // Init
  loadFiles();

})(jQuery);
</script>

<?php include 'includes/footer.php'; ?>
