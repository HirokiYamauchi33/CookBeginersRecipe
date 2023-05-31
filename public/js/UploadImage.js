const uploadImageModule =(() => {
    const inputElement = document.getElementById('image')
    const previewElement = document.getElementById('picture')

    inputElement.addEventListener("change", event => {
        event.preventDefault();
        event.stopPropagation();

        const file = event.target.files[0];

        if(!file || !file.type.match(/image\/*/)) {
            alert('画像ファイルではありません。')
            return false;
        }

        const reader = new FileReader();

        reader.addEventListener('load', event => {
            previewElement.setAttribute('src', event.target.result);
        })

        reader.readAsDataURL(file);
    });

    const input2Element = document.getElementById('image_2')
    const preview2Element = document.getElementById('picture_2')

    input2Element.addEventListener("change", event => {
        event.preventDefault();
        event.stopPropagation();

        const file = event.target.files[0];

        if(!file || !file.type.match(/image\/*/)) {
            alert('画像ファイルではありません。')
            return false;
        }

        const reader = new FileReader();

        reader.addEventListener('load', event => {
            preview2Element.setAttribute('src', event.target.result);
        })

        reader.readAsDataURL(file);
    });

    const input3Element = document.getElementById('image_3')
    const preview3Element = document.getElementById('picture_3')

    input3Element.addEventListener("change", event => {
        event.preventDefault();
        event.stopPropagation();

        const file = event.target.files[0];

        if(!file || !file.type.match(/image\/*/)) {
            alert('画像ファイルではありません。')
            return false;
        }

        const reader = new FileReader();

        reader.addEventListener('load', event => {
            preview3Element.setAttribute('src', event.target.result);
        })

        reader.readAsDataURL(file);
    });

    const input4Element = document.getElementById('image_4')
    const preview4Element = document.getElementById('picture_4')

    input4Element.addEventListener("change", event => {
        event.preventDefault();
        event.stopPropagation();

        const file = event.target.files[0];

        if(!file || !file.type.match(/image\/*/)) {
            alert('画像ファイルではありません。')
            return false;
        }

        const reader = new FileReader();

        reader.addEventListener('load', event => {
            preview4Element.setAttribute('src', event.target.result);
        })

        reader.readAsDataURL(file);
    });

    const input5Element = document.getElementById('image_5')
    const preview5Element = document.getElementById('picture_5')

    input5Element.addEventListener("change", event => {
        event.preventDefault();
        event.stopPropagation();

        const file = event.target.files[0];

        if(!file || !file.type.match(/image\/*/)) {
            alert('画像ファイルではありません。')
            return false;
        }

        const reader = new FileReader();

        reader.addEventListener('load', event => {
            preview5Element.setAttribute('src', event.target.result);
        })

        reader.readAsDataURL(file);
    });

    const input6Element = document.getElementById('image_6')
    const preview6Element = document.getElementById('picture_6')

    input6Element.addEventListener("change", event => {
        event.preventDefault();
        event.stopPropagation();

        const file = event.target.files[0];

        if(!file || !file.type.match(/image\/*/)) {
            alert('画像ファイルではありません。')
            return false;
        }

        const reader = new FileReader();

        reader.addEventListener('load', event => {
            preview6Element.setAttribute('src', event.target.result);
        })

        reader.readAsDataURL(file);
    });

    const input7Element = document.getElementById('image_7')
    const preview7Element = document.getElementById('picture_7')

    input7Element.addEventListener("change", event => {
        event.preventDefault();
        event.stopPropagation();

        const file = event.target.files[0];

        if(!file || !file.type.match(/image\/*/)) {
            alert('画像ファイルではありません。')
            return false;
        }

        const reader = new FileReader();

        reader.addEventListener('load', event => {
            preview7Element.setAttribute('src', event.target.result);
        })

        reader.readAsDataURL(file);
    });

    const inputprofimgElement = document.getElementById('profimg')
    const previewprofpicElement = document.getElementById('profpic')

    inputprofimgElement.addEventListener("change", event => {
        event.preventDefault();
        event.stopPropagation();

        const file = event.target.files[0];

        if(!file || !file.type.match(/image\/*/)) {
            alert('画像ファイルではありません。')
            return false;
        }

        const reader = new FileReader();

        reader.addEventListener('load', event => {
            previewprofpicElement.setAttribute('src', event.target.result);
        })

        reader.readAsDataURL(file);
    });
    
})();