$(document).ready(function(){
  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });
});

// Toastr settings
toastr.options = {
  "positionClass": "toast-bottom-left",
  "timeOut": 2500,
  "progressBar": true,
  "preventDuplicates": true
};

// Admin deletes products
function deleteProduct(id) {
  const data = {
    id: id
  };

  if (confirm('Are you sure want to delete this product?')) {
    $.post('../../backend/ajax/delete_product.php', data, json => {
      const response = JSON.parse(json); 
      if (response.status === 'ok') {
        window.location.reload();
      } else {
        toastr.error(response.message);
      }
    });
  }
}

// Admin updates product's status
function updateProductStatus(element) {
  const data = {
    id: parseInt(element.value),
    status: element.checked ? 1 : 0
  };

  $.post('../../backend/ajax/status_product.php', data, function(response) {
    if (response === 1) {
      toastr.success('Product status updated successfully');
    } else {
      toastr.error('Something went wrong');
    }
  }, 'json');
}

// Admin deletes users
function deleteUser(id) {
  const data = {
    id: id
  };

  if (confirm('Are you sure want to delete this user?')) {
    $.post('../../backend/ajax/delete_user.php', data, response => {
      if (response.status === 'ok') {
        window.location.reload();
      } else {
        toastr.error(response.message);
      }
    }, 'json');
  // thêm tham số thứ 4 là tham số xác định kiểu trả về của ajax thì ko cần dữ liệu trả về
  // đc tự chuyển thành obj, ko cần dùng JSON.parse()
  }
}

// Admin updates user's status
function updateUserStatus(element) {
  const data = {
    id: parseInt(element.value),
    status: element.checked ? 1 : 0
  };

  $.post('../../backend/ajax/status_user.php', data, function(response) {
    if (response.status === 'ok') {
      toastr.success('User updated successfully');
    } else {
      toastr.error(response.message);
    }
  }, 'json');
}

// Admin verifies users
function verify_user(id) {
  const data = {id: id};

  if (confirm('Verify this user and can not undo?')) {
    $.post('../../backend/ajax/verify_user.php', data, response => {
      // chua chay dc
      console.log(response);
      if (response === 1) {
        window.location.reload();
      } else {
        toastr.error('Something went wrong');
      }
    }, 'json');
  }
}






// why deleting item with POST request using fetch() does not work???
// can not log the id return using POST request

// async function confirm_delete_user(id) {
//   const data = {
//     id: id,
//   };

//   try {
//     let response = await fetch('../../backend/ajax/delete_user.php', {
//       method: 'POST',
//       headers: {
//         'Content-type': 'application/json;charset=utf-8'
//       },
//       body: JSON.stringify(data)
//     });

//     let result = await response.json();
//     console.log('result =>', result);
//   } catch (error) {
//     console.log('error =>', error);      
//   }
// }