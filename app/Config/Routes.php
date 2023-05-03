<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//Authentication
$routes->get('/login', 'auth\LoginController::index',['filter' => 'usercheck']);

$routes->get('/register', 'auth\RegisterController::index');


//Admin Panel
$routes->get('/', 'Home::index');


$routes->add('view-user', 'ViewUserController::index',['filter' => 'authGuard']);
$routes->add('view-transaction', 'ViewTransactionController::index',['filter' => 'authGuard']);
$routes->add('view-rfa', 'ViewRFA::index',['filter' => 'authGuard']);

//Admin Panel
$routes->group('admin', function($routes) {
    $routes->add('dashboard', 'admin\DashboardController::index',['filter' => 'authGuard']);
    $routes->add('rfa-dashboard', 'admin\RFADashboardController::index',['filter' => 'authGuard']);
    $routes->add('completed-transactions', 'admin\CompletedTransactionsController::index',['filter' => 'authGuard']);
    $routes->add('pending-transactions', 'admin\PendingTransactionsController::index',['filter' => 'authGuard']);
    $routes->add('cso', 'admin\CsoController::index',['filter' => 'authGuard']);
    $routes->add('responsibility-center', 'admin\ResponsibilityCenterController::index',['filter' => 'authGuard']);
    $routes->add('responsible-section', 'admin\ResponsibleSectionController::index',['filter' => 'authGuard']);
    $routes->add('type-of-activity', 'admin\TypeofActivityController::index',['filter' => 'authGuard']);
    $routes->add('users', 'admin\UserController::index',['filter' => 'authGuard']);
    $routes->add('completed-rfa', 'admin\CompletedRFAController::index',['filter' => 'authGuard']);
    $routes->add('pending-rfa', 'admin\PendingRFAController::index',['filter' => 'authGuard']);
    $routes->add('back-up-database', 'admin\BackupDatabaseController::index',['filter' => 'authGuard']);
    $routes->add('activity-logs', 'admin\ActivityLogsController::index',['filter' => 'authGuard']);
    $routes->add('type-of-request', 'admin\TypeofRequestController::index',['filter' => 'authGuard']);
    $routes->add('clients', 'ClientsController::index',['filter' => 'authGuard']);
});


//View officers
$routes->get('admin/cso/view-officers', 'admin\CsoController::view_officers',['filter' => 'authGuard']);
$routes->get('admin/cso/cso-information', 'admin\CsoController::view_cso',['filter' => 'authGuard']);




//User Panel
$routes->group('user', function($routes) {
    $routes->add('dashboard', 'user\DashboardController::index',['filter' => 'authGuard']);
    $routes->add('rfa-dashboard', 'user\RFADashboardController::index',['filter' => 'authGuard']);
    $routes->add('completed-transactions', 'user\CompletedTransactionsController::index',['filter' => 'authGuard']);
    $routes->add('pending-transactions', 'user\PendingTransactionsController::index',['filter' => 'authGuard']);
    $routes->add('completed-rfa', 'user\CompletedRFAController::index',['filter' => 'authGuard']);
    $routes->add('pending-rfa', 'user\PendingRFAController::index',['filter' => 'authGuard']);
    $routes->add('activity-logs', 'user\ActivityLogsController::index',['filter' => 'authGuard']);

    $routes->add('request-for-assistance', 'user\RequestForAssistanceController::index',['filter' => 'authGuard']);
    $routes->add('clients', 'ClientsController::index',['filter' => 'authGuard']);
    $routes->add('referred', 'user\ReferredController::index',['filter' => 'authGuard']);
});


$routes->group('user/rfa', function($routes) {
    $routes->add('received', 'user\ReceivedController::index',['filter' => 'authGuard']);
     $routes->add('track', 'user\TrackRFAController::index',['filter' => 'authGuard']);
    
});





$routes->get('user/pending-transactions/add-transaction', 'user\PendingTransactionsController::add_transaction',['filter' => 'authGuard']);

$routes->get('user/update-pmas', 'user\PendingTransactionsController::update_transaction',['filter' => 'authGuard']);


$routes->get('user/pending/update-rfa', 'user\PendingRFAController::update_rfa',['filter' => 'authGuard']);

//Sign out
$routes->get('api/auth/sign_out', 'api\Auth::sign_out');

//Login
$routes->post('api/auth/verify', 'api\Auth::verify');






//Admin Api
//Database
$routes->post('api/back-up-db', 'api\BackupDB::index');
$routes->post('api/get-database', 'api\BackupDB::get_database');
//Users
$routes->post('api/add-user', 'api\Users::add_user');
$routes->post('api/get-active-user', 'api\Users::get_user_active');
$routes->post('api/get-inactive-user', 'api\Users::get_user_inactive');
$routes->post('api/update-user-status', 'api\Users::update_user_status');

$routes->post('api/get-user-data', 'api\Users::get_user_data');
$routes->post('api/update-user-information', 'api\Users::update_user_information');

$routes->post('api/update-user-profile', 'api\Users::update_user_profile');


$routes->post('api/verify-old-password', 'api\Users::verify_old_password');
$routes->post('api/update-password', 'api\Users::update_password');
//CSO
$routes->post('api/add-cso', 'api\Cso::add_cso');
$routes->post('api/get-cso', 'api\Cso::get_cso');
$routes->post('api/delete-cso', 'api\Cso::delete_cso');


$routes->post('api/get-cso-infomation', 'api\Cso::get_cso_information');
$routes->post('api/update-cso-information', 'api\Cso::update_cso_information');
$routes->post('api/update-cso-status', 'api\Cso::update_cso_status');
$routes->post('api/update-cor', 'api\Cso::update_cso_cor');
$routes->post('api/update-bylaws', 'api\Cso::update_cso_bylaws');
$routes->post('api/update-aoc', 'api\Cso::update_cso_aoc');

$routes->post('api/get-cor', 'api\Cso::get_cso_cor');
$routes->post('api/get-bylaws', 'api\Cso::get_cso_bylaws');
$routes->post('api/get-aoc', 'api\Cso::get_cso_aoc');



//CSO Officers
$routes->post('api/add-officer', 'api\Cso::add_cso_officer');
$routes->post('api/get-officers', 'api\Cso::get_officers');
$routes->post('api/update-officer-information', 'api\Cso::update_officer');
$routes->post('api/delete-cso-officer', 'api\Cso::delete_cso_officer');


$routes->post('api/count-cso-per-barangay', 'api\Cso::count_cso_per_barangay');

//Responsibility Center
$routes->post('api/add-responsibility', 'api\Responsibility::add_responsibiliy');
$routes->post('api/get-responsiblity', 'api\Responsibility::get_responsibility');
$routes->post('api/delete-center', 'api\Responsibility::delete_responsibility');
$routes->post('api/update-center', 'api\Responsibility::update_responsibility');


//Responsible Section
$routes->post('api/add-responsible', 'api\ResponsibleSection::add_responsible');
$routes->post('api/get-responsible', 'api\ResponsibleSection::get_responsible');
$routes->post('api/delete-responsible', 'api\ResponsibleSection::delete_responsible');
$routes->post('api/update-responsible', 'api\ResponsibleSection::update_responsible');


//Type of Activity
$routes->post('api/add-type-of-activity', 'api\TypeOfActivity::add_type_of_activity');
$routes->post('api/get-activities', 'api\TypeOfActivity::get_activities');
$routes->post('api/delete-activity','api\TypeOfActivity::delete_activity');
$routes->post('api/update-type-of-activity','api\TypeOfActivity::update_activity');

//Under Type of Activity 
$routes->post('api/add-under-type-of-activity', 'api\TypeOfActivity::add_under_type_of_activity');
$routes->post('api/get_under_type_of_activity', 'api\TypeOfActivity::get_under_type_of_activity');
$routes->post('api/delete-under-activity','api\TypeOfActivity::delete_under_activity');
$routes->post('api/update-under-type-of-activity','api\TypeOfActivity::update_under_activity');

//Type of Request
$routes->post('api/add-type-of-request', 'api\TypeofRequest::add_type_of_request');
$routes->post('api/get-request', 'api\TypeofRequest::get_request');
$routes->post('api/update-type-of-request', 'api\TypeofRequest::update_request');
$routes->post('api/delete-request','api\TypeOfRequest::delete_request');


//RFA Pending Transactions

$routes->post('api/get-admin-pending-rfa','api\PendingRFATransactions::get_admin_pending_rfa_transactions');


//Pending Transactions
$routes->post('api/admin/get-admin-pending-transactions', 'api\PendingTransactions::get_admin_pending_transactions');
$routes->post('api/admin/add-remark', 'api\PendingTransactions::add_remark');

//Generate PMAS Report
$routes->post('api/admin/generate-pmas-report', 'api\Transactions::generate_pmas_report');
$routes->post('api/admin/generate-rfa-report', 'api\CompletedRFATransactions::generate_rfa_report');
$routes->post('api/admin/get_total_report', 'api\Transactions::get_total_report');

//Admin Dashboard
$routes->post('api/load-admin-chart-transaction-data', 'api\Transactions::get_admin_chart_transaction_data');
$routes->post('api/get-pending-transaction-limit', 'api\PendingTransactions::get_admin_pending_transaction_limit');
$routes->post('api/get-pending-rfa-transaction-limit', 'api\PendingRFATransactions::get_admin_pending_rfa_transaction_limit');


$routes->post('api/load-admin-chart-rfa-transaction-data', 'api\CompletedRFATransactions::get_admin_chart_rfa_transaction_data');


$routes->post('api/count-pending-transactions', 'api\PendingTransactions::count_pending_transactions');
$routes->post('api/get-rfa-data', 'api\PendingRFATransactions::get_rfa_data');

$routes->post('api/view-rfa-data', 'api\PendingRFATransactions::view_rfa_data');

$routes->post('api/refer-to', 'api\PendingRFATransactions::refer_to');

//User Api:
$routes->post('api/get-last-pmas-number', 'api\PendingTransactions::get_last_pmas_number');
$routes->post('api/get-last-reference-number', 'api\TypeOfRequest::get_last_ref_number');

//Pending Transactions
$routes->post('api/add-transaction', 'api\PendingTransactions::add_transaction');
$routes->post('api/user/get-user-pending-transactions', 'api\PendingTransactions::get_user_pending_transactions');
$routes->post('api/user/delete-transaction', 'api\PendingTransactions::user_delete_transaction');
$routes->post('api/get-transaction-data', 'api\PendingTransactions::get_transaction_data');


$routes->post('api/update-transaction', 'api\PendingTransactions::update_transaction');


$routes->post('api/view-remark', 'api\PendingTransactions::view_remark');
$routes->post('api/accomplished', 'api\PendingTransactions::accomplished');
$routes->post('api/completed', 'api\PendingTransactions::update_completed');


//Completed RFA
$routes->post('api/user/get-user-completed-rfa', 'api\CompletedRFATransactions::get_user_completed_transactions');


//Completed Transactions
$routes->post('api/get-all-transactions', 'api\Transactions::get_all_transactions');
$routes->post('api/get-project-transaction-data', 'api\Transactions::get_project_transaction_data');
$routes->post('api/user/get-user-completed-transactions', 'api\Transactions::get_user_completed_transactions');


//User Dashboard
$routes->post('api/load-user-chart-transaction-data', 'api\Transactions::get_user_chart_transaction_data');
$routes->post('api/load-user-chart-rfa-transaction-data', 'api\CompletedRFATransactions::get_user_chart_rfa_transaction_data');

///Client
$routes->post('api/search-names', 'api\Clients::search_name');
$routes->post('api/add-client', 'api\Clients::add_client');
$routes->post('api/get-clients', 'api\Clients::get_clients');
$routes->post('api/delete-client', 'api\Clients::delete_client');


//RFA
$routes->post('api/add-rfa', 'api\PendingRFATransactions::add_rfa');
$routes->post('api/get-all-rfa-transactions', 'api\CompletedRFATransactions::get_all_rfa_transactions');
$routes->post('api/get-user-pending-rfa', 'api\PendingRFATransactions::get_user_pending_rfa_transactions');

$routes->post('api/update-rfa', 'api\PendingRFATransactions::update_rfa');

$routes->post('api/get-user-pending-rfa', 'api\PendingRFATransactions::get_user_pending_rfa_transactions');

$routes->post('api/view-action', 'api\PendingRFATransactions::view_action');
$routes->post('api/view-action-taken', 'api\PendingRFATransactions::view_action_taken');


$routes->post('api/approved-rfa', 'api\PendingRFATransactions::approved_rfa');

$routes->post('api/get-user-reffered-rfa', 'api\PendingRFATransactions::get_user_referred_rfa');
$routes->post('api/count-reffered-rfa', 'api\PendingRFATransactions::count_reffered_rfa');
$routes->post('api/accomplish-rfa', 'api\PendingRFATransactions::accomplished');

$routes->post('api/received-rfa', 'api\PendingRFATransactions::received_rfa');

$routes->post('api/add-rfa-action-taken', 'api\PendingRFATransactions::add_rfa_action_taken');


$routes->post('api/count-pending-rfa', 'api\PendingRFATransactions::count_pending_rfa');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
