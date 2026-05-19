function postCartAction(url, productId, action){
    const formData = new FormData();
    formData.append('product_id', productId);
    if(action){
        formData.append('action', action);
    }

    return fetch(apiUrl(url), {
        method: 'POST',
        body: formData
    }).then(function(response){
        return response.json();
    });
}

function updateCartTotals(data){
    updateCartCount(data.cart_count);

    const grandTotal = document.getElementById('grand-total');
    if(grandTotal){
        grandTotal.textContent = data.grand_total || '0.00';
    }
}

document.addEventListener('click', function(event){
    const updateButton = event.target.closest('.cart-update');
    const removeButton = event.target.closest('.cart-remove');

    if(updateButton){
        postCartAction('cart/update/index.php', updateButton.dataset.productId, updateButton.dataset.action)
            .then(function(data){
                if(!data.success){
                    alert(data.message || 'Unable to update cart.');
                    return;
                }

                document.getElementById('qty-' + data.product_id).textContent = data.quantity;
                document.getElementById('line-total-' + data.product_id).textContent = data.line_total;
                updateCartTotals(data);
            });
    }

    if(removeButton){
        postCartAction('cart/remove/index.php', removeButton.dataset.productId)
            .then(function(data){
                if(!data.success){
                    alert(data.message || 'Unable to remove item.');
                    return;
                }

                const row = document.getElementById('cart-row-' + data.product_id);
                if(row){
                    row.remove();
                }

                updateCartTotals(data);

                if(data.cart_count === 0){
                    window.location.reload();
                }
            });
    }
});
