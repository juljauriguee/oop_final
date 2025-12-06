function openEditModal(id) {
    const row = document.querySelector(`tr[data-id="${id}"]`);
    if (!row) return;

    document.getElementById('editId').value = id;
    document.getElementById('editIName').value = row.children[0].innerText;
    document.getElementById('editCategory').value = row.children[1].innerText;
    document.getElementById('editQty').value = row.children[2].innerText;
    document.getElementById('editPrice').value = row.children[3].innerText.replace(/[₱,]/g, "");

    document.getElementById('editModal').classList.add("show");
}

function closeEditModal() {
    document.getElementById('editModal').classList.remove("show");
}

window.onclick = function(event) {
    const modal = document.getElementById("editModal");
    if(event.target === modal) closeEditModal();
}