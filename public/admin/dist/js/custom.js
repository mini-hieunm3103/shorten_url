const tableList = document.querySelector('#dataTable')
const deleteForm = document.querySelector('#delete-form');
if (tableList){
    tableList.addEventListener('click', (e)=>{
        if(e.target.classList.contains('delete-action')){
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "Nếu Xóa Bạn Không Thể Khôi Phục",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteForm.action = e.target.href
                    deleteForm.submit();
                }
            });
        }
    });
}
const logoutAction = document.querySelector('.logout-action');
const logoutForm = document.querySelector('.logout-form');
if (logoutAction && logoutForm){
    logoutAction.addEventListener('click', (e)=>{
        e.preventDefault();
        logoutForm.action = e.target.href;

        logoutForm.submit();
    })
}
let linkList = document.querySelectorAll('.limited-url');

for(var i in linkList){
    linkList[i].setAttribute('target', '_blank');
}
