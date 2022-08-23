<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function()
{
Route::any('/login', [App\Http\Controllers\admin\AdminController::class, 'login'])->name('admin.login');
Route::any('/forgot-password', [App\Http\Controllers\admin\AdminController::class, 'forget_password'])->name('admin.forgot.password');
Route::any('/change-password/{id}', [App\Http\Controllers\admin\AdminController::class, 'change_password'])->name('admin.change.password');
Route::any('/check-otp', [App\Http\Controllers\admin\AdminController::class, 'checkotp'])->name('admin.checkotp');
Route::any('/signup', [App\Http\Controllers\admin\AdminController::class, 'signup'])->name('admin.signup');
});

Route::middleware(['admin'])->group(function(){
	Route::prefix('admin')->group(function()
	{
	  	Route::get('home', [App\Http\Controllers\admin\HomeController::class, 'index'])->name('admin.home');
	  	
	  	Route::get('testp', [App\Http\Controllers\admin\HomeController::class, 'testprocedure'])->name('admin.testp');

		Route::any('/logout', [App\Http\Controllers\admin\AdminController::class, 'logout'])->name('admin.logout');
		Route::any('/profile', [App\Http\Controllers\admin\AdminController::class, 'admin_profile'])->name('admin.profile');
		Route::any('/profile-password', [App\Http\Controllers\admin\AdminController::class, 'changepassword'])->name('admin.profile_password');
		Route::any('/edit-profile-image', [App\Http\Controllers\admin\AdminController::class, 'edit_profile_image'])->name('admin.edit.profile.image');

		/*...................... Canteen routes......... */
		Route::any('/create-canteen', [App\Http\Controllers\admin\CanteenController::class, 'canteencreate'])->name('admin.create.canteen');
		Route::any('/manage-canteen', [App\Http\Controllers\admin\CanteenController::class, 'managecanteen'])->name('admin.manage.canteen');
		Route::any('/edit-canteen/{id}', [App\Http\Controllers\admin\CanteenController::class, 'editcanteen'])->name('admin.edit.canteen');
		Route::any('/delete-canteen/{id}', [App\Http\Controllers\admin\CanteenController::class, 'deletecanteen'])->name('admin.delete.canteen');
		/*....................end.........................*/

		/*...................... Department routes......... */
		Route::any('/create-department', [App\Http\Controllers\admin\DepartmentController::class, 'departmentcreate'])->name('admin.create.department');
		Route::any('/manage-department', [App\Http\Controllers\admin\DepartmentController::class, 'managedepartment'])->name('admin.manage.department');
		Route::any('/edit-department/{id}', [App\Http\Controllers\admin\DepartmentController::class, 'editdepartment'])->name('admin.edit.department');
		Route::any('/delete-department/{id}', [App\Http\Controllers\admin\DepartmentController::class, 'deletedepartment'])->name('admin.delete.department');
		/*....................end.........................*/

		/*...................... Division routes......... */
		Route::any('/create-division', [App\Http\Controllers\admin\DivisionController::class, 'divisioncreate'])->name('admin.create.division');
		Route::any('/manage-division', [App\Http\Controllers\admin\DivisionController::class, 'managedivision'])->name('admin.manage.division');
		Route::any('/edit-division/{id}', [App\Http\Controllers\admin\DivisionController::class, 'editdivision'])->name('admin.edit.division');
		Route::any('/delete-division/{id}', [App\Http\Controllers\admin\DivisionController::class, 'deletedivision'])->name('admin.delete.division');
		/*....................end.........................*/

		/*...................... Employee Category routes......... */
		Route::any('/create-employee-category', [App\Http\Controllers\admin\EmpCategoryController::class, 'empcategorycreate'])->name('admin.create.empcategory');
		Route::any('/manage-employee-category', [App\Http\Controllers\admin\EmpCategoryController::class, 'manageempcategory'])->name('admin.manage.empcategory');
		Route::any('/edit-employee-category/{id}', [App\Http\Controllers\admin\EmpCategoryController::class, 'editempcategory'])->name('admin.edit.empcategory');
		Route::any('/delete-employee-category/{id}', [App\Http\Controllers\admin\EmpCategoryController::class, 'deleteempcategory'])->name('admin.delete.empcategory');
		/*....................end.........................*/


		/*...................... Item routes......... */
		Route::any('/create-item', [App\Http\Controllers\admin\ItemController::class, 'itemcreate'])->name('admin.create.item');
		Route::any('/manage-item', [App\Http\Controllers\admin\ItemController::class, 'manageitem'])->name('admin.manage.item');
		Route::any('/edit-item/{id}', [App\Http\Controllers\admin\ItemController::class, 'edititem'])->name('admin.edit.item');
		Route::any('/delete-item/{id}', [App\Http\Controllers\admin\ItemController::class, 'deleteitem'])->name('admin.delete.item');
		/*....................end.........................*/

		/*...................... Card Inventory routes......... */
		Route::any('/create-card', [App\Http\Controllers\admin\CardInventoryController::class, 'cardcreate'])->name('admin.create.card');
		Route::any('/manage-card', [App\Http\Controllers\admin\CardInventoryController::class, 'managecard'])->name('admin.manage.card');
		Route::any('/edit-card/{id}', [App\Http\Controllers\admin\CardInventoryController::class, 'editcard'])->name('admin.edit.card');
		Route::any('/delete-card/{id}', [App\Http\Controllers\admin\CardInventoryController::class, 'deletecard'])->name('admin.delete.card');
		/*....................end.........................*/

		
		/*...................... User Role routes......... */
		Route::any('/add-user-role', [App\Http\Controllers\admin\UsersController::class, 'addrole'])->name('admin.users.role.add');
		Route::any('/manage-user-role', [App\Http\Controllers\admin\UsersController::class, 'manage_roles'])->name('admin.users.role.manage');
		Route::any('/edit-user-role/{id}', [App\Http\Controllers\admin\UsersController::class, 'editrole'])->name('admin.users.role.edit');
		Route::any('/delete-user-role/{id}', [App\Http\Controllers\admin\UsersController::class, 'deleterole'])->name('admin.users.role.delete');
		Route::any('/user-permission', [App\Http\Controllers\admin\UsersController::class, 'user_permission'])->name('admin.users.permission');
		Route::any('/manage-permission/{id}', [App\Http\Controllers\admin\UsersController::class, 'manage_user_permission'])->name('admin.manage.user.perssion');
		Route::any('/user-messages', [App\Http\Controllers\admin\UsersController::class, 'usermessages'])->name('admin.user.message');

		/*....................end.........................*/

		/*...................... User Backend routes......... */

		Route::any('manage-users', [App\Http\Controllers\admin\UsersController::class, 'index'])->name('admin.manage.users');
		Route::any('add-users', [App\Http\Controllers\admin\UsersController::class, 'add'])->name('admin.add.users');
		Route::any('edit-users/{id}', [App\Http\Controllers\admin\UsersController::class, 'edit'])->name('admin.edit.users');
		Route::any('delete-users/{id}', [App\Http\Controllers\admin\UsersController::class, 'delete'])->name('admin.delete.users');
		Route::any('delete-employee-meal/{id}', [App\Http\Controllers\admin\UsersController::class, 'deleteempmeal'])->name('admin.delete.employee.meal');
		Route::any('user-status', [App\Http\Controllers\admin\UsersController::class, 'user_status'])->name('admin.user.status');
		Route::any('manage-user-meal', [App\Http\Controllers\admin\UsersController::class, 'Employeemeal'])->name('admin.manage.user.meal');
		Route::any('employeedate', [App\Http\Controllers\admin\UsersController::class, 'employeedate']);

		/*....................end.........................*/
	});
});
