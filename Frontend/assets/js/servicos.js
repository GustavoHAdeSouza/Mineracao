function openModal(title, content) {
    document.getElementById('modal-title').innerText = title;
    document.getElementById('modal-content').innerHTML = content;
    document.getElementById('service-modal').style.display = 'block';
}

function closeModal() {
    document.getElementById('service-modal').style.display = 'none';
}

// Fecha se clicar fora do modal
window.onclick = function(event) {
    let modal = document.getElementById('service-modal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
