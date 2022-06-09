
const openCart = document.getElementById('open-cart');

// Tunjukan Keranjang 
(function(){ 
    
    const cartBtn= document.getElementById('cart-info');
    
    // untuk tombol klik
    cartBtn.addEventListener('click', displayCart);

    function displayCart() {
        // untuk cssnya
        openCart.classList.toggle('display-cart');
    }

})();

// untuk menambahkan barang
(function(){ 

    const addTocartBtn = document.querySelectorAll('.product-item-icon');


    addTocartBtn.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            
        
            if(event.target.parentElement.classList.contains('product-item-icon')){

                // untuk mendapatkan gambar daru url
                let cartImgUrl = event.target.parentElement.previousElementSibling.src

                // membuat objek kosong pada keranjang
                const cartItemObj = {};

                // Menambahkan properti img ke objek
                cartItemObj.img = cartImgUrl;

                // menambahkan nama
                let cartItemName = event.target.parentElement.parentElement.nextElementSibling.children[0].children[0].textContent;
                cartItemObj.name = cartItemName;

                // menambahkan harga
                let cartItemPrice = event.target.parentElement.parentElement.nextElementSibling.children[0].children[1].textContent;

                // Format untuk angka
                let newPrice = cartItemPrice.slice(1);
                cartItemObj.price = newPrice;

                // membuat elemen div untuk menampilkan item di keranjang
                const productItem = document.createElement('div');
                productItem.classList.add(
                    'cart-item', 
                    'd-flex', 
                    'justify-content-between', 
                    'text-capitalize', 
                    'my-3'
                );
            
                
                productItem.innerHTML =
                `<!-- single cart item -->
                <!-- <div class="cart-item d-flex justify-content-between text-capitalize my-3"> -->
                    <img src="${cartImgUrl}" alt="" class="img-fluid rounded-circle cart-img" id="item-img">
                
                    <div class="item-text">
                        <p id="cart-item-title">${cartItemName}</p>
                        <span></span>
                    <span id="cart-item-price" class="cart-item-price">${newPrice}</span>
                    </div>
                    
                    <a href="#" class="cart-item-remove" id="cart-item-remove">
                        <i class="fas fa-trash"></i>
                    </a>
                <!-- </div> -->`;
               
                const total = document.querySelector('.cart-total')

                openCart.insertBefore(productItem, total);
                // Ketika setiap tombol diklik, perbarui total
                showTotal();               
            }
        })
    });

    function showTotal() {
        // // Inisialisasi array total 
        const total = [];
        const items = document.querySelectorAll('.cart-item-price');

        items.forEach((item) => {
            total.push(parseFloat(item.textContent));
        });

        

        // Penambahan harga
        const money = total.reduce((total,item) => {
            total += item;
            return total
            
        })
        const finalMoney = money.toFixed(2);

        document.getElementById('cart-total').textContent = finalMoney;
        document.querySelector('.item-total').textContent = finalMoney
        document.getElementById('item-count').textContent = total.length;
    }


})();

// VALIDASI BAGIAN KONTAK
(function(){
    
})();