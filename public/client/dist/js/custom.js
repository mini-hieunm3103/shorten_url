const logoutAction = document.querySelector('.logout-action');
const logoutForm = document.querySelector('.logout-form');
if (logoutAction && logoutForm){
    logoutAction.addEventListener('click', (e)=>{
        e.preventDefault();
        logoutForm.action = e.target.href;
        logoutForm.submit();
    })
}
