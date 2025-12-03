const editModal = document.getElementById('editM');

function openEditM(item) {
    const row = [...document.querySelectorAll('tr')].find(r => r.querySelector('td')?.innerText === id);
    if(!row) return;

    document.getElementById('editId').value = item.id;
    document.getElementById('editIName').value = item.name;
    document.getElementById('editCategory').value = item.category;
    document.getElementById('editQty').value = item.qty;
    document.getElementById('editPrice').value = item.price;

    editModal.style.display = 'block';
}
function closeModal() {
    editModal.style.display = 'none';
}

window.onclick = function(event) {
    if (event.target === editModal) {
        closeModal();
    }
}