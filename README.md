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
- Except who is in User Group redirect admin page
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
- [Jquery Multiple-select](https://harvesthq.github.io/chosen/)
- [Date Range Picker](https://www.npmjs.com/package/daterangepicker)
## UI
- [AdminLTE 3](https://adminlte.io/themes/v3/)
- [Bitly](https://app.bitly.com/)
- [Landing page](https://codepen.io/FedLover/pen/NWXPeae)
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

