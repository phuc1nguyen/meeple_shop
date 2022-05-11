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
  const data = {
    id_user: id,
    name: 'John'
  };

  try {
    let response = await fetch('../../backend/ajax/delete_user.php', {
      method: 'POST',
      headers: {
        'Content-type': 'application/json;charset=utf-8'
      },
      body: JSON.stringify(data)
    });

    let result = await response.json();
    console.log('result =>', result);
  } catch (error) {
    console.log('error =>', error);      
  }
}

async function getTest() {
  let response = await fetch('../../backend/ajax/test.php', {
    method: 'POST',
    headers: {
      'Content-type': 'application/json'
    },
    body: JSON.stringify({
      name: 'Khanh',
      age: 27
    })
  });

  let result = await response.json();
  console.log(result);
  // let result = await response.json();

  // console.log(result);
}

// function confirm_delete_user(id) {
//   $.ajax({
//     url: '../../backend/ajax/delete_user.php',
//     type: 'POST',
//     data: {
//       id: id,
//     },
//     success: function(response) {
//       console.log('result =>', JSON.parse(response));
//     },
//     error: function(err) {
//       console.log('error =>', err);
//     }
//   });
// }