/*
Abstract:
A helper function that requests an Apple Pay merchant session using a promise.
*/

function getApplePaySession(url) {
    return new Promise(function (resolve, reject) {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'https://wwland.azurewebsites.net/applepay_includes/apple_pay_conf.php?u='.url);
      xhr.onload = function () {
        if (this.status >= 200 && this.status < 300) {
          resolve(JSON.parse(xhr.response));
        } else {
          reject({
            status: this.status,
            statusText: xhr.statusText
          });
        }
      };
      xhr.onerror = function () {
        reject({
          status: this.status,
          statusText: xhr.statusText
        });
      };
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.send(JSON.stringify({url: url}));
    });
  }