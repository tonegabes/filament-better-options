module.exports = {
  plugins: {
    "postcss-import": {},
    "@tailwindcss/postcss": {},
    cssnano: {
      preset: [
        "default",
        {
          calc: false,
        },
      ],
    },
  },
};
