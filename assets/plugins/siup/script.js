
/* 
    SIUP : Simple image upload with preview
    A utility to upload with image preview
    github: https://github.com/MdFarzan/SIUP
*/

class SIUP{

    // to setup basic things
    static inputClass = '';
    static previewClass = '';
    static acceptFormats = '';


    constructor(id){
        this.selector = id;
        const ref = document.querySelector('#'+this.selector);
        const file = `<div class="add-file">
            <input type="hidden" name="${'flag-'+this.selector}">
            <input type="file" class="${SIUP.inputClass}" onChange="SIUPhandleFile(event)" accept="${SIUP.acceptFormats}" name="${this.selector}" />
            </div>`;
        const previewr = `<div class="preview ${SIUP.previewClass}" onclick="removeImage(event)" data-target="${this.selector}"></div>`;

        ref.innerHTML = file+previewr;
        
    }
    

    populate(src){
        const previewr = document.querySelector('[data-target='+this.selector+']');
        previewr.style.backgroundImage = `url('${src}')`;
        previewr.classList.add('show-preview');
    }

    static setAcceptFormats(formats){
        this.acceptFormats = formats;
    }

    static  setInputClass(classes){
        this.inputClass = classes;
    }

    static setPreviewClass(classes){
        this.previewClass = classes;
    }

}

function SIUPhandleFile(event){
    
    if(event.target.files.length>0){
        
        img = URL.createObjectURL(event.target.files[0]);
        let name = event.target.files[0].name;
        let previewr = event.target.parentNode.nextElementSibling;
        
        previewr.style.backgroundImage = `url('${img}')`
        previewr.classList.add('show-preview');
    }

}


function removeImage(event){
    const target = event.target.dataset.target;
    document.querySelector('[name=flag-'+target+']').value = 1;
    const file = document.querySelector(`[name=${target}]`);
    file.value = '';
    const previewr = file.parentNode.nextElementSibling;
    previewr.classList.remove('show-preview');
    previewr.style.backgroundImage = '';
}

