jQuery.noConflict(); // Reverts '$' variable back to other JS libraries
/**
 * Mascara moeda brasileira
 */
function moeda(a, e, r, t) {
    let n = "",
        h = (j = 0),
        u = (tamanho2 = 0),
        l = (ajd2 = ""),
        o = window.Event ? t.which : t.keyCode;
    if (13 == o || 8 == o) return !0;
    if (((n = String.fromCharCode(o)), -1 == "0123456789".indexOf(n)))
        return !1;
    for (
        u = a.value.length, h = 0;
        h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r);
        h++
    );
    for (l = ""; h < u; h++)
        -1 != "0123456789".indexOf(a.value.charAt(h)) &&
            (l += a.value.charAt(h));
    if (
        ((l += n),
        0 == (u = l.length) && (a.value = ""),
        1 == u && (a.value = "0" + r + "0" + l),
        2 == u && (a.value = "0" + r + l),
        u > 2)
    ) {
        for (ajd2 = "", j = 0, h = u - 3; h >= 0; h--)
            3 == j && ((ajd2 += e), (j = 0)), (ajd2 += l.charAt(h)), j++;
        for (
            a.value = "", tamanho2 = ajd2.length, h = tamanho2 - 1;
            h >= 0;
            h--
        )
            a.value += ajd2.charAt(h);
        a.value += r + l.substr(u - 2, u);
    }
    return !1;
}
jQuery(document).ready(function($) {
    var $ = window.jQuery,
        type,
        atrib,
        price;
    function submitpost(typ, atrb, prc) {
        data = {
            nonce: js_global.filter_nonce,
            action: "filter"
        };
        if (typ) data["type"] = typ;
        if (atrb) data["professional_ttr"] = atrb;
        if (prc) data["price"] = prc;
        console.log(data);

        $.post(
            js_global.xhr_url,
            data,
            function(data, textStatus, jqXHR) {
                console.log(data);
                $(".list__profissionais").html("");
                $(".post__type-" + typ).css("display", "block");
                if (data[0].erros) {
                    var { message, terms } = data[0];

                    $(".post__type-" + typ)
                        .find(".list__profissionais")
                        .html(
                            '<div style="color: #000000; font-size: 35px; margin: 20px auto;">' +
                                message +
                                " " +
                                JSON.stringify(terms) +
                                "</div>"
                        );
                } else {
                    for (var i in data) {
                        if (data.hasOwnProperty(i)) {
                            var element = data[i];

                            console.log(element);
                            var {
                                title,
                                description,
                                ID,
                                atributo,
                                thumbnail,
                                price
                            } = element;
                            var formatprice =
                                price > 999
                                    ? price.substring(0, 1) +
                                      "." +
                                      price.substring(1, 100)
                                    : price;
                            $(".post__type-" + typ)
                                .find(".list__profissionais")
                                .append(
                                    '\
                            <li class="item__list">\
                                <figure>' +
                                        thumbnail +
                                        '</figure>\
                                <span class="item__attr">' +
                                        atributo +
                                        '</span>\
                                <span class="item__title">' +
                                        title +
                                        '</span>\
                                <span class="item__desc">' +
                                        description +
                                        '</span>\
                                <span class="item__salario"><strong>Prentensão salarial</strong>R$' +
                                        formatprice +
                                        ',00</span>\
                                <span class="button--contratar" data-id="' +
                                        ID +
                                        '">Contratar</span>\
                            </li>\
                            '
                                );
                        }
                    }
                }
            },
            "json"
        );
    }
    $(document).on("click", ".list__service > li", function() {
        type = $(this).data("layer");
        atrib = "";
        price = "";
        $(".prices__container").removeClass("active");
        console.log(type);

        submitpost(type, atrib, price);
    });

    $(document).on("click", ".abas__require > li", function() {
        atrib = $(this).data("atrib");
        price = "";
        $(".prices__container").addClass("active");
        submitpost(type, atrib, price);
    });

    $(document).on("click", ".list__price > li", function() {
        price = [
            parseInt($(this).data("priceIn")),
            parseInt($(this).data("priceOut"))
        ];
        console.log(price);
        $(".list__price > li").removeClass("active");
        $(this).addClass("active");
        submitpost(type, atrib, price);
    });
});
