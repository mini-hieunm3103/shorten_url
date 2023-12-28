
const linkList = document.querySelectorAll('.link-detail')
const deleteForm = document.querySelector('#delete-form');
linkList.forEach((e) => {
    var deleteBtn = e.querySelector('.delete-action')
    var copyBtn = e.querySelector('.btnCopy')
    var copyUrl = e.querySelector('.short-link')
    deleteBtn.addEventListener('click', (deleteEvent) => {
        deleteEvent.preventDefault()
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
                deleteForm.action = deleteEvent.target.href
                deleteForm.submit();
            }
        });
    })

    copyBtn.addEventListener('click', (copyEvent) => {
        var copyTextList = document.querySelectorAll('.copy-text')
        copyTextList.forEach((e) =>{
            e.innerText  = 'Copy'
        })
        var input = document.createElement("input");
        input.type = "text";
        input.value = copyUrl.href;
        document.body.appendChild(input);
        // Chọn nội dung của input
        input.select();
        input.setSelectionRange(0, 99999); // Đối với các trình duyệt di động

        // Sao chép nội dung vào clipboard
        document.execCommand("copy");

        // Xóa phần tử input
        document.body.removeChild(input);
        copyBtn.querySelector(".copy-text").innerText = 'Copied'
    })
})

$(document).ready(function() {
    // Attach a change event to the checkbox
    $('#linkCheckbox').change(function() {
        // Check if the checkbox is checked
        if ($(this).is(':checked')) {
            // If checked, add the 'checked' class to the container
            $('.checkbox-container').addClass('check-solid');
        } else {
            // If unchecked, remove the 'checked' class from the container
            $('.checkbox-container').removeClass('check-solid');
        }
    });
});
