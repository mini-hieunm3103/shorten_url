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

## Front End: Clone https://www.shorturl.at/
## Module
### Url:
1. Database:
   - id: bigint
   - long_url: url muốn rút gọn : string:255
   - title: lấy title ra từ url ❎
   - clicks: lấy ra số lượng đã truy cập link ✅
   - expired_at: +30 ngày kể từ lần truy cập cuối cùng ✅
2. Admin: Quản lý người dùng cũng như url đã rút gọn ❎
