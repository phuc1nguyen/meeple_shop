$(document).ready(function(){
  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });
});

document.addEventListener('DOMContentLoaded', function() {
  toastr.info('Toastr worked');
});