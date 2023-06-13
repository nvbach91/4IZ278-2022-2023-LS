function confirmDelete(event) {
    let confirmation = confirm("Opravdu chcete smazat tento záznam?");

    if (!confirmation) {
        event.preventDefault();
    }
}