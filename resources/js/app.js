import './bootstrap';

/* =========================================================
   CUSTOM JAVASCRIPT DÀNH CHO ADMIN WEB (VANILLA JS CHUẨN)
   Tác giả: Trần Minh Vũ
   ========================================================= */

document.addEventListener('DOMContentLoaded', function () {

    // 1. Tự động ẩn các thông báo Alert sau 4 giây
    const alertElements = document.querySelectorAll('.alert');
    alertElements.forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 4000);
    });

    // 2. Tự động tạo Slug từ Tiêu đề / Tên danh mục khi nhập
    const nameInput = document.querySelector('input[name="catename"], input[name="brandname"], input[name="productname"], input[name="title"]');
    const slugInput = document.querySelector('input[name="slug"]');

    if (nameInput && slugInput) {
        nameInput.addEventListener('keyup', function () {
            let title = nameInput.value;
            // Chuyển chữ hoa thành chữ thường & xóa dấu tiếng Việt
            let slug = title.toLowerCase();
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/g, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/g, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/g, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/g, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/g, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/g, 'y');
            slug = slug.replace(/đ/g, 'd');
            slug = slug.replace(/[^a-z0-9\s-]/g, '').trim().replace(/\s+/g, '-');

            slugInput.value = slug;
        });
    }

    // 3. Xem trước hình ảnh Upload (Image Preview)
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(function (fileInput) {
        fileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            const previewContainer = document.querySelector('.image-preview') || document.querySelector('#preview');
            if (file && previewContainer) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewContainer.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    });

    // 4. Xác nhận trước khi Xóa
    const deleteButtons = document.querySelectorAll('.btn-delete-confirm');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function (e) {
            if (!confirm('Bạn có chắc chắn muốn thực hiện thao tác xóa này không?')) {
                e.preventDefault();
            }
        });
    });
});
