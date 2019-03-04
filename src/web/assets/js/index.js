// No ES6 since we are not compiling JS or CSS with webpack
(function () {
    initSelect2();
})();

/**
 * Initialize all select2 instances on the page
 */
function initSelect2() {
    var select2Elements = document.querySelectorAll('.select2');
    select2Elements.forEach(function (element) {
        $(element).select2();
    })
}