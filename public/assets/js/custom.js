(function () {
  "use strict";

  /* page loader */
  function hideLoader() {
    const loader = document.getElementById("loader");
    if (loader) {
      loader.classList.add("d-none");
    }
  }

  window.addEventListener("load", hideLoader);
  /* page loader */

  /* tooltip */
  const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
  );
  if (tooltipTriggerList.length > 0 && typeof bootstrap !== 'undefined') {
    const tooltipList = [...tooltipTriggerList].map(
      (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
    );
  }

  /* popover  */
  const popoverTriggerList = document.querySelectorAll(
    '[data-bs-toggle="popover"]'
  );
  if (popoverTriggerList.length > 0 && typeof bootstrap !== 'undefined') {
    const popoverList = [...popoverTriggerList].map(
      (popoverTriggerEl) => new bootstrap.Popover(popoverTriggerEl)
    );
  }

  /* breadcrumb date range picker */
  if (typeof flatpickr !== 'undefined' && document.querySelector("#daterange")) {
    flatpickr("#daterange", {
      mode: "range",
      dateFormat: "Y-m-d",
      defaultDate: ["2024-05-01", "2024-05-30"]
    });
  }
  /* breadcrumb date range picker */

  //switcher color pickers
  const pickrContainerPrimary = document.querySelector(
    ".pickr-container-primary"
  );
  const themeContainerPrimary = document.querySelector(
    ".theme-container-primary"
  );
  const pickrContainerBackground = document.querySelector(
    ".pickr-container-background"
  );
  const themeContainerBackground = document.querySelector(
    ".theme-container-background"
  );

  /* for theme primary - only if elements exist */
  if (pickrContainerPrimary && themeContainerPrimary && typeof Pickr !== 'undefined') {
    const nanoThemes = [
      [
        "nano",
        {
          defaultRepresentation: "RGB",
          components: {
            preview: true,
            opacity: false,
            hue: true,

            interaction: {
              hex: false,
              rgba: true,
              hsva: false,
              input: true,
              clear: false,
              save: false,
            },
          },
        },
      ],
    ];
    const nanoButtons = [];
    let nanoPickr = null;
    for (const [theme, config] of nanoThemes) {
      const button = document.createElement("button");
      button.innerHTML = theme;
      nanoButtons.push(button);

      button.addEventListener("click", () => {
        const el = document.createElement("p");
        pickrContainerPrimary.appendChild(el);

        /* Delete previous instance */
        if (nanoPickr) {
          nanoPickr.destroyAndRemove();
        }

        /* Apply active class */
        for (const btn of nanoButtons) {
          btn.classList[btn === button ? "add" : "remove"]("active");
        }

        /* Create fresh instance */
        nanoPickr = new Pickr(
          Object.assign(
            {
              el,
              theme,
              default: "#5c67f7",
            },
            config
          )
        );

        /* Set events */
        nanoPickr.on("changestop", (source, instance) => {
          let color = instance.getColor().toRGBA();
          let html = document.querySelector("html");
          html.style.setProperty(
            "--primary-rgb",
            `${Math.floor(color[0])}, ${Math.floor(color[1])}, ${Math.floor(
              color[2]
            )}`
          );
          /* theme color picker */
          localStorage.setItem(
            "primaryRGB",
            `${Math.floor(color[0])}, ${Math.floor(color[1])}, ${Math.floor(
              color[2]
            )}`
          );
        });
      });

      themeContainerPrimary.appendChild(button);
    }
    nanoButtons[0].click();
  }
  /* for theme primary */

  /* for theme background - only if elements exist */
  if (pickrContainerBackground && themeContainerBackground && typeof Pickr !== 'undefined') {
    const nanoThemes1 = [
      [
        "nano",
        {
          defaultRepresentation: "RGB",
          components: {
            preview: true,
            opacity: false,
            hue: true,

            interaction: {
              hex: false,
              rgba: true,
              hsva: false,
              input: true,
              clear: false,
              save: false,
            },
          },
        },
      ],
    ];
    const nanoButtons1 = [];
    let nanoPickr1 = null;
    for (const [theme, config] of nanoThemes1) {
      const button = document.createElement("button");
      button.innerHTML = theme;
      nanoButtons1.push(button);

      button.addEventListener("click", () => {
        const el = document.createElement("p");
        pickrContainerBackground.appendChild(el);

        /* Delete previous instance */
        if (nanoPickr1) {
          nanoPickr1.destroyAndRemove();
        }

        /* Apply active class */
        for (const btn of nanoButtons1) {
          btn.classList[btn === button ? "add" : "remove"]("active");
        }

        /* Create fresh instance */
        nanoPickr1 = new Pickr(
          Object.assign(
            {
              el,
              theme,
              default: "#5c67f7",
            },
            config
          )
        );

        /* Set events */
        nanoPickr1.on("changestop", (source, instance) => {
          let color = instance.getColor().toRGBA();
          let html = document.querySelector("html");
          html.style.setProperty(
            "--body-bg-rgb",
            `${color[0]}, ${color[1]}, ${color[2]}`
          );
          document
            .querySelector("html")
            .style.setProperty(
              "--body-bg-rgb2",
              `${color[0] + 14}, ${color[1] + 14}, ${color[2] + 14}`
            );
          document
            .querySelector("html")
            .style.setProperty(
              "--light-rgb",
              `${color[0] + 14}, ${color[1] + 14}, ${color[2] + 14}`
            );
          document
            .querySelector("html")
            .style.setProperty(
              "--form-control-bg",
              `rgb(${color[0] + 14}, ${color[1] + 14}, ${color[2] + 14})`
            );
          document
            .querySelector("html")
            .style.setProperty(
              "--gray-3",
              `rgb(${color[0] + 14}, ${color[1] + 14}, ${color[2] + 14})`
            );
          localStorage.removeItem("bgtheme");
          html.setAttribute("data-theme-mode", "dark");
          html.setAttribute("data-menu-styles", "dark");
          html.setAttribute("data-header-styles", "dark");
          const switcherDarkTheme = document.querySelector("#switcher-dark-theme");
          if (switcherDarkTheme) switcherDarkTheme.checked = true;
          localStorage.setItem(
            "bodyBgRGB",
            `${color[0]}, ${color[1]}, ${color[2]}`
          );
          localStorage.setItem(
            "bodylightRGB",
            `${color[0] + 14}, ${color[1] + 14}, ${color[2] + 14}`
          );
        });
      });
      themeContainerBackground.appendChild(button);
    }
    nanoButtons1[0].click();
  }
  /* for theme background */

  /* header theme toggle */
  function toggleTheme() {
    let html = document.querySelector("html");
    if (html.getAttribute("data-theme-mode") === "dark") {
      // Switch to light mode
      html.setAttribute("data-theme-mode", "light");
      html.setAttribute("data-header-styles", "light");
      html.setAttribute("data-menu-styles", "dark");
      if (!localStorage.getItem("primaryRGB")) {
        html.setAttribute("style", "");
      }
      html.removeAttribute("data-bg-theme");
      html.style.removeProperty("--body-bg-rgb");
      html.style.removeProperty("--body-bg-rgb2");
      html.style.removeProperty("--light-rgb");
      html.style.removeProperty("--form-control-bg");
      html.style.removeProperty("--input-border");
      
      // Update localStorage
      localStorage.removeItem("xintradarktheme");
      localStorage.removeItem("xintraMenu");
      localStorage.removeItem("xintraHeader");
      localStorage.removeItem("bodylightRGB");
      localStorage.removeItem("bodyBgRGB");
      localStorage.setItem("xintratheme", "light");
      
      // Update switcher checkboxes if they exist
      const switcherLight = document.querySelector("#switcher-light-theme");
      const switcherMenuDark = document.querySelector("#switcher-menu-dark");
      const switcherMenuLight = document.querySelector("#switcher-menu-light");
      const switcherHeaderLight = document.querySelector("#switcher-header-light");
      const switcherBg = document.querySelector("#switcher-background");
      const switcherBg1 = document.querySelector("#switcher-background1");
      const switcherBg2 = document.querySelector("#switcher-background2");
      const switcherBg3 = document.querySelector("#switcher-background3");
      const switcherBg4 = document.querySelector("#switcher-background4");
      
      if (switcherLight) switcherLight.checked = true;
      if (switcherMenuDark) switcherMenuDark.checked = true;
      if (switcherMenuLight) switcherMenuLight.checked = true;
      if (switcherHeaderLight) switcherHeaderLight.checked = true;
      if (switcherBg) switcherBg.checked = false;
      if (switcherBg1) switcherBg1.checked = false;
      if (switcherBg2) switcherBg2.checked = false;
      if (switcherBg3) switcherBg3.checked = false;
      if (switcherBg4) switcherBg4.checked = false;
      
      if (typeof checkOptions === 'function') checkOptions();
    } else {
      // Switch to dark mode
      html.setAttribute("data-theme-mode", "dark");
      html.setAttribute("data-header-styles", "dark");
      html.setAttribute("data-menu-styles", "dark");
      if (!localStorage.getItem("primaryRGB")) {
        html.setAttribute("style", "");
      }
      
      // Update localStorage
      localStorage.setItem("xintradarktheme", "true");
      localStorage.setItem("xintraMenu", "dark");
      localStorage.setItem("xintraHeader", "dark");
      localStorage.removeItem("bodylightRGB");
      localStorage.removeItem("bodyBgRGB");
      localStorage.removeItem("xintratheme");
      
      // Update switcher checkboxes if they exist
      const switcherDark = document.querySelector("#switcher-dark-theme");
      const switcherMenuDark = document.querySelector("#switcher-menu-dark");
      const switcherHeaderDark = document.querySelector("#switcher-header-dark");
      const switcherBg = document.querySelector("#switcher-background");
      const switcherBg1 = document.querySelector("#switcher-background1");
      const switcherBg2 = document.querySelector("#switcher-background2");
      const switcherBg3 = document.querySelector("#switcher-background3");
      const switcherBg4 = document.querySelector("#switcher-background4");
      
      if (switcherDark) switcherDark.checked = true;
      if (switcherMenuDark) switcherMenuDark.checked = true;
      if (switcherHeaderDark) switcherHeaderDark.checked = true;
      if (switcherBg) switcherBg.checked = false;
      if (switcherBg1) switcherBg1.checked = false;
      if (switcherBg2) switcherBg2.checked = false;
      if (switcherBg3) switcherBg3.checked = false;
      if (switcherBg4) switcherBg4.checked = false;
      
      if (typeof checkOptions === 'function') checkOptions();
    }
  }
  
  let layoutSetting = document.querySelector(".layout-setting");
  if (layoutSetting) {
    layoutSetting.addEventListener("click", toggleTheme);
  }
  /* header theme toggle */

  /* Choices JS */
  document.addEventListener("DOMContentLoaded", function () {
    if (typeof Choices !== 'undefined') {
      var genericExamples = document.querySelectorAll("[data-trigger]");
      for (let i = 0; i < genericExamples.length; ++i) {
        var element = genericExamples[i];
        new Choices(element, {
          allowHTML: true,
          placeholderValue: "This is a placeholder set in the config",
          searchPlaceholderValue: "Search",
        });
      }
    }
  });
  /* Choices JS */

  /* footer year */
  const yearElement = document.getElementById("year");
  if (yearElement) {
    yearElement.innerHTML = new Date().getFullYear();
  }
  /* footer year */

  /* node waves */
  if (typeof Waves !== 'undefined') {
    Waves.attach(".btn-wave", ["waves-light"]);
    Waves.init();
  }
  /* node waves */

  /* card with close button */
  let DIV_CARD = ".card";
  let cardRemoveBtn = document.querySelectorAll(
    '[data-bs-toggle="card-remove"]'
  );
  cardRemoveBtn.forEach((ele) => {
    ele.addEventListener("click", function (e) {
      e.preventDefault();
      let $this = this;
      let card = $this.closest(DIV_CARD);
      if (card) card.remove();
      return false;
    });
  });
  /* card with close button */

  /* card with fullscreen */
  let cardFullscreenBtn = document.querySelectorAll(
    '[data-bs-toggle="card-fullscreen"]'
  );
  cardFullscreenBtn.forEach((ele) => {
    ele.addEventListener("click", function (e) {
      let $this = this;
      let card = $this.closest(DIV_CARD);
      if (card) {
        card.classList.toggle("card-fullscreen");
        card.classList.remove("card-collapsed");
      }
      e.preventDefault();
      return false;
    });
  });
  /* card with fullscreen */

  /* count-up */
  var i = 1;
  setInterval(() => {
    document.querySelectorAll(".count-up").forEach((ele) => {
      if (ele.getAttribute("data-count") >= i) {
        i = i + 1;
        ele.innerText = i;
      }
    });
  }, 10);
  /* count-up */

  /* back to top */
  const scrollToTop = document.querySelector(".scrollToTop");
  if (scrollToTop) {
    const $rootElement = document.documentElement;
    const $body = document.body;
    window.onscroll = () => {
      const scrollTop = window.scrollY || window.pageYOffset;
      const clientHt = $rootElement.scrollHeight - $rootElement.clientHeight;
      if (window.scrollY > 100) {
        scrollToTop.style.display = "flex";
      } else {
        scrollToTop.style.display = "none";
      }
    };
    scrollToTop.onclick = () => {
      window.scrollTo(0, 0);
    };
  }
  /* back to top */

  /* header dropdowns scroll */
  if (typeof SimpleBar !== 'undefined') {
    var myHeadernotification = document.getElementById("header-notification-scroll");
    if (myHeadernotification) {
      new SimpleBar(myHeadernotification, { autoHide: true });
    }

    var myHeaderCart = document.getElementById("header-cart-items-scroll");
    if (myHeaderCart) {
      new SimpleBar(myHeaderCart, { autoHide: true });
    }
  }
  /* header dropdowns scroll */

  /* autocomplete */
  if (typeof autoComplete !== 'undefined' && document.querySelector("#header-search")) {
    const autoCompleteJS = new autoComplete({
      selector: "#header-search",
      data: {
        src: [
          "What is the meaning of life?",
          "How does gravity work?",
          "Why is the sky blue?",
          "What is the capital of France?",
          "Who painted the Mona Lisa?",
          "What is the speed of light?",
          "Why do we dream?",
          "How do birds fly?",
          "What is the largest mammal?",
          "Why do leaves change color in the fall?"
        ],
        cache: true,
      },
      resultItem: {
        highlight: true
      },
      events: {
        input: {
          selection: (event) => {
            const selection = event.detail.selection.value;
            autoCompleteJS.input.value = selection;
          }
        }
      }
    });
  }
  /* autocomplete */
})();

/* full screen */
var elem = document.documentElement;
function openFullscreen() {
  if (!document.fullscreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
    requestFullscreen();
  } else {
    exitFullscreen();
  }
}
function requestFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen) {
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) {
    elem.msRequestFullscreen();
  }
}
function exitFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) {
    document.msExitFullscreen();
  }
}
// Listen for fullscreen change event
document.addEventListener("fullscreenchange", handleFullscreenChange);
document.addEventListener("webkitfullscreenchange", handleFullscreenChange);
document.addEventListener("msfullscreenchange", handleFullscreenChange);

function handleFullscreenChange() {
  let open = document.querySelector(".full-screen-open");
  let close = document.querySelector(".full-screen-close");

  if (!open || !close) return;

  if (document.fullscreenElement || document.webkitFullscreenElement || document.msFullscreenElement) {
    // Update icon for fullscreen mode
    close.classList.add("d-block");
    close.classList.remove("d-none");
    open.classList.add("d-none");
  } else {
    // Update icon for non-fullscreen mode
    close.classList.remove("d-block");
    open.classList.remove("d-none");
    close.classList.add("d-none");
    open.classList.add("d-block");
  }
}
/* full screen */

/* toggle switches */
let customSwitch = document.querySelectorAll(".toggle");
customSwitch.forEach((e) =>
  e.addEventListener("click", () => {
    e.classList.toggle("on");
  })
);
/* toggle switches */

/* header dropdown close button */

/* for cart dropdown */
const headerbtn = document.querySelectorAll(".dropdown-item-close");
headerbtn.forEach((button) => {
  button.addEventListener("click", (e) => {
    e.preventDefault();
    e.stopPropagation();
    button.parentNode.parentNode.parentNode.parentNode.parentNode.remove();
    const cartData = document.getElementById("cart-data");
    const cartIconBadge = document.getElementById("cart-icon-badge");
    if (cartData) {
      cartData.innerText = `${document.querySelectorAll(".dropdown-item-close").length} `;
    }
    if (cartIconBadge) {
      cartIconBadge.innerText = `${document.querySelectorAll(".dropdown-item-close").length}`;
    }
    if (document.querySelectorAll(".dropdown-item-close").length == 0) {
      let elementHide = document.querySelector(".empty-header-item");
      let elementShow = document.querySelector(".empty-item");
      if (elementHide) elementHide.classList.add("d-none");
      if (elementShow) elementShow.classList.remove("d-none");
    }
  });
});
/* for cart dropdown */

/* for notifications dropdown */
const headerbtn1 = document.querySelectorAll(".dropdown-item-close1");
headerbtn1.forEach((button) => {
  button.addEventListener("click", (e) => {
    e.preventDefault();
    e.stopPropagation();
    button.parentNode.parentNode.parentNode.parentNode.remove();
    const notificationData = document.getElementById("notifiation-data");
    if (notificationData) {
      notificationData.innerText = `${document.querySelectorAll(".dropdown-item-close1").length} Unread`;
    }
    if (document.querySelectorAll(".dropdown-item-close1").length == 0) {
      let elementHide1 = document.querySelector(".empty-header-item1");
      let elementShow1 = document.querySelector(".empty-item1");
      if (elementHide1) elementHide1.classList.add("d-none");
      if (elementShow1) elementShow1.classList.remove("d-none");
    }
  });
});
/* for notifications dropdown */
