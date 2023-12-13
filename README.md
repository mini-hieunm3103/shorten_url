# Logic Shorten Url: lấy URL theo id
- Ví dụ: lưu url vào id 
với id là 125 có url là https://github.com/UnicodeLession/Laravel_project  
khi đó ta có 125 base 10 chuyển thành X base 62
=> X: 21  
=> shorten url: domain/21
=> encode

- decode: lấy ra value đằng sau domain  
base 64 -> base 10 -> lấy ra được id   
từ id lấy ra url hoàn chỉnh

## Deploy web
#### -> thì phải vào `getIdCounter` của UrlController để sửa regex match lấy ra base62

## Module
1. Database:
   - urls (tham khảo [bitly](https://app.bitly.com))
     - id bigint
     - title string (optional input) (nếu không có thì sẽ thành: Untitled 2023-12-11 15:54:14 UTC)
     - long_url
     - back_half string unique (optional input): là cái đằng sau domain
     - clicks
     - timestamps
     - expired_at
2. Admin: Quản lý url đã rút gọn của người dùng trong trang sửa người dùng trong admin và được phép xóa? người dùng nhưng không được phép sửa thông tin cá nhân của họ: name, email, password ❎
   - Phân quyền:
     * được phép xóa người dùng
     * được phép xem, xóa url đã rút gọn của người dùng (nếu xóa phải có lý do <sweet alert>)</sweet alert
     * được phép sửa group_id của người dùng từ user -> admin nhưng không được thành superadmin
   - tạo ra 1 danh sách người dùng:
     * tổng url đã rút gọn
     * tổng lượng clicks
     * thời gian tạo
     * Nút xem -> redirect đến trang client của user đó 
   - create, udpate, delete
   - show(detail)
     * lấy ra thông tin cơ bản của người dùng
     * bảng: url, clicks, created_at, expired_at
     * có thể xóa đi url và tạo lý do xóa (sweet alert)
3. Clients: tham khảo [Bit.ly](https://app.bitly.com/Bnca3KjfUCo/links)
   - tạo  ra 1 trang render riêng cho người dùng
   - tạo 1 thẻ riêng cho url [Adminlte 3](https://adminlte.io/themes/v3/pages/layout/top-nav.html)
4. Super Admin: Quản lý tất cả về người dùng và url
5. Url Module: 
   - index
     - STT
     - Title (nếu không có title thì sẽ Điền: Untitled 2023-12-11 15:54:14 UTC) (tham khảo bitly)
     - User -> khi click vào sẽ redirect đến trang show của User:
     - Long URL
     - Shorten URL 
     - Created at
     - Expired at
   - edit:
     - Title
     - Long Url
     - Short Url (cho phép sửa nhưng vẫn sẽ là dạng: domain.com/a-zA-Z0-9)
6. Trang show của User(Admin) của Url Module:
    - Name (Input readonly)
    - Email (Input readonly)
    - Group (Input readonly)
    - Created at (Input readonly)
    - Muốn sửa thông tin trên thì tạo 1 btn redirect đến edit user
    - 1 bảng gồm các Url đã tạo < xem, sửa, xóa >
