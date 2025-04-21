// document.getElementById('cardNumber').addEventListener('input', function (e) {
//     let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
//     let formattedValue = value.replace(/(\d{4})/g, '$1 ').trim();
//     e.target.value = formattedValue;
// });

// document.getElementById('expiryDate').addEventListener('input', function (e) {
//     let value = e.target.value.replace(/[^0-9]/g, '');
//     if (value.length > 2) {
//         value = value.slice(0, 2) + '/' + value.slice(2, 4);
//     }
//     e.target.value = value;
// });

// document.getElementById('cvv').addEventListener('input', function (e) {
//     let value = e.target.value.replace(/[^0-9]/g, '');
//     e.target.value = value.slice(0, 3);
// });