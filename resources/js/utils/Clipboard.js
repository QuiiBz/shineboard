export default (text) => {

    const created = document.createElement('input');
    created.style.hidden = 'true';
    created.value = text;

    created.select();
    document.execCommand('copy');
}
