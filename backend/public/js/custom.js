$(document).ready(function(){
  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });
});

// UI Elements
toastr.options = {
  "positionClass": "toast-bottom-left",
  "progressBar": true,
  "timeOut": 3000
};