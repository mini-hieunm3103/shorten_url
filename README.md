# Laravel - Shorten URL Project:
## +1 knowledge
1. Multiple unique: 'name' => 'unique:table,field,NULL,id,field1,value1,field2,value2,field3,value3'


## Note: DATABASE
1. Tạo DATABASE
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
- User Group can't access admin page
## Client Page:
- Manage: Tags, Urls, User Information
- User Permissions:
  - CRUD: tags and urls created by this user
  - Edit user information
- Shorten URL
- All user check login can access this page 
## Features
1. Destination(long_url): Với cùng 1 user thì chỉ có thể tạo khác nhau, nhưng các users với nhau có thể giống nhau 
   - ví dụ: abc.com thì có thể bị trùng với nhiều users : anh A, b, c 
   - Nhưng với tài khoản anh A thì chỉ được phép tạo 1 shorten url của abc.com
2. urls.title, tags.title cũng như trên
3. back_half thì lại chỉ được 1 cái (unique với tất cả trong bảng urls)
4. Lọc dữ liệu của url theo: thời gian tạo (Lọc theo khoảng thời gian), có tự custom back_half hay không, lọc theo multiple select tags, lọc theo active hoặc hidden
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

