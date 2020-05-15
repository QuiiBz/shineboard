function copy(text) {

    if(navigator.clipboard)
        navigator.clipboard.writeText(text);
    else if (window.clipboardData)  // IE
        window.clipboardData.setData('text', text);
}

export default copy;
