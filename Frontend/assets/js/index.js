function openModal(title, content) {
    document.getElementById('modal-title').innerText = title;
    document.getElementById('modal-content').innerHTML = content;
    document.getElementById('product-modal').style.display = 'block';
}

function closeModal() {
    document.getElementById('product-modal').style.display = 'none';
}

window.onclick = function(event) {
    let modal = document.getElementById('product-modal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
