module.exports = {
  content: ["./resources/**/*.{html,js,php}"],
  theme: {
    container: {
      padding: {
        DEFAULT: "1.2rem",
        sm: "2rem",
        lg: "4rem",
        xl: "5rem",
      },
    },
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
