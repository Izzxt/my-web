class WebInterface {
  constructor() {
    this.document = $(document);
    this.window = $(window);

    this.window.on("scroll", () => {
      var sticky = $(".navbar");
      scroll = this.window.scrollTop();

      if (scroll > 0) {
        sticky.addClass("bg-white shadow-md");
      } else {
        sticky.removeClass("bg-white shadow-md");
      }
    });

    this.document.ready(() => {
      this.toggleModal("login");
      this.toggleModal("register");
      this.toggleModal("email");
      this.toggleModal("phone");

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

  toggleModal(name) {
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
}

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

$(function () {
  new WebInterface();
});
