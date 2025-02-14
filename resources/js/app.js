import './bootstrap';


/* Check if nav needs to be in collapsed state from user info component */
document.addEventListener('user-info-collapse-navigation', (evt) => {
    let status = evt.detail.status;
    status === true ? document.body.classList.add('is-collapsed') : document.body.classList.remove('is-collapsed');
});
