cordova.define('cordova/plugin_list', function(require, exports, module) {
  module.exports = [
    {
      "id": "com-darryncampbell-cordova-plugin-intent.IntentShim",
      "file": "plugins/com-darryncampbell-cordova-plugin-intent/www/IntentShim.js",
      "pluginId": "com-darryncampbell-cordova-plugin-intent",
      "clobbers": [
        "intentShim"
      ]
    },
    {
      "id": "cordova-plugin-upi.UPI",
      "file": "plugins/cordova-plugin-upi/www/upi.js",
      "pluginId": "cordova-plugin-upi",
      "clobbers": [
        "window.UPI"
      ]
    }
  ];
  module.exports.metadata = {
    "cordova-plugin-whitelist": "1.3.4",
    "com-darryncampbell-cordova-plugin-intent": "2.0.0",
    "cordova-plugin-upi": "1.0.4"
  };
});