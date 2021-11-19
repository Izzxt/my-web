this.web_body = null;
this.web_document = null;
this.web_window = null;
this.modal = null;

this.init = function () {
  this.web_body = $("body");
  this.web_window = $(window);
  this.web_document = $(document);

  this.web_window.on("scroll", function () {
    var sticky = $(".navbar");
    scroll = this.web_window.scrollTop();

    if (scroll > 0) {
      sticky.addClass("bg-white shadow-md");
    } else {
      sticky.removeClass("bg-white shadow-md");
    }
  });

  $(document).ready(() => {
    this.toggleModal("login");
    this.toggleModal("register");

    var id = $("input").filter("#item-id");
    id.each((v, e) => {
      var id = e.value;

      var value = parseInt($(`.input-number-${id}`).val());

      if (value === 1) {
        $(`.number-decrement-${id}`).attr("disabled", true);
      } else {
        $(`.number-decrement-${id}`).removeAttr("disabled", false);
      }
    });
  });
};

function inc(id) {
  var value = parseInt($(`.input-number-${id}`).val());
  $(`.number-decrement-${id}`).removeAttr("disabled", false);
  $(`.input-number-${id}`).val((value += 1));
}

function dec(id) {
  var value = parseInt($(`.input-number-${id}`).val());
  if (value < 2) {
    $(`.number-decrement-${id}`).attr("disabled", true);
  }
  $(`.input-number-${id}`).val((value -= 1));
}

function toggleModal(name) {
  $("." + name + "-open").click(() => {
    $("." + name + "-modal").toggleClass("opacity-0 pointer-events-none transition-all ease-in-out duration-500");
  });

  $("." + name + "-close").click(() => {
    $("." + name + "-modal").toggleClass("opacity-0 pointer-events-none transition-all ease-in-out duration-500");
  });

  $("." + name + "-overlay").click(() => {
    $("." + name + "-modal").toggleClass("opacity-0 pointer-events-none transition-all ease-in-out duration-500");
  });
}

this.init();
