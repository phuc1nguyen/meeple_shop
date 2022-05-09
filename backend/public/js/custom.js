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

async function confirm_delete_user(id) {
  if (confirm('Are you sure want to delete this user?')) {
    try {
      const response = await fetch('../../backend/ajax/delete_user.php', {
        method: 'POST',
        headers: {
          'Content-type': 'application/json'
        },
        body: id
      });

      const result = await response.text();
      console.log('result =>', result);
    } catch (error) {
      console.log('error =>', error);      
    }
  }
}