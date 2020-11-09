//Product Variations

const pageClass = `single-product`

function getProductVariations(productId) {
    const URL = `/wp-json/wc/v3/products/${productId}/variations`
    fetch(URL, {
        method: 'GET',
        headers: {
            'content-type': 'application/json',
        },
    })
        .then((r) => r.json())
        .then(console.log)
        .catch((error) => console.log(error))
}

//check if page is product single
if (document.body.classList.contains(pageClass)) getProductVariations(productID)
