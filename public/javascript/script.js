let tambah = document.querySelector('#plus');
let kurang = document.querySelector('#minus');
let qty = document.querySelector('#place');
tambah.addEventListener('click',()=>{
    qty.value = parseInt(qty.value) + 1;
});
kurang.addEventListener('click',()=>{
    if (qty.value <= 1) {
        qty.value = 1
    } else {
        qty.value = parseInt(qty.value) - 1;
    }
});