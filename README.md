# Laravel - Shorten URL Project:
## Note: Tôi lười và bạn cũng thế:
- Tuy có file cho migration và seeder hẳn hoi, nhưng do dùng laravel module nên nếu muốn seed thì phải làm từng module   
- Vì vậy hãy tìm file sql trong project rồi import thẳng cho nhanh ❤️ 
- Nếu vẫn cố chấp thì:
1. Tạo bảng
```text
laravel_shorten_url
```
2. Migrate
```terminal
php artisan migrate
```
3. Seeding
```terminal
php artisan module:seed Group 
```
## Admin Page:
- Manage: Users, Groups, Tags, Urls (Create, Read lists, Edit, Delete, Read Detail)
- Relationship Database:
  - one to many : group - users (one group has many users), user - tags, user - urls, module - permissions
  - many to many : urls - tags 
  - one to one : group - role, group - user (one group has one user_create)
- Group permissions:
  - Read 
  - Create
  - Edit
  - Delete
  - Permission
## Client Page:
- Manage: Tags, Urls, User Information
- User Permissions:
  - CRUD: tags and urls created by this user
  - Edit user information
- Shorten URL
## Package used in this project
- [Laravel Module](https://laravelmodules.com/docs/v10/introduction)
- [Laravel UI](https://github.com/laravel/ui)
- [Laravel DebugBar](https://github.com/barryvdh/laravel-debugbar) 
- [Laravel Permission](https://spatie.be/docs/laravel-permission/v6/installation-laravel)
- [Laravel DataTables](https://yajrabox.com/docs/laravel-datatables/10.0)
## UI
- [AdminLTE 3](https://adminlte.io/themes/v3/)
- [Bitly](https://app.bitly.com/)
## Roles and Permission
### Roles: (theo group)
* roles.name: slug(group->name, '_').'_'.group->id
* ví dụ: 
  * group->name: Lập trình C++ cơ bản, nâng cao
  * role.name: lap_trinh_c_co_ban_nang_cao_1
  * có thể thấy khi không thêm group id thì sẽ có thể bị trùng tên role với C và C++
  * chưa làm được do phải lấy id của group insert nhưng phải tạo role trước mới tạo được group
### Permission (theo module có data quản lý)
* Ví dụ: module user
  * view users
  * show user (show detail)
  * create, edit, delete user
* Ví dụ: module group
  * view groups
  * show group
  * create, edit, delete group
  * permission group (phân quyền cho group khác)
1) **Super Administrator**
- Roles:
  - super_admin
- Permission:
  - Full -> group, user, url, tag
2) **Administrator**
- Roles
  - admin
- Permission
  - Full -> user, url and tag
3) **User**
- Roles
  - User
- Permission
  - Show detail, Edit, Delete user's account
  - Create url | tag
  - Edit url | tag
  - Show detail url | tag
  - View all user's url | tag
  - Delete url | tag



I)
- Cũng là gán quyền cho super admin nhưng là của package **[Click here](https://spatie.be/docs/laravel-permission/v6/basic-usage/super-admin#content-gatebefore)**
- Tối ưu: do roles.name (cột name bảng roles) trùng với groups.name thì có thể thay roles.name thành roles.group_id và liên kết 1-1 với groups.id
- Đăng kí: Đăng kí phía người dùng thì phải thêm group_id là của nhóm User
- Đăng nhập: Khi đăng nhập check role, nếu role là user (tức là nhóm User) thì sẽ redirect đến trang client; các role còn lại sẽ redirect đến trang admin

- ở trong project này thay vì sử dụng [Teams Permissions](https://spatie.be/docs/laravel-permission/v6/basic-usage/teams-permissions) do đọc không hiểu gì
- vậy nên sẽ sử dụng cách thiểu năng hơn:
  - trong roles.name (cột name bảng roles) sẽ được đặt tương tự với groups.name do phân quyền theo nhóm
  - Sẽ phải set up lại all user đã tồn tại (xóa nó đi trừ user của super admin 💔 vì lười)
  - Khi tạo user thì sẽ thông qua group_id 
    - (=> groups.name => 7749 bước: str_replace(strtolower(trim())) => roles.name => roles.id) : nếu chưa tối ưu
    - (=> roles.id) : nếu đã tối ưu: liên kết roles.group_id với groups.id 
  - => phân quyền user vào bảng model_has_roles
- Fix:
  - Khi tạo user thì từ group sẽ set up luôn quyền cho user đó
  - khi tạo group thì sẽ không có quyền gì cả
  - khi show quyền group (trang permission) thì sẽ lấy ra 1 user trong group rồi lấy ra các quyền của user đó
  - khi sửa quyền của group thì 
    - Chỉ người tạo cùng với super admin (admin không được) mới có quyền tác động đến group đó
    - lấy ra tất cả users của group đó rồi dùng lặp để sync quyền
  - muốn: $group->role()->... => tạo role_id ở group => khi tạo group thì phải tạo role trước rồi mới tạo được group
  - tạo nhóm thành công hãy phân quyền cho nhóm
III. 
Xóa người dùng: nếu chỉ tạo url và tag thì có xác nhận là được
nhưng nếu user đó tạo group thì phải xóa group trước (hoặc trao quyền tạo group cho user khác?)
 
Thêm nhóm => thêm quyền trước
thêm người dùng => thêm luôn vai trò cho người dùng dựa theo nhóm
xóa group trước, xóa role sau
