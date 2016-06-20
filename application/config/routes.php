<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "site";
$route['404_override'] = '';

/*
*	Site Routes
*/
$route['home'] = 'site/home_page';
$route['about-us'] = 'site/about';
$route['services'] = 'site/services';
$route['services/(:any)/(:any)'] = 'site/view_service/$2';
$route['services/(:any)'] = 'site/services/$1';
$route['loans'] = 'site/loans';
$route['blog'] = 'site/blog';
$route['contact-us'] = 'site/contact_us';
$route['testimonials'] = 'site/testimonials';
$route['specialists'] = 'site/specialists';
$route['faqs'] = 'site/faq';
/*
*	Settings Routes
*/
$route['settings'] = 'admin/settings';
$route['dashboard'] = 'admin/index';

/*
*	Login Routes
*/
$route['login-admin'] = 'login/login_admin';
$route['logout-admin'] = 'login/logout_admin';


$route['login-provider'] = 'login/login_provider';
$route['logout-provider'] = 'login/logout_provider';
$route['provider-sign-up'] = 'login/provider_sign_up';

/*
*	Users Routes
*/
$route['all-users'] = 'provider/users';
$route['all-users/(:num)'] = 'admin/users/index/$1';
$route['add-user'] = 'admin/users/add_user';
$route['edit-user/(:num)'] = 'admin/users/edit_user/$1';
$route['delete-user/(:num)'] = 'admin/users/delete_user/$1';
$route['activate-user/(:num)'] = 'admin/users/activate_user/$1';
$route['deactivate-user/(:num)'] = 'admin/users/deactivate_user/$1';
$route['reset-user-password/(:num)'] = 'admin/users/reset_password/$1';
$route['admin-profile/(:num)'] = 'admin/users/admin_profile/$1';



/*
*	Users Routes
*/
$route['my-jobs'] = 'provider/index';
$route['view-job/(:num)'] = 'provider/view_job_details/$1';
$route['post-job'] = 'provider/post_job';
$route['edit-job/(:num)'] = 'provider/edit_job/$1';

/*
*	Users Routes
*/
$route['all-providers'] = 'admin/providers';
$route['all-providers/(:num)'] = 'admin/providers/index/$1';
$route['delete-provider/(:num)'] = 'admin/providers/delete_provider/$1';
$route['activate-job-provider/(:num)'] = 'admin/users/activate_provider/$1';
$route['deactivate-job-provider/(:num)'] = 'admin/users/deactivate_provider/$1';
$route['reset-provider-password/(:num)'] = 'admin/users/reset_password/$1';
$route['provider-profile/(:num)'] = 'admin/providers/provider_profile/$1';
$route['un-assign-task/(:num)/(:num)'] = 'provider/unassign_seeker_task/$1/$2';
$route['assign-task/(:num)/(:num)'] = 'provider/assign_seeker_task/$1/$2';
$route['dispatch-job/(:num)/(:num)'] = 'provider/record_dispatch_time/$1/$2';
$route['all-jobs'] = 'admin/all_jobs';
$route['mark-complete-job/(:num)'] = 'provider/mark_job_as_complete/$1';


/*
*	Users Routes
*/
$route['all-seekers'] = 'admin/seekers';
$route['all-seekers/(:num)'] = 'admin/seekers/index/$1';
$route['add-new-seeker'] = 'admin/users/add_seeker';
$route['delete-seeker/(:num)'] = 'admin/seekers/delete_seeker/$1';
$route['activate-job-seeker/(:num)'] = 'admin/users/activate_seeker/$1';
$route['deactivate-job-seeker/(:num)'] = 'admin/users/deactivate_seeker/$1';
$route['reset-seeker-password/(:num)'] = 'admin/users/reset_password/$1';
$route['seeker-profile/(:num)'] = 'admin/seekers/seeker_profile/$1';

/*
*	Admin Routes
*/

//jobs
$route['administration/all-jobs'] = 'admin/jobs/index';
$route['administration/all-jobs/(:num)'] = 'admin/jobs/index/created/DESC/$1';//with a page number
$route['administration/all-jobs/(:any)/(:any)/(:num)'] = 'admin/jobs/index/$1/$2/$3';//with a page number
$route['administration/add-job'] = 'admin/jobs/add_job';
$route['administration/edit-job/(:num)/(:num)'] = 'admin/jobs/edit_job/$1/$2';
$route['administration/activate-job/(:num)/(:num)'] = 'admin/jobs/activate_job/$1/$2';
$route['administration/deactivate-job/(:num)/(:num)'] = 'admin/jobs/deactivate_job/$1/$2';
$route['administration/delete-job/(:num)/(:num)'] = 'admin/jobs/delete_job/$1/$2';

//slides
$route['administration/contacts'] = 'admin/contacts/show_contacts';
$route['administration/loans'] = 'admin/loans/show_loans';
$route['administration/all-slides'] = 'admin/slideshow/index';
$route['administration/all-slides/(:num)'] = 'admin/slideshow/index/$1';//with a page number
$route['administration/add-slide'] = 'admin/slideshow/add_slide';
$route['administration/edit-slide/(:num)/(:num)'] = 'admin/slideshow/edit_slide/$1/$2';
$route['administration/activate-slide/(:num)/(:num)'] = 'admin/slideshow/activate_slide/$1/$2';
$route['administration/deactivate-slide/(:num)/(:num)'] = 'admin/slideshow/deactivate_slide/$1/$2';
$route['administration/delete-slide/(:num)/(:num)'] = 'admin/slideshow/delete_slide/$1/$2';

//departments
$route['administration/all-departments'] = 'admin/departments/index';
$route['administration/all-departments/(:num)'] = 'admin/departments/index/$1';//with a page number
$route['administration/add-department'] = 'admin/departments/add_department';
$route['administration/edit-department/(:num)/(:num)'] = 'admin/departments/edit_department/$1/$2';
$route['administration/activate-department/(:num)/(:num)'] = 'admin/departments/activate_department/$1/$2';
$route['administration/deactivate-department/(:num)/(:num)'] = 'admin/departments/deactivate_department/$1/$2';
$route['administration/delete-department/(:num)/(:num)'] = 'admin/departments/delete_department/$1/$2';

//services
$route['administration/all-services'] = 'admin/services/index';
$route['administration/all-services/(:num)'] = 'admin/services/index/$1';//with a page number
$route['administration/add-service'] = 'admin/services/add_service';
$route['administration/edit-service/(:num)/(:num)'] = 'admin/services/edit_service/$1/$2';
$route['administration/activate-service/(:num)/(:num)'] = 'admin/services/activate_service/$1/$2';
$route['administration/deactivate-service/(:num)/(:num)'] = 'admin/services/deactivate_service/$1/$2';
$route['administration/delete-service/(:num)/(:num)'] = 'admin/services/delete_service/$1/$2';

//services
$route['administration/all-gallery-images'] = 'admin/gallery/index';
$route['administration/all-gallery-images/(:num)'] = 'admin/gallery/index/$1';//with a page number
$route['administration/add-gallery'] = 'admin/gallery/add_gallery';
$route['administration/edit-gallery/(:num)/(:num)'] = 'admin/gallery/edit_gallery/$1/$2';
$route['administration/activate-gallery/(:num)/(:num)'] = 'admin/gallery/activate_gallery/$1/$2';
$route['administration/deactivate-gallery/(:num)/(:num)'] = 'admin/gallery/deactivate_gallery/$1/$2';
$route['administration/delete-gallery/(:num)/(:num)'] = 'admin/gallery/delete_gallery/$1/$2';

/*
*	Admin Blog Routes
*/
$route['posts'] = 'admin/blog';
$route['all-posts'] = 'admin/blog';
$route['blog-categories'] = 'admin/blog/categories';
$route['add-post'] = 'admin/blog/add_post';
$route['edit-post/(:num)'] = 'admin/blog/edit_post/$1';
$route['delete-post/(:num)'] = 'admin/blog/delete_post/$1';
$route['activate-post/(:num)'] = 'admin/blog/activate_post/$1';
$route['deactivate-post/(:num)'] = 'admin/blog/deactivate_post/$1';
$route['post-comments/(:num)'] = 'admin/blog/post_comments/$1';
$route['comments/(:num)'] = 'admin/blog/comments/$1';
$route['comments'] = 'admin/blog/comments';
$route['add-comment/(:num)'] = 'admin/blog/add_comment/$1';
$route['delete-comment/(:num)/(:num)'] = 'admin/blog/delete_comment/$1/$2';
$route['activate-comment/(:num)/(:num)'] = 'admin/blog/activate_comment/$1/$2';
$route['deactivate-comment/(:num)/(:num)'] = 'admin/blog/deactivate_comment/$1/$2';
$route['add-blog-category'] = 'admin/blog/add_blog_category';
$route['edit-blog-category/(:num)'] = 'admin/blog/edit_blog_category/$1';
$route['delete-blog-category/(:num)'] = 'admin/blog/delete_blog_category/$1';
$route['activate-blog-category/(:num)'] = 'admin/blog/activate_blog_category/$1';
$route['deactivate-blog-category/(:num)'] = 'admin/blog/deactivate_blog_category/$1';
$route['delete-comment/(:num)'] = 'admin/blog/delete_comment/$1';
$route['activate-comment/(:num)'] = 'admin/blog/activate_comment/$1';
$route['deactivate-comment/(:num)'] = 'admin/blog/deactivate_comment/$1';

/*
*	Blog Routes
*/
$route['blog'] = 'site/blog';
$route['blog/(:num)'] = 'site/blog/index/__/__/$1';//going to different page without any filters
$route['blog/view-single/(:any)'] = 'site/blog/view_post/$1';//going to single post page
$route['blog/category/(:any)'] = 'site/blog/index/$1';//category present
$route['blog/category/(:any)/(:num)'] = 'site/blog/index/$1/$2';//category present going to next page
$route['blog/search/(:any)'] = 'site/blog/index/__/$1';//search present
$route['blog/search/(:any)/(:num)'] = 'site/blog/index/__/$1/$2';//search present going to next page

/* End of file routes.php */
/* Location: ./application/config/routes.php */

/*
*	Gallery Routes
*/
$route['gallery'] = 'site/gallery';
$route['gallery/(:num)'] = 'site/gallery/$1';

/*
*	Gallery Routes
*/
$route['departments'] = 'site/departments';
$route['departments/(:num)'] = 'site/departments/$1';
$route['departments/(:any)'] = 'site/view_department/$1';

/*
*	Job seeker Routes
*/
$route['job-seeker-login'] = 'job_seeker/auth/login_job_seeker';
$route['job-seeker-dashboard'] = 'job_seeker/dashboard';
$route['complete-job/(:num)'] = 'job_seeker/complete_job/$1';

/*
*	Site Routes
*/
$route['jobs'] = 'site/jobs';
$route['my-account'] = 'job_seeker/account_details';
$route['change-password'] = 'job_seeker/change_password';
$route['logout-seeker'] = 'job_seeker/logout_seeker';
$route['book-job/(:num)'] = 'job_seeker/book_job/$1';
$route['contact'] = 'site/contact';
$route['about'] = 'site/about';
$route['about/(:any)'] = 'site/about/$1';

/*
*	Advertisers Routes
*/
$route['all-companies'] = 'admin/companies';
$route['all-companies/(:any)/(:any)/(:num)'] = 'admin/companies/index/$1/$2/$3';
$route['all-companies/(:any)/(:any)'] = 'admin/companies/index/$1/$2';
$route['add-company'] = 'admin/companies/add_company';
$route['edit-company/(:num)'] = 'admin/companies/edit_company/$1';
$route['delete-company/(:num)'] = 'admin/companies/delete_company/$1';
$route['activate-company/(:num)'] = 'admin/companies/activate_company/$1';
$route['deactivate-company/(:num)'] = 'admin/companies/deactivate_company/$1';

$route['all-advertisments'] = 'admin/advertising';
$route['add-advert'] = 'admin/advertising/add_advert';
$route['edit-advert/(:num)'] = 'admin/advertising/edit_advert/$1';