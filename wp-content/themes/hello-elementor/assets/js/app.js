const filter = (() => {
    //private var/functions
    function handleRequest(id, type) {
        return new Promise((resolve, reject) => {
            var requestOptions = {
                method: 'GET',
                redirect: 'follow',
            }

            fetch(`/wp-json/filter/v1/${type}/${id}`, requestOptions)
                .then((response) => response.json())
                .then((res) => {
                    if (res.error) return reject(res)

                    return resolve(res)
                })
                .catch(reject)
        })
    }

    function cleanSelect(select) {
        const options = [...select.querySelectorAll('option')]

        if (options) {
            options.forEach((option) => {
                if (option.value) option.remove()
            })
        }
    }

    async function handleInputChange(input) {
        try {
            const value = input.value

            const inputCity = input.closest('header').querySelector('.city select')

            inputCity.disabled = true

            cleanSelect(inputCity)

            if (!value) return

            const cities = await handleRequest(value, 'city')

            if (cities) {
                inputCity.disabled = false
                cities.forEach((city) => {
                    const option = document.createElement('option')

                    option.value = city.term_id

                    option.innerText = city.name

                    inputCity.append(option)
                })
            }
        } catch (error) {
            return
        }
    }

    function getCities(selector) {
        const theInput = document.querySelector(selector)

        console.log(`Input: `, theInput)

        if (!theInput) return

        theInput.addEventListener('change', function (e) {
            e.preventDefault()

            handleInputChange(theInput)
        })
    }

    async function handleGetShops(input) {
        try {
            const value = input.value

            if (!value) return

            const shops = await handleRequest(value, 'shops')

            const containerShops = document.querySelector('.local-list ul.row')

            const resultCount = document.querySelector('.col-lg-12.shops__result')

            if (shops) {
                containerShops.innerHTML = ``
                resultCount.innerHTML = `${shops.length} resultados encontrados:`
                shops.forEach((shop) => {
                    const theShop = document.createElement('li')

                    theShop.innerHTML = `
                    <div class="shop__container">
                        <figure>${shop.image}</figure>
                        <article>
                            <h3>${shop.title}</h3> 
                            <aside>Marília</aside>
                            ${shop.content}
                        </article>
                    </div>
                    `

                    containerShops.append(theShop)
                })
            }
        } catch (error) {
            return
        }
    }

    function getShops(selector) {
        const input = document.querySelector(selector)

        if (input)
            input.addEventListener('change', function (e) {
                e.preventDefault()

                handleGetShops(input)
            })
    }

    return {
        //public var/functions
        getCities,
        getShops,
    }
})()

//.search__inputs.state select

filter.getCities(`select#selectState`)

filter.getShops(`select#selectCity`)

console.log(`Aqui carregou`)
