<?php

return array(

    'Global' => array(
        array(
            'permission' => 'superuser',
            'label'      => 'Super User',
            'note'       => 'Determines whether the user has full access to all aspects of the admin. This setting overrides any more specific permissions throughout the system. ',
            'display'    => true,
        ),
        array(
            'permission' => 'superview',
            'label'      => 'Super View',
            'note'       => 'Determines whether the user has view to most aspects of the admin. ',
            'display'    => true,
        ),
    ),

    'Admin' => array(
        array(
            'permission' => 'admin',
            'label'      => '',
            'note'       => 'Determines whether the user has access to most aspects of the admin. ',
            'display'    => true,
        ),
        array(
            'permission' => 'admin.api_key',
            'label'      => 'Create API Key',
            'note'       => 'Determines whether the user can access the API via API key.',
            'display'    => false,
        ),
    ),

    'Users' => array(
        array(
            'permission' => 'user.b',
            'label'      => 'Browser ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'user.r',
            'label'      => 'Read ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'user.a',
            'label'      => 'Create ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'user.e',
            'label'      => 'Edit  ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'user.d',
            'label'      => 'Delete ',
            'note'       => '',
            'display'    => true,
        ),
    ),

    'Pengelola TIK' => array(
        array(
            'permission' => 'person.b',
            'label'      => 'Browser ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'person.r',
            'label'      => 'Read ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'person.a',
            'label'      => 'Create ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'person.e',
            'label'      => 'Edit  ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'person.d',
            'label'      => 'Delete ',
            'note'       => '',
            'display'    => true,
        ),
    ),

    'Licenses' => array(
        array(
            'permission' => 'license.b',
            'label'      => 'Browser ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'license.r',
            'label'      => 'Read ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'license.a',
            'label'      => 'Create ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'license.e',
            'label'      => 'Edit  ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'license.d',
            'label'      => 'Delete ',
            'note'       => '',
            'display'    => true,
        ),
    ),

    'Subdomain' => array(
        array(
            'permission' => 'subdomain.b',
            'label'      => 'Browser ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'subdomain.r',
            'label'      => 'Read ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'subdomain.a',
            'label'      => 'Create ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'subdomain.e',
            'label'      => 'Edit  ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'subdomain.d',
            'label'      => 'Delete ',
            'note'       => '',
            'display'    => true,
        ),
    ),

    'IP Address' => array(
        array(
            'permission' => 'ip_address.b',
            'label'      => 'Browser ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'ip_address.r',
            'label'      => 'Read ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'ip_address.a',
            'label'      => 'Create ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'ip_address.e',
            'label'      => 'Edit  ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'ip_address.d',
            'label'      => 'Delete ',
            'note'       => '',
            'display'    => true,
        ),
    ),

    'Application' => array(
        array(
            'permission' => 'application.b',
            'label'      => 'Browser ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'application.r',
            'label'      => 'Read ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'application.a',
            'label'      => 'Create ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'application.e',
            'label'      => 'Edit  ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'application.d',
            'label'      => 'Delete ',
            'note'       => '',
            'display'    => true,
        ),
    ),

    'Server' => array(
        array(
            'permission' => 'server.b',
            'label'      => 'Browser ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'server.r',
            'label'      => 'Read ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'server.a',
            'label'      => 'Create ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'server.e',
            'label'      => 'Edit  ',
            'note'       => '',
            'display'    => true,
        ),
        array(
            'permission' => 'server.d',
            'label'      => 'Delete ',
            'note'       => '',
            'display'    => true,
        ),
    ),
);
