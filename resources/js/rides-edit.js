window.addEventListener('load', init);

let btn;
let token;

function init() {
    btn = document.getElementById('toggle-visibility-btn');
    token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    btn.addEventListener('click', toggleVisibility);
}

function toggleVisibility() {
    fetch(btn.dataset.url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
    })
        .then(response => response.json())
        .then(updateButton)
        .catch(error => console.error('Error:', error));
}

function updateButton(data) {
    if (data.public) {
        btn.innerHTML = 'Visible <i class="fa-solid fa-eye"></i>';
        btn.classList.remove('hidden');
        btn.classList.add('visible');
    } else {
        btn.innerHTML = 'Hidden <i class="fa-solid fa-eye-slash"></i>';
        btn.classList.remove('visible');
        btn.classList.add('hidden');
    }
}
