let timer;

function appBasePath(){
    const parts = window.location.pathname.split('/');
    const appIndex = parts.indexOf('E-Commerce_Store_Management_System');

    if(appIndex !== -1){
        return parts.slice(0, appIndex + 1).join('/');
    }

    return '';
}

function apiUrl(path){
    return appBasePath() + '/api/' + path.replace(/^\/+/, '');
}

function viewUrl(path){
    return appBasePath() + '/View/' + path.replace(/^\/+/, '');
}

function uploadUrl(fileName){
    return appBasePath() + '/uploads/' + encodeURIComponent(fileName || '');
}

function productUrl(id){
    return appBasePath() + '/Controller/productValidation.php?id=' + encodeURIComponent(id);
}

function formatMoney(value){
    return Number(value || 0).toFixed(2);
}

function setSearchMode(keyword){
    const hero = document.getElementById('hero-section');
    const category = document.getElementById('category-section');
    const title = document.getElementById('product-section-title');
    const trimmed = (keyword || '').trim();

    if(hero){
        hero.style.display = trimmed ? 'none' : '';
    }

    if(category){
        category.style.display = trimmed ? 'none' : '';
    }

    if(title){
        title.textContent = trimmed ? 'Search Results for "' + trimmed + '"' : 'Available Products';
    }
}

function focusProductResults(){
    const productSection = document.getElementById('product-section');
    if(productSection){
        productSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

function renderProductGrid(products){
    const grid = document.getElementById('product-grid');
    if(!grid){
        return;
    }

    if(!products.length){
        grid.innerHTML = '<p class="empty-message">No available products found.</p>';
        return;
    }

    grid.innerHTML = products.map(function(product){
        return `
            <div class="product-card">
                <a href="${productUrl(product.id)}">
                    <img src="${uploadUrl(product.image)}" alt="${escapeHtml(product.name)}">
                    <h3>${escapeHtml(product.name)}</h3>
                    <p>$${formatMoney(product.price)}</p>
                </a>
                <button class="cart-btn ajax-add-cart" data-product-id="${product.id}">Add to Cart</button>
            </div>
        `;
    }).join('');
}

function loadProductsByCategory(categoryId){
    const path = categoryId
        ? 'products/index.php?category_id=' + encodeURIComponent(categoryId)
        : 'products/index.php';

    fetch(apiUrl(path))
        .then(function(response){ return response.json(); })
        .then(function(data){ renderProductGrid(data.products || []); });
}

function liveSearch(value){
    clearTimeout(timer);

    if(!document.getElementById('product-grid')){
        return;
    }

    setSearchMode(value);

    timer = setTimeout(function(){
        fetch(apiUrl('products/search/index.php?q=' + encodeURIComponent(value)))
            .then(function(response){ return response.json(); })
            .then(function(data){
                renderProductGrid(data.products || []);
                const suggestions = document.getElementById('suggestions');
                if(suggestions){
                    suggestions.style.display = 'none';
                }
            });
    }, 250);
}

function goSearch(){
    const input = document.getElementById('search');
    const keyword = input ? input.value.trim() : '';

    if(document.getElementById('product-grid')){
        liveSearch(keyword);
        focusProductResults();
    } else {
        window.location.href = viewUrl('homeView.php?q=' + encodeURIComponent(keyword));
    }
}

function submitTopSearch(event){
    const input = document.getElementById('search');
    const keyword = input ? input.value.trim() : '';

    if(document.getElementById('product-grid')){
        event.preventDefault();
        liveSearch(keyword);
        focusProductResults();
        return false;
    }

    return true;
}

function updateCartCount(count){
    const countEl = document.getElementById('cart-count');
    if(countEl){
        countEl.textContent = count;
    }
}

function addToCart(productId){
    const formData = new FormData();
    formData.append('product_id', productId);

    return fetch(apiUrl('cart/add/index.php'), {
        method: 'POST',
        body: formData
    })
        .then(function(response){ return response.json(); })
        .then(function(data){
            if(data.success){
                updateCartCount(data.cart_count);
            } else {
                alert(data.message || 'Unable to add item to cart.');
            }
            return data;
        });
}

function escapeHtml(value){
    const div = document.createElement('div');
    div.textContent = value || '';
    return div.innerHTML;
}

document.addEventListener('change', function(event){
    if(event.target && event.target.id === 'category-filter'){
        loadProductsByCategory(event.target.value);
    }
});

document.addEventListener('click', function(event){
    const button = event.target.closest('.ajax-add-cart');
    if(!button){
        return;
    }

    event.preventDefault();
    addToCart(button.dataset.productId).then(function(data){
        if(data.success && button.dataset.checkout === '1'){
            window.location.href = viewUrl('checkoutView.php');
        }
    });
});
