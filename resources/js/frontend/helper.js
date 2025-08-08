const apiUrl = window.location.origin;
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


export const addProductToCompare = (id, el) => {
    const url = apiUrl + '/compares/add';

    axios.post(url, { product_id: id }).then((res) => {
        const isCompared = res.data?.compared;

        // Show message
        window.FlashMessage?.info?.(res.data?.message, {
            timeout: 2000,
            progress: true
        });

        // Animate button
        el.classList.toggle('active', isCompared);
        el.classList.add('animate');

        // Icon
        const icon = el.querySelector('.compare-icon');
        if (icon) {
            icon.className = isCompared
                ? 'fas fa-check me-2 compare-icon'
                : 'fas fa-balance-scale me-2 compare-icon';
            icon.style.color = isCompared ? 'green' : '#000';
        }

        // Text
        const text = el.querySelector('.compare-text');
        if (text) {
            text.textContent = isCompared ? 'Remove from compare' : 'Add to compare';
        }

        // Clear animation class
        setTimeout(() => {
            el.classList.remove('animate');
        }, 500);

    }).catch(() => {
        window.FlashMessage?.error?.('Item not added to compare', {
            timeout: 2000,
            progress: true
        });
    });
};

// Attach click listeners
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.prdCompares').forEach((btn) => {
        btn.addEventListener('click', function () {
            const productId = this.dataset.productId;
            addProductToCompare(productId, this);
        });
    });
});

//compare functionality
const prdRemoveCompareBtn = document.querySelectorAll('.removeFromCompare');
prdRemoveCompareBtn && prdRemoveCompareBtn.forEach((event) => {
    event.addEventListener('click', function () {
        if (confirm('Are you sure you want to remove this product from compare?')) {
            var id = this.getAttribute('data-id');
            const url = apiUrl + '/compares/' + id + '/delete';
            axios.get(url).then((res) => {
                window.FlashMessage?.info?.(res.data?.message, {
                    timeout: 2000,
                    progress: true
                });
                window.location.reload();
            }).catch((e) => {
                showFlashMessages('alert-danger', e)
            });
        }
    })
})
