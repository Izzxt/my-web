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
  }

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

class LoginManager {
  constructor() {
    $(document).on("click", ".btn-login", (e) => {
      e.preventDefault();

      const email = $("#email").val();
      const password = $("#password").val();

      $.ajax({
        url: "/login",
        method: "POST",
        dataType: "json",
        data: { email: email, password: password },
        success: function (data) {
          if (data.status === 'success') {
            location.replace(data.location);
          } else {
            alert(data.message);
          }
        },
      });
    });
  }
}

class NotificationManager {
  constructor() {
    $(document).ready(() => {
      NotificationManager.loadUnseenNotifications("");
    });

    $(document).on("click", ".i-o", function () {
      $(".incoming-order").html("");
      NotificationManager.loadUnseenNotifications("yes");
    });

    $(document).on("click", ".btn-noti", function () {
      NotificationManager.loadUnseenNotifications("");
    });
  }

  static loadUnseenNotifications(view = "") {
    $.ajax({
      url: "/admin/customer/account/incoming/order",
      method: "POST",
      data: { view: view },
      dataType: "json",
      success: function (data) {
        if (data.order_count > 0) {
          $(".noti").addClass("absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800");
          $(".incoming-order").addClass("inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600");
        } else {
          $(".incoming-order").html(data.order_count);
          $(".incoming-order").addClass("inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600");
        }
      },
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
  new LoginManager();
  new WebInterface();
  new NotificationManager();
  setInterval(() => NotificationManager.loadUnseenNotifications(), 5000);
});
