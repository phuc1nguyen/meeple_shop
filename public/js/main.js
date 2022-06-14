// UI Elements
const tutorials = document.querySelector('.homeIframe');
const tutItem = document.getElementsByClassName('iframe_item_inner');
const firstTutItem = document.querySelector('.iframe_item_inner');
const watchingTutUrl = firstTutItem.querySelector('.video_thumb').dataset.source;
const watchingTutTitle = firstTutItem.querySelector('.video_title');
const tutIframe = document.querySelector('#mainIframe iframe');

// set tutorial to watch when page load
watchingTutTitle.classList.add('active-tut');
tutIframe.setAttribute('src', watchingTutUrl);

for (let i = 0; i < tutItem.length; i++) {
  tutItem[i].addEventListener('click', function(e) {
    // set tutorials to watch upon click on them
    let tutThumb = e.target.closest('.iframe_item_inner').querySelector('.video_thumb');
    let tutTitle = e.target.closest('.iframe_item_inner').querySelector('.video_title');
    let tutUrl = tutThumb.dataset.source;

    tutorials.querySelector('.active-tut').classList.remove('active-tut');
    tutTitle.classList.add('active-tut');
    tutIframe.setAttribute('src', tutUrl);
  });
}

async function updateThumb() {
  const myForm = document.querySelector('#userForm');
  const previewImg = document.querySelector('.thumbPreview img');
  const fileUpload = document.querySelector('#thumbPath');

  const response = await fetch('../../backend/ajax/upload_userprofile.php', {
    method: 'POST',
    body: new FormData(myForm),
  });
  const result = await response.json();

  if (result.status === 'ok') {
    previewImg.setAttribute('src', result.image);
    // fileUpload.setAttribute('value', result.image);
    fileUpload.value = result.image;
  } else {
    alert(result.message);
  }
}