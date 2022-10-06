/* 
    iup.js
    image upload with preview a utility to display image before upload
*/

    document.querySelector('.img-upload [type=file]').addEventListener('change', function(event){
        
        var preview = event.target.dataset.previewId;
        preview = document.querySelector('#'+preview);

        if(event.target.files.length > 0){
          img = URL.createObjectURL(event.target.files[0]);
          preview.style.backgroundImage= `url('${img}')`;  
          let name = event.target.files[0].name;
          event.target.nextElementSibling.innerText = name;
          preview.classList.add('remove-img');
          
        }

        else{
          // no files attached
          preview.classList.remove('remove-img');
          preview.style.backgroundImage= `url('image-icon.png')`;  
          event.target.nextElementSibling.innerText = 'Choose Image';
        }
    });

  document.querySelector('.img-upload-preview').addEventListener('click', function(event){
    // removing attached file
    var file = 'input[data-preview-id='+event.target.id+']';
    file = document.querySelector(file);
    file.value = '';
    file.nextElementSibling.innerText = 'Choose Image';
    file.previousElementSibling.value = '';
    event.target.classList.remove('remove-img');
    event.target.style.backgroundImage = `url(${event.target.dataset.notImg})`;
  });
  
  
  function populateUpload(id, img){
    const preview = document.querySelector('#'+id);
    preview.classList.add('remove-img');
    
    const base = preview.dataset.baseUrl;
    console.log(img);
    preview.style.backgroundImage = `url('${base+img}')`;
    document.querySelector(`[data-preview-id=${id}]`).nextElementSibling.innerText = img;
    document.querySelector(`[data-preview-id=${id}]`).previousElementSibling.value = img;
  }

    
    