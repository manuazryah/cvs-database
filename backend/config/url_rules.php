<?php

return [
    'candidate-details' => 'candidate/candidate/index',
    'unreviewed-candidate' => 'candidate/candidate/unreviewed-candidate',
    'reviewed-candidate' => 'candidate/candidate/reviewed-candidate',
    'create-candidate' => 'candidate/candidate/create',
    'cv-search' => 'candidate/candidate/cv-search',
    'update-candidate/<id:\d+>' => 'candidate/candidate/update',
    'update-profile/<id:\d+>' => 'candidate/candidate/update-profile',
    'candidate-view/<id:\d+>' => 'candidate/candidate/view',
    'reset-password/<id:\d+>' => 'candidate/candidate/reset-password',
    'employer-details' => 'employer/employer/index',
    'create-employer' => 'employer/employer/create',
    'view-employer/<id:\d+>' => 'employer/employer/view',
    'update-employer/<id:\d+>' => 'employer/employer/update',
    'reset-password/<id:\d+>' => 'employer/employer/reset-password',
    'employer-packages' => 'employer/employer-packages/index',
    'employer-package-view/<id:\d+>' => 'employer/employer-packages/view',
    'edit-package/<id:\d+>' => 'employer/employer-packages/update',
    'upgrade-package/<emp_id:\d+>' => 'employer/employer-packages/upgrade-package',
];
