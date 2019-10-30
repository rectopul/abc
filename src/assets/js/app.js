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
  if (((n = String.fromCharCode(o)), -1 == "0123456789".indexOf(n))) return !1;
  for (
    u = a.value.length, h = 0;
    h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r);
    h++
  );
  for (l = ""; h < u; h++)
    -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
  if (
    ((l += n),
    0 == (u = l.length) && (a.value = ""),
    1 == u && (a.value = "0" + r + "0" + l),
    2 == u && (a.value = "0" + r + l),
    u > 2)
  ) {
    for (ajd2 = "", j = 0, h = u - 3; h >= 0; h--)
      3 == j && ((ajd2 += e), (j = 0)), (ajd2 += l.charAt(h)), j++;
    for (a.value = "", tamanho2 = ajd2.length, h = tamanho2 - 1; h >= 0; h--)
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
    idsProfs = [],
    toastbody = "";

  var toastalert = $(
    '<div class="toast toast__warning" role="alert" aria-live="assertive" data-animation="true" aria-atomic="true" data-autohide="true" data-delay="10000">\
        <div class="toast-header">\
            <svg class="bd-placeholder-img rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">\
                <rect fill="#FFA103" width="100%" height="100%"></rect>\
            </svg>\
            <strong class="mr-auto">Alerta</strong>\
            <small class="text-muted">2 seconds ago</small>\
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">\
            <span aria-hidden="true">&times;</span>\
            </button>\
        </div>\
        <div class="toast-body warning__body">' +
      toastbody +
      "</div>\
    </div>"
  );

  $(document).on("click", ".remove__person", function() {
    var identremove = $(this).data("delfun"),
      itemclic = $(this);
    for (var index = 0; index < proflist.length; index++) {
      var func = proflist[index];
      if (func["ID"] == identremove) {
        proflist.splice(index, 1);

        itemclic.parent().remove();

        var namesprofs = [],
          idsProfs = [];
        for (var _i in proflist) {
          if (proflist.hasOwnProperty(_i)) {
            var newlist = proflist[_i];
            namesprofs.push(newlist["name"]);
            idsProfs.push(newlist["ID"]);
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
          txtsend += "Nome: " + namesprofs[i] + ", ID: " + idsProfs[i] + " \n";
        }
        $(".num__personal").html(proflist.length);
        $("input[name=nome_profissional]").val(txtsend);
      }
    }
  });

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
        $(".list__profsadd").append(
          '<div class="list__profsadd-item"><i class="remove__person" data-delfun="' +
            element["ID"] +
            '">x</i>' +
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
      txtsend += "Nome: " + namesprofs[i] + ", ID: " + idsProfs[i] + " \n";
    }
    $("input[name=nome_profissional]").val(txtsend);
  });

  var $ = window.jQuery,
    type,
    atrib,
    price;
  function submitpost(typ, atrb, prc, anch) {
    if (anch) {
      var ancora = $(anch.target),
        offset = anch.offset;
    }
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
        if (data.results[0].erros) {
          if (data.results[0].field == "cep") {
            toastbody = data.results[0].message;
            $(toastalert)
              .find(".warning__body")
              .html(data.results[0].message);
            $(".toast__wrapper").prepend(toastalert);
            $(".toast__warning").toast("show");
            //shown.bs.toast
            $(".toast__warning").on("hidden.bs.toast", function() {
              // do something…
              $(".toast__warning").remove();
            });
            return false;
          } else {
            var { message, terms } = data.results[0];

            toastbody = message;
            $(toastalert)
              .find(".warning__body")
              .html(message);
            $(".toast__wrapper").prepend(toastalert);
            $(".toast__warning").toast("show");
            //shown.bs.toast
            $(".toast__warning").on("hidden.bs.toast", function() {
              // do something…
              $(".toast__warning").remove();
            });

            $(".post__type-" + typ)
              .find(".list__profissionais")
              .html(
                '<div style="color: #000000; font-size: 35px; margin: 20px auto;">' +
                  message +
                  "</div>"
              );
            return false;
          }
        } else {
          var { categorias } = data;
          if (categorias.length > 0 && !atrb) {
            $(".abas__require").html("");
            for (var i in categorias) {
              if (categorias.hasOwnProperty(i)) {
                var element = categorias[i];
                $(".abas__require").append(
                  '<li class="" data-rf="refresh" data-atrib="' +
                    element["slug"] +
                    '">' +
                    element["name"] +
                    "</li>"
                );
              }
            }
          }
          var { results } = data;
          for (var i in results) {
            if (results.hasOwnProperty(i)) {
              var element = results[i];
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
                  ? price.substring(0, 1) + "." + price.substring(1, 100)
                  : price;
              var clsstt = "";
              if (!typ) {
                $(".post__type-baba")
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
              } else {
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

          if (data.results.length > 0) {
            if (anch) {
              $("html,body").animate(
                {
                  scrollTop: ancora.offset().top - offset
                },
                "slow"
              );
            }
          }
          $("#cepuser")
            .parents(".modal__container")
            .addClass("close");

          if ($(".list__service > li:eq(0)").hasClass("active__aba")) {
            $(".domestics").show();
            $(".idadecr").show();
          } else {
            $(".domestics").hide();
            $(".idadecr").hide();
          }
          return true;
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

    submitpost(type, atrib, price, {
      target: ".professionals__wrapper",
      offset: -100
    });
  });

  $(document).on("click", ".abas__require > li", function() {
    atrib = $(this).data("atrib");
    price = "";
    $(".prices__container").addClass("active");
    $(".abas__require > li").removeClass("active__aba");
    $(this).addClass("active__aba");
    submitpost(type, atrib, price, {
      target: ".abas__require",
      offset: -150
    });
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
      var elmts = $(this);
      if (
        submitpost(type, atrib, price, {
          target: ".list__service",
          offset: 60
        }) === true
      ) {
        $(document)
          .find(".active__aba")
          .trigger("click");
        elmts.parents(".modal__container").addClass("close");
      }
    } else {
      toastbody = "Informe o CEP para a busca!";
      $(toastalert)
        .find(".warning__body")
        .html("Informe o CEP para a busca!");
      $(".toast__wrapper").prepend(toastalert);
      $(".toast__warning").toast("show");
      //shown.bs.toast
      $(".toast__warning").on("hidden.bs.toast", function() {
        // do something…
        $(".toast__warning").remove();
      });
    }
    if ($("list__service:eq(0)").hasClass("active__aba")) {
    } else {
      $(".domestics").hide();
    }
    e.preventDefault();
  });

  var idadec;
  if ($("list__service:eq(0)").hasClass("active__aba")) {
  } else {
    $(".domestics").hide();
  }
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
