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
    /**
     * Botao Contratar
     */
    var proflist = [],
        namesprofs = [],
        idsProfs = [];
    $(document).on("click", ".button--contratar", function() {
        var profinfo = {
            name: $(this)
                .parent()
                .find(".item__title")
                .text(),
            ID: $(this).data("id")
        };

        proflist.push(profinfo);
        proflist = proflist
            .map(JSON.stringify)
            .reverse()
            .filter(function(item, index, arr) {
                return arr.indexOf(item, index + 1) === -1;
            })
            .reverse()
            .map(JSON.parse);
        $(".list__profsadd").html("");
        $(".num__personal").html(proflist.length);
        for (var i in proflist) {
            if (proflist.hasOwnProperty(i)) {
                var element = proflist[i];
                console.log(proflist.indexOf(profinfo, i));
                $(".list__profsadd").append(
                    '<div class="list__profsadd-item"><i>x</i>' +
                        element["name"] +
                        "</div>"
                );

                namesprofs.push(element["name"]);
                idsProfs.push(element["ID"]);
                namesprofs = namesprofs
                    .map(JSON.stringify)
                    .reverse()
                    .filter(function(item, index, arr) {
                        return arr.indexOf(item, index + 1) === -1;
                    })
                    .reverse()
                    .map(JSON.parse);
                idsProfs = idsProfs
                    .map(JSON.stringify)
                    .reverse()
                    .filter(function(item, index, arr) {
                        return arr.indexOf(item, index + 1) === -1;
                    })
                    .reverse()
                    .map(JSON.parse);
            }
        }
        var txtsend = "Profissionais: ";
        for (var i in idsProfs) {
            txtsend +=
                "Nome: " + namesprofs[i] + ", ID: " + idsProfs[i] + " \n";
        }
        $("input[name=nome_profissional]").val(txtsend);
    });

    var $ = window.jQuery,
        type,
        atrib,
        price;
    function submitpost(typ, atrb, prc, anch) {
        anch = $(anch);
        data = {
            nonce: js_global.filter_nonce,
            action: "filter"
        };
        if (cepuser) data["cepuser"] = cepuser;
        if (typ) data["type"] = typ;
        if (atrb) data["professional_ttr"] = atrb;
        if (prc) data["price"] = prc;

        $.post(
            js_global.xhr_url,
            data,
            function(data, textStatus, jqXHR) {
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
                    $(".abas__require").html("");
                    for (var i in data) {
                        if (data.hasOwnProperty(i)) {
                            var element = data[i];
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
                            var clsstt = "";
                            if (atributo.length > 0) {
                                for (var a in atributo) {
                                    if (i === 0 && a == 0) {
                                        clsstt = "active__aba";
                                    }
                                    if (atributo.hasOwnProperty(a)) {
                                        var elattrib = atributo[a];
                                        $(".abas__require").append(
                                            '<li class="' +
                                                clsstt +
                                                '" data-rf="refresh" data-atrib="' +
                                                elattrib +
                                                '">' +
                                                elattrib +
                                                "</li>"
                                        );
                                    }
                                }
                            }

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
                    if (data.length > 0) {
                        $("html,body").animate(
                            {
                                scrollTop: anch.offset().top + 100
                            },
                            "slow"
                        );
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
        $(".prices__container").removeClass("active"); //

        submitpost(type, atrib, price, ".professionals__wrapper");
    });

    $(document).on("click", ".abas__require > li", function() {
        atrib = $(this).data("atrib");
        price = "";
        $(".prices__container").addClass("active");
        $(".abas__require > li").removeClass("active__aba");
        $(this).addClass("active__aba");
        submitpost(type, atrib, price);
    });

    $(document).on("click", ".list__price > li", function() {
        price = [
            parseInt($(this).data("priceIn")),
            parseInt($(this).data("priceOut"))
        ];
        $(".list__price > li").removeClass("active");
        $(this).addClass("active");
        submitpost(type, atrib, price);
    });
    /**
     * Modal close
     */
    var cepuser;
    $(document).on("click", ".modal__close", function() {
        $(this)
            .parents(".modal__container")
            .addClass("close");
    });

    $(".modal__container").on("animationend", function() {
        $(this)
            .parent()
            .css("display", "none");
    });

    $(document).on("click", ".modal__footer > button", function(e) {
        if ($("#cepuser").val()) {
            cepuser = $("#cepuser").val();
            $(this)
                .parents(".modal__container")
                .addClass("close");

            submitpost(type, atrib, price);
        } else {
            alert("Informe o CEP para a busca!");
        }
        e.preventDefault();
    });

    var idadec;

    $(document).on("click", ".idade__item", function() {
        $(this)
            .parent()
            .find(".idade__item")
            .removeClass("selected");
        $(this).addClass("selected");
        idadec = "Idade das criancas: " + $(this).data("idade");
        $("input[name=idade_crianca]").val(idadec);
    });
});
