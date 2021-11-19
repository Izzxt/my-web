const plugin = require("tailwindcss/plugin");

module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      fontFamily: {
        sans: ["Arvo", "serif"],
        poppins: ["Poppins", "sans-serif"],
      },
      colors: {
        darkblue: "#05386B",
        peach: "#EDF5E1",
        cg: {
          4: "#5f462b",
          3: "#379683",
          2: "#5CDB95",
          1: "#8EE4AF",
        },
        lime: "#00DE61",
        "black-100": "#171613",
      },
      backgroundImage: {
        "gradient-radial": "radial-gradient(var(--tw-gradient-stops))",
        "buah-1": "url(./images/buah-kelapa.jpg)",
        "buah-2": "url(./images/buah-kelapa-2.jpeg)",
      },
      height: {
        100: "48rem",
      },
    },
  },
  variants: {
    extend: {
      opacity: ["disabled"],
      textColor: ["disabled"],
      borderColor: ["label-checked"],
    },
  },
  plugins: [
    plugin(({ addVariant, e }) => {
      addVariant("label-checked", ({ modifySelectors, separator }) => {
        modifySelectors(({ className }) => {
          const eClassName = e(`label-checked${separator}${className}`); // escape class
          const yourSelector = 'input[type="radio"]'; // your input selector. Could be any
          return `${yourSelector}:checked ~ .${eClassName}`; // ~ - CSS selector for siblings
        });
      });
    }),
  ],
};
