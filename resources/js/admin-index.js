window.addEventListener('load', init);

function init() {
    const buttons = document.querySelectorAll('.toggle-visibility-btn');
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => toggleVisibility(btn, token));
    });
}

function toggleVisibility(btn, token) {
    fetch(btn.dataset.url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
    })
        .then(response => response.json())
        .then(data => updateButton(btn, data))
        .catch(error => console.error('Error:', error));
}

function updateButton(btn, data) {
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
