function openModal(title, content) {
    document.getElementById('modal-title').innerText = title;
    document.getElementById('modal-content').innerHTML = content;
    document.getElementById('news-modal').style.display = 'block';
}

function closeModal() {
    document.getElementById('news-modal').style.display = 'none';
}

// Fecha se clicar fora do modal
window.onclick = function(event) {
    let modal = document.getElementById('news-modal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

