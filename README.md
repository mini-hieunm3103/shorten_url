# Logic Shorten Url: lấy url theo id
- Ví dụ: lưu url vào id 
với id là 125 có url là https://github.com/UnicodeLession/Laravel_project  
khi đó ta có 125 base 10 chuyển thành X base 62
=> X: 21  
=> shorten url: domain/21
=> encode

- decode: lấy ra value đằng sau domain  
base 64 -> base 10 -> lấy ra được id   
từ id lấy ra url hoàn chỉnh
## Front End: Clone https://www.shorturl.at/
## Module
### Admin : Quản Lý bảng: 
- id bigint
- long_url : string 255
- title : string 255 ( lấy ra title của url)
- description : text
- clicks : int (lấy ra tất cả những người đã click vào link đó) (vẫn chưa biết làm kiểu gì)
- timestamps
### Clients: Lấy ra lists các shorten url đã làm ngắn
- ở create: tương tự: https://www.shorturl.at/
- sau khi post lên db và tạo shorten url thì di chuyển đến detail page của shorten url đó
- ví dụ về trang detail: https://www.shorturl.at/shortener.php
