module.exports = {
  "env": {
    "browser": true,
    "es6": true
  },
  "extends": "eslint:recommended",
  "rules": {
    "linebreak-style": [
      "error",
      "unix"
    ],
    "no-undef": "off",
    "quotes": [
      "error",
      "single"
    ],
    "no-console": [
      "warn",
    ],
    "semi": [
      "error",
      "always"
    ]
  },
  "parserOptions": {
    "sourceType": "module"
  }
}
