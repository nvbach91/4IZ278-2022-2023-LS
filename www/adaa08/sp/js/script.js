function addressSelectChanged(selectElement) {
    var isAddressSelected = selectElement.value !== '';
    if (isAddressSelected) {
        document.getElementById('city').value = '';
        document.getElementById('postal_code').value = '';
        document.getElementById('street_plus_number').value = '';
        document.getElementById('country').value = '';
    }
    document.getElementById('city').disabled = isAddressSelected;
    document.getElementById('postal_code').disabled = isAddressSelected;
    document.getElementById('street_plus_number').disabled = isAddressSelected;
    document.getElementById('country').disabled = isAddressSelected;
}

function validateForm() {
    var selectElement = document.getElementById('previous_addresses');
    if (selectElement.value === '') {
      alert('Prosím, vyberte si adresu.');
      return false;
    }
    return true;
}
  
