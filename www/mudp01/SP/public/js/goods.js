const productTypes = $("input[name='productType']");
const previousOrder = $('#previousOrder');
const nextOrder = $('#nextOrder');
const urlParams = new URLSearchParams(window.location.search);
let urlParamseters = urlParams.toString();

function getParameter(productType) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(productType);
}

$.each(productTypes, (i, productType) => {
    const type = productType.value;
    $(`#previous${type}`).on('click', () => {
        var url_params = new URLSearchParams(window.location.search);
        if (url_params.get(type) == null) {
            if (urlParamseters == '') {
                urlParamseters += `${type}=1`
            } else {
                urlParamseters += `&${type}=1`
            }
            window.location.replace(`./goods/?${urlParamseters}`);
        } else {
            currentPage = getParameter(type);
            if (parseInt(currentPage) > 1) {
                urlParamseters = urlParamseters.replace(`${type}=${currentPage}`, `${type}=${parseInt(currentPage) - 1}`);
                window.location.replace(`./goods/?${urlParamseters}`);
            } else {
                urlParamseters = urlParamseters.replace(`${type}=${currentPage}`, `${type}=1`);
                window.location.replace(`./goods/?${urlParamseters}`);
            }
        }
    });
    $(`#next${type}`).on('click', () => {
        var url_params = new URLSearchParams(window.location.search);
        if (url_params.get(type) == null) {
            if (urlParamseters == '') {
                urlParamseters += `${type}=2`
            } else {
                urlParamseters += `&${type}=2`
            }
            window.location.replace(`./goods/?${urlParamseters}`);
        } else {
            currentPage = getParameter(type);
            urlParamseters = urlParamseters.replace(`${type}=${currentPage}`, `${type}=${parseInt(currentPage) + 1}`);
            window.location.replace(`./goods/?${urlParamseters}`);

        }
    });
});