const API_BASE_URI = 'https://api.cloudinary.com/v1_1/dilusf0q7/upload';
const UPLOAD_PRESET = 'ysatlask';

let file_upload = document.getElementById('file-upload');
let submitbtn = document.getElementById('submitbtn');
let inputImageUrl = document.getElementById('imageUrlInput');

file_upload.onclick = function () {
    this.value = null;
}

file_upload.addEventListener('change', function(e) {
    let file = e.target.files[0];
    let formData = new FormData();
    formData.append('file', file);
    formData.append('upload_preset', UPLOAD_PRESET)
    submitbtn.classList.remove("hidden");
    axios({
        url: API_BASE_URI,
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        data: formData
    }).then(function(res) {
        let imageUrl = res.data.secure_url;
        inputImageUrl.value = imageUrl;
        console.log(inputImageUrl.value);
    }).catch(function (err) {
        console.error(err);
    })
});