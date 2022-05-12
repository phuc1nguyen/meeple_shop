$(document).ready(function(){
  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });
});

// Toastr settings
toastr.options = {
  "positionClass": "toast-bottom-left",
  "timeOut": 1000
};

// Admin deletes products
function delete_product(id) {
  const data = {
    id: id
  };

  if (confirm('Are you sure want to delete this product?')) {
    $.post('../../backend/ajax/delete_product.php', data, json => {
      const response = JSON.parse(json); 
      if (response.status === 'ok') {
        toastr.options.onHidden = function() {
          window.location.reload();
        }
        toastr.success(response.message);
      } else {
        toastr.error(response.message);
      }
    });
  }
}

// Admin deletes users
function delete_user(id) {
  const data = {
    id: id
  };

  if (confirm('Are you sure want to delete this user?')) {
    $.post('../../backend/ajax/delete_user.php', data, response => {
      if (response.status === 'ok') {
        toastr.options.onHidden = function() {
          window.location.reload();
        }
        toastr.success(response.message);
      } else {
        toastr.error(response.message);
      }
    }, "json");
  // thêm tham số thứ 4 là tham số xác định kiểu trả về của ajax thì ko cần dữ liệu trả về
  // đc tự chuyển thành obj, ko cần dùng JSON.parse()
  }
}

// Admin updates product's status
function updateProductStatus(element) {
  if (element.checked) {
    const status = 1;
  } else {
    const status = 0;
  }

  $.post('../../backend/ajax/status_product.php', {
    id: element.value,
    status: status
  }, response => {
    console.log(response);
    //  if (response === true) {
    //   toastr.success('Product status updated successfully');
    //  } else {
      // toastr.error('Something went wrong')
    //  }
  });
}

// Admin updates user's status
function updateUserStatus(element) {
  if (element.checked) {
    const status = 1;
  } else {
    const status = 0;
  }

  $.post('../../backend/ajax/status_user.php', {
    id: element.value,
    status: status
  }, response => {
    if (response === true) {
      toastr.success('User status updated successfully');
    } else {
      toastr.error('Something went wrong');
    }
  })
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