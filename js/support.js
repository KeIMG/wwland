/*
Abstract:
A helper function that requests an Apple Pay merchant session using a promise.
*/

function getApplePaySession(url) 
{
  return new Promise(function (resolve, reject) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'https://wwland.azurewebsites.net/applepay_includes/apple_pay_common.php');
    xhr.overrideMimeType = 'json';
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
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("url=" + url);
  });
}
/*
Abstract:
A helper function that post apple token to realex.
*/
function postPaymentToken(paymentToken) 
{
  return new Promise(function (resolve, reject) {
    var xhr = new XMLHttpRequest();
    xhr.overrideMimeType = 'json';
    xhr.open('POST', 'https://wwland.azurewebsites.net/applepay_includes/realex_handler.php');
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
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("paymentToken=" + paymentToken);
  });
}