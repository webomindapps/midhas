const apiUrl = "https://www.furniturestore.to/staging/public";
export const product_id = document.getElementById('product_id')?.value;

//wishlists
export const addProductToWishList = (id, el) => {
    const url = apiUrl + '/wishlists/add';
    axios.post(url, {
        product_id: id,
    }).then((res) => {
        const isWishlisted = res.data?.wishlisted;

        window.FlashMessage?.info?.(res.data?.message, {
            timeout: 2000,
            progress: true
        });

        // Toggle classes and update icon/text
        el.classList.toggle('active', isWishlisted);
        el.classList.add('animate'); // Optional animation

        const icon = el.querySelector('.wishlist-icon');
        const text = el.querySelector('.wishlist-text');

        if (icon) {
            icon.className = isWishlisted
                ? 'fas fa-heart me-2 wishlist-icon'
                : 'far fa-heart me-2 wishlist-icon';
            icon.style.color = isWishlisted ? 'red' : '#ccc';
        }

        if (text) {
            text.textContent = isWishlisted
                ? 'Remove from wishlist'
                : 'Add to wishlist';
        }

        // Optionally remove the animate class after a short delay
        setTimeout(() => {
            el.classList.remove('animate');
        }, 500);

    }).catch((e) => {
        window.FlashMessage?.error?.('Item not added to wishlist', {
            timeout: 2000,
            progress: true
        });
    });
};

document.querySelectorAll('.addToWishList').forEach(btn => {
    btn.addEventListener('click', function () {
        const productId = this.dataset.productId;
        addProductToWishList(productId, this);
    });
});


