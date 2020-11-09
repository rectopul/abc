//Product Variations
const pageClass = `single-product`

const wooClientKey = 'ck_d81acb9e8527501327f83ae3a87f2e89a93f2f1e'
const wooClientSecret = 'ck_d81acb9e8527501327f83ae3a87f2e89a93f2f1e'

function basicAuth(key, secret) {
    let hash = btoa(key + ':' + secret)
    return 'Basic ' + hash
}

function handleImagesVariation(variations) {
    return new Promise((resolve, reject) => {
        const containerImages = document.querySelector('.product_variations_images .swiper-container')

        if (!containerImages) return reject('não existe carousel')

        const swiperVariation = containerImages.swiper

        const slides = []
        variations.map((variation) => {
            const element = document.createElement('div')

            element.classList.add('swiper-slide')

            element.innerHTML = `<figure class="swiper-slide-inner"></figure>`

            const image = document.createElement('img')

            image.src = variation.image.src

            image.alt = variation.image.alt || variation.image.name

            image.classList.add('swiper-slide-image')

            element.querySelector('figure').append(image)

            slides.push(element)
        })
        swiperVariation.removeAllSlides()
        swiperVariation.addSlide(1, slides)
        swiperVariation.destroy()

        const nSlide = new Swiper(containerImages, {
            // Default parameters
            slidesPerView: 1,
            navigation: {
                nextEl: '.elementor-swiper-button-next',
                prevEl: '.elementor-swiper-button-prev',
            },

            pagination: {
                el: '.variationsNavigation',
                type: 'bullets',
                clickable: true,
                renderBullet: function (index, className) {
                    return (
                        '<span class="' +
                        className +
                        '"><figure><img src="' +
                        variations[index].image.src +
                        '"></figure></span>'
                    )
                },
            },

            init: false,
        })

        nSlide.update()
        nSlide.init()

        console.log(nSlide)
    })
}

function handleNavigation(variations) {
    return new Promise((resolve, reject) => {
        const container = document.createElement('div')

        container.classList.add('swiper-pagination')

        container.classList.add('variationsNavigation')
        variations.map((variation) => {
            const newItem = document.createElement('span')

            newItem.classList.add('variationPagination')

            const img = document.createElement('img')

            img.src = variation.image.src || null

            newItem.innerHTML = `<figure></figure>`

            newItem.querySelector('figure').append(img)
        })

        handlePutNavigation(container)
        handleImagesVariation(variations)

        return resolve(container)
    })
}

function handlePutNavigation(navigation) {
    return new Promise((resolve, reject) => {
        const navContainer = document.querySelector('.product_variations_nav')
        const containerImages = document.querySelector('.product_variations_images .swiper-container')

        if (navContainer) return resolve(navContainer.append(navigation))
    })
}

function getProductVariations(productId) {
    // This initializes the wp.api object with the custom WooCommerce namespace.
    wp.api.init({ versionString: 'wc/v2/' })

    let nvariation = new wp.api.collections.ProductsVariations(null, { parent: productId })

    nvariation.fetch().done(handleNavigation)
}

if (window.wp) {
    //check if page is product single
    if (document.body.classList.contains(pageClass)) getProductVariations(productID)
}
