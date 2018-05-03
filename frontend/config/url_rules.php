<?php

return [
//    'home' => '/employer/home',
    'update-profile' => '/employer/update',
    'change-password' => '/employer/change-password',
    'user-packages' => '/employer/user-plans',
    'upgrade-package' => '/employer/upgrade-package',
    'shortlist-folder' => '/employer/shortlist-folder',
//    '<report_id>' => '/employer/report',
    'invoice/<id:\w+>' => '/employer/report',
    'view-cv/<id:\w+>' => '/employer/view-cv',
//    '<cv_id>' => '/employer/view-cv',
    'jobseeker/update-profile' => '/candidate/update-profile',
    'jobseeker/index' => '/candidate/index',
    'jobseeker/online-curriculum-vitae' => '/candidate/online-curriculum-vitae',
    'jobseeker/reset-password' => '/candidate/reset-password',
];
