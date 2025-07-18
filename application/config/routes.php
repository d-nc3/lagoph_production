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

|	https://codeigniter.com/userguide3/general/routing.html

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

$route['default_controller'] = 'landing';

$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;

// Authentication


$route['Landing'] = 'Landing/index';
$route['Member-process'] = 'Landing/membership';
$route['About-us'] = 'Landing/aboutUs';
$route['FAQ'] = 'Landing/FAQ';
$route['Auth'] = 'Authentication/Auth/index';
$route['Auth/logout'] = 'Authentication/Auth/logout';

//Admin
$route['Role/create_role'] = 'Admin/Role/create_role';
$route['Role/index'] = 'Admin/Role/index';
$route['Role'] = 'Admin/Role/index';

//Member
$route['Member/index'] = 'Admin/Member/index';

//permissions
$route['Permissions/create_permissions'] = 'Admin/Permissions/create_permissions';
$route['Permissions/index'] = 'Admin/Permissions/index';
$route['Permissions'] = 'Admin/Permissions';

//user-role-permissions
$route['User_roles_permissions/index'] = 'Admin/User_roles_permissions';



//loans

$route['loans'] = 'Loans/Loan/index';
$route['loan-disbursment'] = 'Loans/Loan/cashier_index';
$route['manager/loans'] = 'Loans/Loan/manager_index';
$route['loan-repayment'] = 'Loans/Loan/repaymentIndex';
$route['Loan/loan_application'] = 'Loans/Loan/loan_application';
$route['Loan/admin'] = 'Loans/Loan/index_admin';
$route['Loan/index_admin'] = 'Loans/Loan/index_admin';
$route['Loan/loan_dt_list'] = 'Loans/Loan/loan_dt_list';
$route['Loan/view/(:any)'] = 'Loans/L   oan/index_view/$1';
$route['Loan/approve'] = 'Loans/Loan/approve';
$route['Loan/cashier_view/(:num)'] = 'Loans/Loan/cashier_view/$1';
$route['Membership/update_attachments'] = 'Membership/Membership/update_attachments';
$route['applyLoan'] = 'Loans/loan/loanApplication';
$route['repayment'] = 'Loans/loan/loanRepayment';


//transaction history

$route['transaction-history'] = 'Transaction/Transaction_history/index'; // → https://yourdomain.com/transaction-history

$route['transaction-history/view/(:num)'] = 'Transaction/Transaction_history/view/$1';

$route['Profile/Billing'] = 'Settings/Billing';



//Transaction

$route['transactions'] = 'Transaction/Transaction'; // → https://yourdomain.com/transactions

$route['transactions/view/(:any)'] = 'Transaction/Transaction/view/$1';



//Membership

$route['applicant/view/(:num)'] = 'Membership/Applicant/view/$1'; // → https://yourdomain.com/Applicant/view/1

$route['manager/applicant'] = 'Membership/Applicant/manager_index'; // → https://yourdomain.com/manager/applicant\

$route['membership'] = 'Membership/Membership'; // → https://yourdomain.com/membership

$route['membership/form'] = 'Membership/Membership/form'; // → https://yourdomain.com/membership/form

$route['membership/schedules'] = 'Membership/Membership/schedules'; // → https://yourdomain.com/membership/schedule



// routines memebrship:

$route['Membership/personal-data'] = 'Membership/Membership/Personal_information';
$route['Event-scheduling'] = 'Membership/Membership/event_scheduling';

$route['Membership/beneficiaries'] = 'Membership/Membership/beneficiaries';

$route['Membership/educational_background'] = 'Membership/Membership/educational_background';

$route['Membership/work_experience'] ='Membership/Membership/work_experience';

$route['Membership/administrative_offense'] = 'Membership/Membership/administrative_offense';

$route['Membership/update_attachments'] = 'Membership/Membership/update_attachments';

$route['Membership/form'] ='Membership/Membership/form';

$route['Membership'] = 'Membership/Membership/index';

$route['Membership/book_event'] = 'Membership/Membership/book_event';



//Member

$route['member/view/(:num)'] = 'Admin/Member/view/$1'; // → https://yourdomain.com/members

$route['event-logs/(:num)'] = 'Admin/Member/event_logs/$1'; // → https://yourdomain.com/event-logs/1

$route['statement/(:num)'] = 'Admin/Member/Statement/$1'; // → https://yourdomain.com/event-logs/1



//Employee

$route['employee/view/(:num)'] = 'Admin/Employee/view/$1'; // → https://yourdomain.com/employee/view/1

$route['employee'] = 'Admin/Employee'; // → https://yourdomain.com/employee/statement/1





