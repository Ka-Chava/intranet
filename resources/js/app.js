import './bootstrap';


document.addEventListener('collapse-navigation', (evt) => {
    let status = evt.detail.status;
    status === true ? document.body.classList.add('is-collapsed') : document.body.classList.remove('is-collapsed');
});
