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


// Admin Deletes 
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


// Admin Updates Status
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


// Admin Searches
function enterSearch(event) {
  // get products by pressing enter after input instead of clicking on the search icon
  // must use 'event' as function parameter
  if (event.keyCode === 13) {
    if (window.location.pathname === '/backend/prod_index.php') {
      getProductSearch();
    } else if (window.location.pathname === '/backend/user_index.php') {
      getUserSearch();
    }
  }
}

function getProductSearch() {
  // get products searched by name using ajax
  const queryStr = document.querySelector('#table_search').value;
  // must remove previous query string (if there is) before concatenating new query string then reload
  // in order to search continuously

  // old way
  // let url = window.location.href;
  // url = url.substring(0, url.indexOf('?'));
  // window.location.href = url + `?query=${queryStr}`

  // better do this way
  // window.location.search = `?query=${queryStr}`;  

  // maybe the 2nd best way yet
  const url = new URL(window.location.href);
  url.searchParams.set('query', queryStr);
  console.log(url);
  window.location.assign(url.href);
  // https://javascript.info/url
  // https://stackoverflow.com/questions/10302905/location-href-property-vs-location-assign-method#14673342
}

function getUserSearch() {
  // get users searched by name and email using ajax
  const queryStr = document.querySelector('#table_search').value;
  window.location.search = `?query=${queryStr}`;  
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


// Admin product thumb management
async function uploadThumb() {
  const previewImg = document.querySelector('#thumbPreview img');
  const myForm = document.getElementById('myForm');
  const fileUpload = document.getElementById('thumbPath');

  const response = await fetch('../../backend/ajax/upload_images.php', {
    method: "POST",
    body: new FormData(myForm)
  });
  const result = await response.json();

  if (result.status === 'ok') {
    previewImg.setAttribute('src', result.image);
    fileUpload.setAttribute('value', result.image);
  } else {
    toastr.error(result.message);
  }
}

async function updateThumb() {
  const previewImg = document.querySelector('#thumbPreview img');
  const myForm = document.getElementById('myForm');
  const fileUpdate = document.getElementById('thumbPath');
  // get product current image path
  const currentFilePath = fileUpdate.value;
  document.querySelector('#oldThumb').value = currentFilePath;

  const response = await fetch('../../backend/ajax/upload_images.php', {
    method: "POST",
    body: new FormData(myForm)
  });
  const result = await response.json();

  if (result.status === 'ok') {
    previewImg.setAttribute('src', result.image);
    fileUpdate.setAttribute('value', result.image);
  } else {
    toastr.error(result.message);
  }
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