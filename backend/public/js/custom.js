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
      toastr.success('Product updated successfully');
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
  // the fourth parameter is the return type of ajax (json, xml, script, text, html), omit JSON.parse(response) if add this parameter as 'json'
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
      if (response === 1) {
        window.location.reload();
      } else {
        toastr.error('Something went wrong');
      }
    }, 'json');
  }
}

function enterSearch(event) {
  // get products by pressing enter after input instead of clicking on the search icon
  // must use 'event' as function parameter
  if (event.keyCode === 13) getProductSearch();
}

async function getProductSearch() {
  // get products searched by name using ajax
  const queryStr = document.querySelector('#table_search').value;
  const url = window.location.href;
  // must remove previous query string (if there is) before concatenating new query string then reload

  console.log(url);
  // window.location.href += `?query=${queryStr}`;
}






// why deleting item with POST request using fetch() does not work???
// can not log the returned id in console using POST request

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