function openEditModal(id) {
    const row = [...document.querySelectorAll('tr')].find(r => r.querySelector('td')?.innerText === id);
    if (!row) return;

    document.getElementById('editId').value = id;
    document.getElementById('editIName').value = row.children[1].innerText;
    document.getElementById('editCategory').value = row.children[2].innerText;
    document.getElementById('editQty').value = row.children[3].innerText;
    document.getElementById('editPrice').value = row.children[4].innerText.replace('₱','').replace(',','');

    document.getElementById('editModal').style.display = 'flex'; 
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

window.onclick = function(event) {
    const editModal = document.getElementById("editModal");
    if (event.target === editModal) closeEditModal();
}
    