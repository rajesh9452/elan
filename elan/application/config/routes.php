<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//  admin loogin page
$route['admin-login'] = 'admin/welcome/loginPost';
$route['admin-dashboard'] = 'admin/welcome/dashboard';
$route['logout-account'] = 'admin/welcome/logoutAccount';
$route['manage-users'] = 'admin/welcome/manageUsers';
$route['add-new-users'] = 'admin/welcome/addNewUsers';
$route['add-new-users/(:any)'] = 'admin/welcome/addNewUsers/$1';
$route['register-new-users'] = 'admin/welcome/registerAccount';

$route['user-account-delete/(:any)'] = 'admin/welcome/usersdelete/$1';
$route['activate-userAccount/(:any)'] = 'admin/welcome/usersactivate/$1';
$route['deactivate-userAccount/(:any)'] = 'admin/welcome/usersDeactivate/$1';
// Manage agents

$route['admin-profile-update'] = 'admin/welcome/adminUpdateProfile';
$route['profile-admin'] = 'admin/welcome/updateAdminProfiles';
// Add new projects
$route['manage-projects-list'] = 'admin/welcome/manageProjects';
$route['add-projects'] = 'admin/welcome/addProjects';
$route['add-projects-post'] = 'admin/welcome/addProjectsPost';
$route['update-projects-post/(:any)'] = 'admin/welcome/updateProjects/$1';
$route['projects-delete/(:any)'] = 'admin/welcome/projectsdelete/$1';
$route['activate-projects/(:any)'] = 'admin/welcome/projectsctivate/$1';
$route['deactivate-projects/(:any)'] = 'admin/welcome/projectsDeactivate/$1';
$route['project-view/(:any)'] = 'admin/welcome/projectView/$1';
$route['project-gallery-view/(:any)'] = 'admin/welcome/projectGalleryView/$1';
// Manage company
$route['manage-company-list'] = 'admin/welcome/manageCompany';
$route['company-account-delete/(:any)'] = 'admin/welcome/companydelete/$1';
$route['activate-companyAccount/(:any)'] = 'admin/welcome/companyactivate/$1';
$route['deactivate-companyAccount/(:any)'] = 'admin/welcome/companyDeactivate/$1';
$route['add-new-company'] = 'admin/welcome/addNewcompany';
$route['add-new-company/(:any)'] = 'admin/welcome/addNewcompany/$1';
$route['register-new-company'] = 'admin/welcome/registerCompanyAccount';
// Manage asign user list

// $route['project-asign-user-list/(:any)'] = 'admin/welcome/projectAsignUsers/$1';
$route['jobs-list/(:any)'] = 'admin/welcome/projectJobsList/$1';
$route['jobs-list-deactive/(:any)/(:any)'] = 'admin/welcome/projectJobsListDeactive/$1/$2';
$route['jobs-list-deactive/(:any)/(:any)/(:any)'] = 'admin/welcome/projectJobsListDeactive/$1/$2/$3';
$route['jobs-list-active/(:any)/(:any)'] = 'admin/welcome/projectJobsListactive/$1/$2';
$route['jobs-list-active/(:any)/(:any)/(:any)'] = 'admin/welcome/projectJobsListactive/$1/$2/$3';
$route['jobs-list-deleted/(:any)/(:any)'] = 'admin/welcome/projectJobsListDelete/$1/$2';
$route['jobs-list-deleted/(:any)/(:any)/(:any)'] = 'admin/welcome/projectJobsListDelete/$1/$2/$3';


$route['project-assign-user-list/(:any)'] = 'admin/welcome/projectAssignUserList/$1';
$route['assign-project-list/(:any)'] = 'admin/welcome/projectAssignList/$1';
$route['project-list-delete/(:any)/(:any)'] = 'admin/welcome/projectAssignDelete/$1/$2';
$route['project-list-delete/(:any)/(:any)/(:any)'] = 'admin/welcome/projectAssignDelete/$1/$2/$3';
//  Manage Factory
$route['manage-factory-list'] = 'admin/welcome/manageFactory';
$route['add-new-factory'] = 'admin/welcome/addNewFactory';
$route['add-new-factory/(:any)'] = 'admin/welcome/addNewFactory/$1';
$route['register-new-factory'] = 'admin/welcome/registerFactoryAccount';
$route['factory-account-delete/(:any)'] = 'admin/welcome/factorydelete/$1';
$route['activate-factoryAccount/(:any)'] = 'admin/welcome/factoryactivate/$1';
$route['deactivate-factoryAccount/(:any)'] = 'admin/welcome/factoryDeactivate/$1';
// Factory Login
$route['factory-dashboard'] = 'admin/factory/dashboard';
$route['factory-logout-account'] = 'admin/factory/logoutFactory';
$route['factory-job-list'] = 'admin/factory/assignJobList';
$route['factory-assign-job/(:any)'] = 'admin/welcome/factoryJobsAssign/$1';
$route['factory-assign-jobPost'] = 'admin/welcome/factoryJobsAssignPost';
$route['factory-job-view/(:any)'] = 'admin/factory/factoryJobsAssignView/$1';
$route['factory-update-profile']  = 'admin/factory/updateProfile';
$route['profile-factory']  = 'admin/factory/updateFactoryProfiles';